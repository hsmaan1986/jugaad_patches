<?php

namespace Drupal\nhsc_linked_in_feed\Controller;

use Drupal\Core\Controller\ControllerBase;
use League\OAuth2\Client\Provider\LinkedIn;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Url;

/**
 * Provides route responses for the Example module.
 */
class GetTokenLinkedin extends ControllerBase {

  /**
   * Request.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  public $request;

  /**
   * Class constructor.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $request
   *   Request stack.
   */
  public function __construct(RequestStack $request) {
    $this->request = $request;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    return new static(
    // Load the service required to construct this class.
      $container->get('request_stack')
    );
  }

  /**
   * Returns a callback page for creation Linkedin token.
   *
   * @return array
   *   A simple render array.
   */
  public function getToken() {

    $config = \Drupal::configFactory()
      ->getEditable('nhsc_linked_in_feed.settings');
    $code = $this->request->getCurrentRequest()->get('code');
    $state = $this->request->getCurrentRequest()->get('state');

    if ($code && $state) {
      $client_id = $config->get('linkedin_client_id');
      $client_secret = $config->get('linkedin_client_secret');

      $provider = new LinkedIn([
        'clientId' => $client_id,
        'clientSecret' => $client_secret,
        'redirectUri' => Url::fromUri('base:admin/config/content/nhsc_linked_in_feed/token', ['absolute' => TRUE])
          ->toString(),
      ]);

      try {
        $token = $provider->getAccessToken('authorization_code', [
          'code' => $code,
        ]);

        // Linkedin access token expires every 60 days. Set 55 days
        // from now and inform user with countdown from 55 days instead of 60.
        // 4752000 == 55 days
        $notification_start_interval = 4752000;
        $config->set('linkedin_access_token_expires', time() + $notification_start_interval);
        $config->set('linkedin_access_token', $token->getToken());
        $config->save();

        \Drupal::logger('nhsc_linked_in_feed')
          ->notice($this->t('New Linkedin access token has been generated.'));
        \Drupal::messenger()->addMessage($this->t('New Linkedin access token has been generated.'), 'status');
        $url = Url::fromRoute('nhsc_linked_in_feed.config_form');
        $response = new RedirectResponse($url->toString());
        $response->send();

        // Set flag about send email notification.
        \Drupal::state()->set('nhsc_linked_in_feed_letter_sent', 0);

        return JsonResponse(['status' => 'ok']);
      }
      catch (\Exception $e) {
        $error_string = $this->t('Bad Client Id or Client Secret in the settings. Or user click "Cancel" button in Linkedin Login form, @error', [
          '@error' => $e->getMessage(),
        ]);
        \Drupal::logger('nhsc_linked_in_feed')
          ->error($error_string);
        \Drupal::messenger()->addMessage($error_string, 'error');
        $url = Url::fromRoute('nhsc_linked_in_feed.config_form');
        $response = new RedirectResponse($url->toString());
        $response->send();

        return JsonResponse(['status' => 'ok']);
      }
    }
  }

}
