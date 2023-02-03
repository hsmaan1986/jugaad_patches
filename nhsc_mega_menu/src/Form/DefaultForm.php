<?php

namespace Drupal\nhsc_mega_menu\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\NodeType;

/**
 * Class DefaultForm.
 */
class DefaultForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nhsc_mega_menu.config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'default_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('nhsc_mega_menu.config');
    $node_types = NodeType::loadMultiple();

    $options = [];
    foreach ($node_types as $node_type) {
      $options[$node_type->id()] = $node_type->label();
    }

    $form['configure_menu'] = [
      '#type' => 'select',
      '#title' => $this->t('Hide / Show Menu Configuration'),
      '#options' => [
        '' => $this->t('-- Please select --'),
        'show_menu' => $this->t('Configure Menu'),
        'hide_menu' => $this->t('Hide Menu'),
      ],
      '#default_value' => $config->get('configure_menu'),
      '#required' => TRUE,
    ];

    $form['content_types'] = array(
      '#type' => 'select',
      '#title' => t('Select a content type'),
      '#options' => $options,
      '#description' => t('Select a one or more content type.'),
      '#default_value' => $config->get('content_types'),
      '#required' => TRUE,
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    );

    $form['sort_menu_items_by'] = [
      '#type' => 'select',
      '#title' => t('Sort Menu Items by'),
      '#options' => [
        '' => $this->t('-- Please select --'),
        'select_weight' => $this->t('Weight'),
        'select_alphabet' => $this->t('Alphabet'),
      ],
      '#description' => t('Sort menu items by Weight or Alphabet.'),
      '#default_value' => $config->get('sort_menu_items_by'),
    ];

    $form['nhsc_mega_menu_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Overwrite Content Type Name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#description' => t('This uses the content type name, overwrite the menu item with this field. E.g. Overwrite "Brand" to "NHSc Brands" on the menu item'),
      '#default_value' => $config->get('nhsc_mega_menu_name'),
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['nhsc_mega_menu_url'] = [
      '#type' => 'url',
      '#title' => $this->t('NHSc Mega Menu URL'),
      '#default_value' => $config->get('nhsc_mega_menu_url'),
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['mega_menu_filter_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filter brands label text'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => TRUE,
      '#description' => t('Filter brands for:'),
      '#default_value' => $config->get('mega_menu_filter_name'),
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['mega_menu_choose_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Choose Therapie label text'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => TRUE,
      '#description' => t('Choose Therapie'),
      '#default_value' => $config->get('mega_menu_choose_name'),
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['mega_menu_filter_for'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filtrar Por label text'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => TRUE,
      '#description' => t('Filtrar Por'),
      '#default_value' => $config->get('mega_menu_filter_for'),
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['show_hide_filters'] = [
      '#type' => 'select',
      '#title' => $this->t('Show / Hide Brands Filter'),
      '#options' => [
        '' => $this->t('-- Please select --'),
        'show_filters' => $this->t('Show Brand Filters'),
        'hide_filters' => $this->t('Hide Brand Filters'),
      ],
      '#default_value' => $config->get('show_hide_filters'),
      '#required' => TRUE,
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['mega_menu_submit'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filter Submit Text'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => TRUE,
      '#default_value' => $config->get('mega_menu_submit'),
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['mega_menu_reset'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filter Reset Text'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => TRUE,
      '#default_value' => $config->get('mega_menu_reset'),
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['mega_menu_back_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Back Text'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => TRUE,
      '#default_value' => $config->get('mega_menu_back_text'),
      '#states' => [
        'visible' => [
          ':input[name="configure_menu"]' => array('value' => 'show_menu'),
        ],
      ],
    ];

    $form['mega_menu_position'] = [
      '#type' => 'number',
      '#title' => $this->t('Menu Position'),
      '#default_value' => $config->get('mega_menu_position'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('nhsc_mega_menu.config')
      ->set('configure_menu', $form_state->getValue('configure_menu'))
      ->set('show_hide_filters', $form_state->getValue('show_hide_filters'))
      ->set('content_types', $form_state->getValue('content_types'))
      ->set('nhsc_mega_menu_name', $form_state->getValue('nhsc_mega_menu_name'))
      ->set('nhsc_mega_menu_url', $form_state->getValue('nhsc_mega_menu_url'))
      ->set('mega_menu_filter_name', $form_state->getValue('mega_menu_filter_name'))
      ->set('mega_menu_choose_name', $form_state->getValue('mega_menu_choose_name'))
      ->set('mega_menu_filter_for', $form_state->getValue('mega_menu_filter_for'))
      ->set('mega_menu_submit', $form_state->getValue('mega_menu_submit'))
      ->set('mega_menu_reset', $form_state->getValue('mega_menu_reset'))
      ->set('mega_menu_back_text', $form_state->getValue('mega_menu_back_text'))
      ->set('mega_menu_position', $form_state->getValue('mega_menu_position'))
      ->set('sort_menu_items_by', $form_state->getValue('sort_menu_items_by'))
      ->save();

      \Drupal::messenger()->addMessage('Settings Saved Succesfully');
  }

}
