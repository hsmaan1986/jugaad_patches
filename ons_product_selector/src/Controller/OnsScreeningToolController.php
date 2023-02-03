<?php

namespace Drupal\ons_product_selector\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Url;

class OnsScreeningToolController extends OnsCalculatorBase
{
  public $langcode;

  public function render()
  {
    $data = [];
    if ($this->isPostRequest()) {
      return  new JsonResponse(\Drupal::request()->request->all());
    }
    $data['langcode'] = $this->langcode;
    $data['action'] = Url::fromUri('internal:/ons_product_selector/calc/patient_screening_tool');
    $build = [
      '#theme' => 'ons_calc_screening_tool',
      '#data'  => $data,
      '#cache' => ['max-age' => 0]
    ];

    return $this->renderElement($build);
  }
}
