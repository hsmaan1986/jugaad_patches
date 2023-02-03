<?php

namespace Drupal\nhsc_user_profile\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase
{

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'nhsc_user_profile.config',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nhsc_user_profile_config_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('nhsc_user_profile.config');
        $email_token_help = $this->t('Available variables are: [site:name], [site:url], [user:display-name], [user:account-name], [user:mail], [site:login-url], [user:register-url].');

        $roles = [];
        foreach (user_roles() as $name => $role) {
            $roles[$name] = $role->label();
        }

        $form['settings'] = array(
            '#type' => 'vertical_tabs',
            '#title' => t('Settings'),
        );

        $form['market'] = [
            '#type' => 'details',
            '#title' => t('Market Settings'),
            '#group' => 'settings',
        ];

        $form['market']['market_code'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Market Country Code'),
            '#description' => $this->t('i.e: BR, UK'),
            '#default_value' => $config->get('market_code'),
        ];

        $form['formats'] = [
            '#type' => 'details',
            '#title' => t('Formats Settings'),
            '#group' => 'settings',
        ];

        $form['formats']['id_number_pattern'] = [
            '#type' => 'textfield',
            '#title' => $this->t('ID Number Pattern'),
            '#description' => $this->t('i.e: [0-9]{3}[.][0-9]{3}[.][0-9]{3}[-][0-9]{2}'),
            '#default_value' => $config->get('id_number_pattern'),
        ];

        $form['password_settings'] = [
            '#type' => 'details',
            '#title' => t('Password Settings'),
            '#group' => 'settings',
        ];

        $form['password_settings']['password_tooltip'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Password Tooltip'),
            '#description' => $this->t('This is a tooltip shown on a password field.'),
            '#default_value' => $config->get('password_tooltip'),
        ];

        $form['formats']['id_number_mask_pattern'] = [
            '#type' => 'textfield',
            '#title' => $this->t('ID Number Mask Pattern'),
            '#description' => $this->t('i.e: 000.000.000-00'),
            '#default_value' => $config->get('id_number_mask_pattern'),
        ];

        $form['formats']['id_number_tooltip'] = [
            '#type' => 'textfield',
            '#title' => $this->t('ID Number Tooltip'),
            '#description' => $this->t('i.e: XXX.XXX.XXX-XX'),
            '#default_value' => $config->get('id_number_tooltip'),
        ];

        $form['terms'] = array(
            '#type' => 'details',
            '#title' => t('Terms & Conditions'),
            '#group' => 'settings',
        );

        $form['terms']['terms_link'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Terms & Conditions Link'),
            '#description' => $this->t('The page to Nestle\'s Terms and Conditions'),
            '#default_value' => $config->get('terms_link'),
        ];

        $form['roles'] = array(
            '#type' => 'details',
            '#title' => t('Roles'),
            '#group' => 'settings',
        );
        $form['roles']['exempt_roles'] = [
            '#type' => 'checkboxes',
            '#title' => $this->t('Roles which are used by site managers'),
            '#options' => $roles,
            '#description' => $this->t(''),
            '#default_value' => $config->get('exempt_roles'),
        ];
        $form['page'] = array(
            '#type' => 'details',
            '#title' => t('Registration Success Page'),
            '#group' => 'settings',
        );

        $form['forgot'] = array(
            '#type' => 'details',
            '#title' => t('Forgot Password Success Page'),
            '#group' => 'settings',
        );

        $form['page']['registration_message_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Page Title'),
            '#description' => $this->t('The title of the page.'),
            '#default_value' => $config->get('registration_message_title'),
        ];
        $form['page']['registration_message'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Registration Message'),
            '#description' => $this->t('The message displayed to user after the first step in the registration process.'),
            '#default_value' => $config->get('registration_message'),
        ];

        $form['forgot']['forgot_password_message_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Page Title'),
            '#description' => $this->t('The title of the page.'),
            '#default_value' => $config->get('forgot_password_message_title'),
        ];
        $form['forgot']['forgot_password_message'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Forgot Password Message'),
            '#description' => $this->t('The message displayed to user after forgot password process.'),
            '#default_value' => $config->get('forgot_password_message'),
        ];

        $form['email_unregistered'] = array(
            '#type' => 'details',
            '#title' => t('Unregistered User Email '),
            '#description' => $this->t('Edit the welcome email messages sent to new user accounts.') . ' ' . $email_token_help,
            '#group' => 'settings',
        );
        $form['email_unregistered']['email_unregistered_subject'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Subject'),
            '#default_value' => $config->get('email_unregistered.subject'),
        ];
        $form['email_unregistered']['email_unregistered_body'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Body'),
            '#description' => $this->t('Email sent to the user after the first registration step.'),
            '#default_value' => $config->get('email_unregistered.body'),
            '#rows' => 15,
        ];
        $form['email_registered'] = array(
            '#type' => 'details',
            '#title' => t('Registered User Email '),
            '#description' => $this->t('Edit the welcome email messages sent to existing user accounts.') . ' ' . $email_token_help,
            '#group' => 'settings',
        );
        $form['email_registered']['email_registered_subject'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Subject'),
            '#default_value' => $config->get('email_registered.subject'),
        ];
        $form['email_registered']['email_registered_body'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Body'),
            '#description' => $this->t('Email sent to the user after the first registration step.'),
            '#default_value' => $config->get('email_registered.body'),
            '#rows' => 15,
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

        $this->config('nhsc_user_profile.config')
            ->set('exempt_roles', $form_state->getValue('exempt_roles'))
            ->set('terms_link', $form_state->getValue('terms_link'))
            ->set('market_code', $form_state->getValue('market_code'))
            ->set('registration_message_title', $form_state->getValue('registration_message_title'))
            ->set('registration_message', $form_state->getValue('registration_message'))
            ->set('forgot_password_message_title', $form_state->getValue('forgot_password_message_title'))
            ->set('forgot_password_message', $form_state->getValue('forgot_password_message'))
            ->set('email_unregistered.subject', $form_state->getValue('email_unregistered_subject'))
            ->set('email_unregistered.body', $form_state->getValue('email_unregistered_body'))
            ->set('email_registered.subject', $form_state->getValue('email_registered_subject'))
            ->set('email_registered.body', $form_state->getValue('email_registered_body'))
            ->set('id_number_pattern', $form_state->getValue('id_number_pattern'))
            ->set('id_number_mask_pattern', $form_state->getValue('id_number_mask_pattern'))
            ->set('id_number_tooltip', $form_state->getValue('id_number_tooltip'))
            ->set('password_tooltip', $form_state->getValue('password_tooltip'))
            ->save();
    }

}
