<?php

namespace Drupal\nhsc_user_profile_via\EventSubscriber;

use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\nhsc_user_profile_via\Controller\PageController;

/**
 * Class RedirectAnonymousSubscriber.
 */
class RedirectAnonymousSubscriber implements EventSubscriberInterface {

    /**
     * Constructs a new RedirectAnonymousSubscriber object.
     */
    public function __construct() {
        $this->account = \Drupal::currentUser();
    }

    /**
     * {@inheritdoc}
     */
    static function getSubscribedEvents() {
        $events[KernelEvents::REQUEST] = ['checkAuthStatus'];
        return $events;
    }

    /**
     * This method is called whenever the event_subscriber event is
     * dispatched.
     *
     * @param GetResponseEvent $event
     */
    public function checkAuthStatus(GetResponseEvent $event) {
        $route_name = \Drupal::routeMatch()->getRouteName();

        $pageControler  = new PageController();
        $config         = $pageControler->getConfigs();
        $market_code    = $config->get('market_code');

        if ($route_name == 'user.pass'){
            $name = \Drupal::request()->query->get('name');

            if (isset($name)){
	            $response = new RedirectResponse(Url::fromRoute('user.pass')->toString(), 302);
                $event->setResponse($response);
                $event->stopPropagation();
                $response->send();
            }
        }

        if ($this->account->isAnonymous() && \Drupal::routeMatch()->getRouteName() != 'user.login' && $route_name != 'user.reset' && $route_name != 'user.reset.form') {
            // add logic to chesck other routes you want available to anonymous users,
            // otherwise, redirect to login page.

            if ($route_name !== 'system.403') {
                return;
            }

	        $response = new RedirectResponse(Url::fromRoute('user.login')->toString(), 302);
            $event->setResponse($response);
            $event->stopPropagation();
            $response->send();
        }

        switch ($route_name) {
            case "entity.user.canonical":
	            $url = Url::fromRoute('nhsc_user_profile_via.page_controller_homepage')->toString();
                $response = new RedirectResponse($url, 302);
                break;
            case "entity.user.edit_form":
	            $url = Url::fromRoute('nhsc_user_profile_via.edit')->toString();
                $response = new RedirectResponse($url, 302);
                break;
            case "nhsc_user_profile_via.page_controller_homepage":
            case "nhsc_user_profile_via.page_controller_agenda":
            case "nhsc_user_profile_via.page_controller_achievements":
            case "nhsc_user_profile_via.page_controller_settings":
                $user               = \Drupal\user\Entity\User::load($this->account->id());
                $profile_complete   = $user->get('field_profile_complete')->getValue();
                $config             = \Drupal::config('nhsc_user_profile_via.config');

                $roles              = $config->get('exempt_roles');
                $user_roles         = $user->getRoles();
                $bypass             = false;

                foreach ($user_roles as $role) {
                    if (in_array($role, $roles, TRUE)) {
                        $bypass = true;
                        break;
                    }
                }

                if ($profile_complete[0]['value'] != '1' && $bypass == false) { // Test if profile complete
                  \Drupal::messenger()->addMessage(t('Please complete your profile.'), 'warning');
	                $response = new RedirectResponse(Url::fromRoute('nhsc_user_profile_via.edit')->toString(), 302);
                }

                break;
        }

        if (isset($response)) {
            $event->setResponse($response);
            $event->stopPropagation();
            $response->send();
        }
    }

}
