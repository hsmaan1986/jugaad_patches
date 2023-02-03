<?php

namespace Drupal\ons_product_selector\Controller;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\JsonResponse;

class OnsNrsController extends OnsCalculatorBase
{
  public $langcode;

  public function render()
  {
    $messages = [
      [
        'title' => t('Low risk of malnutrition:'),
        'message' => t('The patient should be re-screened at weekly intervals. If the patient e.g. is scheduled for a major operation, a preventive nutritional care plan is considered to avoid the associated risk status.')
      ],
      [
        'title' => t('At risk of malnutrition:'),
        'message' => t('Provide dietary advice to maximise nutritional intake. Refer to a  dietician or nutrition specialist if no improvement or if you need a detailed assessment of nutritional status.')
      ],
      [
        'title' => t('High risk of malnutrition:'),
        'message' => t('An early intervention nutritional care plan should be initiated. If oral feeding is possible provide dietary advice to maximize nutritional intake, diet enhancement by food fortiﬁcation, enrichment and/or snacks between meals and consider to prescribe an Oral nutritional supplements could be administered if food intake is insufficient to meet nutritional requirements. If oral feeding is not possible consider enteral or parenteral nutrition. Refer to a  dietician or nutrition specialist if no improvement or if you need a detailed assessment of nutritional status.​<br /><br />
                  If you are looking for an Oral Nutritional Supplement you can find our products <a href="#" class="product">here</a>. Check the nutritional details and ingredients of the selected  product to verify it is appropriate for your patient.')
      ],
    ];
    if ($this->isPostRequest()) {

      // rule: Weight loss < 5 = 0
      $weightloss = 0;

      if (!empty($_REQUEST['weightloss'])) {
        // rule: Weight loss > 10 = 2
        if ($_REQUEST['weightloss'] > 10) $weightloss = 2;

        // rule: Weight loss between 5 - 10 = 1
        else if ($_REQUEST['weightloss'] >= 5) $weightloss = 1;
      }

      // // rule: Not Set
      // $bmi = 0;

      // if (!empty($_REQUEST['bmi'])) {
      //   // rule: BMI > 20 = 0
      //   if ($_REQUEST['bmi'] > 20) $bmi = 0;

      //   // rule: BMI between 18.5 - 20 = 0
      //   else if ($_REQUEST['bmi'] >= 18.5) $bmi = 1;

      //   // rule: 2 - BMI < 18.5 23
      //   else if ($_REQUEST['bmi'] < 18.5) $bmi = 2;
      // }

      $score = $_POST['intake_past_week'] + $_POST['severity_of_disease'];
      if ($score <= 3) {
        $message = $messages[0];
        $malnutrition = 0;
      }
      if ($score == 4) {
        $message = $messages[1];
        $malnutrition = 1;
      }
      if ($score >= 5) {
        $message = $messages[2];
        $malnutrition = 2;
      }

      $response = new JsonResponse([
        'score' => $score,
        'message' => $message,
        'malnutrition' => $malnutrition
      ]);

      return $response;
    }
    if ($_REQUEST['bmi'] < 20.5 || $_REQUEST['weightloss'] > 0) {
      $hidePre = 'style=display:none';
      $hideNrs = null;
    } else {
      $hidePre = null;
      $hideNrs = 'style=display:none';
    }

    $build = [
      '#theme' => 'calculate_nrs_2002',
      '#data'  => [
        'currentUrl' => $this->getCurrentUrl(),
        'bmi' => \Drupal::request()->query->get('bmi'),
        'weightloss' => \Drupal::request()->query->get('weightloss'),
        'hidePre' => $hidePre,
        'hideNrs' => $hideNrs,
        'action' => Url::fromUri('internal:/ons_product_selector/calc/nrs_2002')
      ]
    ];

    return $this->renderElement($build);
  }
}
