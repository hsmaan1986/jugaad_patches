<?php

namespace Drupal\nhsc_kwit\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

class KwitController extends ControllerBase implements ContainerInjectionInterface
{
    /**
     * @return mixed
     * @param $name
     */
    public function getConfigs($name) {
        $config = $this->config('nhsc_kwit.config');

        return $config->get($name);
    }
}