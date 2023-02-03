<?php


namespace Drupal\schema_medical_condition\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;
use Drupal\schema_metatag\SchemaMetatagManager;

class SchemaAssociatedAnatomyBase extends SchemaNameBase
{
    use SchemaAssociatedAnatomyTrait;

    /**
     * {@inheritdoc}
     */
    public function form(array $element = [])
    {

        $value = SchemaMetatagManager::unserialize($this->value());

        $input_values = [
            'title' => $this->label(),
            'description' => $this->description(),
            'value' => SchemaMetatagManager::unserialize($this->value()),
            '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
            'visibility_selector' => $this->visibilitySelector(),
        ];

        $form = $this->imageForm($input_values);

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
        $keys = self::imageFormKeys();
        foreach ($keys as $key) {
            switch ($key) {
                case '@type':
                    $items[$key] = 'AnatomicalSystem';
                    break;

                case 'name':
                    $items[$key] = 'True';
                    break;

                default:
                    $items[$key] = parent::testDefaultValue(1, '');
                    break;

            }
        }
        return $items;
    }
}
