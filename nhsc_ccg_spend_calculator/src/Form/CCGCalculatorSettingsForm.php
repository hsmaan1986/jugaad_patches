<?php

namespace Drupal\nhsc_ccg_spend_calculator\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class CCGCalculatorSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'nhsc_ccg_spend_calculator.config',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nhsc_ccg_spend_calculator_settings_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('nhsc_ccg_spend_calculator.config');

        $form['calculator'] = [
            '#type' => 'details',
            '#title' => t('Settings'),
            '#group' => 'settings',
            '#open' => TRUE,
        ];

        $form['calculator']['ccg_currency'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Currency Symbol'),
            '#description' => $this->t('Currency Symbol'),
            '#default_value' => $config->get('ccg_currency'),
        ];

        $form['calculator']['ccg_footer_copy'] = [
            '#type' => 'text_format',
            '#format' => 'rich_text',
            '#title' => $this->t('Modal\'s Footer Copy'),
            '#default_value' => $config->get('ccg_footer_copy'),
        ];

        $form['calculator']['ccg_csv_delimiter'] = [
            '#type' => 'textfield',
            '#title' => $this->t('CSV Delimiter'),
            '#description' => $this->t('Separator for the csv file(ie: ,)'),
            '#default_value' => $config->get('ccg_csv_delimiter'),
        ];

        $form['product_info'] = [
            '#type' => 'details',
            '#title' => t('Product Info'),
            '#group' => 'settings',
            '#open' => TRUE,
        ];

        // product 1
        $form['product_info']['product1'] = [
            '#type' => 'details',
            '#title' => t('Product 1 Info'),
            '#group' => 'settings',
            '#open' => TRUE,
        ];

        $form['product_info']['product1']['product1_title'] = [
            '#type' => 'textfield',
            '#title' => t('Product 1 Title'),
            '#default_value' => $config->get('product1_title'),
        ];

        $form['product_info']['product1']['product1_image'] = [
            '#type' => 'managed_file',
            '#title' => t('Product 1 Image'),
            '#description' => t('Product 1 Image'),
            '#upload_location' => 'public://images',
            '#default_value' => $config->get('product1_image'),
        ];

        // product 2
        $form['product_info']['product2'] = [
            '#type' => 'details',
            '#title' => t('Product 2 Info'),
            '#group' => 'settings',
            '#open' => TRUE,
        ];

        $form['product_info']['product2']['product2_title'] = [
            '#type' => 'textfield',
            '#title' => t('Product 2 Title'),
            '#default_value' => $config->get('product2_title'),
        ];

        $form['product_info']['product2']['product2_image'] = [
            '#type' => 'managed_file',
            '#title' => t('Product 2 Image'),
            '#description' => t('Product 2 Image'),
            '#upload_location' => 'public://images',
            '#default_value' => $config->get('product2_image'),
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
        $config =  $this->config('nhsc_ccg_spend_calculator.config');

        if ( $product1_image = $form_state->getValue('product1_image') ) {
            $product1_image_file = File::load( $product1_image [0] );
            $product1_image_file->setPermanent();
            $product1_image_file->save();
        }

        if ( $product2_image = $form_state->getValue('product2_image') ) {
            $product2_image_file = File::load($product2_image [0]);
            $product2_image_file->setPermanent();
            $product2_image_file->save();
        }


        $config
            ->set('ccg_currency', $form_state->getValue('ccg_currency'))
            ->set('product1_title', $form_state->getValue('product1_title'))
            ->set('product2_title', $form_state->getValue('product2_title'))
            ->set('product1_image', $product1_image)
            ->set('product2_image', $product2_image)
            ->set('ccg_csv_delimiter', $form_state->getValue('ccg_csv_delimiter'))
            ->set('ccg_footer_copy', $form_state->getValue('ccg_footer_copy')['value'])
            ->save();

    }
}