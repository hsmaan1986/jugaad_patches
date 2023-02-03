<?php

namespace Drupal\ons_product_selector\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use \Symfony\Component\HttpFoundation\Response;
use Drupal\views\Controller;

class ProductsController extends ControllerBase {
  public function productDetails() {
    $block = views_embed_view('ons_product_selector_view', 'ons_product_selector_view_block');
    return new Response(drupal_render($block));
  }


}