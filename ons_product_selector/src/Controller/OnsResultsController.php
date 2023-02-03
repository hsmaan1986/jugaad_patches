<?php

namespace Drupal\ons_product_selector\Controller;
use Drupal\Core\Url;
use Drupal\file\Entity\File;

class OnsResultsController extends OnsCalculatorBase
{
  public $langcode;

  public function render()
  {
    if ($this->isPostRequest()) $data = \Drupal::request()->request->all();
    else $data = $_REQUEST;

    if (isset($data['pre-nrs2002']) && !isset($data['nrs2002'])) {
      $data['nrs2002'] = $data['pre-nrs2002'];
    }

    foreach ($data as $item) {
      if (array_key_exists('malnutrition', $item)) {
        $malnutrition = $item['malnutrition'];
        break;
      }
    }
    // $config = $this->config('ons_product_selector.settings');
    //$config = $this->languageManager();
    $configOverride = \Drupal::languageManager()->getLanguageConfigOverride($this->langcode, 'ons_product_selector.settings')->get();
    $config = array_merge($this->config('ons_product_selector.settings')->get()['ons_product_selector'], $configOverride);

    $data['disclaimer'] = $config['product_disclaimer'];
    if($this->getCalculatorVersion() == 'V2') {
      $data['calculatorV2'] = $this->messagesCalculatorV2($data);
      $malnutrition = $this->checkMalnutritionV2($data);
    }

    if ($malnutrition != 0) {
      $products = json_decode($config['prod_info'], true);
      if ($products)
      {
        if (isset($data['eat_10']) && $data['eat_10']['score'] >= 3) {
          $recomendedProducts = array_filter($products, function ($item) use ($data, $malnutrition) {
            if ($data['eat_10']['score'] >= 3 && $item['dysphagya'] && $data['patient_data']['illness'] == $item['illnessId'] && $item['riskId'] == $malnutrition) {
              return $item['productsRecomendation'];
            }
          });
        } else {
          $recomendedProducts = array_filter($products, function ($item) use ($data, $malnutrition) {
            if (!$item['dysphagya'] && $data['patient_data']['illness'] == $item['illnessId'] && $item['riskId'] == $malnutrition) {
              return $item['productsRecomendation'];
            }
          });
        }
      }

      if (isset($recomendedProducts) && !empty($recomendedProducts) && !$config['ons_product_selector.product_hide']) {
        $dataProducts = array_values($recomendedProducts)[0]['productsRecomendation'];
        $dataProducts = array_map(function ($product) {
          return $product['productId'];
        }, $dataProducts);
        $data['products'] = \Drupal\node\Entity\Node::loadMultiple($dataProducts);
        $data['products'] = array_map(function (\Drupal\node\Entity\Node $product) {
          $returnData = [];
          $productImage = $product->get('field_ons_product')->referencedEntities()[0]->get('field_images')->getValue()[0]['target_id'];
          $returnData['productImage'] = !is_null($productImage) ? File::load($productImage)->getFileUri() : null;


          $returnData['path'] = $product->get('field_ons_product')->referencedEntities()[0]->toUrl('canonical', [
            'language' => $configOverride,
          ])->setAbsolute()->toString();
          $returnData['title'] = $product->get('title')->getValue()[0]['value'];
          $returnData['field_ons_kcal'] = $product->get('field_ons_kcal')->getValue()[0]['value'];
          $returnData['field_ons_protein'] = $product->get('field_ons_protein')->getValue()[0]['value'];
          $returnData['field_ons_p_cho_f_'] = $product->get('field_ons_p_cho_f_')->getValue()[0]['value'];
          $returnData['field_ons_format_size'] = $product->get('field_ons_format_size')->getValue()[0]['value'];
          $returnData['field_ons_flavours'] = array_map(
            function (\Drupal\taxonomy\Entity\Term $flavour) {
              $returnFlavour = $flavour->get('name')->getValue()[0]['value'];
              return $returnFlavour;
            },
            $product->get('field_ons_flavours')->referencedEntities()
          );
          $returnData['field_ons_intolerance'] = array_map(function (\Drupal\taxonomy\Entity\Term $intolerance) {
            $fid = $intolerance->get('field_image_intolerance')->getValue()[0]['target_id'];
            $file = \Drupal\file\Entity\File::load($fid);
            if(!is_null($file)) {
              $urlImage = $file->getFileUri();
              return $urlImage;
            } else {
              return null;
            }
          }, $product->get('field_ons_intolerance')->referencedEntities());
          return $returnData;
        }, $data['products']);
      }
    }
    $data['img_body'] = $this->getImgBody($data['patient_data']['bmi']);
    $data['calc_version'] = $this->getCalculatorVersion();
    $data['langcode'] = $this->langcode;
    $build = [
      '#theme' => 'results',
      '#data'  => $data,
      '#cache' => ['max-age' => 0]
    ];

    return $this->renderElement($build);
  }
  public function getImgBody($bmi) {
    if($bmi < 16) return 'img-body-1.png';
    elseif($bmi < 17) return 'img-body-2.png';
    elseif($bmi < 18.6) return 'img-body-3.png';
    elseif($bmi < 25) return 'img-body-4.png';
    elseif($bmi < 30) return 'img-body-5.png';
    elseif($bmi < 35) return 'img-body-6.png';
    else return 'img-body-7.png';
  }

  public function messagesCalculatorV2($data) {
    $message['title'] = t("Normal nutritional status");
    $message['message'] = null;

    $maxBmi = $data['patient_data']['patient_age'] >= 70 ? 22 : 18.5;
    //var_dump($maxBmi,$data['patient_data']['patient_age']);
    $messages = array();

    if($data['patient_data']['weightloss_1'] >= 5 || $data['patient_data']['weightloss_6'] >= 10 || $data['patient_data']['bmi'] < $maxBmi || (isset($data['mna']['score']) && $data['mna']['score'] < 7)) {
      $message['title'] = t('At risk of malnutrition.');
      $message['message'] = t("Your patient presents the following phenotypic criteria: ");
      $criteria = [];
      if($data['patient_data']['weightloss_1'] >= 5) {
        $criteria[] = t("Weight lost ≥ 5 % in 1 month");
      } if($data['patient_data']['weightloss_6'] >= 10) {
        $criteria[] = t("Weight lost ≥ 10 % in 6 month");
      } if($data['patient_data']['bmi'] < $maxBmi) {
        $criteria[] = t("BMI < $maxBmi");
      }
      //  if($data['mna']['score'] <= 7 && $data['patient_data']['patient_age'] >= 70) {
      //   $criteria[] = t("MNA ≤ 7");
      // }
      $message['message'].=implode(' - ', $criteria);
    }
    return $message;
  }

  public function checkMalnutritionV2($data) {
    $maxBmi = $data['patient_data']['patient_age'] >= 70 ? 22 : 18.5;
    if($data['patient_data']['weightloss_1'] >= 5 || $data['patient_data']['weightloss_6'] >= 10 || $data['patient_data']['bmi'] < $maxBmi || (isset($data['mna']['score']) && $data['mna']['score'] < 7)) {
      return 1;
    }
    return 0;
  }

}
