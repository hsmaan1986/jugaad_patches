<?php

namespace Drupal\nhsc_self_assessment_survey\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_self_assessment_survey\Controller\SelfAssessmentController;
use Drupal\file\Entity\File;

class SelfAssessmentSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'nhsc_self_assessment_survey.config',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nhsc_self_assessment_survey';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $config = $this->config('nhsc_self_assessment_survey.config');
        $controller =  new SelfAssessmentController();

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

        $form['survey']['self_assessment_webform_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('WebForm Name'),
            '#description' => $this->t('Name of the webform'),
            '#default_value' => $config->get('self_assessment_webform_name'),
        ];

        $form['survey']['main_banner_image'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Main Banner Image'),
            '#description' => $this->t('Main Banner Image'),
            '#upload_location' => 'public://images',
        ];

        $form['results_a_settings'] = [
            '#type' => 'details',
            '#title' => t('Results A Settings'),
            '#group' => 'settings',
        ];

        $form['results_a_settings']['result_a_score'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Score for results A'),
            '#default_value' => $config->get('result_a_score'),
        ];

        $form['results_a_settings']['result_a_banner_image'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Result A Banner Image'),
            '#description' => $this->t('Result A Banner Image'),
            '#upload_location' => 'public://images',
        ];

        $form['results_a_settings']['result_a_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('result_a_copy_format'),
            '#title' => $this->t('Copy for results A'),
            '#default_value' => $config->get('result_a_copy'),
        ];

        $form['results_b_settings'] = [
            '#type' => 'details',
            '#title' => t('Results B Settings'),
            '#group' => 'settings',
        ];

        $form['results_b_settings']['result_b_score'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Score for results B'),
            '#default_value' => $config->get('result_b_score'),
        ];

        $form['results_b_settings']['result_b_banner_image'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Result B Banner Image'),
            '#description' => $this->t('Result B Banner Image'),
            '#upload_location' => 'public://images',
        ];

        $form['results_b_settings']['result_b_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('result_b_copy_format'),
            '#title' => $this->t('Copy for results B'),
            '#default_value' => $config->get('result_b_copy'),
        ];

        $form['results_c_settings'] = [
            '#type' => 'details',
            '#title' => t('Results C Settings'),
            '#group' => 'settings',
        ];

        $form['results_c_settings']['result_c_score'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Score for results C'),
            '#default_value' => $config->get('result_c_score'),
        ];

        $form['results_c_settings']['result_c_banner_image'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Result C Banner Image'),
            '#description' => $this->t('Result C Banner Image'),
            '#upload_location' => 'public://images',
        ];

        $form['results_c_settings']['result_c_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('result_c_copy_format'),
            '#title' => $this->t('Copy for results C'),
            '#default_value' => $config->get('result_c_copy'),
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

        $config =  $this->config('nhsc_self_assessment_survey.config');

        if (isset($form_state->getValue('main_banner_image')[0])){
            // get images
            $main_banner_image = $form_state->getValue('main_banner_image')[0];
            // save images permanent
            $main_banner_image_file = File::load( $main_banner_image );
            $main_banner_image_file->setPermanent();
            $main_banner_image_file->save();

            $config->set('main_banner_image', $main_banner_image_file->createFileUrl());

        }

        if (isset($form_state->getValue('result_a_banner_image')[0])){
            // get images
            $result_a_banner_image = $form_state->getValue('result_a_banner_image')[0];
            // save images permanent
            $result_a_banner_image_file = File::load( $result_a_banner_image );
            $result_a_banner_image_file->setPermanent();
            $result_a_banner_image_file->save();

            $config->set('result_a_banner_image', $result_a_banner_image_file->createFileUrl());
        }

        if (isset($form_state->getValue('result_b_banner_image')[0])){
            // get images
            $result_b_banner_image = $form_state->getValue('result_b_banner_image')[0];
            // save images permanent
            $result_b_banner_image_file = File::load( $result_b_banner_image );
            $result_b_banner_image_file->setPermanent();
            $result_b_banner_image_file->save();

            $config->set('result_b_banner_image', $result_b_banner_image_file->createFileUrl());
        }

        if (isset($form_state->getValue('result_c_banner_image')[0])){
            // get images
            $result_c_banner_image = $form_state->getValue('result_c_banner_image')[0];
            // save images permanent
            $result_c_banner_image_file = File::load( $result_c_banner_image );
            $result_c_banner_image_file->setPermanent();
            $result_c_banner_image_file->save();

            $config->set('result_c_banner_image', $result_c_banner_image_file->createFileUrl());
        }

        $config
            ->set('self_assessment_webform_name', $form_state->getValue('self_assessment_webform_name'))
            ->set('survey_title', $form_state->getValue('survey_title'))

            ->set('result_a_score', $form_state->getValue('result_a_score'))
            ->set('result_a_copy', $form_state->getValue('result_a_copy')['value'])
            ->set('result_a_copy_format', $form_state->getValue('result_a_copy_format')['format'])

            ->set('result_b_score', $form_state->getValue('result_b_score'))
            ->set('result_b_copy', $form_state->getValue('result_b_copy')['value'])
            ->set('result_b_copy_format', $form_state->getValue('result_b_copy_format')['format'])

            ->set('result_c_score', $form_state->getValue('result_c_score'))
            ->set('result_c_copy', $form_state->getValue('result_c_copy')['value'])
            ->set('result_c_copy_format', $form_state->getValue('result_c_copy_format')['format'])

            ->save();
    }

}
