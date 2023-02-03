<?php

namespace Drupal\ons_product_selector\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use Drupal\taxonomy\Entity\Term;

class OnsNutritionalNeedsController extends OnsCalculatorBase
{
  protected $langcode;
  public function render()
  {
    $activity = [
      'm' => [
        1,
        1.11,
        1.25,
        1.48
      ],
      'f' => [
        1,
        1.12,
        1.27,
        1.45
      ]
    ];

    $data = \Drupal::request()->request->all();

    if ($this->isPostRequest()) {
      $daily_caloric = $this->getHM($_POST['gender'], $_GET['weight'], $_GET['height'], $_GET['age'], $activity[$_POST['gender']][$_POST['activity']]);
    // * $_POST['activity']
    // * $this->getStress($_POST['stress'])['base'];

      $daily_protein = $this->getDailyProtein();

      $response = new JsonResponse(array_merge($_REQUEST, [
        'dri'           => $this->dri($_POST['gender'], $_GET['age']),
        'daily_caloric' => ceil($daily_caloric),
        'daily_protein' => ceil($daily_protein),
        'post'          => $_POST,
        'get'           => $_GET,
        'request'       => $_REQUEST
      ]));
      return $response;
    }

    $build = [
      '#theme' => 'calculate_nutritional_needs',
      '#data'  => [
        'currentUrl' => $this->getCurrentUrl(),
        'langcode' => $this->langcode,
        'calc_version' => strtolower($this->getCalculatorVersion())
      ]
    ];

    return $this->renderElement($build);
  }

  private function getDailyCaloric() {
    return $this->getHM($_POST['gender'], $_GET['weight'], $_GET['height'], $_GET['age'])
    * $_POST['activity']
    * $this->getStress($_POST['stress'])['base'];
  }

  private function getDailyProtein() {
    // switch($this->getCalculatorVersion()) {
    //   case 'V1':
    //     $proteinAgeIndex = $_GET['age'] >= 65 ? '>=65' : '<65';
    //   return $_GET['weight']
    //     * $this->getStress($_POST['stress'])[$proteinAgeIndex];
    //   break;
    //   case 'V2':
        return $_POST['stress'] * $_GET['weight'];
    //   break;
    // }
  }

  private function getHM($gender, $weight, $height, $age, $activity)
  {
    $parameters = [
      'm' => [
        'base' => 662,
        'age' => 9.53,
        'weight' => 15.91,
        'height' => 539.6
      ],
      'f' => [
        'base' => 354,
        'age' => 6.91,
        'weight' => 9.36,
        'height' => 726
      ]
    ];

    $ageCalc = $parameters[$gender]['age'] * $age;
    $weightCalc = $parameters[$gender]['weight'] * $weight;
    $heightCalc = $parameters[$gender]['height'] * ($height / 100);
    $dimensionCalc = $weightCalc + $heightCalc;

    return $parameters[$gender]['base'] - $ageCalc + ($activity * $dimensionCalc);

    // $parameters = [
    //   'm' => ['base' => 662,  'weight' => 15.91, 'height' => 539.6,   'age' => 9.53],
    //   'f' => ['base' => 655.1, 'weight' => 9.6,  'height' => 1.8, 'age' => -4.7],
    // ];
    // $param = $parameters[$gender];
    // return $param['base'] - ($param['age'] * $age) + ($param['height'] * $height) + ($param['age'] * $age);
  }

  private function getStress($key)
  {
    $parameters = [
      'str00' => ['base' => 1,    '<65' => 0.8,  '>=65' => 1.25],
      'str01' => ['base' => 1.15, '<65' => 1.35, '>=65' => 1.35],
      'str02' => ['base' => 1.5,  '<65' => 1.35, '>=65' => 1.35],
      'str03' => ['base' => 1.8,  '<65' => 1.5,  '>=65' => 1.5],
    ];
    return $parameters[$key];
  }


  private function getEER($sex, $age, $weight, $height, $pa) {

    return $this->calculateEER($sex, $age, $weight, $height, $pa);
  }

  private function calculateEER($sex, $age, $weight, $height, $pa) {
    switch ($sex) {
      case 'm':
        return 662 - (9.53 * $age) + $pa * ((15.91 * $weight) + (539.6 * $height));
      break;
      case 'f':
        return 354 - (6.91 * $age) + $pa * ((9.36 * $weight) + (726 * $height));
    }
  }

  private function dri($gender, $age)
  {
    $configOverride = \Drupal::languageManager()->getLanguageConfigOverride($this->langcode, 'ons_product_selector.settings')->get();
    $config = empty($configOverride) ? $this->config('ons_product_selector.settings')->get()['ons_product_selector'] : $configOverride;
    $data = json_decode($config['dri'], true);
    $lastSelected = [];
    foreach ($data as $rec) {
      if ($rec['start_age'] < $age && ($age < 11 || $rec['gender'] == $gender)) {
        $lastSelected = $rec;
      }
    }

    /* Tradução dos títulos das calculadoras */
    foreach ($lastSelected['dri'] as &$el) {
      $el['title'] = t($el['title']);
    }
    return $lastSelected;
  }
}
