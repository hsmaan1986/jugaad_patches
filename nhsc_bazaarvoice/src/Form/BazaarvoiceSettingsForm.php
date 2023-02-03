<?php

/**
 * @file
 * Contains \Drupal\nhsc_bazaarvoice\Form\BazaarvoiceSettingsForm.
 */

namespace Drupal\nhsc_bazaarvoice\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class BazaarvoiceSettingsForm
 * @package Drupal\nhsc_bazaarvoice\Form
 */
class BazaarvoiceSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nhsc_bazaarvoice_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['nhsc_bazaarvoice.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('nhsc_bazaarvoice.settings');

    $form['bazaarvoice_env'] = array(
        '#type' => 'select',
        '#title' => $this->t('Environment'),
        '#options' => array(
            'staging' => 'Staging',
            'production' => 'Production',
        ),
        '#default_value' => $config->get('bazaarvoice_env'),
    );

    $form['bazaarvoice_client_name'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Client Name'),
        '#default_value' => $config->get('bazaarvoice_client_name'),
    );

    $form['bazaarvoice_locale'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Locale'),
        '#default_value' => $config->get('bazaarvoice_locale'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Trim the text values.

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   * @var $config \Drupal\Core\Config\Config
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('nhsc_bazaarvoice.settings')
      //Range form elements
      ->set('bazaarvoice_env', $form_state->getValue('bazaarvoice_env'))
      ->set('bazaarvoice_client_name', $form_state->getValue('bazaarvoice_client_name'))
      ->set('bazaarvoice_locale', $form_state->getValue('bazaarvoice_locale'))
      ->save();

    parent::submitForm($form, $form_state);
  }


}
