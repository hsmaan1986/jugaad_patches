<?php

namespace Drupal\ln_c_ip_locator\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for ln_c_ip_locator.
 */
class GeoIPCountryHeaderForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'geoiplocation_country_code';
    }

    /**
     * Gets the configuration names that will be editable.
     *
     * @return array
     *   An array of configuration object names that are editable if called in
     *   conjunction with the trait's config() method.
     */
    protected function getEditableConfigNames() {
        return ['geoip_country_code_header.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('geoip_country_code_header.settings');
        
        $form['service_option'] = [
            '#type' => 'radios',
            '#title' => $this->t('Pick a Geo IP Location Service.'),
            '#options' => [
                'GeoPluginWebService' => $this->t('GeoPlugin Web Service'),
                'GeoIp2WebService' => $this->t('MaxMind\'s Geolocate IP Web Service'),
                'GeoIp2Database' => $this->t('MaxMind\'s Geolocate Database'),
                '' => $this->t('None of the above'),
            ],
            '#default_value' => $config->get('service_option') ?? NULL,
            '#attributes' => [
                'name' => 'service_option'
            ]
        ];

        // GEOPLUGIN
        $form['geoplugin_webservice'] = [
            '#type' => 'textfield',
            '#title' => $this->t('geoPlugin Web Service url'),
            '#default_value' => $config->get('geoplugin_webservice') ?? NULL,
            '#weight' => 100,
            '#states' => [
                'visible' => [
                    ':input[name="service_option"]' => ['value' => 'GeoPluginWebService'],
                ],
            ],
            '#prefix' => '<div style="margin: 1.75em 0">',
            '#suffix' => '</div>',
        ];

        // MAXMIND WEB
        $form['maxmind_webservice_user_id'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Max Mind User ID'),
            '#default_value' => $config->get('maxmind_webservice_user_id') ?? NULL,
            '#states' => [
                'visible' => [
                    ':input[name="service_option"]' => ['value' => 'GeoIp2WebService'],
                ],
            ],
            '#prefix' => '<div style="margin-top: 1.75em">',
            '#suffix' => '</div>',
        ];

        $form['maxmind_webservice_license_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Max Mind License Key'),
            '#default_value' => $config->get('maxmind_webservice_license_key') ?? NULL,
            '#states' => [
                'visible' => [
                    ':input[name="service_option"]' => ['value' => 'GeoIp2WebService'],
                ],
            ],
            '#prefix' => '<div style="margin-bottom: 1.75em">',
            '#suffix' => '</div>',
        ];


        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        $service_option = $form_state->getValue('service_option');
        switch($service_option) {
            case 'GeoPluginWebService':
                $url = $form_state->getValue('geoplugin_webservice') ?? '';
                $regex = '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i';
                if ((\filter_var($url, FILTER_VALIDATE_URL) === FALSE || \preg_match($regex, $url) === FALSE) && !empty($url)) {
                    $form_state->setErrorByName('geoplugin_webservice', $this->t('The url you have entered is not valid, please try again!'));
                }
                break;
            case 'GeoIp2WebService':
                if (empty($form_state->getValue('maxmind_webservice_user_id')) || empty($form_state->getValue('maxmind_webservice_license_key'))) {
                    $form_state->setErrorByName('maxmind_webservice_user_id', $this->t('The User ID / License Key fields are required, please try again!'));
                }
                break;
            case 'GeoIp2Database':
                $form_state->setErrorByName('service_option', $this->t('The Geolocate Database option is not available.'));
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config('geoip_country_code_header.settings');
        $service_option = $form_state->getValue('service_option');
        if ($service_option == NULL || empty($service_option) || $service_option === 'GeoIp2Database') {
            // Erase all configs
            $config->set('maxmind_webservice_user_id', NULL)->save();
            $config->set('maxmind_webservice_license_key', NULL)->save();
            $config->set('geoplugin_webservice', NULL)->save();
        } else {
            switch($service_option) {
                case 'GeoPluginWebService':
                    $config->set('geoplugin_webservice', $form_state->getValue('geoplugin_webservice'))->save();
                    $config->set('maxmind_webservice_user_id', NULL)->save();
                    $config->set('maxmind_webservice_license_key', NULL)->save();
                    break;
                case 'GeoIp2WebService':
                    $config->set('maxmind_webservice_user_id', $form_state->getValue('maxmind_webservice_user_id'))->save();
                    $config->set('maxmind_webservice_license_key', $form_state->getValue('maxmind_webservice_license_key'))->save();
                    $config->set('geoplugin_webservice', NULL)->save();
                break;
            }
        }
        $config->set('service_option', $form_state->getValue('service_option'))->save();
        parent::submitForm($form, $form_state);
    }

}
