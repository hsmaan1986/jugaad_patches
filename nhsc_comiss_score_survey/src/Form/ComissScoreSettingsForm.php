<?php

namespace Drupal\nhsc_comiss_score_survey\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\nhsc_comiss_score_survey\Controller\ComissScoreController;

class ComissScoreSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'nhsc_comiss_score_survey.config',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nhsc_comiss_score_survey_settings_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $config = $this->config('nhsc_comiss_score_survey.config');

        $form['settings'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Settings'),
        ];

        $form['survey'] = [
            '#type' => 'details',
            '#title' => t('Survey Settings'),
            '#group' => 'settings',
        ];

        $form['above_cutoff'] = [
            '#type' => 'details',
            '#title' => t('Above Cut-Off Settings'),
            '#group' => 'settings',
        ];

        $form['above_cutoff']['comiss_score_above_cutoff'] = [
            '#type' => 'text_format',
            '#format' => $config->get('comiss_score_above_cutoff_format'),
            '#title' => $this->t('Above Cut-Off Recommendation'),
            '#default_value' => $config->get('comiss_score_above_cutoff'),
        ];

        $form['above_cutoff']['above_first_cta_link'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First CTA Link'),
            '#default_value' => $config->get('above_first_cta_link'),
        ];

        $form['above_cutoff']['above_first_cta_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First CTA Text'),
            '#default_value' => $config->get('above_first_cta_text'),
        ];

        $form['above_cutoff']['above_second_cta_link'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Second CTA Link'),
            '#default_value' => $config->get('above_second_cta_link'),
        ];

        $form['above_cutoff']['above_second_cta_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Second CTA Text'),
            '#default_value' => $config->get('above_second_cta_text'),
        ];

        $form['below_cutoff'] = [
            '#type' => 'details',
            '#title' => t('Below Cut-Off Settings'),
            '#group' => 'settings',
        ];


        $form['below_cutoff']['comiss_score_below_cutoff'] = [
            '#type' => 'text_format',
            '#format' => $config->get('comiss_score_below_cutoff_format'),
            '#title' => $this->t('Below Cut-Off Recommendation'),
            '#default_value' => $config->get('comiss_score_below_cutoff'),
        ];


        $form['below_cutoff']['below_first_cta_link'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First CTA Link'),
            '#default_value' => $config->get('below_first_cta_link'),
        ];

        $form['below_cutoff']['below_first_cta_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First CTA Text'),
            '#default_value' => $config->get('below_first_cta_text'),
        ];

        $form['below_cutoff']['below_second_cta_link'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Second CTA Link'),
            '#default_value' => $config->get('below_second_cta_link'),
        ];

        $form['below_cutoff']['below_second_cta_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Second CTA Text'),
            '#default_value' => $config->get('below_second_cta_text'),
        ];

        $form['form_content'] = [
            '#type' => 'details',
            '#title' => t('Form Content Settings'),
            '#group' => 'settings',
        ];

        $form['form_content']['comiss_score_content'] = [
            '#type' => 'text_format',
            '#format' => $config->get('comiss_score_content_format'),
            '#title' => 'Form Content',
            '#default_value' => $config->get('comiss_score_content')
        ];

        $form['survey']['comiss_score_webform_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Form Name'),
            '#description' => $this->t('Name of the webform'),
            '#default_value' => $config->get('comiss_score_webform_name'),
        ];

        $form['survey']['comiss_survey_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Survey Title'),
            '#description' => $this->t('Survey Title'),
            '#default_value' => $config->get('comiss_survey_title'),
        ];

        $form['survey']['comiss_score_cutoff_value'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Cut-Off Value'),
            '#default_value' => $config->get('comiss_score_cutoff_value'),
        ];

        $form['survey']['comiss_score_total_score'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Total Score'),
            '#default_value' => $config->get('comiss_score_total_score'),
        ];

        $form['print_form'] = [
            '#type' => 'details',
            '#title' => t('Print Form Settings'),
            '#group' => 'settings',
        ];

        $form['print_form']['company_logo_location'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Company Logo'),
            '#description' => $this->t('Location Company Logo'),
            '#upload_location' => 'public://images',
        ];

        $form['print_form']['copy_right_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Copy Right Text'),
            '#description' => $this->t('Location Company Logo'),
            '#default_value' => $config->get('copy_right_text'),
        ];

        $form['print_form']['purpose_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Purpose Title'),
            '#description' => $this->t('Purpose Title'),
            '#default_value' => $config->get('purpose_title'),
        ];

        $form['print_form']['purpose_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('purpose_copy_format'),
            '#title' => $this->t('Purpose Copy'),
            '#description' => $this->t('Purpose Copy'),
            '#default_value' => $config->get('purpose_copy'),
        ];

        $form['print_form']['instructions_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Scoring Instructions Title'),
            '#description' => $this->t('Scoring Instructions Title'),
            '#default_value' => $config->get('instructions_title'),
        ];


        $form['print_form']['instructions_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('instructions_copy_format'),
            '#title' => $this->t('Scoring Instructions Copy'),
            '#description' => $this->t('Instructions Copy'),
            '#default_value' => $config->get('instructions_copy'),
        ];

        $form['print_form']['reading_results_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Reading Results Title'),
            '#description' => $this->t('Reading Results Title'),
            '#default_value' => $config->get('reading_results_title'),
        ];

        $form['print_form']['reading_results_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('reading_results_copy_format'),
            '#title' => $this->t('Reading Results Copy'),
            '#description' => $this->t('Reading Results Copy'),
            '#default_value' => $config->get('reading_results_copy'),
        ];

        $form['print_form']['form_print_footer'] = [
            '#type' => 'text_format',
            '#format' => $config->get('form_print_footer_format'),
            '#title' => $this->t('Print Form Footer Copy'),
            '#description' => $this->t('Print Form Footer Copy'),
            '#default_value' => $config->get('form_print_footer'),
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

        $config = $this->config('nhsc_comiss_score_survey.config');

        if(isset($form_state->getValue('company_logo_location')[0])){
            $company_logo = $form_state->getValue('company_logo_location')[0];

            $company_logo_file = File::load( $company_logo );
            $company_logo_file->setPermanent();
            $company_logo_file->save();

            $config->set('company_logo_location', $company_logo_file->createFileUrl());

        }

        $config
            ->set('comiss_score_webform_name', $form_state->getValue('comiss_score_webform_name'))
            ->set('comiss_score_cutoff_value', $form_state->getValue('comiss_score_cutoff_value'))

            ->set('comiss_survey_title', $form_state->getValue('comiss_survey_title'))

            ->set('comiss_score_total_score', $form_state->getValue('comiss_score_total_score'))

            ->set('comiss_score_above_cutoff', $form_state->getValue('comiss_score_above_cutoff')['value'])
            ->set('comiss_score_above_cutoff_format', $form_state->getValue('comiss_score_above_cutoff')['format'])
            ->set('above_first_cta_link', $form_state->getValue('above_first_cta_link'))
            ->set('above_first_cta_text', $form_state->getValue('above_first_cta_text'))
            ->set('above_second_cta_link', $form_state->getValue('above_second_cta_link'))
            ->set('above_second_cta_text', $form_state->getValue('above_second_cta_text'))

            ->set('comiss_score_below_cutoff', $form_state->getValue('comiss_score_below_cutoff')['value'])
            ->set('comiss_score_below_cutoff_format', $form_state->getValue('comiss_score_below_cutoff')['format'])

            ->set('below_first_cta_link', $form_state->getValue('below_first_cta_link'))
            ->set('below_first_cta_text', $form_state->getValue('below_first_cta_text'))
            ->set('below_second_cta_link', $form_state->getValue('below_second_cta_link'))
            ->set('below_second_cta_text', $form_state->getValue('below_second_cta_text'))
            ->set('comiss_score_content', $form_state->getValue('comiss_score_content')['value'])
            ->set('comiss_score_content_format', $form_state->getValue('comiss_score_content')['format'])

            ->set('reading_results_title', $form_state->getValue('reading_results_title'))
            ->set('purpose_title', $form_state->getValue('purpose_title'))
            ->set('instructions_title', $form_state->getValue('instructions_title'))
            ->set('reading_results_copy', $form_state->getValue('reading_results_copy')['value'])
            ->set('reading_results_copy_format', $form_state->getValue('reading_results_copy')['format'])
            ->set('form_print_footer', $form_state->getValue('form_print_footer')['value'])
            ->set('form_print_footer_format', $form_state->getValue('form_print_footer')['format'])
            ->set('purpose_copy', $form_state->getValue('purpose_copy')['value'])
            ->set('purpose_copy_format', $form_state->getValue('purpose_copy')['format'])
            ->set('instructions_copy', $form_state->getValue('instructions_copy')['value'])
            ->set('instructions_copy_format', $form_state->getValue('instructions_copy')['format'])
            ->set('copy_right_text', $form_state->getValue('copy_right_text'))
            ->save();
    }

}
