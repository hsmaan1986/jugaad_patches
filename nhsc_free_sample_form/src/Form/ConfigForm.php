<?php

namespace Drupal\nhsc_free_sample_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\options\Plugin\Field\FieldType;
use Drupal\options\Plugin\Field\FieldType\ListStringItem;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
 
/**
 * Class questionboxApplySettings.
 *
 * @package Drupal\nhsc_free_sample_form\Form
 */
class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nhsc_free_sample_form.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nhsc_free_sample_form_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('nhsc_free_sample_form.settings');
    
    $form['nhsc_form_fieldset'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Webform Configuration Settings'),
      '#prefix' => "<div id='nhsc-form-fieldset-wrapper'>",
      '#suffix' => '</div>',
    ];
    
    $form['nhsc_form_fieldset']['webform_key'] = [
        '#type' => 'textfield',
        '#title' => $this->t('WebForm Machine Name'),
        '#description' => $this->t('Add your Webform Machine name here.'),
        '#default_value' => $config->get('webform_key'),
      ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
        // Retrieve the configuration
    $this->config('nhsc_free_sample_form.settings')
      // Set the submitted configuration setting
      ->set('webform_key', $form_state->getValue('webform_key'))
      // You can set multiple configurations at once by making
      // multiple calls to set()
      ->save();

    parent::submitForm($form, $form_state);

  }

}
