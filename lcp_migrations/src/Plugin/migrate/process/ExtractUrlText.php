<?php

namespace Drupal\lcp_migrations\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use DOMDocument;

/**
 * Defines content type name based on Path.
 *
 * @MigrateProcessPlugin(
 *   id = "extract_url_text",
 *   handle_multiples = TRUE
 * )
 */
class ExtractUrlText extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $output = [];
    if (!empty($value)) {
      $dom = new DomDocument();
      $dom->loadHTML($value);
      foreach ($dom->getElementsByTagName('a') as $item) {
        $output[] = $item->nodeValue;
      }
    }
    return $output;
  }

}
