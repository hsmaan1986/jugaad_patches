<?php
/**
 * @file
 * Definition of Drupal\nhsc_bazaarvoice\Plugin\Field\FieldFormatter\BazaarvoiceDefaultFormatter.
 */

namespace Drupal\nhsc_bazaarvoice\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal;

/**
 * Plugin implementation of the 'nhsc_bazaarvoice' formatter.
 *
 * @FieldFormatter(
 *   id = "bazaarvoice_review",
 *   module = "nhsc_bazaarvoice",
 *   label = @Translation("Bazaarvoice Reviews"),
 *   field_types = {
 *     "bazaarvoice_product_id"
 *   }
 * )
 */
class BazaarvoiceReviewFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
   $summary = array();
   $settings = $this->getSettings();

   $summary[] = t('Displays Bazaarvoice user reviews');

   return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = array();

    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $element[$delta] = array(
        '#type' => 'html',
        '#theme' => 'bazaarvoice_product_review',
        '#product_id' => Xss::filter($item->value),
      );
    }

    return $element;
  }
}
