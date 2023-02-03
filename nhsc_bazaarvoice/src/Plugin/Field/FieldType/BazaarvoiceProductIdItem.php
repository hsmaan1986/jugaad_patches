<?php
/**
 * @file
 * Contains \Drupal\nhsc_bazaarvoice\Plugin\Field\FieldType\BazaarvoiceProductIdItem.
 */

namespace Drupal\nhsc_bazaarvoice\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Plugin implementation of the 'nhsc_bazaarvoice' field type.
 *
 * @FieldType(
 *   id = "bazaarvoice_product_id",
 *   label = @Translation("Bazaarvoice Product ID"),
 *   description = @Translation("The ID of a product listed on Bazaarvoice"),
 *   category = @Translation("Bazaarvoice"),
 *   default_widget = "bazaarvoice_default",
 *   default_formatter = "bazaarvoice_review"
 * )
 */
class BazaarvoiceProductIdItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'varchar',
          'length' => 50,
          'not null' => FALSE,
        ),
      ),
    );
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
  public function getConstraints() {
    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
    $constraints = parent::getConstraints();
    $constraints[] = $constraint_manager->create('ComplexData', array(
      'value' => array(
        'Length' => array(
          'max' => 50,
          'maxMessage' => t('%name: the product ID may not be longer than @max characters.', array('%name' => $this->getFieldDefinition()->getLabel(), '@max' => 32)),
        )
      ),
    ));
    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Product ID'));
    return $properties;
  }
}
