<?php

namespace Drupal\nppe_auth_redirect_module\EventSubscriber;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Path\CurrentPathStack;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class RedirectAuthSubscriber.
 */
class RedirectAuthSubscriber implements EventSubscriberInterface {

  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Drupal\Core\Path\CurrentPathStack definition.
   *
   * @var \Drupal\Core\Path\CurrentPathStack
   */
  protected $pathCurrent;

  /**
   * Symfony\Component\HttpFoundation\RequestStack definition
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Constructs a new RedirectAuthSubscriber object.
   */
  public function __construct(ConfigFactory $config_factory, CurrentPathStack $path_current, RequestStack $requestStack) {
    $this->configFactory = $config_factory;
    $this->pathCurrent = $path_current;
    $this->requestStack = $requestStack;
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['onUserAuthRequest',100];

    return $events;
  }

  /**
   * This method is called whenever the kernel.request event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   *
   * @return bool | RedirectResponse
   */
  public function onUserAuthRequest(GetResponseEvent $event) {
    $authBlocked = (bool) $this->configFactory->get('nppe_auth_redirect_module.authredirect')
      ->get('block_auth');
    $allowedHosts = explode(',', $this->configFactory->get('nppe_auth_redirect_module.authredirect')
      ->get('allowed_domains'));
    $defaultPatternAccepted = $this->configFactory->get('nppe_auth_redirect_module.authredirect')
      ->get('default_pattern_accepted');
    if (is_null($defaultPatternAccepted)) {
      $defaultPatternAccepted = "factory";
    }
    $currentHostURL = $this->requestStack->getCurrentRequest()->getHttpHost();
/*
    \Drupal::logger('nppe_auth_redirect_module')
          ->notice('currentHostURL: %currentHostURL', [
            '%currentHostURL' => print_r($this->requestStack->getCurrentRequest(),true),

          ]);
*/
    $uri = $this->pathCurrent->getPath();

    $langPrefix = $this->getLanguagePrefix() ?: "";

    $blockedPaths = [
      $langPrefix . '/user/login',
      $langPrefix . '/user/register',
      $langPrefix . '/user/logout',
      $langPrefix . '/user/password',
      $langPrefix . '/admin',
      '/user/login',
      '/user/register',
      '/user/logout',
      '/user/password',
      '/admin'
    ];

    # Check if current URL has the word factory. It will be accepted by default.
    # Global pattern flags
    # i modifier: insensitive. Case insensitive match (ignores case of [a-zA-Z])
    # m modifier: multi line. Causes ^ and $ to match the begin/end of each line (not only begin/end of string)
    # defaultPatternAccepted = factory|domain1|domain2
    $defaultPatternAccepted = '/' . $defaultPatternAccepted . '/im';
    preg_match_all($defaultPatternAccepted, $currentHostURL, $matches, PREG_SET_ORDER, 0);

    $blockedPath = FALSE;
    // Check if requested path is blocked.
    if(in_array($uri, $blockedPaths)) {
      $blockedPath = TRUE;
    }

    # We have exceptions in the Exceptions field
    // @Todo: Check if the given domains are valid

    $allowedHost = strstr(implode(',', $allowedHosts), $currentHostURL);
    if ($blockedPath !== FALSE) {
      // Add drupal logger on field configuration.
      if ($this->configFactory->get('nppe_auth_redirect_module.authredirect')
        ->get('logging_attempt')) {
        \Drupal::logger('nppe_auth_redirect_module')
          ->notice('Attempt to access %uri. Auth blocked: %auth_blocked, Matches: %matches ,DefaultPatternAccepted: %defaultPatternAccepted', [
            '%defaultPatternAccepted' => $defaultPatternAccepted,
            '%uri' => $currentHostURL . $uri,
            '%auth_blocked' => $authBlocked,
            '%matches' => '<pre><code>' . print_r($matches, TRUE) . '</code></pre>',
          ]);
      }

      if ($allowedHost === FALSE & $authBlocked && empty($matches)) {

        $url = \Drupal\Core\Url::fromRoute('<front>')->toString();
        $response = new RedirectResponse($url);
        \Drupal::service('page_cache_kill_switch')->trigger();
        return $response->send();
      }
    }
    return TRUE;
  }

  /**
   * Helper function to ge language prefix from settings
   *
   * @return null|string
   */
  protected function getLanguagePrefix() {
    if ($prefixes = \Drupal::config('language.negotiation')
      ->get('url.prefixes')) {
      $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
      return "/" . $prefixes[$language];
    }
    return NULL;
  }

}
