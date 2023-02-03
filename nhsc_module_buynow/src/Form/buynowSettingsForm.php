<?php

/**
 * @file
 * Contains \Drupal\nhsc_module_fusepump\Form\fusepumpSettingsForm.
 */

namespace Drupal\nhsc_module_buynow\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class fusepumpSettingsForm
 * @package Drupal\nhsc_module_fusepump\Form
 */
class buynowSettingsForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_module_buynow_settings';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['nhsc_module_buynow.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('nhsc_module_buynow.settings');
        $leave_empty = '<b>Leave empty to use default</b>';


        // Build form elements.
        $form['settings'] = [
            '#type' => 'vertical_tabs',
            '#attributes' => ['class' => ['nhsc_module_buynow']],
            '#attached' => [
                'library' => ['nhsc_module_buynow/drupal.settings_form'],
            ],
        ];

        // General tab
        $form['buynow_settings'] = [
            '#type' => 'details',
            '#title' => $this->t('General Settings'),
            '#group' => 'settings',
        ];



        $form['buynow_settings']['buynow_brand'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Brand name'),
            '#default_value' => $config->get('buynow_brand'),
            '#description' => $this->t('e.g. purinaone - provided by Fusepump'),
        );

        $form['buynow_settings']['buynow_unit'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Unit'),
            '#default_value' => $config->get('buynow_unit'),
            '#description' => $this->t('e.g. product'),
        );

        $form['buynow_settings']['buynow_environment'] = array(
            '#type' => 'select',
            '#title' => $this->t('Environment'),
            '#default_value' => $config->get('buynow_environment'),
            '#description' => $this->t('Select Production/Staging'),
            '#options' => array('production' => $this->t('Production'), 'staging' => $this->t('Staging')),
        );

        $form['buynow_settings']['buynow_country'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Country'),
            '#default_value' => $config->get('buynow_country'),
            '#description' => $this->t('Country Code e.g. FR for France'),

        );

        $form['buynow_settings']['buynow_language'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Language'),
            '#default_value' => $config->get('buynow_language'),
            '#description' => $this->t('Language code e.g. fr for French <small>Please note this should be lowercase</small>'),

        );


        $form['buynow_settings']['buynow_showprice'] = array(
            '#type' => 'select',
            '#title' => $this->t('Show Price'),
            '#default_value' => $config->get('buynow_showprice'),
            '#description' => $this->t('True / False'),
            '#options' => array('FALSE' => $this->t('FALSE'), 'TRUE' => $this->t('TRUE')),
        );

        $form['buynow_settings']['buynow_version'] = array(
            '#type' => 'select',
            '#title' => $this->t('API Version'),
            '#default_value' => $config->get('buynow_version'),
            '#description' => $this->t('API Version to use'),
            '#options' => array(1 => $this->t('1'), 2 => $this->t('2')),
        );


        /// styling settings
        $form['buynow_styling'] = [
            '#type' => 'details',
            '#title' => $this->t('Styling Settings'),
            '#group' => 'settings',
        ];
       
        
        $form['buynow_styling']['buynow_styling_background'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Background'),
            '#default_value' => $config->get('buynow_styling_background'),
            '#description' => $this->t('HEX Colour '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_backgroundopacity'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Background Opacity'),
            '#default_value' => $config->get('buynow_styling_backgroundopacity'),
            '#description' => $this->t('Opacity e.g. 0.4 '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_backgroundimg'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Background Image Path'),
            '#default_value' => $config->get('buynow_styling_backgroundimg'),
            '#description' => $this->t('Absolute URL to background image '.$leave_empty),

        );


        $form['buynow_styling']['buynow_styling_backgroundimgopacity'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Background Image Opacity'),
            '#default_value' => $config->get('buynow_styling_backgroundimgopacity'),
            '#description' => $this->t('Opacity e.g. 0.4 '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_borderwidth'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Border Width'),
            '#default_value' => $config->get('buynow_styling_borderwidth'),
            '#description' => $this->t('e.g. 2px '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_borderradius'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Border Radius'),
            '#default_value' => $config->get('buynow_styling_borderradius'),
            '#description' => $this->t('e.g. 2px '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_img_position'] = array(
            '#type' => 'select',
            '#title' => $this->t('Product Image Position'),
            '#default_value' => $config->get('buynow_styling_img_position'),
            '#description' => $this->t('Select an option'),
            '#options' => array('default' => $this->t('Default'), 'left' => $this->t('Left'), 'right' => $this->t('Right'),'none' => $this->t('Display no image')),

        );


        $form['buynow_styling']['buynow_styling_fontfamily'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Font Family'),
            '#default_value' => $config->get('buynow_styling_fontfamily'),
            '#description' => $this->t('e.g. Arial '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_fontsize'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Font Size'),
            '#default_value' => $config->get('buynow_styling_fontsize'),
            '#description' => $this->t('e.g. 12px '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_ctacolor'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA Color'),
            '#default_value' => $config->get('buynow_styling_ctacolor'),
            '#description' => $this->t('HEX value '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_ctafontcolor'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA  Font Color'),
            '#default_value' => $config->get('buynow_styling_ctafontcolor'),
            '#description' => $this->t('HEX value '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_ctahovercolor'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA  Hover  Color'),
            '#default_value' => $config->get('buynow_styling_ctahovercolor'),
            '#description' => $this->t('HEX value '.$leave_empty),

        );

        $form['buynow_styling']['buynow_styling_ctafonthovercolor'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA Font Hover  Color'),
            '#default_value' => $config->get('buynow_styling_ctafonthovercolor'),
            '#description' => $this->t('HEX value '.$leave_empty),

        );


         /// click and collect settings
        $form['buynow_cac'] = [
            '#type' => 'details',
            '#title' => $this->t('Click & Collect Settings'),
            '#group' => 'settings',
        ];

        $form['buynow_cac']['buynow_cac_geolocate'] = array(
            '#type' => 'select',
            '#title' => $this->t('Geolocation'),
            '#default_value' => $config->get('buynow_cac_geolocate'),
            '#description' => $this->t('Enable Geolocation'),
            '#options' => array('FALSE' => $this->t('FALSE'), 'TRUE' => $this->t('TRUE')),

        );

        $form['buynow_cac']['buynow_cac_autocomplete'] = array(
            '#type' => 'select',
            '#title' => $this->t('Autocomplete'),
            '#default_value' => $config->get('buynow_cac_autocomplete'),
            '#description' => $this->t('Enable Autocomplete'),
            '#options' => array('FALSE' => $this->t('FALSE'), 'TRUE' => $this->t('TRUE')),

        );

        $form['buynow_cac']['buynow_cac_storelocation'] = array(
            '#type' => 'select',
            '#title' => $this->t('Store Location'),
            '#default_value' => $config->get('buynow_cac_storelocation'),
            '#description' => $this->t('Enable Store Location'),
            '#options' => array('FALSE' => $this->t('FALSE'), 'TRUE' => $this->t('TRUE')),

        );

        $form['buynow_cac']['buynow_cac_map'] = array(
            '#type' => 'select',
            '#title' => $this->t('Map'),
            '#default_value' => $config->get('buynow_cac_map'),
            '#description' => $this->t('Enable Map'),
            '#options' => array('FALSE' => $this->t('FALSE'), 'TRUE' => $this->t('TRUE')),

        );

         $form['buynow_cac']['buynow_cac_dualtable'] = array(
            '#type' => 'select',
            '#title' => $this->t('Dual Table'),
            '#default_value' => $config->get('buynow_cac_dualtable'),
            '#description' => $this->t('Enable Map'),
            '#options' => array('FALSE' => $this->t('FALSE'), 'TRUE' => $this->t('TRUE')),

        );


        $form['buynow_cac']['buynow_cac_filter'] = array(
            '#type' => 'select',
            '#title' => $this->t('Filter'),
            '#default_value' => $config->get('buynow_cac_filter'),
            '#description' => $this->t('Filter type'),
            '#options' => array('checkbox' => $this->t('Checkbox'), 'select' => $this->t('Select')),

        );


         /// buy now range settings
        $form['buynow_rangebtn'] = [
            '#type' => 'details',
            '#title' => $this->t('Range Button Settings'),
            '#group' => 'settings',
        ];

        $form['buynow_rangebtn']['buynow_rangebtn_status'] = array(
            '#type' => 'select',
            '#title' => $this->t('Range Status'),
            '#default_value' => $config->get('buynow_rangebtn_status'),
            '#options' => array(0 => $this->t('Disabled'), 1 => $this->t('Enabled')),
            '#description' => $this->t('Range Button Enabled/Disabled'),
        );

        $form['buynow_rangebtn']['buynow_rangebtn_label'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Range Button Label'),
            '#default_value' => $config->get('buynow_rangebtn_label'),
            '#description' => $this->t('e.g. View Our Range'),
        );


        $form['buynow_rangebtn']['buynow_rangebtn_id'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Range ID'),
            '#default_value' => $config->get('buynow_rangebtn_id'),
            '#description' => $this->t('e.g. 133303 - provided by Fusepump'),
        );

        $form['buynow_rangebtn']['buynow_rangebtn_class'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Range Button Class'),
            '#default_value' => $config->get('buynow_rangebtn_class'),
            '#description' => $this->t('e.g. buynow-button-class'),
        );

        $form['buynow_rangebtn']['buynow_rangebtn_buttonid'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Range Button ID'),
            '#default_value' => $config->get('buynow_rangebtn_buttonid'),
            '#description' => $this->t('e.g. buynow-button-id'),
        );

        $form['buynow_rangebtn']['buynow_rangebtn_ext_url'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Range Button External URL'),
            '#default_value' => $config->get('buynow_rangebtn_ext_url'),
            '#description' => $this->t('e.g. http://www.amazon.com<br/><span style="color: red; font-weight: bold;">Please note when completed it will ignore all other Range Buy Now settings and redirect to this external link via a new tab</span>'),
        );

          /// buy now product settings
        $form['buynow_productbtn'] = [
            '#type' => 'details',
            '#title' => $this->t('Product Button Settings'),
            '#group' => 'settings',
        ];

        $form['buynow_productbtn']['buynow_productbtn_status'] = array(
            '#type' => 'select',
            '#title' => $this->t('Product Button Status'),
            '#default_value' => $config->get('buynow_productbtn_status'),
            '#options' => array(0 => $this->t('Disabled'), 1 => $this->t('Enabled')),
            '#description' => $this->t('Product Button Button Enabled/Disabled<br/><span style="color: red; font-weight: bold;">Please note if this button is disabled it will remove all product buy now buttons with JavaScript</span>'),
        );


        $form['buynow_productbtn']['buynow_productbtn_label'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Product Button Label'),
            '#default_value' => $config->get('buynow_productbtn_label'),
            '#description' => $this->t('Product Button Label<br/><span style="color: red; font-weight: bold;">Please note if this field is completed it will replace all local translations with JavaScript</span>'),
        );

        $form['buynow_productbtn']['buynow_productbtn_class'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Product Button Class'),
            '#default_value' => $config->get('buynow_productbtn_class'),
            '#description' => $this->t('Class of button to target to assign specific values to e.g. buynow-button <br/><b>Please not this should be the button class of the anchor text/button</b>'),
        );

        $form['buynow_productbtn']['buynow_productbtn_external_url'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Product Button External URL'),
            '#default_value' => $config->get('buynow_productbtn_external_url'),
            '#description' => $this->t('e.g. http://www.amazon.com/product/1<br/><span style="color: red; font-weight: bold;">Please note this will remove all Fusepump functionality on all products and provide it with an external link that opens in a new tab.</span>'),
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
        $this->config('nhsc_module_buynow.settings')
            // Save form elements
            ->set('buynow_brand', $form_state->getValue('buynow_brand'))
            ->set('buynow_unit', $form_state->getValue('buynow_unit'))
            ->set('buynow_environment', $form_state->getValue('buynow_environment'))
            ->set('buynow_country', $form_state->getValue('buynow_country'))
            ->set('buynow_language', $form_state->getValue('buynow_language'))
            ->set('buynow_showprice', $form_state->getValue('buynow_showprice'))
            ->set('buynow_version', $form_state->getValue('buynow_version'))
            ->set('buynow_styling_background', $form_state->getValue('buynow_styling_background'))
            ->set('buynow_styling_backgroundopacity', $form_state->getValue('buynow_styling_backgroundopacity'))
            ->set('buynow_styling_backgroundimg', $form_state->getValue('buynow_styling_backgroundimg'))
            ->set('buynow_styling_backgroundimgopacity', $form_state->getValue('buynow_styling_backgroundimgopacity'))
            ->set('buynow_styling_borderwidth', $form_state->getValue('buynow_styling_borderwidth'))
            ->set('buynow_styling_borderradius', $form_state->getValue('buynow_styling_borderradius'))
            ->set('buynow_styling_img_position', $form_state->getValue('buynow_styling_img_position'))
            ->set('buynow_styling_fontfamily', $form_state->getValue('buynow_styling_fontfamily'))
            ->set('buynow_styling_fontsize', $form_state->getValue('buynow_styling_fontsize'))
            ->set('buynow_styling_ctacolor', $form_state->getValue('buynow_styling_ctacolor'))
            ->set('buynow_styling_ctafontcolor', $form_state->getValue('buynow_styling_ctafontcolor'))
            ->set('buynow_styling_ctahovercolor', $form_state->getValue('buynow_styling_ctahovercolor'))
            ->set('buynow_styling_ctafonthovercolor', $form_state->getValue('buynow_styling_ctafonthovercolor'))
            ->set('buynow_cac_geolocate', $form_state->getValue('buynow_cac_geolocate'))
            ->set('buynow_cac_autocomplete', $form_state->getValue('buynow_cac_autocomplete'))
            ->set('buynow_cac_storelocation', $form_state->getValue('buynow_cac_storelocation'))
            ->set('buynow_cac_map', $form_state->getValue('buynow_cac_map'))
            ->set('buynow_cac_dualtable', $form_state->getValue('buynow_cac_dualtable'))
            ->set('buynow_cac_filter', $form_state->getValue('buynow_cac_filter'))
            ->set('buynow_rangebtn_status', $form_state->getValue('buynow_rangebtn_status'))
            ->set('buynow_rangebtn_label', $form_state->getValue('buynow_rangebtn_label'))
            ->set('buynow_rangebtn_id', $form_state->getValue('buynow_rangebtn_id'))
            ->set('buynow_rangebtn_class', $form_state->getValue('buynow_rangebtn_class'))
            ->set('buynow_rangebtn_buttonid', $form_state->getValue('buynow_rangebtn_buttonid'))
            ->set('buynow_rangebtn_ext_url', $form_state->getValue('buynow_rangebtn_ext_url'))
             ->set('buynow_productbtn_status', $form_state->getValue('buynow_productbtn_status'))
             ->set('buynow_productbtn_label', $form_state->getValue('buynow_productbtn_label'))
             ->set('buynow_productbtn_class', $form_state->getValue('buynow_productbtn_class'))
             ->set('buynow_productbtn_external_url', $form_state->getValue('buynow_productbtn_external_url'))
            ->save();

        parent::submitForm($form, $form_state);
    }


}
