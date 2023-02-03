<?php
namespace Drupal\atitude_webmeeting;
use GuzzleHttp\Client;

class ClientFactory {
  
  /**
  * Return a configured Client object.
  */
  public function get() {
    $config = [
      'base_uri' => 'https://api.webmeeting.com.br',
      'timeout'  => 5.0,
    ];

    $client = new Client($config);
    return $client;
  }

  /**
   * Request the video player from the Atitude APi by webmeeting id.
   *
   * @return Reder Object
   *   Return Video PLayer
   */
  public function get_webmeeting($webmeeting_id) {

    //$user = \Drupal::currentUser();

    try {
        $form_params =  [

            //'email' => $user->get('field_email')->getValue(),
            //'name' => $user->get('name')->getValue(),

            //TEST DATA
            'email' => 'dev@atitude.com.br',
            'webmeeting' => $webmeeting_id,
            'name' => 'Atitude Midia Digital',
            'teste'=> 1
        ];

    $response = $this->api_call('/api/signin', 'POST', NULL,  NULL, $form_params);

    return  $response->getBody();

    } catch (Exception $e) {
        return  'Caught exception: '.  $e->getMessage(). "\n";
    }
  }

    /**
     * Generic Api call method.
     *
     * @return API response
     *
     */
    public function api_call($path, $method = 'POST', $headers = array(), $body = NULL, $form_params = NULL){
    $config_defaults =  \Drupal::config('atitude_webmeeting.apisettings');

      $config = [
        'base_uri' => $config_defaults->get('endpoint'),
        'timeout'  => 5.0,
              ];

      $client = new Client($config);

    //  $endpoint = $this->globals->get('endpoint').$path;
     $endpoint = $path;

    $timestamp = mktime();
    $site_key = $config_defaults->get('site_key');
    $chave_acesso = $config_defaults->get('secret_key');
    $token = sha1($chave_acesso . $site_key . $timestamp);

    $request_params = [];

    if (count($headers)) {

      $request_params['headers']['X-WM-Client-Token']  = $token;
      $request_params['headers']['Content-Type'] = 'application/json';
      $request_params['headers'] =  array_merge($request_params['headers'] , $headers);
     }

    if ($form_params) {
    $request_params['form_params']  =   [
        'site_key' => $site_key,
          'timestamp' => $timestamp,
          'token' => $token,
        ];
      $request_params['form_params'] =  array_merge($request_params['form_params'] , $form_params);

   //$request_params['form_params']  +  $form_params;
    }

    if ($body) {
    $request_params['body'] = $body;
    }

  //  \Drupal::logger('atitude')->notice(print_r($request_params['form_params']));


        try {
             $response =   $client->request($method, $endpoint, $request_params);
        } catch (Exception $e) {
            $response = 'Caught exception: ' .  $e->getMessage() . "\n";
        }

         return $response;

    }


    /**
     * Get Percentage viewd of a webmeeting.
     *
     * @return string
     *   Return Hello string.
     */
    public function get_percentage_webmeeting($user, $event_key) {

      $body = [
        'code' => $event_key,
        'user_email' => $user->email
      ];

      $headers  =  ['X-WM-Event-Code' => $event_key];

      $response = $this->api_call('api/1/users/getUserWatched',  'POST', $headers , $body,  NULL);
      $ajax_response = new AjaxResponse();
      $ajax_response->addCommand(new HtmlCommand('#enroll_block', $response->getBody()));



      return $ajax_response;
    }
}
