<?php

namespace Drupal\hcp_advice_booking\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class BookingListController.
 */
class BookingListController extends ControllerBase {

  /**
   * Page.
   *
   * @return string
   *   Return Hello string.
   */
  public function page() {
    return [
          '#theme' => 'hcp_advice_booking_accordion',
          '#slots' => _hcp_get_slot_list(),
      ];
  }

}
