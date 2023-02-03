<?php

namespace Drupal\nhsc_learn_to_grow_survey\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_learn_to_grow_survey\Controller\LearnToGrowController;
use Drupal\file\Entity\File;

class LearnToGrowSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'nhsc_learn_to_grow_survey.config',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nhsc_learn_to_grow_survey_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $config = $this->config('nhsc_learn_to_grow_survey.config');

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

        $form['survey']['survey_sub_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Survey Sub-Title'),
            '#description' => $this->t('Survey Sub-Title'),
            '#default_value' => $config->get('survey_sub_title'),
        ];

        $form['survey']['webform_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('WebForm Name'),
            '#description' => $this->t('Name of the webform'),
            '#default_value' => $config->get('webform_name'),
        ];

        $form['survey']['intro_form_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Introduction Form Title'),
            '#description' => $this->t('Introduction Form Title'),
            '#default_value' => $config->get('intro_form_title'),
        ];

        $form['survey']['instructions_copy'] = [
            '#type' => 'text_format',
            '#format' => $config->get('instructions_copy_format'),
            '#title' => $this->t('Instructions Copy'),
            '#default_value' => $config->get('instructions_copy'),
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

        $config =  $this->config('nhsc_learn_to_grow_survey.config');

        $config
            ->set('webform_name', $form_state->getValue('webform_name'))
            ->set('survey_title', $form_state->getValue('survey_title'))
            ->set('survey_sub_title', $form_state->getValue('survey_sub_title'))
            ->set('intro_form_title', $form_state->getValue('intro_form_title'))
            ->set('instructions_copy', $form_state->getValue('instructions_copy')['value'])
            ->set('instructions_copy_format', $form_state->getValue('instructions_copy_format')['format'])

            ->save();
    }

}