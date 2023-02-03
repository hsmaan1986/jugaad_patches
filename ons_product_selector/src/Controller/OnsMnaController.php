<?php

namespace Drupal\ons_product_selector\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Url;

class OnsMnaController extends OnsCalculatorBase
{
  public $langcode;

  public function render()
  {
    // var_dump(\Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId());
    $messages = $this->mnaMessages();
    $formData = \Drupal::request()->query->all();
    if ($this->isPostRequest()) {
      $params = \Drupal::request()->request->all();

      if (empty($params['weightloss'])) $weightloss = 1;

      if ($params['weightloss'] < 1) {
        $weightloss = 3;
      }

      if (($params['weightloss'] >= 1 && $params['weightloss'] <= 3)) $weightloss = 2;

      if ($params['weightloss'] > 3) $weightloss = 0;

      // rule: 0 - BMI less than 19
      $bmi = 0;

      if ($params['bmi'] < 19) $bmi = 0;
      if ($params['bmi'] >= 19 && $params['bmi'] < 21) $bmi = 1;
      if ($params['bmi'] >= 21 && $params['bmi'] < 23) $bmi = 2;
      if ($params['bmi'] >= 23) $bmi = 3;

      $cc = !empty($params['cc']) && $params['cc'] >= 31 ? 3 : 0;
      $score =
        $weightloss
        + $bmi
        + $cc
        + $params['intake']
        + $params['mobility']
        + $params['psychological']
        + $params['neuropsychological'];

      if (in_array($score, range(0, 7))) {
        $malnutrition = 2;
        $message = $messages[0];
      }
      if (in_array($score, range(8, 11))) {
        $message = $messages[1];
        $malnutrition = 1;
      }
      if (in_array($score, range(12, 14))) {
        $malnutrition = 0;
        $message = $messages[2];
      }

      //header('Content-Type: application/json');
      $response = new JsonResponse([
        'weightloss' => $weightloss,
        'bmi' => $bmi,
        'cc' => $cc,
        'intake' => $params['intake'],
        'mobility' => $params['mobility'],
        'psychological' => $params['psychological'],
        'neuropsychological' => $params['neuropsychological'],
        'score' => $score,
        'message' => $message,
        'malnutrition' => $malnutrition
      ]);
      return $response;
    }
    // var_dump($this->getCurrentUrl());
    $build = [
      '#theme' => 'confirm_malnutricion_risk_with_mna',
      '#data'  => [
        'currentUrl' => $this->getCurrentUrl(),
        'formData' => $formData,
        'langcode' => $this->langcode,
        'action' => Url::fromUri('internal:/ons_product_selector/calc/confirm_malnutricion_risk_with_mna')
      ],
    ];
    return $this->renderElement($build);
  }

  private function mnaMessages()
  {
    return [
      [
        'title' => t('Malnutrition:'),
        'message' => t(' Proceed to a detailed assessment of nutritional status or refer to a  dietician or nutrition specialist to ensure diagnostic accuracy.  Meanwhile, you could implement nutritional intervention:  Dietary advice to maximize nutritional intake, diet enhancement by food fortiﬁcation, enrichment and/or snacks between meals and consider to prescribe an Oral Nutritional Supplement in addition to the normal food.​<br />
                    If you are looking for an Oral Nutritional Supplement you can find our products <a href="#" class="product">here</a>. Check the nutritional details and ingredients of the selected  product to verify it is appropriate for your patient.')
      ],
      [
        'title' => t('At risk of malnutrition:'),
        'message' => t('Monitor weight closely and rescreen according to local protocols and/or after acute events or illness. Consider dietary advice to maximize nutritional intake and diet enhancement by food fortiﬁcation, enrichment and/or snacks between meals. Oral nutritional supplements could be administered if food intake is insufficient to meet nutritional requirements. Refer to a  dietician or nutrition specialist if no improvement or if you need a detailed assessment of nutritional status.​<br />
                   If you are looking for an Oral Nutritional Supplement you can find our products <a href="#" class="product">here</a>. Check the nutritional details and ingredients of the selected  product to verify it is appropriate for your patient.')
      ],
      [
        'title' => t('Normal nutritional status:​'),
        'message' => t('Provide dietary advice to maintain a healthy eating diet. Review / re-screen: according to local protocols and/or after acute event or illness.')
      ]
    ];
  }

}
