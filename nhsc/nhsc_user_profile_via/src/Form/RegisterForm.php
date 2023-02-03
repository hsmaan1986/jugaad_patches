<?php

namespace Drupal\nhsc_user_profile_via\Form;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\nhsc_user_profile_via\Controller\PageController;

/**
 * Implements InputDemo form controller.
 *
 * This example demonstrates the different input elements that are used to
 * collect data in a form.
 */
class RegisterForm extends FormBase {

    public $market_code;



    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $user = \Drupal::currentUser();
        if ($user->id() !== 0) {
            $url = Url::fromRoute('nhsc_user_profile_via.page_controller_homepage')->toString();
            $response = new RedirectResponse($url);
            $response->send();
        }

        $controller = new PageController();

        // get module's configs
        $config                 = $this->config('nhsc_user_profile_via.config');
        $this->market_code      = $config->get('market_code');
        $terms_link             = $config->get('terms_link');
        $policy_link             = $config->get('policy_link');
        $id_number_tooltip      = $config->get('id_number_tooltip');

        $form['#cache'] = ['max-age' => 0];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email address'),
            '#placeholder' => t('Please enter your email address'),
            '#required' => true,
            '#weight' => -10,
        ];

        $form['account']['pass'] = [
            '#type' => 'password_confirm',
            '#title' => null,
            '#required' => true,
            '#weight' => -5,
        ];

        $form['occupation'] = [
            '#default_value' => false,
            '#type' => 'select',
            '#title' => $this->t('Job role'),
            '#options' => [
                'student' => $this->t("I'm a Student Dietitian"),
                'hcp1' => $this->t("I'm a Dietitian"),
                'hcp2' => $this->t("I'm a Dietetic Assistant"),
                'hcp3' => $this->t("I'm a GP"),
                'hcp4' => $this->t("I'm a Pharmacist"),
                'hcp5' => $this->t("I'm a Specialist Nurse"),
                'hcp6' => $this->t("I'm a Consultant"),
                'hcp7' => $this->t("I'm a Junior Doctor"),
                'hcp9' => $this->t("I'm a Researcher"),
                'hcp10' => $this->t("I'm a Speech and Language Therapist"),
                'hcp11' => $this->t("Other"),
            ],
            '#ajax' => [
                'callback' => [$this, 'updateJobRole'],
                'event' => 'change',
                'wrapper' => 'university-name-wrapper',
                'progress' => ['type' => 'none'],
            ],
            "#empty_option"=> t('Please select your job role'),
            '#required' => true,
        ];

        $occupation = $form_state->getValue('occupation');

        $form['another_specialty_wrapper'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'another-specialty-wrapper'],
        ];

        $form['another_specialty_wrapper']['another_specialty'] = [
            '#type' => ($occupation == 'hcp11') ? 'textfield' : 'hidden',
            '#title' => $this->t('Other specialty'),
            '#required' => ($occupation == 'hcp11') ? true : false,
        ];

        $form['patients'] = [
            '#type' => 'select',
            '#title' => $this->t('Which patients do you see?'),
            '#empty_option' => $this->t('Please select your patients'),
            '#options' => [
                'paeds' => $this->t('Paediatrics'),
                'adults' => $this->t('Adults'),
                'both' => $this->t('Both'),
            ],
            '#required' => true,
        ];

        $form['country'] = [
            '#type' => 'select',
            '#title' => $this->t('Country'),
            '#empty_option' => $this->t('Please select your country'),
            '#options' => $controller->getCountrylist(),
            '#required' => true,
            '#ajax' => [
                'callback' => 'updateForm',
                'event' => 'change',
                'wrapper' => 'countryfields-wrapper',
                'progress' => ['type' => 'none'],
            ]
        ];

        $country = $form_state->getValue('country');

        $form['countryfields_wrapper'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'countryfields-wrapper'],
        ];

        $form['university_name_wrapper'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'university-name-wrapper'],
        ];


        $form['university_name_wrapper']['university_name'] = [
            '#type' => ($occupation === 'student') ? 'textfield' : 'hidden',
            '#title' => t('University Name'),
            '#placeholder' => t('Please enter your university name'),
            '#required' => ($occupation === 'student') ? true : false,
        ];

        $form['countryfields_wrapper'] ['place_of_work'] = [
            '#type' => 'textfield',
            '#title' => t('Place Of Work'),
            '#required' => ($country === 'United Kingdom') ? true : false,
            '#autocomplete_route_name' => ($country === 'United Kingdom') ? 'nhsc_user_profile_via.place_autocomplete' : null,
            '#placeholder' => ($country === 'United Kingdom') ? t('Please begin typing your organisation and then select it from the list') : t('Please enter your place of work'),
            '#description_display' => 'after',
        ];

        $form['countryfields_wrapper']['region_of_work'] = [
            '#type' => ($country === 'United Kingdom') ? 'select' : 'textfield',
            '#title' => t('Region Of Work'),
            '#placeholder' => t('Please enter your region of work'),
            '#required' => ($country === 'United Kingdom') ? true : false,
            '#options' => ($country === 'United Kingdom') ? $controller->get_taxonomy_term('regions') : null,
        ];

        $form['hear_about_via'] = [
            '#type' => 'select',
            '#title' => t('How did you hear about VIA?'),
            '#empty_option' => t('Please select your option'),
            '#options' => $controller->getHearlist(),
            '#required' => true,

        ];

        $form['restricted'] = [
            '#type' => 'checkbox',
            '#title' => $this->t("I’m aware that this site is restricted to health professionals and I assume full responsibility for the veracity of the Information above"),
            '#required' => true,
        ];

        $form['terms'] = [
            '#type' => 'checkbox',
            '#title' => $this->t("I agree to Vitaflo's <a href='" .$terms_link. "' target='_blank'>terms and conditions</a> and <a href='" .$policy_link. "' target='_blank'>privacy policy</a>"),
            '#required' => true,
        ];


        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Register'),
        ];

        $form['cancel'] = [
            '#markup' => '<div class="already-register-login"><a href="/user/login"><span>'.$this->t('Already Registered').'</span>?</a></div>',
        ];

        return $form;
    }

    /**
     * Ajax callback for the specific dropdown.
     */
    public function updateOccupation(array $form, FormStateInterface $form_state) {
        return $form['another_specialty_wrapper'];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_user_profile_via_register_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        $uid = \Drupal::currentUser()->id();
        $config_name = sprintf("nhsc_user_profile_via.user-%s.settings", $uid);
        return [
            $config_name,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {

        $values = $form_state->getValues();

        $email = \Drupal::service('email.validator')->isValid($values['email']);

        if (!$email) {
            $form_state->setErrorByName('email', t('Email address is invalid.'));
        } else {
            $user = user_load_by_mail($values['email']);// Check if email exists

            if (!empty($user)) {// check if user exists
                $form_state->set('redirect', true);
            }
        }

    }

    /**
     * Ajax callback for the specific dropdown.
     */
    function updateForm(array $form, FormStateInterface $form_state) {
        return $form['countryfields_wrapper'];
    }

    /**
     * Ajax callback for the specific dropdown.
     */
    function updateJobRole(array $form, FormStateInterface $form_state) {
        return $form['university_name_wrapper'];
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $language   = \Drupal::languageManager()->getCurrentLanguage()->getId();
        $formdata   = \Drupal::request()->request;
        $values     = $form_state->getValues();

        $password   = $formdata->get('pass')['pass1'];

        $job_roles  = [
            'student' => t("Student Dietitian"),
            'hcp1' => t("Dietitian"),
            'hcp2' => t("Dietetic Assistant"),
            'hcp3' => t("GP"),
            'hcp4' => t("Pharmacist"),
            'hcp5' => t("Specialist Nurse"),
            'hcp6' => t("Consultant"),
            'hcp7' => t("Junior Doctor"),
            'hcp9' => t("Researcher"),
            'hcp10' => t("Speech and Language Therapist"),
            'hcp11' => t("Other"),
        ];

        $occupation = $job_roles[$values['occupation']];


        if ($form_state->get('redirect')) {// check if user exists
            $user_data = user_load_by_mail($values['email']);

            $url = Url::fromRoute('nhsc_user_profile_via.register_next');
            _nhsc_user_profile_via_mail_notify('email_registered', $user_data);
            $form_state->setRedirectUrl($url);
        } else {
            $user_data = User::create();
            $user_data->enforceIsNew();

            $user_data->setEmail($values['email']);
            $user_data->setPassword($password);
            $user_data->setUsername($values['email']);

            $user_data->set('langcode', $language);
            $user_data->set('preferred_langcode', $language);
            $user_data->set('preferred_admin_langcode', $language);
            // Optional.
            $user_data->set('init', 'email');
            $user_data->set('field_accept_terms', $values['terms']);
//            $user_data->set('field_opt_in_communication', 1);
            $user_data->set('field_patients', $values['patients']);
            // save occupation
            if($occupation == 'Other'){
                $user_data->set('field_speciality', $form_state->getValue('another_specialty'));
            }else{
                $user_data->set('field_speciality', $occupation);
            }

            // save additional fields
            $user_data->set('field_country', $values['country']);
            $user_data->set('field_university_name', $values['university_name']);
            $user_data->set('field_place_of_work', $values['place_of_work']);
            $user_data->set('field_region_of_work', $values['region_of_work']);
            $user_data->set('field_how_did_you_hear', $values['hear_about_via']);


            // block user to be activated by email
            $user_data->block();


            // Save user account.
            if ($result = $user_data->save()) {
                $new_user = user_load_by_mail($values['email']);

                if (substr_count($values['occupation'], 'hcp')) {
                    $values['occupation'] = 'hcp';
                }

                \Drupal::service('user.data')->set('nhsc_user_profile_via', $new_user->id(), 'user_profile', $values['occupation']);

                _nhsc_user_profile_via_register_mail_notify($new_user);

                $url = Url::fromRoute('nhsc_user_profile_via.register_next');
                $form_state->setRedirectUrl($url);
            } else {
                \Drupal::messenger()->addMessage(t('There was a problem creating your account.'), 'error');

                $url = Url::fromRoute('nhsc_user_profile_via.register');
                $form_state->setRedirectUrl($url);
            }
        }
    }

}
