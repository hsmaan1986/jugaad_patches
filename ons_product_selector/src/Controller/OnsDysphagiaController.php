<?php

namespace Drupal\ons_product_selector\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Url;

class OnsDysphagiaController extends OnsCalculatorBase
{
  public $langcode;
  public function render()
  {
    $messages = [
      t('The EAT-10 total score indicates no potential problems swallowing efficiently and/or safely.'),
      t('The EAT-10 total score indicates potential problems swallowing efficiently and/or safely. Confirm diagnosis  with another validated method of clinical assessment or refer to dysphagia specialist for a detailed swallowing assessment to ensure diagnostic accuracy.<br /><br />
        If you are looking for a dysphagia dietary management you can find our products <a href="#" class="product">here</a>. Check the nutritional details and ingredients of the selected  product to verify it is appropriate for your patient.')
    ];
    $questions = [
      'lose_weight'           => t('Swallowing problem has caused to lose weight'),
      'ability_meals'         => t('Swallowing problem interferes with ability to go out meals'),
      'liquids_extra_effort'  => t('Swallowing liquids takes extra effort'),
      'solids_extra_effort'   => t('Swallowing solids takes extra effort'),
      'pills_extra_effort'    => t('Swallowing pills takes extra effort'),
      'painful'               => t('Swallowing is painful'),
      'pleasure_eat_affected' => t('The pleasure of eating is affected by swallowing'),
      'food_throat'           => t('When swallow food stick in throat'),
      'cough_when_eat'        => t('Cough when eat'),
      'stressful'             => t('Swallowing is stressful')
    ];

    if ($this->isPostRequest()) {
      $score = 0;
      foreach ($questions as $key => $question)
        $score += isset($_POST[$key]) ? $_POST[$key] : 0;
      if ($score < 3) {
        $message = $messages[0];
      }
      if ($score >= 3) {
        $message = $messages[1];
      }

      $response = new JsonResponse((array_merge(
        array_intersect_key($_POST, $questions),
        [
          'score' => $score,
          'message' => $message
        ]
      )));
      return $response;
    }

    $build = [
      '#theme' => 'check_dysphagia_risk_with_eat_10',
      '#data'  => [
        'questions' => $questions,
        'currentUrl' => $this->getCurrentUrl(),
        'langcode' => $this->langcode,
        'action' => Url::fromUri('internal:/ons_product_selector/calc/check_dysphagia_risk_with_eat_10')
      ]
    ];

    return $this->renderElement($build);
  }
}
