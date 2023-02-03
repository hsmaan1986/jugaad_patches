<?php

/**
 * @file
 * Contains \Drupal\nhsc_bazaarvoice\Plugin\Field\FieldWidget\BazaarvoiceDefaultWidget.
 */

namespace Drupal\nhsc_bazaarvoice\Plugin\Field\FieldWidget;

use Drupal;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'bazaarvoice_default' widget.
 *
 * @FieldWidget(
 *   id = "bazaarvoice_default",
 *   label = @Translation("Product ID"),
 *   field_types = {
 *     "bazaarvoice_product_id"
 *   }
 * )
 */
class BazaarvoiceDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'size' => '50',
      'placeholder' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';

    $element['value'] = $element + array(
      '#type' => 'textfield',
      '#default_value' => $value,
      '#size' => $this->getSetting('size'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#maxlength' => 255,
    );

    return $element;
  }
}
