<?php

namespace Drupal\ons_product_selector\Controller;

class OnsCalculatorsController extends OnsCalculatorBase
{
  protected $langcode;
  public function render()
  {
    $stepsDefault = $this->stepsDefault();

    $breadcrumbsDefault = $this->breadcrumbsDefault();
    $stepsChecked = \Drupal::request()->query->all();

    if ($stepsChecked['calculator'])
    {
      if (in_array('malnutrition', $stepsChecked['calculator'])) {
        unset($stepsDefault['patient_location']);
        unset($breadcrumbsDefault['patient_location']);
        if($this->getCalculatorVersion() == 'V3') {
          unset($stepsDefault['patient_screening_tool']);
          unset($breadcrumbsDefault['patient_screening_tool']);
        }
      }
    }

    $steps = array_diff($stepsDefault, $stepsChecked['calculator'] ?: []);



    $breadcrumbs = array_intersect_key($breadcrumbsDefault, array_flip($steps));

    $build = [
      '#theme' => 'calculators',
      '#data' => [
        'steps' => $steps,
        'breadcrumbs' => $breadcrumbs,
        'langcode' => $this->langcode,
      ],
      '#cache' => ['max-age' => 0],
    ];

    return $this->renderElement($build);
  }

  public function stepsDefault()
  {
    switch ($this->getCalculatorVersion()) {
      case 'V1':
        return [
          'patient_data',
          'patient_location',
          'malnutrition',
          'check_dysphagia_risk_with_eat_10',
          'calculate_nutritional_needs',
          'results'
        ];
        break;
      case 'V2':
        return [
          'patient_data',
          'check_dysphagia_risk_with_eat_10',
          'calculate_nutritional_needs',
          'results'
        ];
        break;
      case 'V3':
        return [
          'patient_data',
          'patient_screening_tool',
          'malnutrition',
          'check_dysphagia_risk_with_eat_10',
          'calculate_nutritional_needs',
          'results'
        ];
        break;
    }
  }

  public function breadcrumbsDefault()
  {
    switch ($this->getCalculatorVersion()) {
      case 'V1':
        return [
          'patient_data' => t('Patient Data'),
          'patient_location' => t('Patient Location'),
          'malnutrition' => t('Check malnutrition risk'),
          'check_dysphagia_risk_with_eat_10' => t('Check dysphagia risk'),
          'calculate_nutritional_needs' => t('Calculate nutritional needs'),
          'results' => t('Result')
        ];
        break;
      case 'V2':
        return [
          'patient_data' => t('Patient Data'),
          'check_dysphagia_risk_with_eat_10' => t('Check dysphagia risk'),
          'calculate_nutritional_needs' => t('Calculate nutritional needs'),
          'results' => t('Result')
        ];
        break;
      case 'V3':
        return [
          'patient_data' => t('Patient Data'),
          'patient_screening_tool' => t('Screening Tool for Malnutrition'),
          'malnutrition' => t('Check malnutrition risk'),
          'check_dysphagia_risk_with_eat_10' => t('Check dysphagia risk'),
          'calculate_nutritional_needs' => t('Calculate nutritional needs'),
          'results' => t('Result')
        ];
        break;
    }
  }
}
