<?php

namespace Drupal\nhsc_cadastro_unico_api\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements InputDemo form controller.
 *
 * This example demonstrates the different input elements that are used to
 * collect data in a form.
 */
class ConfigForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('nhsc_cadastro_unico_api.settings');

        $form['description'] = [
            '#type' => 'item',
            '#markup' => $this->t('API Settings for Cadastro Unico.'),
        ];

        // API URL.
        $form['cadu_url'] = [
            '#type' => 'url',
            '#title' => $this->t('API URL'),
            '#maxlength' => 255,
            '#size' => 60,
            '#description' => $this->t('Url to API endpoint'),
            '#default_value' => $config->get('cadu_url'),
        ];

        // PartnerCode.
        $form['partner_code'] = [
            '#type' => 'textfield',
            '#title' => t('Partner Code'),
            '#size' => 20,
            '#maxlength' => 128,
            '#description' => $this->t('Partner Code'),
            '#default_value' => $config->get('partner_code'),
        ];

        // CryptoAreaSite.
        $form['hcp_crypto_area_site'] = [
            '#type' => 'textfield',
            '#title' => t('HCP - CryptoAreaSite'),
            '#size' => 40,
            '#maxlength' => 128,
            '#description' => $this->t(''),
            '#default_value' => $config->get('hcp_crypto_area_site'),
        ];

        // CryptoAreaSite.
        $form['student_crypto_area_site'] = [
            '#type' => 'textfield',
            '#title' => t('Student - CryptoAreaSite'),
            '#size' => 40,
            '#maxlength' => 128,
            '#description' => $this->t(''),
            '#default_value' => $config->get('student_crypto_area_site'),
        ];

        // CryptoAreaSite.
        $form['institute_crypto_area_site'] = [
            '#type' => 'textfield',
            '#title' => t('Institute - CryptoAreaSite'),
            '#size' => 40,
            '#maxlength' => 128,
            '#description' => $this->t(''),
            '#default_value' => $config->get('institute_crypto_area_site'),
        ];

        $form['proxy'] = array(
            '#type' => 'fieldset',
            '#title' => $this->t('Proxy Settings'),
        );

        $form['proxy']['proxy_enable'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Use a proxy for all API calls.'),
            '#default_value' => $config->get('proxy_enable'),
        ];

        // proxy_host.
        $form['proxy']['proxy_host'] = [
            '#type' => 'textfield',
            '#title' => t('Hostname'),
            '#size' => 40,
            '#maxlength' => 128,
            '#description' => $this->t(''),
            '#default_value' => $config->get('proxy_host'),
        ];

        // proxy_port.
        $form['proxy']['proxy_port'] = [
            '#type' => 'textfield',
            '#title' => t('Port Number'),
            '#size' => 40,
            '#maxlength' => 128,
            '#description' => $this->t(''),
            '#default_value' => $config->get('proxy_port'),
        ];

        // proxy_login.
        $form['proxy']['proxy_login'] = [
            '#type' => 'textfield',
            '#title' => t('Username'),
            '#size' => 40,
            '#maxlength' => 128,
            '#description' => $this->t(''),
            '#default_value' => $config->get('proxy_login'),
        ];

        // proxy_password.
        $form['proxy']['proxy_password'] = [
            '#type' => 'textfield',
            '#title' => t('Password'),
            '#size' => 40,
            '#maxlength' => 128,
            '#description' => $this->t(''),
            '#default_value' => $config->get('proxy_password'),
        ];

        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
            '#description' => $this->t('Submit, #type = submit'),
        ];

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_cadastro_unico_api_config_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'nhsc_cadastro_unico_api.settings',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        // Retrieve the configuration
        $this->configFactory->getEditable('nhsc_cadastro_unico_api.settings')
            // Set the submitted configuration setting
            ->set('cadu_url', $form_state->getValue('cadu_url'))
            ->set('partner_code', $form_state->getValue('partner_code'))
            ->set('hcp_crypto_area_site', $form_state->getValue('hcp_crypto_area_site'))
            ->set('student_crypto_area_site', $form_state->getValue('student_crypto_area_site'))
            ->set('institute_crypto_area_site', $form_state->getValue('institute_crypto_area_site'))
            ->set('proxy_enable', $form_state->getValue('proxy_enable'))
            ->set('proxy_host', $form_state->getValue('proxy_host'))
            ->set('proxy_port', $form_state->getValue('proxy_port'))
            ->set('proxy_login', $form_state->getValue('proxy_login'))
            ->set('proxy_password', $form_state->getValue('proxy_password'))
            ->save();

        parent::submitForm($form, $form_state);

    }
}
