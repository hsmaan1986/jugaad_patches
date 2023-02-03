<?php

namespace Drupal\nhsc_user_profile\Form;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use Drupal\Core\Link;
use Drupal\Core\Url;

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
            $url = Url::fromRoute('nhsc_user_profile.page_controller_homepage', [], ['absolute' => true])->toString();
            $response = new RedirectResponse($url, 302);
            $response->send();
        }

        // get module's configs
        $config                 = $this->config('nhsc_user_profile.config');
        $this->market_code      = $config->get('market_code');
        $terms_link             = $config->get('terms_link');
        $id_number_tooltip      = $config->get('id_number_tooltip');
        $register_link          = URl::fromRoute('nhsc_user_profile.register', [], ['absolute' => true])->toString();


        $form['#cache'] = ['max-age' => 0];

        // amend field according to market
        switch ($this->market_code) {
            case 'UK': // UK market

                $form['email'] = [
                    '#type' => 'email',
                    '#title' => $this->t('Email Address'),
                    '#placeholder' => 'Please enter your email address.',
                    '#required' => true,
                ];

                $form['account']['pass'] = [
                    '#type' => 'password_confirm',
                    '#title' => null,
                    '#required' => true,
                ];


                $form['identification_number'] = [
                    '#type' => 'textfield',
                    '#title' => t('HCPC or GMC Council Registration number (if relevant)'),
                    '#pattern' => '[A-Za-z]{2}[0-9]{6}',
                    '#placeholder' => 'Please enter your ID number',
                    '#required' => false,
                    '#weight' => -13,
                    '#data-valid-example' => 'AB12345',
                    '#attributes' => [
                        'class' => ['id-number-mask'],
                        'data-toggle' => ['tooltip'],
                        'data-original-title' => $id_number_tooltip,
                    ]
                ];

                $form['occupation'] = [
                    '#default_value' => false,
                    '#type' => 'select',
                    '#title' => $this->t('Occupation'),
                    '#options' => [
                        (string)$this->t('Please select your occupation') => [],// default value
                        'student' => $this->t("I'm a medical student"),
                        'institute' => $this->t('I represent a medical Institution'),
                        (string)$this->t( 'Health Care Professional') => [
                            'hcp1' => $this->t("I'm a Nurse"),
                            'hcp2' => $this->t("I'm a Nutritionist"),
                            'hcp3' => $this->t("I'm a General Practitioner"),
                            'hcp4' => $this->t("I'm a Oncologist"),
                            'hcp5' => $this->t("I'm a Gastroenterologist"),
                            'hcp6' => $this->t("I'm a Surgeon"),
                            'hcp7' => $this->t("I'm a Speech & Language Therapist"),
                            'hcp8' => $this->t("I'm a Pediatrician"),
                            'hcp9' => $this->t("I'm a Dietitian"),
                        ],
                    ],
                    '#required' => true,
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


                break;
            case 'BR':
                $form['first_name'] = [
                    '#type' => 'textfield',
                    '#title' => $this->t('First Name'),
                    '#required' => true,
                    '#weight' => -15,
                ];

                $form['last_name'] = [
                    '#type' => 'textfield',
                    '#title' => $this->t('Last Name'),
                    '#required' => true,
                    '#weight' => -15,
                ];

                $form['email'] = [
                    '#type' => 'email',
                    '#title' => $this->t('Email Address'),
                    '#required' => true,
                    '#weight' => -10,
                ];

                $form['password'] = [
                    '#type' => 'password_confirm',
                    '#title' => null,
                    '#required' => true,
                    '#weight' => -10,
                    '#attributes' => [
                        'style' => ['hello']
                    ]
                ];

                $form['occupation'] = [
                    '#default_value' => false,
                    '#type' => 'select',
                    '#title' => $this->t('Occupation'),
                    '#options' => [
                        (string)$this->t('Please select your occupation') => [],// default value
                        'student' => $this->t("I'm a medicine student"),
                        'institute' => $this->t('I represent a medical Institution'),
                        (string)$this->t('Health Care Professional') => [
                            'hcp1' => $this->t("I'm a Nurse"),
                            'hcp2' => $this->t("I'm a Nutritionist"),
                            'hcp3' => $this->t("I'm a Intensivist"),
                            'hcp4' => $this->t("I'm a Cardiologist"),
                            'hcp5' => $this->t("I'm a General Practitioner"),
                            'hcp6' => $this->t("I'm a Nutrologist"),
                            'hcp7' => $this->t("I'm a Oncologist"),
                            'hcp8' => $this->t("I'm a Gastroenterologist"),
                            'hcp9' => $this->t("I'm a Geriatrics"),
                            'hcp10' => $this->t("I'm a Surgeon"),
                            'hcp11' => $this->t("I'm a Speech Therapist"),
                            'hcp12' => $this->t("I'm a Pediatrician"),
                            'hcp13' => $this->t("I'm a Protologist"),
                            'hcp14' => $this->t("I'm a Endocrinologist"),
                            'hcp16' => $this->t("I'm a Biomedic"),
                            'hcp17'	=> $this->t("I'm a Physical Educator"),
                            'hcp18' => $this->t("I'm a Pharmaceutical"),
                            'hcp19' => $this->t("I'm a Physiotherapist"),
                            'hcp20' => $this->t("I'm a Dentist / Dentistry"),
                            'hcp21' => $this->t("I'm a Psychologist"),
                            'hcp22' => $this->t("I'm a Resident"),
                            'hcp23' => $this->t("I'm a Occupational Therapist"),
                            'hcp15' => $this->t("I'm a Doctor and I have another specialty"),
                        ],
                    ],
                    '#required' => true,
                    '#weight' => -5,
                ];

                $occupation = $form_state->getValue('occupation');

                $form['another_specialty_wrapper'] = [
                    '#type' => 'container',
                    '#attributes' => ['id' => 'another-specialty-wrapper'],
                ];

                $form['another_specialty_wrapper']['another_specialty'] = [
                    '#type' => ($occupation == 'hcp15') ? 'textfield' : 'hidden',
                    '#title' => $this->t('Other Specialty'),
                    '#required' => ($occupation == 'hcp15') ? true : false,
                ];
            default:
                // default?

        }

        $form['privacy_policy'] = [
            '#type' => 'checkbox',
            '#title' => $this->t("I'm aware that my information will be automatically recognised on other WebMeeting platform sites on which I deliberately register"),
            '#required' => true,
        ];

        $form['restricted'] = [
            '#type' => 'checkbox',
            '#title' => $this->t("I’m aware that this site is restricted to health professionals and I assume full responsibility for the veracity of the information above"),
            '#required' => true,
        ];

        $form['terms'] = [
            '#type' => 'checkbox',
            '#title' => $this->t("<a href='" .$terms_link. "' target='_blank'>I agree to Nestle's policies and terms</a>"),
            '#required' => true,
        ];

        if ($this->market_code == 'UK'){
            $form['privacy_policy'] = [
                '#type' => 'checkbox',
                '#title' => $this->t("By registering your account you are agreeing for Nestlé Health Science UK&I
                and Affiliates to process your data. You will only be contacted by Nestlé Health Science UK&I for
                marketing purposes* and can update these preferences at any time. <a href='/privacy-policy' target='_blank'><strong>View our Privacy Policy</strong></a>.
                Nestlé will not share your information with any third party."),
                '#required' => true,
            ];
        }
        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Register'),
        ];

        $login_url = Url::fromRoute('user.login')->toString();
        $form['cancel'] = [
            '#markup' => '<div class="already-register-login"><a href="'.$login_url.'"><span>'.$this->t('Already Registered').'</span>?</a></div>'
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
        return 'nhsc_user_profile_register_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        $uid = \Drupal::currentUser()->id();
        $config_name = sprintf("nhsc_user_profile.user-%s.settings", $uid);
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

        if(empty($values['identification_number']) && $this->market_code !== 'UK'){
            $form_state->setErrorByName('identification_number', t('Please Enter Identification Number'));
        }

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
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $language   = \Drupal::languageManager()->getCurrentLanguage()->getId();
        $formdata   = \Drupal::request()->request;
        $values     = $form_state->getValues();

        $password   = ($this->market_code == 'BR') ? $values['password'] :
            $formdata->get('pass')['pass1'];

        // check cadastro api has error
        if ($form_state->get('api_error') == true && $this->market_code == 'BR'){
            \Drupal::messenger()->addMessage(t('There was a problem creating your account.'), 'error');

            $url = Url::fromRoute('nhsc_user_profile.register');
            $form_state->setRedirectUrl($url);
        }else {

            if ($form_state->get('redirect')) {// check if user exists
                $user_data = user_load_by_mail($values['email']);

                $url = Url::fromRoute('nhsc_user_profile.register_next');
                _nhsc_user_profile_mail_notify('email_registered', $user_data);
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
                $user_data->set('field_receive_visits', 1);
                $user_data->set('field_accept_terms', 1);
                $user_data->set('field_opt_in_communication', 1);

                //save speciality other option
                $occupation = $form_state->getValue('occupation');

                if ($this->market_code == 'UK') {
                    $user_data->set('field_patients', $values['patients']);
                    $user_data->set('field_identification_number', $values['identification_number']);
                    $user_data->set('field_privacy_policy', $values['privacy_policy']);
                    // block user to be activated by email
                    $user_data->block();
                }

                if ($this->market_code == 'BR') {

                    if($occupation == 'hcp15'){
                        $user_data->set('field_speciality', $form_state->getValue('another_specialty'));
                    }

                    $user_data->set('field_first_name', $values['first_name']);
                    $user_data->set('field_last_name', $values['last_name']);
                    $user_data->activate();
                }

                // Save user account.
                if ($result = $user_data->save()) {
                    $new_user = user_load_by_mail($values['email']);

                    if (substr_count($values['occupation'], 'hcp')) {
                        $values['occupation'] = 'hcp';
                    }

                    \Drupal::service('user.data')->set('nhsc_user_profile', $new_user->id(), 'user_profile', $values['occupation']);

                    if ($this->market_code == 'UK') {
                        //_nhsc_user_profile_mail_notify('email_unregistered', $new_user);
                        _nhsc_user_profile_register_mail_notify($new_user);
                    }

                    $url = Url::fromRoute('nhsc_user_profile.register_next', [], ['absolute' => true]);
                    $form_state->setRedirectUrl($url);
                } else {
                    \Drupal::messenger()->addMessage(t('There was a problem creating your account.'), 'error');

                    $url = Url::fromRoute('nhsc_user_profile.register', [], ['absolute' => true]);
                    $form_state->setRedirectUrl($url);
                }
            }
        }
    }

}
