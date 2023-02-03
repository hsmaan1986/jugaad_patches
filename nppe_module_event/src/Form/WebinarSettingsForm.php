<?php

/**
 * @file
 * Contains \Drupal\nppe_module_event\Form\WebinarSettingsForm.
 */

namespace Drupal\nppe_module_event\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WebinarSettingsForm
 * @package Drupal\nppe_module_event\Form
 */
class WebinarSettingsForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nppe_module_event_settings';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['nppe_module_event.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('nppe_module_event.settings');

        $form['APIdisplay'] = [
            '#type' => 'details',
            '#title' => t('Web meeting (Webinars) API Settings'),
            '#open' => FALSE,
        ];

        $form['APIdisplay']['credit_endpoint'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Get Credit End-Point'),
            '#default_value' => $config->get('credit_endpoint'),
        ];

        $form['APIdisplay']['endpoint'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Video End-Point'),
            '#default_value' => $config->get('endpoint'),
        ];

        $form['APIdisplay']['site_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Site key'),
            '#default_value' => $config->get('site_key'),
        ];

        $form['APIdisplay']['access_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Access key'),
            '#default_value' => $config->get('access_key'),
        ];


        $form['WebinarAchivement'] = [
            '#type' => 'details',
            '#title' => t('My Webinars Achievements blocks settings'),
            '#open' => FALSE,
        ];

        $form['WebinarAchivement']['my_achievements'] = [
            '#type' => 'textarea',
            '#title' => $this->t('My Achievements Blocks Config'),
            '#description' => $this->t('<br/><b>Please use the following JSON Structure and validate (https://jsonlint.com) your JSON after editing : </b><br/>
                                        { <br/>
                                            &nbsp;"partner":"In partnership with", <br/>
                                            &nbsp;"category": [ <br/>
                                                &nbsp;&nbsp;{ "name":"Update Course in Enteral Nutritional Therapy", "certificate_total":"4", "code":"BRASPEN", "image":"avante-hospitalar.png", "alt":"avant hospitalar","certificate_key":"avante"}, <br/>
                                                &nbsp;&nbsp;{ "name":"Extra-Hospital Assistance Extension Course", "certificate_total":"32", "code":"SBGG" , "image":"avante-helping-care.png", "alt":"avante helping care","certificate_key":"helping"} <br/>
                                            &nbsp;] <br/>
                                         }'),
            '#default_value' => $config->get('my_achievements'),
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
        $this->config('nppe_module_event.settings')
            ->set('site_key', $form_state->getValue('site_key'))
            ->set('access_key', $form_state->getValue('access_key'))
            ->set('endpoint', $form_state->getValue('endpoint'))
            ->set('credit_endpoint', $form_state->getValue('credit_endpoint'))
            ->set('my_achievements', $form_state->getValue('my_achievements'))
            ->save();

        parent::submitForm($form, $form_state);
    }
}
