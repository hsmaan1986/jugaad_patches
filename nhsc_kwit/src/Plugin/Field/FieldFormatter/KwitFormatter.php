<?php
/**
 * @file Contains
 *   \Drupal\nhs_kwit\Plugin\Field\FieldFormatter\KwitFormatter.
 */

namespace Drupal\nhsc_kwit\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\nhsc_kwit\Controller\KwitController;

/**
 * Plugin implementation of the 'field_kwit' formatter.
 *
 * @FieldFormatter(
 *   id = "kwit_formatter",
 *   module = "nhsc_kwit",
 *   label = @Translation("Kwit button formatter"),
 *   field_types = {
 *     "field_kwit"
 *   }
 * )
 */
class KwitFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    $html_id = 'kwit-'.rand(0, 999999);
    $controller = new KwitController();

    $brand_widget_id = $controller->getConfigs('brand_widget_id');

    $kwit_template = [
        '#theme' => 'kwitbutton',
        '#html_id' => $html_id,
        '#brand_id' => $brand_widget_id,
    ];
    $markup = \Drupal::service('renderer')->render($kwit_template);
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#markup' => $markup,
        '#values' => [
          'kwit_id' => $item->value,
          'html_id' => $html_id,
        ],
      ];
    }
    return $element;
  }

}
