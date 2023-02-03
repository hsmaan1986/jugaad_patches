<?php

namespace Drupal\nhsc_symptom_checker\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_symptom_checker\Controller\SelfAssessmentController;
use Drupal\file\Entity\File;

class SymptomCheckerSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'nhsc_symptom_checker.config',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nhsc_symptom_checker_settings_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $config = $this->config('nhsc_symptom_checker.config');

        $form['settings'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Settings'),
        ];


        $form['survey'] = [
            '#type' => 'details',
            '#title' => t('Survey Settings'),
            '#group' => 'settings',
        ];

        $form['survey']['survey_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Survey Title'),
            '#description' => $this->t('Survey Title'),
            '#default_value' => $config->get('survey_title'),
        ];

        $form['survey']['webform_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('WebForm Name'),
            '#description' => $this->t('Name of the web form'),
            '#default_value' => $config->get('webform_name'),
        ];

        $form['survey']['main_banner_image'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Main Banner Image'),
            '#description' => $this->t('Main Banner Image'),
            '#upload_location' => 'public://images',
        ];

        $form['survey']['home_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('home_copy_format'),
            '#title' => $this->t('Home Screen Copy'),
            '#default_value' => $config->get('home_copy'),
        ];

        $form['results'] = [
            '#type' => 'details',
            '#title' => t('Results Settings'),
            '#group' => 'settings',
        ];

        $form['results']['results_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('results_copy_format'),
            '#title' => $this->t('Results Screen Copy'),
            '#default_value' => $config->get('results_copy'),
        ];

        $form['results']['call_to_action_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Call to Action Text'),
            '#default_value' => $config->get('call_to_action_text'),
        ];

        $form['results']['call_to_action_link'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Call to Action Link'),
            '#default_value' => $config->get('call_to_action_link'),
        ];

        $form['results']['disclaimer_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('disclaimer_copy_format'),
            '#title' => $this->t('Disclaimer Copy'),
            '#default_value' => $config->get('disclaimer_copy'),
        ];


        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        parent::submitForm($form, $form_state);

        $config = $this->config('nhsc_symptom_checker.config');

        if (isset($form_state->getValue('main_banner_image')[0])){
            // get images
            $main_banner_image = $form_state->getValue('main_banner_image')[0];
            // save images permanent
            $main_banner_image_file = File::load( $main_banner_image );
            $main_banner_image_file->setPermanent();
            $main_banner_image_file->save();

            $config->set('main_banner_image', $main_banner_image_file->createFileUrl());

        }

        $config
            ->set('webform_name', $form_state->getValue('webform_name'))
            ->set('survey_title', $form_state->getValue('survey_title'))
            ->set('home_copy', $form_state->getValue('home_copy')['value'])
	        ->set('home_copy_format', $form_state->getValue('home_copy_format')['format'])
            ->set('results_copy', $form_state->getValue('results_copy')['value'])
            ->set('results_copy_format', $form_state->getValue('results_copy_format')['format'])
            ->set('call_to_action_text', $form_state->getValue('call_to_action_text'))
            ->set('call_to_action_link', $form_state->getValue('call_to_action_link'))
            ->set('disclaimer_copy', $form_state->getValue('disclaimer_copy')['value'])
            ->set('disclaimer_copy_format', $form_state->getValue('disclaimer_copy_format')['format'])

            ->save();
    }
}
