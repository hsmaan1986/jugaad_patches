<?php


namespace Drupal\schema_multiple_products\Plugin\metatag\Tag;


use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaPivotTrait;
use Drupal\schema_metatag\SchemaMetatagManager;

trait SchemaMultipleProductsListItemTrait
{
    use SchemaPivotTrait;

    /**
     * Form keys.
     */
    public static function breadListFormKeys() {
        return [
            '@type',
            'position',
            'name',
            'item'
        ];
    }

    /**
     * The form element.
     */
    public function breadListForm ($input_values) {

        $input_values += SchemaMetatagManager::defaultInputValues();
        $value = $input_values['value'];
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
                'ListItem' => $this->t('ListItem'),
            ],
            '#required' => $input_values['#required'],
            '#weight' => -10,
        ];

        $form['position'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Position'),
            '#empty_value' => '',
            '#default_value' => !empty($value['position']) ? $value['position'] : '',
            '#required' => $input_values['#required'],
        ];

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#empty_value' => '',
            '#default_value' => !empty($value['name']) ? $value['name'] : '',
            '#required' => $input_values['#required'],
        ];

        $form['item'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Item'),
            '#empty_value' => '',
            '#default_value' => !empty($value['item']) ? $value['item'] : '',
            '#required' => $input_values['#required'],
        ];

        $keys = static::breadlistFormKeys();
        foreach ($keys as $key) {
            if ($key != '@type') {
                $form[$key]['#states'] = $visibility;
            }
        }

        return $form;
    }
}