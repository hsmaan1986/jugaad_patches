<?php

namespace Drupal\schema_faq_page\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaPivotTrait;
use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org Image trait.
 */
trait SchemaAcceptedAnswerTrait {

    use SchemaPivotTrait;
  /**
   * Form keys.
   */
  public static function answerFormKeys() {
    return [
      '@type',
      'text',
    ];
  }

  /**
   * The form element.
   */
  public function answerForm($input_values) {

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
              'Answer' => $this->t('Answer'),
          ],
          '#required' => $input_values['#required'],
          '#weight' => -10,
      ];


    $form['text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Accepted answer'),
      '#empty_value' => '',
      '#default_value' => !empty($value['text']) ? $value['text'] : '',
      '#required' => $input_values['#required'],
      '#description' => $this->t('Accepted answer'),
    ];

    $keys = static::answerFormKeys();
    foreach ($keys as $key) {
      if ($key != '@type') {
        $form[$key]['#states'] = $visibility;
      }
    }

    return $form;
  }

}
