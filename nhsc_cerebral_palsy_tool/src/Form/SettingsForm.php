<?php

namespace Drupal\nhsc_cerebral_palsy_tool\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Class SettingsForm.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return [
      'nhsc_cerebral_palsy_tool.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('nhsc_cerebral_palsy_tool.settings');

    $form['cerebral_palsy_tool'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['landing'] = [
      '#type' => 'details',
      '#title' => $this->t('Landing Page'),
      '#description' => $this->t('Configure Landing Page for My Child with Cerebral Palsy'),
      '#group' => 'cerebral_palsy_tool',
    ];

    $form['landing_card'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Home page Card'),
      '#description' => $this->t('Configure welcome card'),
      '#group' => 'landing',
    ];

    $form['landing']['welcome_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Welcome Title'),
      '#default_value' => $config->get('welcome_title'),
      '#required' => true,
    ];

    $form['landing']['welcome_image'] = [
      '#type' => 'managed_file',
      '#title' => t('Welcome Image'),
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
        'file_validate_size' => [25600000],
      ],
      '#default_value' => $config->get('welcome_image'),
      '#upload_location' => 'public://cerebral-palsy',
      '#required' => TRUE,
    ];

    $form['landing']['welcome_text'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Welcome Text'),
      '#description' => $this->t('Description/body welcome copy'),
      '#default_value' => $config->get('welcome_text')['value'],
      '#format' => 'rich_text',
      '#required' => true,
    ];

    $form['landing_card']['more_info_text'] = [
      '#type' => 'text_format',
      '#title' => $this->t('More Information Text'),
      '#description' => $this->t('More information/body welcome copy'),
      '#default_value' => $config->get('more_info_text')['value'],
      '#format' => 'rich_text',
      '#required' => true,
    ];

    $form['landing_card']['more_info_cta_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('More Information CTA label'),
      '#default_value' => $config->get('more_info_cta_text'),
      '#required' => true,
    ];

    $form['landing_card']['more_info_cta_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('More Information CTA URL'),
      '#default_value' => $config->get('more_info_cta_link'),
      '#required' => true,
    ];

    $form['landing_card']['continue_text'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Continue Text'),
      '#default_value' => $config->get('continue_text')['value'],
      '#format' => 'rich_text',
      '#required' => true,
    ];

    $form['landing_card']['continue_cta_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Continur CTA label'),
      '#default_value' => $config->get('continue_cta_text'),
      '#required' => true,
    ];

    $form['landing_card']['continue_cta_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Continue CTA URL'),
      '#default_value' => $config->get('continue_cta_link'),
      '#required' => true,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Configuration'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    parent::submitForm($form, $form_state);

    if($form_state->getValue('welcome_image')) {
      // Set file status to permanent.
      $image = $form_state->getValue('welcome_image');
      $file = File::load($image[0]);
      $file->setPermanent();
      $file->save();
      // Add to file usage calculation.
      \Drupal::service('file.usage')->add;
    }

    $this->config('nhsc_cerebral_palsy_tool.settings')
      ->set('welcome_image', $form_state->getValue('welcome_image'))
      ->set('welcome_text', $form_state->getValue('welcome_text'))
      ->set('more_info_text', $form_state->getValue('more_info_text'))
      ->set('more_info_cta_text', $form_state->getValue('more_info_cta_text'))
      ->set('more_info_cta_link', $form_state->getValue('more_info_cta_link'))
      ->set('continue_text', $form_state->getValue('continue_text'))
      ->set('continue_cta_text', $form_state->getValue('continue_cta_text'))
      ->set('continue_cta_link', $form_state->getValue('continue_cta_link'))
      ->set('welcome_title', $form_state->getValue('welcome_title'))
      ->save();
  }

}
