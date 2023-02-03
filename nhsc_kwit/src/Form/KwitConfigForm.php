<?php

namespace Drupal\nhsc_kwit\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class KwitConfigForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'nhsc_kwit.config',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nhsc_kwit_config';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $config = $this->config('nhsc_kwit.config');

        $form['settings'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Settings'),
        ];

        $form['kwit'] = [
            '#type' => 'details',
            '#title' => t('Kwit Settings'),
            '#group' => 'settings',
        ];

        $form['kwit']['brand_widget_id'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Brand Widget UID'),
            '#description' => $this->t(' ie: kwit_brand_widget_uid'),
            '#default_value' => $config->get('brand_widget_id'),
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

        $config =  $this->config('nhsc_kwit.config');

        $config
            ->set('brand_widget_id', $form_state->getValue('brand_widget_id'))
            ->save();
    }

}