<?php
/**
 * @file
 * Contains \Drupal\atitude_webmeeting\Form\VideoForm.
 */
namespace Drupal\atitude_webmeeting\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;

class VideoForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'video_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    //TEST DATA

    $timestamp = time();
    $site_key = 'a9HD';
    $chave_acesso = 'ZWE3YTM0ZTEzZGQwYzI5YmVjZmJjZjE2OGU2YzM4NjBhODI5ZGQ0YQ==';
    $token = sha1($chave_acesso . $site_key . $timestamp);


    $form['site_key'] = array(
      '#type' => 'hidden',
      '#value' =>   $site_key,
      '#required' => TRUE,
    );
    $form['timestamp'] = array(
      '#type' => 'hidden',
      '#value' => $timestamp,
      '#required' => TRUE,
    );
    $form['token'] = array(
      '#type' => 'hidden',
      '#value' => $token,
      '#required' => TRUE,
    );
    $form['webmeeting'] = array(
      '#type' => 'hidden',
      '#value' => 'W4FXV',
      '#required' => TRUE,
    );

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name:'),
      '#required' => TRUE,
    );

    $form['email'] = array(
      '#type' => 'textfield',
      '#title' => t('Email:'),
      '#required' => TRUE,
    );
    $form['actions']['#type'] = 'actions';
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('VER'),
      '#button_type' => 'primary',
      '#ajax' => array(
      //    'url' => 'https://api.webmeeting.com.br/api/signin',
           'callback' => '::atitude_ajax_callback' ,
          )

    );
    // $form['#action'] = 'https://api.webmeeting.com.br/api/signin';
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {




  }
  //TEST method

  function atitude_ajax_callback($form, $form_state) {



    $client = \Drupal::httpClient();
    $url = 'https://api.webmeeting.com.br/api/signin';
    $method = 'POST';

    $options = [];
       foreach ($form_state->getValues() as $key => $value) {
            $options['form_params'][$key] = $value ;
          }


    try {
      $response = $client->request($method, $url, [
        'form_params' => [
        'site_key' => $form_state->getValue('site_key'),
          'timestamp' => $form_state->getValue('timestamp'),
          'token' =>  $form_state->getValue('token'),
          'email' => 'dev@atitude.com.br',
          'webmeeting' => 'W4FXV',
          'name' => 'Atitude Midia Digital'
          //'teste'=> 1
      ],
      'allow_redirects' => [
      'max'             => 10,        // allow at most 10 redirects.
      'strict'          => true,      // use "strict" RFC compliant redirects.
      'referer'         => true,      // add a Referer header
      'protocols'       => ['https'], // only allow https URLs
    //  'on_redirect'     => $onRedirect,
      'track_redirects' => true
  ],
    'debug' => true]);
      $code = $response->getStatusCode();
      if ($code == 200) {
        $body = $response->getBody()->getContents();
      //  return $body;
      }
    }
    catch (RequestException $e) {
      $ajax_response->addCommand(new HtmlCommand('#block-atitudevideoblock',  print_r($e, true)));

     }





       $options = [
    'dialogClass' => 'popup-dialog-class',
    'width' => '50%',
  ];
    $ajax_response = new AjaxResponse();
    //$response->addCommand(new OpenModalDialogCommand(t('Modal title'), print_r($response, true), $options));

   $ajax_response->addCommand(new HtmlCommand('#block-atitudevideoblock',  print_r($body, true)));
       return $ajax_response;

  }
}
