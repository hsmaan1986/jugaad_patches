<?php

namespace Drupal\ons_product_selector\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Url;

class OnsMustController extends OnsCalculatorBase
{
  public $langcode;

  public function render()
  {
    $messages = [
      [
        'title' => t('​High risk of malnutrition: Treat'),
        'message' => t('Refer to a  dietician, nutritional support team or implement local policy. Set goals, improve and increase overall nutritional intake. Monitor and review care plan monthly in care homes and the community. To improve and increase overall nutritional intake you could advice on food choices, eating and drinking when necessary. Treat, unless detrimental or no benefit is expected from nutritional support . ​<br /><br />
                    If you are looking for an Oral Nutritional Supplement you can find our products <a href="#" class="product">here</a>. Check the nutritional details and ingredients of the selected  product to verify it is appropriate for your patient.')
      ],
      [
        'title' => t('Medium risk of malnutrition: Observe'),
        'message' => t('Record dietary intake for 3 days. If adequate-little concern repeat screening at least monthly in care homes and at least every 2-3 months in community. If inadequate-clinical concern follow local policy, set goals, improve and increase overall nutritional intake, monitor and review care plan regularly. To improve and increase overall nutritional intake you could advice on food choices, eating and drinking when necessary.​<br /><br />
                    If you are looking for an Oral Nutritional Supplement you can find our products <a href="#" class="product">here</a>. Check the nutritional details and ingredients of the selected  product to verify it is appropriate for your patient.')
      ],
      [
        'title' => t('Low risk of malnutrition:'),
        'message' => t('Provide dietary advice to maintain a healthy eating diet. Review / rescreen: monthly in care homes and annually in community. Consider more frequent rescreening in high-risk groups.')
      ]
    ];
    $dataWeightloss = \Drupal::request()->query->get('weightloss');
    $dataBmi = \Drupal::request()->query->get('bmi');
    $dataWeightlossPercentage = \Drupal::request()->get('weightlossPercentage');
    $illness = \Drupal::request()->query->get('illness');
    $malnutrition = '';
    if ($this->isPostRequest()) {

      $params = \Drupal::request()->request->all();

      // rule: Weight loss < 5 = 0
      $weightloss = 0;

      if (!empty($params['weightlossPercentage'])) {
        // rule: Weight loss > 10 = 2
        if ($params['weightlossPercentage'] > 10) $weightloss = 2;

        // rule: Weight loss between 5 - 10 = 1
        else if ($params['weightlossPercentage'] >= 5) $weightloss = 1;
      }

      // rule: Not Set
      $bmi = 0;

      if (!empty($params['bmi'])) {
        // rule: BMI > 20 = 0
        if ($params['bmi'] > 20) $bmi = 0;

        // rule: BMI between 18.5 - 20 = 0
        else if ($params['bmi'] >= 18.5) $bmi = 1;

        // rule: 2 - BMI < 18.5 23
        else if ($params['bmi'] < 18.5) $bmi = 2;
      }
      $score = $params['must'] + $weightloss + $bmi;
      if ($score == 0) {
        $message = $messages[2];
        $malnutrition = 0;
      }
      if ($score == 1) {
        $message = $messages[1];
        $malnutrition = 1;
      }
      if ($score >= 2) {
        $message = $messages[0];
        $malnutrition = 2;
      }

      $response = new JsonResponse(['score' => $score, 'message' => $message, 'malnutrition' => $malnutrition]);
      return $response;
    }

    $build = [
      '#theme' => 'calculate_must',
      '#data'  => [
        'currentUrl' => $this->getCurrentUrl(),
        'bmi' => $dataBmi,
        'weightloss' => $dataWeightloss,
        'weightlossPercentage' => $dataWeightlossPercentage,
        'langcode' => $this->langcode,
        'illness' => $illness,
        'action' => Url::fromUri('internal:/ons_product_selector/calc/must')
      ]
    ];

    return $this->renderElement($build);
  }
}
