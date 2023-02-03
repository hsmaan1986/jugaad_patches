<?php

namespace Drupal\schema_medical_condition\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaPivotTrait;
use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org Image trait.
 */
trait SchemaMedicalConditionRiskFactorTrait {

    use SchemaPivotTrait;
  /**
   * Form keys.
   */
  public static function imageFormKeys() {
    return [
      '@type',
      'name',
    ];
  }

  /**
   * The form element.
   */
  public function imageForm($input_values) {

    $input_values += SchemaMetatagManager::defaultInputValues();
    $value = $input_values['value'];

    // Get the id for the nested @type element.
    $selector = ':input[name="' . $input_values['visibility_selector'] . '[@type]"]';
    $visibility = ['invisible' => [$selector => ['value' => '']]];
    $selector2 = SchemaMetatagManager::altSelector($selector);
    $visibility2 = ['invisible' => [$selector2 => ['value' => '']]];
    $visibility['invisible'] = [$visibility['invisible'], $visibility2['invisible']];

    $form['#type'] = 'fieldset';
    $form['#title'] = $input_values['title'];
    $form['#description'] = $input_values['description'];
    $form['#tree'] = TRUE;

    // Add a pivot option to the form.
    $form['pivot'] = $this->pivotForm($value);
    $form['pivot']['#states'] = $visibility;

      $form['@type'] = [
          '#type' => 'select',
          '#title' => $this->t('@type'),
          '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
          '#empty_option' => t('- None -'),
          '#empty_value' => '',
          '#options' => [
              'MedicalRiskFactor' => $this->t('MedicalRiskFactor'),
          ],
          '#required' => $input_values['#required'],
          '#weight' => -10,
      ];


    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#empty_value' => '',
      '#default_value' => !empty($value['name']) ? $value['name'] : '',
      '#required' => $input_values['#required'],
    ];

    $keys = static::imageFormKeys();
    foreach ($keys as $key) {
      if ($key != '@type') {
        $form[$key]['#states'] = $visibility;
      }
    }

    return $form;
  }

}
