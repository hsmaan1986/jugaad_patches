<?php

namespace Drupal\ons_product_selector\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\ons_product_selector\Form\OnsPatientDataForm;
use Drupal\Core\Url;

class OnsPatientDataController extends OnsCalculatorBase
{
  public $langcode;

  public function render()
  {
    $data = array();
    $data['next_action'] = $this->langcode . '/ons_product_selector/calc/patient_data';
    $data['calcType'] = 'bmi';
    if ($this->isPostRequest()) {
      $params = \Drupal::request()->request->all();
      $data = $params;
      $data['weightlossPercentage'] = null;
      $data['next_action'] = $this->langcode . '/ons_product_selector/calc/patient_data';
      $data['patient_location_form'] = false;
      $data['patient_weight'] = $data['calcType'] == 'cc' ? $data['patient_weight_cc'] : $data['patient_weight'];
      $data['patient_weight_past'] = $data['patient_weight_past'] ?: $data['patient_weight'];

      if ($data['bmi'] != '') {
        $data['next_action'] = $this->langcode . '/ons_product_selector/calc/steps';
        $data['patient_location_form'] = true;
      }
      switch ($params['calcType']) {
        case 'bmi':
          $bmi = $params["patient_weight"] / pow($params["patient_height"] / 100, 2);

          $fmt = new \NumberFormatter( $this->langcode, \NumberFormatter::DECIMAL );
          // $data['bmi'] = $fmt->format($data['bmi']);


          $data['bmi'] = number_format($bmi, 1);
          if ($bmi < 18.5) $data['bmi_status'] = t('Underweight');
          if ($bmi >= 18.5 && $bmi < 25) $data['bmi_status'] = t('Normal range');
          if ($bmi >= 25 && $bmi <= 30) $data['bmi_status'] = t('Overweight');
          if ($bmi > 30) $data['bmi_status'] = t('Obese');
          $data['bmi'] = $fmt->format($data['bmi']);
          break;
        case 'cc':
          $data['cc'] = $data['patient_cc'] == 'greater31' ? 32 : 0;
          break;
      }

      $data = array_merge($data, $this->calculateWeightloss($data));

      return new JsonResponse($data);
    };
    $data['calc_version'] = $this->getCalculatorVersion();
    $data['langcode'] = $this->langcode;
    $data['action'] = Url::fromUri('internal:/ons_product_selector/calc/patient_data');
    $data['pathologies'] = $this->getTaxonomiesFromConfig();
    $build = [
      '#theme' => 'ons_calc_patient_data',
      '#data'  => $data,
      '#cache' => ['max-age' => 0],
    ];
    return $this->renderElement($build);
  }

  private function calculateWeightloss(array $data) {
    switch ($this->getCalculatorVersion()) {
      case self::CALCULATOR_VERSION_1:
      case self::CALCULATOR_VERSION_3:
        return $this->weightlossV1($data);
        break;
      case self::CALCULATOR_VERSION_2:
        return $this->weightlossV2($data);
        break;
    }
  }

  private function weightlossV1(array $data) {
    return [
      'weightloss' => !empty($data['patient_weight_past']) ? $data['patient_weight_past'] - $data['patient_weight'] : null,
      'weightlossPercentage' => !empty($data['patient_weight_past']) ? ceil((1 - $data['patient_weight'] / $data['patient_weight_past']) * 100) : null
    ];
  }

  private function weightlossV2(array $data) {

    if ($data['patient_weight_past_1'] == '') $data['patient_weight_past_1'] = $data['patient_weight'];
    if ($data['patient_weight_past_6'] == '') $data['patient_weight_past_6'] = $data['patient_weight'];

    $weightloss['weightloss_1'] = (int) ceil((1 - $data['patient_weight'] / $data['patient_weight_past_1']) * 100);
    $weightloss['weightloss_3'] = (int) !empty($data['patient_weight_past_3']) ? ceil((1 - $data['patient_weight'] / $data['patient_weight_past_3']) * 100) : null;
    $weightloss['weightloss_6'] = (int) ceil((1 - $data['patient_weight'] / $data['patient_weight_past_6']) * 100);
    $data['patient_weight_past_1'] = ($data['patient_weight_past_1'] == '' || $data['patient_weight_past_1'] == 0) ? $data['patient_weight'] : $data['patient_weight_past_1'];
    $data['patient_weight_past_6'] = ($data['patient_weight_past_6'] == '' || $data['patient_weight_past_6'] == 0) ? $data['patient_weight'] : $data['patient_weight_past_6'];
    $weightloss['patient_weight_past'] = $data['patient_weight_past_1'] - $data['patient_weight'];
    $weightloss['patient_weight_past_2'] = $data['patient_weight_past_6'] - $data['patient_weight'];

    array_map(function($number) use ($data) {
      return $number == 0 ? $data['patient_weight'] : $number;
    }, $weightloss);

    return $weightloss;
  }
}
