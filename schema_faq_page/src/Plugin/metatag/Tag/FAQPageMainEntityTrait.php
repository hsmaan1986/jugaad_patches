<?php

namespace Drupal\schema_faq_page\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaImageTrait;
use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaPivotTrait;
use Drupal\schema_metatag\SchemaMetatagManager;

trait FAQPageMainEntityTrait
{
    use SchemaAcceptedAnswerTrait, SchemaPivotTrait{
        SchemaPivotTrait::pivotForm insteadof SchemaAcceptedAnswerTrait;
    }


    /**
     * Form keys.
     */
    public static function mainEntityFormKeys() {
        return [
            '@type',
            'name',
            'acceptedAnswer',
        ];
    }

    /**
     * The form element.
     */
    public function mainEntityForm($input_values) {

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
                'Question' => $this->t('Question'),
            ],
            '#required' => $input_values['#required'],
            '#weight' => -10,
        ];

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('name'),
            '#default_value' => !empty($value['name']) ? $value['name'] : '',

            '#required' => $input_values['#required'],
            '#weight' => -10,
        ];


        $input_values = [
            'title' => $this->t('Answer'),
            'value' => !empty($value['answer']) ? $value['answer'] : [],
            '#required' => $input_values['#required'],
            'visibility_selector' => $input_values['visibility_selector'] . '[answer]',
        ];

        // Display accepted answer form
        $form['acceptedAnswer'] = $this->answerForm($input_values);

        $keys = static::mainEntityFormKeys();
        foreach ($keys as $key) {
            if ($key != '@type') {
                $form[$key]['#states'] = $visibility;
            }
        }

        return $form;
    }
}