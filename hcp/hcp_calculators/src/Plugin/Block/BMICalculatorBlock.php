<?php

namespace Drupal\hcp_calculators\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\hcp_calculators\Form\hcp_calculatorsSettingsForm;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a 'BMI Calculator' Block.
 *
 * @Block(
 *   id = "bmi_calculator_block",
 *   admin_label = @Translation("BMI Calculator Block"),
 *   category = @Translation("HCP Calculators"),
 * )
 */
class BMICalculatorBlock extends BaseCalculatorBlock {

    const LABEL_TYPE = '_label';
    const CALCULATOR_FIELD_KEY_PREABMLE = 'bmi_calculator_block_';
    const THEME_NAME = 'bmi_calculator';
    const LIBRARY_NAME = 'hcp_calculators/hcp_calculators';

    const TITLE_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE."title".self::LABEL_TYPE;
    const HEIGHT_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE."height_field".self::LABEL_TYPE;
    const WEIGHT_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE."weight_field".self::LABEL_TYPE;
    const LEGAL_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE."legal".self::LABEL_TYPE;
    //const HOMEPAGE_BUTTON_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE."homepage_btn".self::LABEL_TYPE;
    const HEIGHT_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE."height_placeholder".self::LABEL_TYPE;
    const WEIGHT_PLACEHOLDER_LABEL_KEY =self:: CALCULATOR_FIELD_KEY_PREABMLE."weight_placeholder".self::LABEL_TYPE;
    const CALCULATE_BUTTON_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE."calculate_btn".self::LABEL_TYPE;

}