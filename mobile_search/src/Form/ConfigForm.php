<?php

namespace Drupal\mobile_search\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase
{

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'mobile_search.config',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'mobile_search_config_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('mobile_search.config');



        $form['settings'] = array(
            '#type' => 'vertical_tabs',
            '#title' => t('Settings'),
        );

        $form['details'] = [
            '#type' => 'details',
            '#title' => t('URLs'),
            '#group' => 'settings',
        ];

        $form['details']['search_url'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Search Url'),
            '#description' => $this->t('i.e: /searchcontent'),
            '#default_value' => $config->get('search_url'),
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

        $this->config('mobile_search.config')
            ->set('search_url', $form_state->getValue('search_url'))
            ->save();
    }

}
