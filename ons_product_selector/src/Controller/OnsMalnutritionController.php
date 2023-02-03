<?php

namespace Drupal\ons_product_selector\Controller;
use Drupal\Core\Url;

class OnsMalnutritionController extends OnsCalculatorBase
{
  public $langcode;


  public function render()
  {
    $formData = \Drupal::request()->query->all();
    $parameters = [
      'bmi' => $formData['patient_data']['bmi'],
      'weightloss' => $formData['patient_data']['weightloss'],
      'cc' => $formData['patient_data']['cc'],
      'weightlossPercentage' => $formData['patient_data']['weightlossPercentage'],
      'illness' => $formData['patient_data']['illness']
    ];

    $queryData = http_build_query($parameters);
    if($this->getCalculatorVersion() == 'V1' || $this->getCalculatorVersion() == 'V3') {
      if ($formData['patient_data']['patient_age'] >= 65 && $this->getCalculatorVersion() == 'V1') {
        header('Location: ' . Url::fromUri('internal:/ons_product_selector/calc/confirm_malnutricion_risk_with_mna', ['query' => $parameters])->toString());
        exit;
      }
    }

    // if($this->getCalculatorVersion() == 'V2'){
    //   dump($queryData);
    //   if ($formData['patient_data']['patient_age'] >= 70) {
    //     header('Location: ' . Url::fromUri('internal:/ons_product_selector/calc/nrs_2002', ['query' => $parameters])->toString());
    //     exit;
    //   }
    // }

    if($formData['patient_screening_tool']['screening_tool'] == 'mna') {
      header('Location: ' . Url::fromUri('internal:/ons_product_selector/calc/confirm_malnutricion_risk_with_mna', ['query' => $parameters])->toString());
      exit;
    }

    if($formData['patient_screening_tool']['screening_tool'] == 'nrs2002') {
      header('Location: ' . Url::fromUri('internal:/ons_product_selector/calc/nrs_2002', ['query' => $parameters])->toString());
      exit;
    }

    if ($formData['patient_location']['patient_location'] == 'home' || $formData['patient_location']['patient_location'] == 'nursing') {
      header('Location: ' . Url::fromUri('internal:/ons_product_selector/calc/must', ['query' => $parameters])->toString());
      exit;
    }

    if ($formData['patient_location']['patient_location'] == 'hospital') {
      header('Location: ' . Url::fromUri('internal:/ons_product_selector/calc/nrs_2002', ['query' => $parameters])->toString());
      exit;
    }
    $formData['currentUrl'] = \Drupal\Core\Url::fromRoute('<current>');
    $build = [
      '#theme' => 'ons_malnutrition',
      '#data'  => $formData,
      '#cache' => ['max-age' => 0],
    ];

    return $this->renderElement($build);
  }
}
