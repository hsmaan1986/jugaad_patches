<?php


namespace Drupal\schema_faq_page\Plugin\metatag\Tag;


use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;
use Drupal\schema_metatag\SchemaMetatagManager;

class FAQPageMainEntityBase extends SchemaNameBase
{
    use FAQPageMainEntityTrait;


    /**
     * Allowed action types.
     *
     * @var array
     */
    protected $actionTypes;

    /**
     * Allowed actions.
     *
     * @var array
     */
    protected $actions;

    /**
     * {@inheritdoc}
     */
    public function __construct(array $configuration, $plugin_id, array $plugin_definition) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->actionTypes = [];
        $this->actions = [];
    }

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
            'actionTypes' => $this->actionTypes,
            'actions' => $this->actions,
        ];

        $form = $this->mainEntityForm($input_values);

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
        $keys = self::mainEntityFormKeys();
        foreach ($keys as $key) {
            switch ($key) {
                case '@type':
                    $items[$key] = 'Answer';
                    break;

                case 'text':
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