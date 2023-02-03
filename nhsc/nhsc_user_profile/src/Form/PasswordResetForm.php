<?php

namespace Drupal\nhsc_user_profile\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Password\PasswordInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Password Reset Form.
 */
class PasswordResetForm extends FormBase {

    public $market_code;
    /**
     * The password service class.
     *
     * @var \Drupal\Core\Password\PasswordInterface
     */
    protected $password;

    /**
     * {@inheritdoc}
     */
    public function __construct(PasswordInterface $password) {
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static($container->get('password'));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        // get module's configs
        $config                 = $this->config('nhsc_user_profile.config');
        $this->market_code      = $config->get('market_code');

        $form['heading'] = [
            //'#type' => 'password',
            //'#title' => $this->t('Current Password'),
            '#markup' => '<h1 class="page-title-text register-title">' . $this->t('CHANGE PASSWORD') . '</h1>',
        ];

        $form['password_current'] = [
            '#type' => 'password',
            '#title' => $this->t('Current Password'),
            '#required' => true,
        ];

        switch ($this->market_code) {
            case 'UK':
                $form['account']['pass'] = [
                    '#type' => 'password_confirm',
                    '#title' => $this->t('New Password'),
                    '#required' => true,
                ];
                break;
            case 'BR':
                $form['password'] = [
                    '#type' => 'password_confirm',
                    '#title' => $this->t('New Password'),
                    '#required' => true,
                ];
                break;
        }

        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Reset Password'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_user_profile_password_reset_form';
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        $values         = $form_state->getValues();
        $formdata       = \Drupal::request()->request;

        $uid            = \Drupal::currentUser()->id();
        $user           = \Drupal\user\Entity\User::load($uid);
        $password_hash  = $user->getPassword();
        $password       = ($this->market_code == 'BR') ? $values['password'] :
            $formdata->get('pass')['pass1'];

        if (!$this->password->check($values['password_current'], $password_hash)) {
            $form_state->setErrorByName('password_current', t('Current password is invalid.'));
            return;
        }

        if ($values['password_current'] === $password) {
            $form_state->setErrorByName('password', t('New password cannot be the same is the current password.'));
            return;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $values     = $form_state->getValues();
        $formdata   = \Drupal::request()->request;
        $password   = ($this->market_code == 'BR') ? $values['password'] :
            $formdata->get('pass')['pass1'];

        $uid        = \Drupal::currentUser()->id();
        $user       = \Drupal\user\Entity\User::load($uid);

        $user->setPassword($password);
        $user->save();

        //_nhsc_user_profile_mail_notify('password_reset', $user);

        //logout user
        user_logout();

        // redirect to login page
        $url = Url::fromRoute('user.login')->toString();
        $response = new RedirectResponse($url, [], ['absolute' => true]);
        $response->send();
    }

}