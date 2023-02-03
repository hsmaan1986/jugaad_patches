<?php
/**
 * @file Contains \Drupal\nhsc_kwit\Plugin\Field\FieldType\Kwit.
 */

namespace Drupal\nhsc_kwit\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'kwit' field type.
 *
 * @FieldType(
 *   id = "field_kwit",
 *   label = @Translation("Kwit Button"),
 *   module = "nhsc_kwit",
 *   description = @Translation("Introduce the lightbox id to display a Kwit Buynow button."),
 *   category = @Translation("General"),
 *   default_widget = "kwit_widget",
 *   default_formatter = "kwit_formatter"
 * )
 */
class Kwit extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('kwit button'));

    return $properties;
  }

}
