<?php

namespace Drupal\nhsc_cadastro_unico_api\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\nhsc_cadastro_unico_api\ApiService;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Class PasswordResetForm.
 */
class PasswordResetForm extends FormBase
{

    /**
     * Drupal\nhsc_cadastro_unico_api\ApiService definition.
     *
     * @var \Drupal\nhsc_cadastro_unico_api\ApiService
     */
    protected $api;

    /**
     * Constructs a new PasswordResetForm object.
     */
    public function __construct(ApiService $nhsc_cadastro_unico_api)
    {
        $this->api = $nhsc_cadastro_unico_api;
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('nhsc_cadastro_unico_api')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nhsc_cadastro_unico_api_password_reset_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $token = null)
    {
        $form['token'] = [
            '#type' => 'hidden',
            '#value' => $token,
        ];

        $form['password'] = [
            '#type' => 'password_confirm',
            '#title' => null,
            '#size' => 64,
            '#weight' => '0',
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        // Add a reset button that handles the submission of the form.
//        $reset_password_url = Url::fromRoute('user.pass');
//        $form['reset'] = [
//            '#markup' => Link::fromTextAndUrl($this->t('Request Password Reset'), $reset_password_url)->toString(),
//        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $values = $form_state->getValues();
        $token = $values['token'];

        if ($email = $this->api->validatePasswordResetToken($token)) {
//            if ($user = user_load_by_mail($email)) {
                $form_state->set('email', $email);
//            } else {
//                $form_state->setErrorByName('token', t('Token is invalid.'));
//            }
        } else {
            $form_state->setErrorByName('token', t('Token is invalid.'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $values = $form_state->getValues();

        if ($this->api->resetPasswordWithToken($form_state->get('email'), $values['token'], $values['password'])) {
            $user = user_load_by_mail($form_state->get('email'));

            if ($user){
                $user->setPassword($values['password']);
                $user->save();
            }


            \Drupal::messenger()->addMessage(t('Password has been reset. You may now login.'), 'status');
            $url = Url::fromRoute('user.login');
            $form_state->setRedirectUrl($url);
        } else {
            \Drupal::messenger()->addMessage(t('There was a problem updating your password.'), 'error');
            $form_state->setRebuild();
        }

    }

}
