<?php

namespace Drupal\ons_product_selector\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\ons_product_selector\ContentSelector;
use Drupal\ons_product_selector\Controller\OnsProductCardController;
use Drupal\ons_product_selector\Controller\OnsProductController;

/**
 * Provides a 'ONS Product Selector' cards.
 *
 * @Block(
 *   id = "ons_product_selector_cards",
 *   admin_label = @Translation("ONS Product Selector Products Cards")
 * )
 */

class OnsProductSelectorCards extends BlockBase
{
  public function getCacheMaxAge()
  {
    return 0;
  }

  public function build()
  {
    //drupal_add_js(array('ons_product_selector' => $settings), 'setting');
    $controller = new OnsProductCardController();

    return [
      '#theme' => 'ons_product_selector_card',
      '#data' => ['products' => $controller->findProducts(), 'disable_compare' => OnsProductController::getDisableCompare()],
      '#attached' => [
        'library' => [
          'ons_product_selector/ons-product-selector-css',
        ],
      ]
    ];
  }
}
