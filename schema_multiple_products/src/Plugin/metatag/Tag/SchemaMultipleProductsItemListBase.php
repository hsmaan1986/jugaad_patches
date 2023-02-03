<?php


namespace Drupal\schema_multiple_products\Plugin\metatag\Tag;


use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;
use Drupal\schema_metatag\SchemaMetatagManager;


class SchemaMultipleProductsItemListBase extends SchemaNameBase
{
    use SchemaMultipleProductsListItemTrait;


    /**
     * {@inheritdoc}
     */
    public function form(array $element = []) {

        $value = SchemaMetatagManager::unserialize($this->value());

        $input_values = [
            'title' => $this->label(),
            'description' => $this->description(),
            'value' => $value,
            '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
            'visibility_selector' => $this->visibilitySelector(),
        ];

        $form = $this->breadListForm($input_values);

        if (empty($this->multiple())) {
            unset($form['pivot']);
        }

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public static function testValue()
    {
        $items = [];
        $keys = self::breadListFormKeys();
        foreach ($keys as $key) {
            switch ($key) {
                case '@type':
                    $items[$key] = 'ListItem';
                    break;

                case 'position':
                    $items[$key] = '1';
                    break;
                case 'name':
                    $items[$key] = 'Test';
                    break;
                case 'item':
                    $items[$key] = 'www.test.com';
                    break;

                default:
                    $items[$key] = parent::testDefaultValue(1, '');
                    break;

            }
        }
        return $items;
    }

}