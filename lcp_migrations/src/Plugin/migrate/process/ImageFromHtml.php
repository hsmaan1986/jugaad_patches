<?php

namespace Drupal\lcp_migrations\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines content type name based on Path.
 *
 * @MigrateProcessPlugin(
 *   id = "image_from_html"
 * )
 */
class ImageFromHtml extends ProcessPluginBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $migrationHelper) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->migrationHelper = $migrationHelper;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('lcp_migrations.migrations_helper')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $value = stripcslashes($value);

    if ($file = $this->migrationHelper->createReusableMediaFromImageTag($value)) {
      return $file->id();
    }
    return NULL;
  }

}
