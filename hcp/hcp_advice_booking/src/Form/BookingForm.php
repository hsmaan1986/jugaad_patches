<?php

namespace Drupal\hcp_advice_booking\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
Use Drupal\Core\File\FileSystemInterface;

/**
 * Class BookingForm.
 */
class BookingForm extends FormBase
{


    protected $step;

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'booking_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $parameters = \Drupal::routeMatch()->getParameters();
        $slot_id = $parameters->get('id');
        $booking_slot = \Drupal::entityTypeManager()->getStorage('booking_entity')->load($slot_id);

        // Make sure that the slot exists and isn't booked.
        if (!$booking_slot) {
            throw new NotFoundHttpException();
        }

        $form['#theme'] = 'hcp_advice_booking_form';

        $date = $booking_slot->booking_start->date->format('l, d F Y');// weekday, day month year
        $form['date'] = array(
            '#markup' => $date,
        );
        $timestamp = $booking_slot->booking_start->date->getTimestamp();
        $length = $booking_slot->length->getValue();
        $starttime = \Drupal::service('date.formatter')->format($timestamp, 'custom', 'H:i', date_default_timezone_get());
        $endtime = \Drupal::service('date.formatter')->format(($timestamp + (60 * $length[0]['value'])), 'custom', 'H:i', date_default_timezone_get());

        $form['time'] = array(
            '#markup' => $starttime . ' - ' . $endtime,
        );


        if ($form_state->get('finish')) {
            $form['finish'] = ['#markup' => 'finished'];

            $user = \Drupal::currentUser();
            $user_email = $user->getEmail();
            $form['email'] = ['#markup' => $user_email];
            $form['home'] = array(
                '#type' => 'submit',
                '#value' => $this->t('Go back to homepage'),
                '#submit' => ['::homeSubmit'],
            );
        } else {

            // Make sure that the slot exists and isn't booked.
            if (!empty($booking_slot->booked_user_id->getValue())) {
                $element = array();
                $form_state->setError($element, t('Sorry, this slot has been booked. Please go back and choose a different one.'));
            }
            $about_options = \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->get('about');
            $about_options = preg_split('/\r\n|\r|\n/', $about_options);
            $about_options = array_combine($about_options, $about_options);
            $form['about'] = array(
                '#label' => $this->t('What\'s your inquiry about?'),
                '#type' => 'select',
                '#options' => $about_options,
            );
            $where_options = \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->get('where');
            $where_options = preg_split('/\r\n|\r|\n/', $where_options);
            $where_options = array_combine($where_options, $where_options);
            $form['where'] = array(
                '#label' => $this->t('Where do you work?'),
                '#type' => 'select',
                '#options' => $where_options,
            );
            $form['phone'] = array(
                '#label' => $this->t('Mobile Number'),
                '#type' => 'textfield',
                '#require' => true,
                '#attributes' => [
                    'data-toggle' => ['tooltip'],
                    'data-original-title' => t('Format: (xxx) xxxxx-xxxx')
                ]
            );
            $form['back'] = array(
                '#type' => 'submit',
                '#value' => $this->t('Back'),
                '#submit' => ['::backSubmit'],
            );
            $form['confirm'] = array(
                '#type' => 'submit',
                '#value' => $this->t('Confirm'),
                '#submit' => ['::confirmSubmit'],
                '#validate' => ['::confirmValidate'],
            );
        }

        return $form;
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
    public function confirmValidate(array &$form, FormStateInterface $form_state)
    {
        $parameters = \Drupal::routeMatch()->getParameters();
        $slot_id = $parameters->get('id');
        $booking_slot = \Drupal::entityTypeManager()->getStorage('booking_entity')->load($slot_id);
        // Make sure that the slot exists and isn't booked.
        if (!empty($booking_slot->booked_user_id->getValue())) {
            $element = array();
            $form_state->setError($element, t('Sorry, this slot has been booked. Please go back and choose a different one.'));
        }
        parent::validateForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function backSubmit(array &$form, FormStateInterface $form_state)
    {
        $form_state->setRedirect('hcp_advice_booking.booking_list_controller_page');
    }

    /**
     * {@inheritdoc}
     */
    public function homeSubmit(array &$form, FormStateInterface $form_state)
    {
        $form_state->setRedirect('<front>');
    }

    /**
     * {@inheritdoc}
     */
    public function confirmSubmit(array &$form, FormStateInterface $form_state)
    {
        $parameters = \Drupal::routeMatch()->getParameters();
        $slot_id = $parameters->get('id');
        $booking_slot = \Drupal::entityTypeManager()->getStorage('booking_entity')->load($slot_id);
        $user = \Drupal::currentUser();

        $booking_slot->booked_about->setValue($form_state->getValue('about'));
        $booking_slot->booked_where->setValue($form_state->getValue('where'));
        $booking_slot->phone->setValue($form_state->getValue('phone'));
        $booking_slot->booked_user_id->setValue($user->id());
        $booking_slot->save();


        $file = file_save_data(_hcp_generate_ical($booking_slot), "temporary://appointment.ics", FileSystemInterface::EXISTS_REPLACE);
        $params = [
            'booking_slot' => $booking_slot,
            // further params as needed by your hook_mail
        ];
        $file = (object)[
            'filename' => $file->getFilename(),
            'uri' => $file->getFileUri(),
            'filemime' => $file->getMimeType(),
        ];

        $params['files'][] = $file;

        $time = $booking_slot->booking_start->date->format('H:i');
        $date = $booking_slot->booking_start->date->format('l, d F Y');// weekday, day month year

        $timestamp = $booking_slot->booking_start->date->getTimestamp();
        $length = $booking_slot->length->value;
        $starttime = \Drupal::service('date.formatter')->format($timestamp, 'custom', 'H:i', date_default_timezone_get());
        $endtime = \Drupal::service('date.formatter')->format(($timestamp + (60 * $length)), 'custom', 'H:i', date_default_timezone_get());


        $userCurrent = \Drupal::currentUser();
        $user = \Drupal\user\Entity\User::load($userCurrent->id());

        $params['time'] = $time;
        $params['end_time'] = $endtime;
        $params['date'] = $date;
        $params['username'] = $user->field_first_name->getValue()[0]['value'];
        $params['lastname'] = $user->field_last_name->getValue()[0]['value'];
        $params['speciality'] = $user->get('field_speciality')->value;
        $params['booking_slot'] = $booking_slot;
        $params['slot_id'] = $slot_id;

        $user_email = $user->getEmail();

        $mail_manager = \Drupal::service('plugin.manager.mail');
        $result = $mail_manager->mail('hcp_advice_booking', 'calendar', $user_email, 'en', $params);

        $emails = explode(',', \Drupal::configFactory()->getEditable('hcp_advice_booking.settings')->get('email'));

        foreach ($emails as $email) {
            $result = $mail_manager->mail('hcp_advice_booking', 'calendar_admin', $email, 'en', $params);
        }

        $form_state->set('finish', TRUE);
        $form_state->setRebuild();
    }
}
