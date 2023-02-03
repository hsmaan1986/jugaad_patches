<?php

namespace Drupal\ln_c_ip_locator\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a popup block configurations form.
 */
class PopUpBlockConfForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ln_c_ip_locator.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'popup_blockform_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /**
     * Fixes image upload bug in form. Deos not work unless we disable the cache while using PrivateTempStore
     */
    $form_state->disableCache();

    $country_popup_configs = $this->config('ln_c_ip_locator.settings')->get('country_popup_configs');
    $popup_modal_logo = $this->config('ln_c_ip_locator.settings')->get('modal_popup_block_logo') ?? [];
    $enabled_countries = $this->configFactory->get('geolocation.settings')->get('country_based_configurations');

    $form['modal_popup_block_logo'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Popup Block Modal Logo'),
      '#name' => 'modal_popup_block_logo',
      '#description' => $this->t('Allowed extensions: png, jpg, jpeg'),
      '#default_value' => $popup_modal_logo,
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_is_image' => [],
        'file_validate_extensions' => ['png jpg jpeg'],
        'file_validate_size' => [0.3*1024*1024],
      ],
    ];

    if (!empty($enabled_countries)) {
      foreach ($enabled_countries as $country_code => $config) {
        $form[$country_code . '_container'] = [
          '#type' => 'details',
          '#open' => FALSE,
          '#title' => 'Popup config for ' . $country_code,
          '#description' => $this->t('Popup config for @country', ['@country' => $country_code]),
        ];

        $form[$country_code . '_container'][$country_code . '-body'] = [
          '#type' => 'text_format',
          '#title' => 'Body',
          '#format' => 'rich_text',
          '#default_value' => !empty($country_popup_configs[$country_code]) && (isset($country_popup_configs[$country_code]['body']['value']) && !empty($country_popup_configs[$country_code]['body']['value'])) ? $country_popup_configs[$country_code]['body']['value'] : $this->t("<p>You will be redirected to your home country\'s Nestle website soon.</p>"),
          '#description' => $this->t('Content user sees in the popup.'),
          '#required' => TRUE,
        ];

        $form[$country_code . '_container'][$country_code . '-cookie_validity'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Cookie validation limit.'),
          '#description' => $this->t('Number of days of value of the cookie (Defaults to 90 days).'),
          '#default_value' => !empty($country_popup_configs[$country_code]) && (isset($country_popup_configs[$country_code]['cookie_validity']) && !empty($country_popup_configs[$country_code]['cookie_validity'])) ? $country_popup_configs[$country_code]['cookie_validity'] : '+90 days',
        ];

        $form[$country_code . '_container'][$country_code . '-btn_label_yes'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Yes button'),
          '#description' => $this->t('Yes button text.'),
          '#default_value' => !empty($country_popup_configs[$country_code]) && (isset($country_popup_configs[$country_code]['btn_label_yes']) && !empty($country_popup_configs[$country_code]['btn_label_yes'])) ? $country_popup_configs[$country_code]['btn_label_yes'] : 'Yes',
        ];

        $form[$country_code . '_container'][$country_code . '-btn_label_no'] = [
          '#type' => 'textfield',
          '#title' => $this->t('No button'),
          '#description' => $this->t('No button text.'),
          '#default_value' => !empty($country_popup_configs[$country_code]) && (isset($country_popup_configs[$country_code]['btn_label_no']) && !empty($country_popup_configs[$country_code]['btn_label_no'])) ? $country_popup_configs[$country_code]['btn_label_no'] : 'No Thanks',
        ];

      }
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $file = file_save_upload('modal_popup_block_logo', [], false, 0, FILE_EXISTS_REPLACE);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $country_popup_configs = [];
    // Retrieve the configuration.
    $conf = $this->configFactory->getEditable('ln_c_ip_locator.settings');
    $enabled_countries = $this->configFactory->get('geolocation.settings')->get('country_based_configurations');

    $fid = $form_state->getValue('modal_popup_block_logo');
    $conf->set('modal_popup_block_logo', $fid)->save();
    if (isset($fid[0]) && !empty($fid[0])) {
      $file = \Drupal\file\Entity\File::load($fid[0]);
      if ($file) {
        $file->setPermanent();
        $file->save();
        // $file = file_save_upload('modal_popup_block_logo', [], false, 0, FILE_EXISTS_REPLACE);
      }
    }

    foreach ($enabled_countries as $key => $config) {
      // Fetch country code from form key.
      if (!isset($country_popup_configs[$key])) {
        $country_popup_configs[$key] = [];
      }

      // Split config into multi-dimensional array keyed by country code.
      $country_popup_configs[$key]['body'] = $form_state->getValue($key . '-body');
      $country_popup_configs[$key]['cookie_validity'] = $form_state->getValue($key . '-cookie_validity');
      $country_popup_configs[$key]['btn_label_yes'] = $form_state->getValue($key . '-btn_label_yes');
      $country_popup_configs[$key]['btn_label_no'] = $form_state->getValue($key . '-btn_label_no');
    }

    $conf->set('country_popup_configs', $country_popup_configs)->save();
    parent::submitForm($form, $form_state);
  }

}
