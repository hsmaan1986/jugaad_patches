<?php

namespace Drupal\nhsc_protein_calculator\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My nhsc_protein_calculator basic settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nhsc_protein_calculator_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nhsc_protein_calculator.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('nhsc_protein_calculator.settings');

    $form['settings'] = [
      '#type'  => 'details',
      '#open'  => TRUE,
      '#title' => $this->t('Settings'),
    ];

    $form['about_yourself'] = [
      '#type' => 'fieldset',
      '#title' => t('About yourself'),
      '#group' => 'settings',
    ];

    $form['about_yourself']['heading'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Heading (about yourself)'),
      '#default_value' => $config->get('heading'),
    ];

    $form['about_yourself']['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description (about yourself)'),
      '#default_value' => $config->get('description'),
    ];

    $form['how_active'] = [
      '#type' => 'fieldset',
      '#title' => t('How active are you?'),
      '#group' => 'settings',
    ];

    $form['how_active']['heading_active'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Heading (How active are you?)'),
      '#default_value' => $config->get('heading'),
    ];

    $form['how_active']['description_active'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description (How active are you?)'),
      '#default_value' => $config->get('description'),
    ];

    $form['results'] = [
      '#type' => 'fieldset',
      '#title' => t('Results'),
      '#group' => 'settings',
    ];

    $form['results']['read_more'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Results Read More Title'),
      '#default_value' => $config->get('read_more'),
    ];

    $form['results']['read_more_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Results Read More URL'),
      '#default_value' => $config->get('read_more_url'),
    ];

    $form['results']['results_heading'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Results Heading'),
      '#default_value' => $config->get('results_heading'),
    ];

    $form['results']['results_measurement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Results Measurement'),
      '#default_value' => $config->get('results_measurement'),
    ];

    $form['results']['results_body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Results Body'),
      '#default_value' => $config->get('results_body'),
    ];

    $form['units'] = [
      '#type' => 'fieldset',
      '#title' => t('Units'),
      '#group' => 'settings',
    ];

    $form['units']['us_units'] = [
      '#type' => 'textfield',
      '#title' => t('US Units'),
      '#description' => t('Use US based units feet, inches, and pounds'),
      '#default_value' => $config->get('us_units'),
      '#required' => true,
    ];

    $form['units']['metric_units'] = [
      '#type' => 'textfield',
      '#title' => t('Metric Units'),
      '#description' => t('Use US based units centimeters, and kilograms'),
      '#default_value' => $config->get('metric_units'),
      '#required' => true,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->configFactory->getEditable('nhsc_protein_calculator.settings');

    // Save configurations.
    $config->set('heading', $form_state->getValue('heading'))->save();
    $config->set('description', $form_state->getValue('description'))->save();
    $config->set('heading_active', $form_state->getValue('heading_active'))->save();
    $config->set('description_active', $form_state->getValue('description_active'))->save();
    $config->set('read_more', $form_state->getValue('read_more'))->save();
    $config->set('read_more_url', $form_state->getValue('read_more_url'))->save();
    $config->set('results_heading', $form_state->getValue('results_heading'))->save();
    $config->set('results_measurement', $form_state->getValue('results_measurement'))->save();
    $config->set('results_body', $form_state->getValue('results_body'))->save();
    $config->set('us_units', $form_state->getValue('us_units'))->save();
    $config->set('metric_units', $form_state->getValue('metric_units'))->save();

    \Drupal::messenger()->addMessage('Settings Saved Succesfully');

  }

}
