<?php

namespace Drupal\ln_c_ip_locator\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Locale\CountryManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides a geo-location redirection setting configurations form.
 */
class IPRedirectionConfForm extends ConfigFormBase {

  /**
   * The country manager.
   *
   * @var \Drupal\Core\Locale\CountryManagerInterface
   */
  protected $countryManager;

  /**
   * Request services.
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $request;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory, CountryManagerInterface $country_manager, Request $request) {
    parent::__construct($config_factory);
    $this->countryManager = $country_manager;
    $this->request = $request;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('country_manager'),
      $container->get('request_stack')->getCurrentRequest()
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['geolocation.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'geolocation_redirection_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $countries = $this->countryManager->getList();
    $form['country'] = [
      '#type' => 'select',
      '#title' => $this->t('Country'),
      '#options' => $countries,
      '#empty_option' => $this->t('- Select a country -'),
      '#attributes' => ['class' => ['country-detect']],
      '#ajax' => [
        'callback' => '::updateCountrySettings',
        'wrapper' => 'country-settings',
      ],
      '#required' => TRUE,
    ];

    $form['country_settings'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'country-settings'],
    ];

    $form['country_settings']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    ];

    $form['country_settings']['country_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country Code'),
      '#size' => 10,
      '#maxlength' => 5,
      '#required' => TRUE,
    ];

    $form['country_settings']['language_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Language Code'),
      '#size' => 10,
      '#maxlength' => 5,
    ];

    // URL.
    $form['country_settings']['url'] = [
      '#type' => 'url',
      '#title' => $this->t('Website URL'),
      '#maxlength' => 255,
      '#size' => 30,
      '#required' => TRUE,
      '#description' => $this->t('Please enter URL in form of %url', ['%url' => 'https://www.nestle.com']),
    ];

    // Delete Button.
    $form['actions']['delete'] = [
      '#type' => 'submit',
      '#value' => $this->t('Delete'),
      '#weight' => 2,
      '#submit' => ['::deleteConfiguration'],
    ];

    // Check for the country URL parameter.
    // @see IPLocatorController::getConfigOverview().
    $config = $this->config('geolocation.settings')->get('country_based_configurations');
    if (!empty($config) && $this->request->getMethod() === 'GET' && !empty($country = $this->request->query->get('country'))) {
      // Set the values as per received parameter value.
      if (array_key_exists($country, $config)) {
        $form['country']['#value'] = $country;
        $this->updateFormValues($form, $config, $country);
      }
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * Ajax callback for fetching the country settings.
   */
  public function updateCountrySettings(array &$form, FormStateInterface $form_state) {
    $country = $form_state->getValue('country');
    $config = $this->config('geolocation.settings')->get('country_based_configurations');
    $this->updateFormValues($form, $config, $country);
    return $form['country_settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $conf = $this->configFactory->getEditable('geolocation.settings');

    $geolocation_settings = $conf->get('country_based_configurations');

    // Prepare configurations array per country-code.
    $geolocation_settings[$form_state->getValue('country')] = [
      'title' => $form_state->getValue('title'),
      'country_code' => $form_state->getValue('country_code'),
      'language_code' => $form_state->getValue('language_code'),
      'url' => $form_state->getValue('url'),
    ];

    $conf->set('country_based_configurations', $geolocation_settings)->save();
    $form_state->setRedirect('ln_c_ip_locator.overview');
    parent::submitForm($form, $form_state);
  }

  /**
   * Custom submission handler for deletion.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function deleteConfiguration(array &$form, FormStateInterface $form_state) {
    $country = $form_state->getValue('country');
    $title = $form_state->getValue('title');
    // Retrieve the configuration.
    $conf = $this->configFactory->getEditable('geolocation.settings');
    $geolocation_settings = $conf->get('country_based_configurations');

    // Unset the settings for simulating delete and save it again.
    unset($geolocation_settings[$country]);
    $conf->set('country_based_configurations', $geolocation_settings)->save();

    // Let the user know about it.
    $form_state->setRedirect('ln_c_ip_locator.overview');
    $this->messenger()->addStatus($this->t('The configuration for @country has been delete', ['@country' => $title]));
  }

  /**
   * Updates the form arbitrary values.
   *
   * @param array $form
   *   Form array.
   * @param array $config
   *   The configuration array.
   * @param string $country
   *   The country code.
   */
  private function updateFormValues(array &$form, array $config, $country) {
    $form['country_settings']['title']['#value'] = $config[$country]['title'];
    $form['country_settings']['country_code']['#value'] = $config[$country]['country_code'];
    $form['country_settings']['language_code']['#value'] = $config[$country]['language_code'];
    $form['country_settings']['url']['#value'] = $config[$country]['url'];
  }

}
