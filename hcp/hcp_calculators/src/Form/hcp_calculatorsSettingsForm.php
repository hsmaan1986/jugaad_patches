<?php

 namespace Drupal\hcp_calculators\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
class hcp_calculatorsSettingsForm extends ConfigFormBase {

    const HCP_LEGAL_KEY = "hcp_legal-notice";
    const HCP_SETTINGS_KEY = "hcp_calculators.settings";
  /**
   *
   */
  public function getFormId() {
    return 'hcp_calculators_settings';
  }

  /**
   *
   */
  protected function getEditableConfigNames() {
    return ['hcp_calculators.settings'];
  }

  /**
   *
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hcp_calculators.settings');

      $form['settings'] = [
          '#type' => 'vertical_tabs'
      ];

      $form['general'] = [
          '#type' => 'details',
          '#title' => $this->t('General Settings'),
          '#group' => 'settings',
      ];



    return parent::buildForm($form, $form_state);
  }

  /**
   *
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    parent::validateForm($form, $form_state);
  }

  /**
   *
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

      $this->config(hcp_calculatorsSettingsForm::HCP_SETTINGS_KEY)
        ->set(hcp_calculatorsSettingsForm::HCP_LEGAL_KEY, $form_state->getValue(hcp_calculatorsSettingsForm::HCP_LEGAL_KEY))
        ->save();
    parent::submitForm($form, $form_state);

   // $this->saveSnippets();
  }

  /**
   *
   */
//  public function saveSnippets() {
//    module_load_include('inc', 'hcp_calculators', 'includes/scripts');
//    $result = TRUE;
//    $snippets = hcp_calculators_snippets();
//    $path = file_unmanaged_save_data($snippets, "public://js/hcp_calculators.js", FILE_EXISTS_REPLACE);
//    $result = !$path ? FALSE : $result;
//    if (!$path) {
//      drupal_set_message(t('An error occurred saving one or more snippet files. Please try again or contact the site administrator if it persists.'));
//    }
//    else {
//      drupal_set_message(t('Created the Ghostery snippet file based on configuration.'));
//      \Drupal::service('asset.js.collection_optimizer')->deleteAll();
//      _drupal_flush_css_js();
//    }
//  }

  /**
   *
   */


}
