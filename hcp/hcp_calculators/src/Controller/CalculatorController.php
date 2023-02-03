<?php

namespace Drupal\hcp_calculators\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class BookingListController.
 */
class CalculatorController extends ControllerBase {

  /**
   * Page.
   *
   * @return array
   *   Return Hello string.
   */
  public function page() {
      return [
          '#type' => 'markup',
          '#markup' => null,
      ];
  }

}
