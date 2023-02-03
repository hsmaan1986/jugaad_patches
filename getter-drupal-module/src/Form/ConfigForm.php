<?php

namespace Drupal\getter\Form;

use Drupal\Component\Utility\Random;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ConfigForm extends ConfigFormBase
{
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'getter_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return [
      'getter.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('getter.settings');

    $random = new Random();
    $default_user = $config->get('default_user') ? $config->get('default_user') : 1;
    $token = $config->get('token') ? $config->get('token') : $random->name(32, 1);

    $form['default_user'] = [
      '#title' => ('Default User'),
      '#description' => ('Default user for to content created through Getter.'),
      '#type' => 'entity_autocomplete',
      '#target_type' => 'user',
      '#required' => TRUE,
      '#default_value' => \Drupal\user\Entity\User::load($default_user),
      '#selection_settings' => [
        'include_anonymous' => FALSE,
        'filter' => [
          'role' => ['Administrator'],
        ],
      ],
    ];

    // Auth Token.
    $form['token'] = [
      '#type' => 'textfield',
      '#title' => t('Auth Token'),
      '#size' => 40,
      '#maxlength' => 128,
      '#description' => $this->t('Authentication token for Getter'),
      '#default_value' => $token,
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#description' => $this->t('Submit, #type = submit'),
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['export'] = [
      '#type' => 'button',
      '#value' => $this->t('Export Field Config'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if ($form_state->getTriggeringElement()['#id'] === 'edit-export') {
      $url = URL::fromRoute('getter.export')->toString();
      $redirect =  new RedirectResponse($url);
      $redirect->send();
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // Retrieve the configuration
    $this->configFactory->getEditable('getter.settings')
      // Set the submitted configuration setting
      ->set('default_user', $form_state->getValue('default_user'))
      ->set('token', $form_state->getValue('token'))
      ->save();

    parent::submitForm($form, $form_state);

  }
}
