<?php

namespace Drupal\atitude_webmeeting\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ApiSettingsForm.
 */
class ApiSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'atitude_webmeeting.apisettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'api_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('atitude_webmeeting.apisettings');

    $form['endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Endpoint'),
      '#maxlength' => 255,
      '#size' => 64,
      '#default_value' => $config->get('endpoint'),
    ];
    $form['secret_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Secret Key'),
      '#maxlength' => 255,
      '#size' => 64,
      '#default_value' => $config->get('secret_key'),
    ];

    $form['site_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site Key'),
      '#maxlength' => 255,
      '#size' => 64,
      '#default_value' => $config->get('site_key'),
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
    parent::submitForm($form, $form_state);

    $this->config('atitude_webmeeting.apisettings')
      ->set('endpoint', $form_state->getValue('endpoint'))
      ->set('secret_key', $form_state->getValue('secret_key'))
      ->set('site_key', $form_state->getValue('site_key'))
      ->save();
  }

}
