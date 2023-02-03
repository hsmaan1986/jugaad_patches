<?php

namespace Drupal\ln_c_ip_locator\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for ln_c_ip_locator.
 */
class IPCountryHeaderForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'geolocation_country_code';
  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['country_code_header.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('country_code_header.settings');

    $form['cdn_country_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CDN Country Code Attribute'),
      '#description' => $this->t('Once you add site domain on CDN service provider site. On your website http header you will get country code attribute.'),
      '#default_value' => $config->get('cdn_country_code') ?? '',
      '#attributes' => ['placeholder' => ['CDN Country Code Attribute']],
      '#size' => 50,
      '#maxlength' => 15,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('country_code_header.settings')
      ->set('cdn_country_code', $form_state->getValue('cdn_country_code'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
