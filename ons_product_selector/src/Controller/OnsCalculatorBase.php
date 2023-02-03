<?php

namespace Drupal\ons_product_selector\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\taxonomy\Entity\Term;

class OnsCalculatorBase extends ControllerBase implements ContainerInjectionInterface
{
  protected $langcode;
  const CALCULATOR_VERSION_1 = 'V1';
  const CALCULATOR_VERSION_2 = 'V2';
  const CALCULATOR_VERSION_3 = 'V3';

  public function __construct()
  {
    \Drupal::service('page_cache_kill_switch')->trigger();
    session_start();
    $this->langcode = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
  }

  protected function isPostRequest()
  {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  protected function renderElement($build)
  {
    $output = \Drupal::service('renderer')->renderRoot($build);
    $response = new Response();
    $response->setContent($output);
    return $response;
  }

  protected function getCurrentUrl()
  {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }

  public function getCalculatorVersion() {
    return $this->config('ons_product_selector.settings')->get()['ons_product_selector']['calc_version'] ?: 'V1';
  }

  protected function getTaxonomiesFromConfig(){
    $config = $this->config('ons_product_selector.settings');
    $taxonomies = $config->get("ons_product_selector.pathologies_nutritional");

    foreach ($taxonomies as $tid => $name) {
      if ($name !== 0) {

        $term = Term::load($name);
        $term = \Drupal::service('entity.repository')->getTranslationFromContext($term, $this->langcode);
        // var_dump(get_class($term));
        $tax[] = [
          'tid' => $term->get('tid')->getValue()[0]['value'],
          'name' => $term->get('name')->getValue()[0]['value']
        ];
      }
    }
    return $tax;
  }
}
