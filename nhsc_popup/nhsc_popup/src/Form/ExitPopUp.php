<?php

/**
 * @file
 * Contains Drupal\nhsc_popup\Form\ExitPopUp.
 */

namespace Drupal\nhsc_popup\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\Role;

/**
 * Class ExitPopUp.
 */
class ExitPopUp extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nhsc_popup.adminsettings',
    ];
  }

  /**
   * Get form id.
   */
  public function getFormId() {
    return 'nhsc_popup_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('nhsc_popup.adminsettings');

    $form['nhsc_popup_html'] = [
      '#type' => 'textarea',
      //'#format' => 'restricted_html',
      //'#base_type' => 'textarea',
      '#rows' => 20,
      '#title' => $this->t('HTML Template'),
      '#description' => $this->t('The HTML code to be placed within the popup. HTML can be added through this function or on the page itself within a element.'),
      '#default_value' => $config->get('nhsc_popup_html'),
    ];

    $form['nhsc_popup_css'] = [
      '#type' => 'textarea',
      //'#format' => 'restricted_html',
      '#rows' => 20,
      '#title' => $this->t('Custom CSS'),
      '#description' => $this->t('write custom css for the above html code.'),
      '#default_value' => $config->get('nhsc_popup_css'),
    ];

    $form['nhsc_popup_delay'] = [
      '#type' => 'number',
      '#title' => $this->t('Delay on Display POP UP'),
      '#description' => $this->t('The time, in seconds, until the popup activates and begins watching for exit intent. If showOnDelay is set to true, this will be the time until the popup shows.'),
      '#default_value' => $config->get('nhsc_popup_delay'),
    ];

    $form['nhsc_popup_cookie_exp'] = [
      '#type' => 'number',
      '#title' => $this->t('Cookie Expire Time (in Days)'),
      '#description' => $this->t('The number of days to set the cookie for. A cookie is used to track if the popup has already been shown to a specific visitor. If the popup has been shown, it will not show again until the cookie expires. A value of 0 will always show the popup.'),
      '#default_value' => $config->get('nhsc_popup_cookie_exp'),
    ];

    $form['nhsc_popup_width'] = [
      '#type' => 'number',
      '#title' => $this->t('Width For the POP UP'),
      '#description' => $this->t('The width of the popup. This can be overridden by adding your own CSS for the #bio_ep element.'),
      '#default_value' => $config->get('nhsc_popup_width'),
    ];

    $form['nhsc_popup_height'] = [
      '#type' => 'number',
      '#title' => $this->t('Height For the POP UP'),
      '#description' => $this->t('The width of the popup. This can be overridden by adding your own CSS for the #bio_ep element.'),
      '#default_value' => $config->get('nhsc_popup_height'),
    ];

    $defaultRoles = $config->get('roles');
    $roles = Role::loadMultiple();
    $options = [];
    foreach ($roles as $role) {
      $options[$role->id()] = $role->label();
    }
    $form['roles'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Select roles to show exit popup'),
      '#options' => $options,
      '#default_value' => isset($defaultRoles) ? $defaultRoles : FALSE,
    ];

    $form['cache'] = [
      '#cache' => [
        'max-age' => 0,
      ],
    ];

    return parent::buildForm($form, $form_state);

    /*$config = $this->config('nhsc_popup.adminsettings');

    $form['nhsc_popup_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Welcome message'),
      '#description' => $this->t('Welcome message display to users when they login'),
      '#default_value' => $config->get('nhsc_popup_message'),
    ];
    return parent::buildForm($form, $form_state); */
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    // Get the config object.
    $config = $this->config('nhsc_popup.adminsettings');

    $exitpopup_html = $form_state->getValue('nhsc_popup_html');
    $exitpopup_css = $form_state->getValue('nhsc_popup_css');
    $exitpopup_delay = $form_state->getValue('nhsc_popup_delay');
    $exitpopup_width = $form_state->getValue('nhsc_popup_width');
    $exitpopup_height = $form_state->getValue('nhsc_popup_height');
    $exitpopup_cookie_exp = $form_state->getValue('nhsc_popup_cookie_exp');
    $roles = $form_state->getValue('roles');

    // Set the values the user submitted in the form.
    $config->set('nhsc_popup_html', $exitpopup_html)
      ->set('nhsc_popup_css', $exitpopup_css)
      ->set('nhsc_popup_delay', $exitpopup_delay)
      ->set('nhsc_popup_width', $exitpopup_width)
      ->set('nhsc_popup_height', $exitpopup_height)
      ->set('nhsc_popup_cookie_exp', $exitpopup_cookie_exp)
      ->set('roles', $roles)
      ->save();
  }

}
