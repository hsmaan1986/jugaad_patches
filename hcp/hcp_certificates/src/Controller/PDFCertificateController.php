<?php

namespace Drupal\hcp_certificates\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class BookingListController.
 */
class PDFCertificateController extends ControllerBase {

  /**
   * Page.
   *
   * @return string
   *   Return Hello string.
   */
  public function page($key) {
      global $base_url;
      $user =  \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

      $route_match = \Drupal::service('current_route_match');
      $date = \Drupal::request()->query->get('date');
      $name = $user->field_first_name->getValue()[0]['value'] . ' ' . $user->field_last_name->getValue()[0]['value'];
      $cert_url = $base_url.'/certificate/html/'.$key.'?date='.$date.'&name='.$name;

      $ch = curl_init($cert_url);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $page = curl_exec($ch);
      curl_close($ch);

      $print_engine = \Drupal::service('plugin.manager.entity_print.print_engine')->createSelectedInstance('pdf');
      $print_engine->getPrintObject()->ignoreWarnings = TRUE;
      $print_engine->addPage("@".$page);
      $print_engine->send('certificate.pdf');
      return [];
  }

}
