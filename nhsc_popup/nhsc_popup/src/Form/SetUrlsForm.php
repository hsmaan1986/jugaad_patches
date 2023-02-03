<?php
/**
 * @file
 * Contains Drupal\nhsc_popup\Form\SetUrlsForm.
 */
namespace Drupal\nhsc_popup\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SetUrlsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nhsc_popup.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nhsc_popup_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('nhsc_popup.adminsettings');

    $form['url_name'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Add the Url of page where gygia Form is rendred in this format /url'),
      '#description' => $this->t('Configure the URL to gygia form'),
      '#default_value' => $config->get('url_name'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('nhsc_popup.adminsettings')
      ->set('url_name', $form_state->getValue('url_name'))
      ->save();
  }

}
