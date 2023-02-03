<?php

namespace Drupal\ons_product_selector\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\taxonomy\Entity\Term;
use Drupal\ons_product_selector\ContentSelector;

class OnsProductSettingsForm extends ConfigFormBase
{
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'ons-product-settings-form';
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('ons_product_selector.settings');

    $taxonomyData = (array) $this->options($this->getTaxonomies());

    $form['product_hide'] = [
      '#type' => 'checkbox',
      '#title' => t('Hide products recommendation'),
      '#default_value' => $config->get('ons_product_selector.product_hide')
    ];

    $form['pip_hide'] = [
      '#type' => 'checkbox',
      '#title' => t('Hide PIP code'),
      '#default_value' => $config->get('ons_product_selector.pip_hide'),
    ];
    $form['hide_filters'] = [
      '#type' => 'checkbox',
      '#title' => t('Hide Simple Filters'),
      '#default_value' => $config->get('ons_product_selector.hide_filters')
    ];
    $form['hide_advanced_filters'] = [
      '#type' => 'checkbox',
      '#title' => t('Hide Advanced Filters'),
      '#default_value' => $config->get('ons_product_selector.hide_advanced_filters')
    ];
    $form['disable_compare'] = [
      '#type' => 'checkbox',
      '#title' => t('Disable Compare'),
      '#default_value' => $config->get('ons_product_selector.disable_compare')
    ];
    $form['calc_version'] = [
      '#type' => 'radios',
      '#title' => t('Calculator type'),
      '#options' => ['V1' => t('Calculator V1'), 'V2' => t('Calculator V2'), 'V3' => t('Calculator V3')],
      '#default_value' => $config->get('ons_product_selector.calc_version')
    ];
    $form['prod_info'] = [
      '#type' => 'textarea',
      '#title' => t('Prod Info'),
      '#default_value' => $config->get('ons_product_selector.prod_info'),
    ];
    $form['dri'] = [
      '#type' => 'textarea',
      '#title' => t('DRI'),
      '#default_value' => $config->get('ons_product_selector.dri'),
    ];
    $form['product_order'] = [
      '#type' => 'textarea',
      '#title' => t('Products order by pathology'),
      '#default_value' => $config->get('ons_product_selector.product_order')
    ];
    $form['product_disclaimer'] = [
      '#type' => 'textarea',
      '#title' => t('Product Disclaimer'),
      '#default_value' => $config->get('ons_product_selector.product_disclaimer')
    ];

    $form['pathologies_nutritional'] = [
      '#type' => 'checkboxes',
      '#title' => t('Set pathologies under "nutritional needs" calculator'),
      '#options' => $this->listTaxonomyItems('pathology'),
      '#default_value' => $config->get('ons_product_selector.pathologies_nutritional')
    ];


    /**
     * Filter Form
     */
    $form['filters_form'] = [
      '#type' => 'fieldset',
      '#title' => t('Main Filters'),
      '#prefix' => '<div id="filters-wrapper">',
      '#suffix' => '</div>',
    ];

    $form['filters_form']['select_field'] = [
      '#type' => 'container',
      '#attributes' => ['class' => ['container-inline']]
    ];

    $form['filters_form']['select_field']['search_fields'] = [
      '#type' => 'select',
      '#title' => t('Add Main Search Field'),
      "#empty_option" => t('- Select -'),
      '#options' => $taxonomyData,
      '#default_value' => $config->get('ons_product_selector.search_fields'),
    ];


    $form['filters_form']['select_field']['add_field'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add'),
      '#submit' => ['::ajaxSubmit'],
      '#ajax' => array(
        'callback' => '::addMoreSet',
        'wrapper' => 'filters-wrapper',
      ),
      '#button_type' => 'default',
      '#name' => 'filters_form'
    ];
    $form['filters_form']['filters'] = [
      '#type' => 'table',
      '#tree' => true,
      '#header' => array(t('Filter'),  t('Actions')),
      '#tabledrag' => array(
        array(
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'filters-order-weight',
        ),
      ),
    ];

    $weights = empty($form_state->get('filters')) ? array() : $form_state->get('filters');
    if(empty($weights)) {
      $form_state->set('filters', $config->get('ons_product_selector.filters'));
      $weights = $config->get('ons_product_selector.filters');
    }
    $weights = empty($weights) ? (array) $config->get('ons_product_selector.filters') : $weights;
    uasort($weights, 'Drupal\Component\Utility\SortArray::sortByWeightElement');
    if(!empty($weights)){
      $form['filters_form']['filters']['#header'][] = t('Weight');
      if (count($weights) >= 5) {
        $form['filters_form']['select_field']['add_field']['#disabled']  = true;
      }
    }
    foreach ($weights as $delta => $weight) {
      $form['filters_form']['filters'][$delta]['#attributes']['class'][] = 'draggable';
      $form['filters_form']['filters'][$delta]['#weight'] = isset($weight['weight']) ? $weight['weight'] : 0;


      $form['filters_form']['filters'][$delta]['filter'] = [
        '#plain_text' => empty($weight['filter']['label']) ? $this->getFilterName($weight['filter']['filter_machine_name'], $taxonomyData) : $weight['filter']['label'],
      ];

      $form['filters_form']['filters'][$delta]['filter']['filter_machine_name'] = [
        '#type' => 'hidden',
        '#value' => $weight['filter']['filter_machine_name']
      ];


      $form['filters_form']['filters'][$delta]['delete'] = [
        '#type' => 'submit',
        '#title' => t('Remove'),
        '#name' => 'delete_' . $delta,
        '#value' => 'Remove',
        '#submit' => ['::ajaxSubmit'],
        '#ajax' => [
          'callback' => '::addMoreSet',
          'wrapper' => 'filters-wrapper'
        ]
      ];
      $form['filters_form']['filters'][$delta]['weight'] = [
        '#type' => 'weight',
        '#title' => t('Weight for @title', array('@title' => 'filter')),
        '#title_display' => 'invisible',
        '#attributes' => array('class' => array('filters-order-weight')),
        '#default_value' => isset($weight['weight']) ? $weight['weight'] : 0
      ];
    }


    /**
     * More Filter Form
     */

    $form['more_filters_form'] = [
      '#type' => 'fieldset',
      '#title' => t('More Filters'),
      '#prefix' => '<div id="more-filters-wrapper">',
      '#suffix' => '</div>',
    ];

    $form['more_filters_form']['select_field'] = [
      '#type' => 'container',
      '#attributes' => ['class' => ['container-inline']]
    ];

    $form['more_filters_form']['select_field']['more_search_fields'] = [
      '#type' => 'select',
      '#title' => t('Add More Search Field'),
      "#empty_option" => t('- Select -'),
      '#options' => $taxonomyData,
      // '#default_value' => $config->get('ons_product_selector.search_fields'),
    ];


    $form['more_filters_form']['select_field']['more_add_field'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add'),
      '#submit' => ['::ajaxSubmitMoreFilters'],
      '#ajax' => array(
        'callback' => '::addMoreSetMoreFilters',
        'wrapper' => 'more-filters-wrapper',
      ),
      '#name' => 'more_filters_form',
      '#button_type' => 'default'
    ];

    $form['more_filters_form']['more_filters'] = [
      '#type' => 'table',
      '#tree' => true,
      '#header' => array(t('Filter'),  t('Actions')),
      '#tabledrag' => array(
        array(
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'more-filters-order-weight',
        ),
      ),
    ];

    $weights = '';
    $weights = empty($form_state->get('more-filters')) ? array() : $form_state->get('more-filters');
    uasort($weights, 'Drupal\Component\Utility\SortArray::sortByWeightElement');
    if(empty($weights)) {
      $form_state->set('more-filters', $config->get('ons_product_selector.more_filters'));
      $weights = $config->get('ons_product_selector.more_filters');
    }
    $weights = empty($weights) ? (array) $config->get('ons_product_selector.more_filters') : $weights;

    if (!empty($weights)) {
      $form['more_filters_form']['more_filters']['#header'][] = t('Weight');
      if(count($weights) >= 5){
        $form['more_filters_form']['select_field']['more_add_field']['#disabled']  = true;
      }
    }
    foreach ($weights as $delta => $weight) {
      $form['more_filters_form']['more_filters'][$delta]['#attributes']['class'][] = 'draggable';
      $form['more_filters_form']['more_filters'][$delta]['#weight'] = isset($weight['weight']) ? $weight['weight'] : 0;

      $form['more_filters_form']['more_filters'][$delta]['filter'] = [
        '#plain_text' => empty($weight['filter']['label']) ? $this->getFilterName($weight['filter']['filter_machine_name'], $taxonomyData) : $weight['filter']['label'],
      ];

      $form['more_filters_form']['more_filters'][$delta]['filter']['filter_machine_name'] = [
        '#type' => 'hidden',
        '#value' => $weight['filter']['filter_machine_name']
      ];


      $form['more_filters_form']['more_filters'][$delta]['delete'] = [
        '#type' => 'submit',
        '#title' => t('Remove'),
        '#name' => 'more_delete_' . $delta,
        '#value' => 'Remove',
        '#submit' => ['::ajaxSubmitMoreFilters'],
        '#ajax' => [
          'callback' => '::addMoreSetMoreFilters',
          'wrapper' => 'more-filters-wrapper'
        ]
      ];
      $form['more_filters_form']['more_filters'][$delta]['weight'] = [
        '#type' => 'weight',
        '#title' => t('Weight for @title', array('@title' => 'filter')),
        '#title_display' => 'invisible',
        '#attributes' => array('class' => array('more-filters-order-weight')),
        '#default_value' => isset($weight['weight']) ? $weight['weight'] : 0
      ];
    }

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $dri = $form_state->getValue('dri');
    if (!empty($dri)) {
      $dri = json_decode($dri, true);
      usort($dri, function ($a, $b) {
        return $a['start_age'] > $b['start_age'];
      });
      $dri = json_encode($dri);
    }


    $config = $this->config('ons_product_selector.settings');
    $config->set('ons_product_selector.prod_info', $form_state->getValue('prod_info'));
    $config->set('ons_product_selector.calc_version', $form_state->getValue('calc_version'));
    $config->set('ons_product_selector.dri', $dri);
    $config->set('ons_product_selector.pip_hide', $form_state->getValue('pip_hide'));
    $config->set('ons_product_selector.hide_filters', $form_state->getValue('hide_filters'));
    $config->set('ons_product_selector.hide_advanced_filters', $form_state->getValue('hide_advanced_filters'));
    $config->set('ons_product_selector.disable_compare', $form_state->getValue('disable_compare'));
    $config->set('ons_product_selector.product_hide', $form_state->getValue('product_hide'));
    $config->set('ons_product_selector.product_order', $form_state->getValue('product_order'));
    $config->set('ons_product_selector.product_disclaimer', $form_state->getValue('product_disclaimer'));
    $config->set('ons_product_selector.filters', $form_state->getValue('filters'));
    $config->set('ons_product_selector.more_filters', $form_state->getValue('more_filters'));
    $config->set('ons_product_selector.pathologies_nutritional', $form_state->getValue('pathologies_nutritional'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  protected function getEditableConfigNames()
  {
    return [
      'ons_product_selector.settings',
    ];
  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if (trim($form_state->getValue('prod_info')) != '' && empty(json_decode($form_state->getValue('prod_info'))))
      $form_state->setErrorByName('prod_info', $this->t('Invalid json'));

    if (trim($form_state->getValue('dri')) != '' && empty(json_decode($form_state->getValue('dri'))))
      $form_state->setErrorByName('dri', $this->t('Invalid json'));
  }

  private function options($data)
  {
    $returnTaxonomy = [];
    foreach ($data as $tax) {
      $returnTaxonomy[$tax->id()] = $tax->get('name');
    }
    return $returnTaxonomy;
  }

  private function getFilterName($name, $taxonomies) {
    if(empty($name)) return null;

    return $taxonomies[$name];
  }

  private function getTaxonomies()
  {
    $taxonomies = [];
    $definitions = \Drupal::service('entity_field.manager')->getFieldDefinitions('node', 'ons_product_selector');
    foreach ($definitions as $field) {
      if ($field->getSetting('handler') == 'default:taxonomy_term') {
        $taxonomies[] = $this->getTaxonomyByName($field->getSetting('handler_settings')['target_bundles']);
      }
    }
    return $taxonomies;
  }

  private function getTaxonomyByName($vocabulary_name)
  {
    $vocabs = Vocabulary::loadMultiple();
    foreach ($vocabs as $vocab_obj) {
      if ($vocab_obj->id() == key($vocabulary_name)) {
        return $vocab_obj;
      }
    }
    return NULL;
  }

  private function listTaxonomyItems($vid) {
    $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);
    foreach ($terms as $term) {
      $term_data[$term->tid] = $term->name;
    }
    return $term_data;
  }

  public function addMoreSet(array &$form, FormStateInterface $form_state)
  {
    return $form['filters_form'];
  }

  public function addMoreSetMoreFilters(array &$form, FormStateInterface $form_state)
  {
    return $form['more_filters_form'];
  }

  public function ajaxSubmit(array &$form, FormStateInterface $form_state)
  {
    $weights = empty($form_state->get('filters')) ? array() : $form_state->get('filters');

    $element = $form_state->getTriggeringElement();
    if (isset($element['#parents'][0]) && $element['#parents'][0] == 'add_field') {
      $fieldMachineName = $form_state->getValue('search_fields');
      array_push($weights, [
        'weight' => '',
        'filter' => [
          'filter_machine_name' => $fieldMachineName,
          'label' => $form['filters_form']['select_field']['search_fields']['#options'][$fieldMachineName],
        ]
      ]);
    }
    if (isset($element['#parents'][2]) && $element['#parents'][2] == 'delete') {
      unset($weights[$element['#parents'][1]]);
    }

    $form_state->set('filters', $weights);
    $form_state->setRebuild(TRUE);
  }

  public function ajaxSubmitMoreFilters(array &$form, FormStateInterface $form_state)
  {
    $weights = empty($form_state->get('more-filters')) ? array() : $form_state->get('more-filters');

    $element = $form_state->getTriggeringElement();
    if (isset($element['#parents'][0]) && $element['#parents'][0] == 'more_add_field') {
      $fieldMachineName = $form_state->getValue('more_search_fields');
      array_push($weights, [
        'weight' => '',
        'filter' => [
          'filter_machine_name' => $fieldMachineName,
          'label' => $form['more_filters_form']['select_field']['more_search_fields']['#options'][$fieldMachineName],
        ]
      ]);
    }

    if (isset($element['#parents'][2]) && $element['#parents'][2] == 'delete') {
      unset($weights[$element['#parents'][1]]);
    }

    $form_state->set('more-filters', $weights);
    $form_state->setRebuild(TRUE);
  }

}
