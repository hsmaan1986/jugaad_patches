<?php

namespace Drupal\ons_product_selector\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Url;

class OnsPatientLocationController extends OnsCalculatorBase
{
  public $langcode;

  public function render()
  {
    $data = [];
    if ($this->isPostRequest()) {
      return  new JsonResponse(\Drupal::request()->request->all());
    }
    $data['langcode'] = $this->langcode;
    $data['action'] = Url::fromUri('internal:/ons_product_selector/calc/patient_location');
    $build = [
      '#theme' => 'ons_calc_patient_location',
      '#data'  => $data,
      '#cache' => ['max-age' => 0]
    ];

    return $this->renderElement($build);
  }
}
