<?php

namespace Drupal\nhsc_user_profile_via\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CheckCookieSubscriber implements EventSubscriberInterface {

    public function checkCookie(GetResponseEvent $event) {
        $request = $event->getRequest();
        if($request->cookies->has('password_reset_message')) {
            \Drupal::messenger()->addMessage("Password has been reset. You may now login.", 'status');
            setcookie('password_reset_message', '', time() - 3600);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
        $events[KernelEvents::REQUEST][] = array('checkCookie');
        return $events;
    }

}
