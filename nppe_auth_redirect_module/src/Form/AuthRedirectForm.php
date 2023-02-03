<?php

namespace Drupal\nppe_auth_redirect_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AuthRedirectForm.
 */
class AuthRedirectForm extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return [
      'nppe_auth_redirect_module.authredirect',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'auth_redirect_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('nppe_auth_redirect_module.authredirect');
    $form['block_auth'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Block auth'),
      '#description' => $this->t('Disable authentication on site'),
      '#default_value' => $config->get('block_auth'),
    ];

    $form['logging_attempt'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable user access attempt logging'),
      '#description' => $this->t('Entry in drupal logger for tracking on block path'),
      '#default_value' => $config->get('logging_attempt'),
    ];

    $form['allowed_domains'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Allowed domains'),
      '#description' => $this->t('Comma separated list of domains allowed to access authentication.'),
      '#default_value' => $config->get('allowed_domains'),
    ];

    $default_pattern_accepted = $config->get('default_pattern_accepted');
    if (is_null($default_pattern_accepted)) {
      $default_pattern_accepted = "factory";
    }
    $form['default_pattern_accepted'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default Pattern Accepted'),
      '#description' => $this->t('Pipeline separated list REGEX will be added in by the module REGEX    /...|...|.../img     example factory|domain1|domain2'),
      '#default_value' => $default_pattern_accepted,
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

    $this->config('nppe_auth_redirect_module.authredirect')
      ->set('allowed_domains', $form_state->getValue('allowed_domains'))
      ->set('logging_attempt', $form_state->getValue('logging_attempt'))
      ->set('block_auth', $form_state->getValue('block_auth'))
      ->set('default_pattern_accepted', $form_state->getValue('default_pattern_accepted'))
      ->save();
  }

}
