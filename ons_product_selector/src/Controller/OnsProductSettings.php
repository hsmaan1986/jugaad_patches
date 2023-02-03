<?php

namespace Drupal\ons_product_selector\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class OnsProductSettings extends ControllerBase implements ContainerInjectionInterface {

    private function getFieldValue ($name) {
        header('Content-Type: application/json');
        $config = $this->config('ons_product_selector.settings');
        $response = new Response();
        $value = $config->get("ons_product_selector.{$name}");
        if (empty($value)) $value = '{}';
        $response->setContent($value);
        return $response;
    }

    public function prod_info() {
        return $this->getFieldValue('prod_info');
    }

    public function dri() {
        return $this->getFieldValue('dri');
    }

    public function product_order() {
        return $this->getFieldValue('product_order');
      }
}
