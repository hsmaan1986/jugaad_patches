<?php

namespace Drupal\lcp_migrations\Plugin\migrate\source;

use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate_plus\Plugin\migrate\source\Url;
use Drupal\migrate\Row;

/**
 * Source plugin for retrieving data via URLs.
 *
 * @MigrateSource(
 *   id = "json_parser_multiple"
 * )
 */
class JsonParserMultiple extends Url {
  protected $dataNewParserPlugin;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration) {
    $filter_path = $configuration['filter_path'] ?? NULL;
    if (!empty($configuration['filename'])) {
      $configuration['urls'] = $this->getDynamicUrl($configuration['filename']);
    }
    else {
      $configuration['urls'] = $this->getUrls($migration->id(), $configuration['content_type'], $filter_path);
    }
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);
  }

  /**
   * {@inheritdoc}
   */
  protected function getUrls($migration_id, $content_type, $filter_path = NULL) {
    $migrations_helper = \Drupal::service("lcp_migrations.migrations_helper");
    return $migrations_helper->getSourceUrls($migration_id, $content_type, $filter_path);
  }

  /**
   * Helper function for dynamic url.
   */
  protected function getDynamicUrl($settings) {
    $migrations_helper = \Drupal::service("lcp_migrations.migrations_helper");
    return $migrations_helper->getSourceFullPath() . '/' . $settings . '.json';
  }

  /**
   * {@inheritdoc}
   */
  protected function fetchNextRow() {
    $this->getIterator()->next();
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    // Fix unwanted titles.
    if ($row->getSourceProperty('html_title') == '<br />') {
      $row->setSourceProperty('html_title', NULL);
    }
    // SEO metatags fields to be applied across all content types.
    $metatags = [];
    if ($keywords = $row->getSourceProperty('seo_keywords')) {
      $metatags['keywords'] = $keywords;
    }
    if ($description = $row->getSourceProperty('seo_description')) {
      $metatags['description'] = $description;
    }
    if ($canonical_url = $row->getSourceProperty('seo_canonical_url')) {
      $metatags['canonical_url'] = $canonical_url;
    }
    if ($row->getSourceProperty('seo_noindex') == 'True') {
      $metatags['robots'] = 'noindex';
    }
    // Set Twitter cards metatags.
    if ($image = $row->getSourceProperty('twitter_image')) {
      $migrations_helper = \Drupal::service("lcp_migrations.migrations_helper");
      if ($file = $migrations_helper->createReusableMediaFromImageTag($image)) {
        $metatags['twitter_cards_image'] = file_create_url($file->getFileUri());
      }
    }
    if ($description = $row->getSourceProperty('twitter_description')) {
      $metatags['twitter_cards_description'] = $description;
    }
    if (isset($metatags['twitter_cards_description']) || isset($metatags['twitter_cards_image'])) {
      $metatags['twitter_cards_type'] = 'summary';
    }

    if (!empty($metatags)) {
      $metatags = serialize($metatags);
      $row->setSourceProperty('metatags', $metatags);
    }

    // Set Scheduled Transition Date && State.
    $scheduled_transitions = [];
    if ($publishing_date = $row->getSourceProperty('publishing_start_date')) {
      $scheduled_transitions['published'] = date('Y-m-d\TH:i:s', strtotime($publishing_date));
    }
    if ($expiration_date = $row->getSourceProperty('publishing_expiration_date')) {
      $scheduled_transitions['draft'] = date('Y-m-d\TH:i:s', strtotime($expiration_date));
    }
    if (!empty($scheduled_transitions)) {
      $row->setSourceProperty('transition_dates', array_values($scheduled_transitions));
      $row->setSourceProperty('transition_states', array_keys($scheduled_transitions));
    }
    $moderation_state = 'published';
    if (!empty($expiration_date)) {
      if (strtotime($expiration_date) < time()) {
        $moderation_state = 'draft';
      }
    }
    $row->setSourceProperty('moderation_state', $moderation_state);

    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return parent::fields() + [
      'metatags' => $this->t('Metatags'),
      'moderation_state' => $this->t('Moderation State'),
      'transition_dates' => $this->t('Transition Dates'),
      'transition_states' => $this->t('Transition States'),
    ];
  }

}
