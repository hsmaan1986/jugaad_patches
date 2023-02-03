<?php

namespace Drupal\ons_product_selector\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Url;

class OnsCalculatorController extends ControllerBase implements ContainerInjectionInterface
{
  private $langcode;

  public function __construct()
  {
    \Drupal::service('page_cache_kill_switch')->trigger();
    session_start();
    $this->langcode = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
  }

  private function isPostRequest()
  {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  private function getCurrentUrl()
  {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }

  private function render($build)
  {
    $output = \Drupal::service('renderer')->renderRoot($build);
    $response = new Response();
    $response->setContent($output);
    return $response;
  }

  public function steps()
  {
    //var_dump(\Drupal::request()->request->all());
    $build = [
      '#theme' => 'steps',
      '#data'  => [],
      '#cache' => ['max-age' => 0]
    ];

    return $this->render($build);
  }

  public function step_2_completed()
  {
    $build = [
      '#theme' => 'step_2_completed',
      '#data'  => [],
      '#cache' => ['max-age' => 0]
    ];

    return $this->render($build);
  }

  public function send_mail()
  {
    $mailData = \Drupal::request()->request->all();
    parse_str($mailData['form']);
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'ons_product_selector';
    $key = 'ons_product_selector';
    $to = $email;
    $params['message'] = t(
      "Thank you for using the online healthcare professional tool to identify adults at risk of malnutrition.
      Please, find attached the results based on the information you provided in each step of the online tool. These results are not intended to be a substitute for professional medical advice, diagnosis, or treatment. They could help you to identify those individuals who would benefit from a further comprehensive nutritional assessment. We hope that you will find this information useful.
      Warm regards,<br /><b>Nestlé Health Science</b>"
    );
    $params['subject'] = t('ONS Product Selector');

    $attachment = array(
      'filecontent' => base64_decode($mailData['pdf']),
      'filename' => 'results.pdf',
      'filemime' => 'application/pdf'
    );

    $params['attachments'][] = $attachment;
    $send = true;

    if ($mailManager->mail($module, $key, $to, $this->langcode, $params, null, $send)) {
      $result['status'] = 'true';
      $result['message'] = t('Email successfully sent');
      $result['class'] = 'success';
    } else {
      $result['status'] = 'false';
      $result['message'] = t('Error sending email. Try again later.');
      $result['class'] = 'error';
    }
    $response = new JsonResponse($result);
    return $response;
  }

  public function listTaxonomies()
  {
    $vid = 'pathology';
    $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);
    foreach ($terms as $term) {
      $nodes = \Drupal::entityQuery('node')->condition('type', 'ons_product_selector')->condition('field_ons_pathology', $term->tid)->execute();
      $nodesLoaded = \Drupal\node\Entity\Node::loadMultiple($nodes);
      $order = array_keys($nodesLoaded);
      $termData[] = [
        $term->tid => $order
      ];
    }
    return new JsonResponse($termData);
  }
}
