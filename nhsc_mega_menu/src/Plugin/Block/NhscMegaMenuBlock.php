<?php

namespace Drupal\nhsc_mega_menu\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\file\Entity\File;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'NhscMegaMenuBlock' block.
 *
 * @Block(
 *  id = "nhsc_mega_menu_block",
 *  admin_label = @Translation("NHSc Mega Menu block"),
 * )
 */
class NhscMegaMenuBlock extends BlockBase implements ContainerFactoryPluginInterface {
  /**
   * Drupal Configuration.
   *
   * @var Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $configFactory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->configFactory->get('nhsc_mega_menu.config');
    $langCode = \Drupal::languageManager()->getCurrentLanguage()->getId();

    $configSettings = [
      'menu_item_name' => ($config->get('nhsc_mega_menu_name')) ? $config->get('nhsc_mega_menu_name') : $config->get('content_types'),
      'menu_content_type' => $config->get('content_types'),
      'menu_item_url' => ($config->get('nhsc_mega_menu_url')) ? $config->get('nhsc_mega_menu_url') : '#',
      'mega_menu_filter_name' => $config->get('mega_menu_filter_name'),
      'mega_menu_choose_name' => $config->get('mega_menu_choose_name'),
      'mega_menu_filter_for' => $config->get('mega_menu_filter_for'),
      'mega_menu_submit' => $config->get('mega_menu_submit'),
      'mega_menu_reset' => $config->get('mega_menu_reset'),
      'configure_menu' => ($config->get('configure_menu')) ? $config->get('configure_menu') : 'show_menu',
      'show_hide_filters' => ($config->get('show_hide_filters')) ? $config->get('show_hide_filters') : 'show_filters',
      'mega_menu_back_text' => ($config->get('mega_menu_back_text')) ? $config->get('mega_menu_back_text') : t('Back'),
      'sort_menu_items_by' => $config->get('sort_menu_items_by'),
    ];

    if ($configSettings['configure_menu'] == 'show_menu') {

      $filter_terms_list = \Drupal::entityTypeManager()
        ->getStorage('taxonomy_term')
        ->loadTree('marcas_menu_filters');

      $nids = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type', $configSettings['menu_content_type'])
        ->condition('field_product_image', '', '<>')
        ->condition('field_filtrar_por', '', '<>')
        ->condition('langcode', $langCode)
        ->execute();

      $nodes = Node::loadMultiple($nids);

      $sort_value = '';
      if (!empty($configSettings['sort_menu_items_by'])){
        $sort_value = $configSettings['sort_menu_items_by'] == 'select_weight' ? 'field_weight': 'title';
      }

      if ($sort_value != '') {
        $nids = \Drupal::entityQuery('node')
          ->condition('status', 1)
          ->condition('type', $configSettings['menu_content_type'])
          ->condition('field_product_image', '', '<>')
          ->condition('field_filtrar_por', '', '<>')
          ->condition('langcode', $langCode)
          ->sort($sort_value, 'ASC')
          ->execute();

        $nodes = Node::loadMultiple($nids);
      }

      $filter_terms = [];
      foreach ($filter_terms_list as $term) {

        if ($langCode == $term->langcode) {

          $filter_terms[] = [
            'term_id' => $term->tid,
            'term_name' => $term->name,
          ];

        }

      }

      $image = [];
      $activeFilterTerms = [];
      $selectedTerms = '';
      $data = [];
      foreach ($nodes as $item) {

        if ($item->hasField('field_product_image')) {

          $temp_image = $item->get('field_product_image')->first()->getValue();
          $image_alt = $temp_image['alt'];
          $image_title = $temp_image['title'];
          $image_target_id = $temp_image['target_id'];

          $file = File::load($image_target_id);
          $file_url = $file->createFileUrl(FALSE);

          $image = [
            'alt' => $image_alt,
            'title' => $image_title,
            'url' => $file_url,
          ];

        }

        if($item->hasField('field_brand_link')) {

          if ($item->get('field_brand_link')->first()->getValue()) {

            $node_field_link = $item->get('field_brand_link')->first();
            $brandUrl = $node_field_link->getUrl()->toString();

          }

        } else {
          $brandUrl = '/node/' . $item->id();
        }

        if ($item->hasField('field_filtrar_por')) {

          $selectedTerms = $item->get('field_filtrar_por')->getString();
          $field_filtrar_por = $item->get('field_filtrar_por')->getValue();

          foreach ($field_filtrar_por as $filter) {

            $term = Term::load($filter['target_id']);
            $translated_term = \Drupal::service('entity.repository')->getTranslationFromContext($term, $langCode);
            $name = $translated_term->getName();

            $activeFilterTerms[$filter['target_id']] = [
              'term_id' => $filter['target_id'],
              'term_name' => $name,
            ];
          }
        }

        $data[] = [
          'id' => $item->id(),
          'image' => $image,
          'brand_url' => $brandUrl,
          'filter_id' => $selectedTerms,
        ];
      }

      usort($activeFilterTerms, function($a, $b) {
        return $a['term_name'] <=> $b['term_name'];
      });

      return [
        '#theme' => 'nhsc_mega_menu_block',
        '#filters' => $activeFilterTerms,
        '#data' => $data,
        '#config_settings' => $configSettings,
      ];

    } else {
      return [
        '#theme' => 'nhsc_mega_menu_block',
        '#config_settings' => $configSettings,
      ];
    }

  }

  /**
   * Creates an instance of the plugin.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container to pull out services used in the plugin.
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   *
   * @return static
   *   Returns an instance of this plugin.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory')
    );
  }

}
