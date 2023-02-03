<?php

namespace Drupal\atitude_webmeeting\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\atitude_webmeeting\ClientFactory;
use GuzzleHttp\Client;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Drupal\Core\Ajax\OpenModalDialogCommand;

/**
 * Class ApiController.
 */

class ApiController extends ControllerBase {

  /**
   * Drupal\atitude_webmeeting\MyClient definition.
   *
   * @var \Drupal\atitude_webmeeting\ClientFactory
   */
  protected $client;
  protected $globals;

  /**
   * {@inheritdoc}
   */
  public function __construct(Client $my_client) {
    $this->client = $my_client;
    $this->globals = $this->config('atitude_webmeeting.apisettings');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('atitude_webmeeting.client')
    );
  }

  /**
   * Request the video player from the Atitude APi by webmeeting id.
   *
   * @return Reder Object
   *   Return Video PLayer
   */
  public function getWebmeeting($webmeeting_id) {

    // $user = \Drupal::currentUser();
    try {
      $form_params = [
        // 'email' => $user->get('field_email')->getValue(),
        // 'name' => $user->get('name')->getValue(),
        // TEST DATA.
        'email' => 'dev@atitude.com.br',
        'webmeeting' => $webmeeting_id,
        'name' => 'Atitude Midia Digital',
        'teste' => 1,
      ];

      $response = $this->apiCall('/api/signin', 'POST', NULL, NULL, $form_params);

    }
    catch (Exception $e) {
      echo 'Caught exception: ', $e->getMessage(), "\n";
    }

    return [
      '#type' => 'markup',
      '#markup' => $response->getBody(),
    ];
  }

  /**
   * Generic Api call method.
   *
   * @return API Url
   *   Description
   */
  public function apiCall($path, $method = 'POST', $headers = [], $body = NULL, $form_params = NULL) {

    // $endpoint = $this->globals->get('endpoint').$path;.

    $endpoint = $path;
    $timestamp = mktime();
    $site_key = $this->globals->get('site_key');
    $chave_acesso = $this->globals->get('secret_key');
    $token = sha1($chave_acesso . $site_key . $timestamp);
    $request_params = [];

    if (count($headers)) {
      $request_params['headers']['X-WM-Client-Token'] = $token;
      $request_params['headers']['Content-Type'] = 'application/json';
      $request_params['headers'] .= $headers;
    }

    if ($form_params) {
      $request_params['form_params'] = [
        'site_key' => $site_key,
        'timestamp' => $timestamp,
        'token' => $token,
      ];
      $request_params['form_params']  .=  $form_params;
    }

    if ($body) {
      $request_params['body'] = $body;
    }
    try {
      $response = $this->client->request($method, $endpoint, $request_params);
    }
    catch (Exception $e) {
      $response = 'Caught exception: ' . $e->getMessage() . "\n";
    }
  }

  /**
   * Get Percentage viewed of a webmeeting.
   *
   * @return string
   *   Return Hello string.
  */
  public function getPercentageWebmeeting($user, $event_key) {
    $body = [
      'code' => $event_key,
      'user_email' => $user->email,
    ];

    $headers = ['X-WM-Event-Code' => $event_key];
    $response = $this->api_call('api/1/users/getUserWatched', 'POST', $headers, $body, NULL);
    $ajax_response = new AjaxResponse();
    $ajax_response->addCommand(new HtmlCommand('#enroll_block', $response->getBody()));
    return $ajax_response;
  }

}
