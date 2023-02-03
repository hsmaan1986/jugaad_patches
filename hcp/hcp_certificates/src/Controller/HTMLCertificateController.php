<?php

namespace Drupal\hcp_certificates\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class BookingListController.
 */
class HTMLCertificateController extends ControllerBase {

  /**
   * Page.
   *
   * @return string
   *   Return Hello string.
   */
  public function page($key) {
      // Disable cache
      \Drupal::service('page_cache_kill_switch')->trigger();

      $route_match = \Drupal::service('current_route_match');
      $date = \Drupal::request()->query->get('date');
      $name = \Drupal::request()->query->get('name');

      return [
          '#theme' => 'hcp_certificate',
          '#date' => $date,
          '#name' => $name,
      ];
  }

}
