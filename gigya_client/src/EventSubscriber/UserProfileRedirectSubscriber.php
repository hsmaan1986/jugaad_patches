<?php
namespace Drupal\gigya_client\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class UserProfileRedirectSubscriber implements EventSubscriberInterface {

  const EVENT_LISTENER_METHOD = 'RespondForbiddenAsNotFound';

  public static function getSubscribedEvents() {

    //$events[KernelEvents::EXCEPTION][] = array(UserProfileRedirectSubscriber::EVENT_LISTENER_METHOD, 100);
    $events[KernelEvents::RESPONSE][] = array('FixResponseCode', -10);

    return $events;
  }

  public function RespondForbiddenAsNotFound(GetResponseForExceptionEvent $event) { }

  public function FixResponseCode(FilterResponseEvent $resp) {

    $req = $resp->getRequest();

    $user = \Drupal::currentUser();
    $gigya_profile_page_alias = \Drupal::config(GIGYA_SETTINGS_KEY)->get('gigya_client.gigya_profile_page_alias');
    $gigya_login_page_alias = \Drupal::config(GIGYA_SETTINGS_KEY)->get('gigya_client.gigya_login_page_alias');

    if(!empty($gigya_profile_page_alias) && !empty($gigya_login_page_alias))
    {
      if($user->isAuthenticated() && $req->getPathInfo() == $gigya_login_page_alias)
      {
        $repsonse = new RedirectResponse($gigya_profile_page_alias);
        $repsonse->send();
      }
    }
  }
}
