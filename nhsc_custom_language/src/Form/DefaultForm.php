<?php

namespace Drupal\nhsc_custom_language\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\NodeType;

/**
 * Class DefaultForm.
 */
class DefaultForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nhsc_custom_language.config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nhsc_custom_language_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('nhsc_custom_language.config');

    $form['nodes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nodes'),
      '#maxlength' => 64,
      '#size' => 64,
      '#description' => $this->t('Please specify drupal nodes URL, one per line.'),
      '#default_value' => $config->get('nodes'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('nhsc_custom_language.config')
      ->set('nodes', $form_state->getValue('nodes'))
      ->save();

      \Drupal::messenger()->addMessage('Settings Saved Succesfully');
  }

}
