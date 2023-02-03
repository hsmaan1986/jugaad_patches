<?php

namespace Drupal\hcp_advice_booking\Controller;

use Drupal\Core\Controller\ControllerBase;
Use Drupal\Core\File\FileSystemInterface;

/**
 * Class BookingListController.
 */
class CalendarFileController extends ControllerBase {

  /**
   * Page.
   *
   * @return string
   *   Return Hello string.
   */
    public function generate() {

      $timestamp_start = \Drupal::request()->query->get('timestamp_start');
      $timestamp_end = \Drupal::request()->query->get('timestamp_end');
      $summary = \Drupal::request()->query->get('summary');
      $description = \Drupal::request()->query->get('description');
      $uid = \Drupal::request()->query->get('uid');
      $location = \Drupal::request()->query->get('location');

      $timestamp_start = \Drupal\Component\Utility\Html::escape($timestamp_start);
      $timestamp_end = \Drupal\Component\Utility\Html::escape($timestamp_end);
      $summary = \Drupal\Component\Utility\Html::escape($summary);
      $description = \Drupal\Component\Utility\Html::escape($description);
      $uid = \Drupal\Component\Utility\Html::escape($uid);
      $location = \Drupal\Component\Utility\Html::escape($location);

      if($timestamp_start && $timestamp_end) {
          $vCalendar = new \Eluceo\iCal\Component\Calendar('NHS');
          $vCalendar->setTimezone(date_default_timezone_get());

          $vCalendar->setDescription($description);

          $vEvent = new \Eluceo\iCal\Component\Event();

          $start_dt = new \DateTime();
          $end_dt = new \DateTime();

          $vEvent
              ->setDtStart($start_dt->setTimestamp($timestamp_start))
              ->setDtEnd($end_dt->setTimestamp($timestamp_end))
              ->setSummary($summary)
              ->setDescription($description);

          $vCalendar->addComponent($vEvent);

          // Send output.
          $filename = 'cal.ics';
          $uri = 'public://' . $filename;
          $content = $vCalendar->render();
          $file = file_save_data($content, $uri, FileSystemInterface::EXISTS_REPLACE);
          if (empty($file)) {
              return new Response(
                  'ICS Error, Please contact the System Administrator'
              );
          }

          $mimetype = 'text/calendar';
          $scheme = 'public';
          $parts = explode('://', $uri);
          $file_directory = \Drupal::service('file_system')->realpath(
              $scheme . "://"
          );
          $filepath = $file_directory . '/' . $parts[1];
          $filename = $file->getFilename();

          if (!file_exists($filepath)) {
              throw new NotFoundHttpException();
          }

          $headers = [
              'Content-Type' => $mimetype,
              'Content-Disposition' => 'attachment; filename="' . $filename . '"',
              'Content-Length' => $file->getSize(),
              'Content-Transfer-Encoding' => 'binary',
              'Pragma' => 'no-cache',
              'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
              'Expires' => '0',
              'Accept-Ranges' => 'bytes',
          ];

          // \Drupal\Core\EventSubscriber\FinishResponseSubscriber::onRespond()
          // sets response as not cacheable if the Cache-Control header is not
          // already modified. We pass in FALSE for non-private schemes for the
          // $public parameter to make sure we don't change the headers.
          return new \Symfony\Component\HttpFoundation\BinaryFileResponse($uri, 200, $headers, $scheme !== 'private');

      } else {
          return new Response(
              'ICS dates not specified'
          );
      }

  }

}
