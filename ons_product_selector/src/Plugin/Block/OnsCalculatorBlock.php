<?php

namespace Drupal\ons_product_selector\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\ons_product_selector\Form\OnsBmiCalculatorForm;
use Drupal\ons_product_selector\Controller\OnsCalculatorBase;
use Drupal\Core\Url;

/**
 * Provides OnsBmiCalculatorForm.
 *
 * @Block(
 *  id = "ons_calculator_block",
 *  admin_label = @Translation("Ons Calculators block")
 * )
 */

 class OnsCalculatorBlock extends BlockBase {
   public function build(){
     $controller = new OnsCalculatorBase();

     return [
       '#data' => [
         'language' => \Drupal::languageManager()->getCurrentLanguage()->getId(),
         'config' => strtolower($controller->getCalculatorVersion()),
         'action' => Url::fromUri('internal:/ons_product_selector/calc/calculators', ['absolute' => true])
       ],
       //'#markup' => '<h1>teste</h1>'
       '#theme' => 'ons_calculators_start',
       '#attached' => [
        'library' => [
          'ons_product_selector/ons-product-selector-calculator-'.strtolower($controller->getCalculatorVersion()),
        ],
      ]
     ];
   }

 }
