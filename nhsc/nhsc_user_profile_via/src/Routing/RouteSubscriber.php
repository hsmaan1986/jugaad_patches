<?php

namespace Drupal\nhsc_user_profile_via\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

    /**
     * {@inheritdoc}
     */
    protected function alterRoutes(RouteCollection $collection) {

        // alter the default registration route
        if ($route = $collection->get('user.register')) {
            $route->setDefault('_title', 'Register');
            $route->setDefault('_form', '\Drupal\nhsc_user_profile_via\Form\RegisterForm');
        }

    }

}