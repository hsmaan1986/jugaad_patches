<?php

namespace Drupal\hcp_advice_booking\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class BookingEntitySettingsForm.
 *
 * @ingroup hcp_advice_booking
 */
class BookingEntitySettingsForm extends FormBase
{

    /**
     * Returns a unique string identifying the form.
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId()
    {
        return 'bookingentity_settings';
    }

    /**
     * Form submission handler.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->set('email', $form_state->getValue('email'))->save();
        \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->set('about', $form_state->getValue('about'))->save();
        \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->set('where', $form_state->getValue('where'))->save();
        \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->set('user_email', $form_state->getValue('user_email'))->save();
    }

    /**
     * Defines the settings form for Advice Booking entities.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @return array
     *   Form definition array.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['#markup'] = $this->t('Settings form for Expert Advice Booking.');
        $form['email'] = array(
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#required' => TRUE,
            '#default_value' => \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->get('email'),
            '#description' => $this->t("Email to send booking notifications to. Separate multiple addresses with a comma."),
        );
        $form['about'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('"What\'s your inquiry about?" Options'),
            '#description' => $this->t('Please add each on a new line.'),
            '#default_value' => \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->get('about'),
        );
        $form['where'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('"Where do you work?" Options'),
            '#description' => $this->t('Please add each on a new line.'),
            '#default_value' => \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->get('where'),
        );

        $user_email = \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->get('user_email');

        if (!strlen(trim($user_email))) {
            $user_email = 'Greetings. You have successfully placed a booking for Expert Advice at [time] on [date]. ';
            $user_email .= 'Please find an iCal file attached for your convenience. ';
        }

        $form['user_email'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('User confirmation email'),
            '#default_value' => $user_email,
        );
        // Add the token tree UI.
        $form['token_tree'] = array(
            '#theme' => 'token_tree_link',
            '#token_types' => array('user'),
            '#show_restricted' => FALSE,
            '#global_types' => FALSE,
        );
        $form['submit'] = array(
            "#type" => 'submit',
            '#value' => $this->t('Save'),
        );
        return $form;
    }

}
