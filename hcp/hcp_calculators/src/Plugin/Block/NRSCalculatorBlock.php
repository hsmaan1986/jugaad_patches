<?php

namespace Drupal\hcp_calculators\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\Config;
use Drupal\hcp_calculators\Form\hcp_calculatorsSettingsForm;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Provides a 'BMI Calculator' Block.
 *
 * @Block(
 *   id = "nrs_calculator_block",
 *   admin_label = @Translation("NRS Calculator Block"),
 *   category = @Translation("HCP Calculators"),
 * )
 */
class NRSCalculatorBlock extends BaseCalculatorBlock {

    const CALCULATOR_FIELD_KEY_PREABMLE = 'nrs_calculator_block_';
    const LABEL_TYPE = '_label';
    const THEME_NAME = 'nrs_calculator';
    const LIBRARY_NAME = 'hcp_calculators/hcp_calculators';


    const TITLE1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'title1'.self::LABEL_TYPE;
    const TITLE2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'title2'.self::LABEL_TYPE;

    const STEP1_TITLE_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'step1_title'.self::LABEL_TYPE;
    const QUESTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question1'.self::LABEL_TYPE;
    const QUESTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question2'.self::LABEL_TYPE;
    const QUESTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question3'.self::LABEL_TYPE;
    const QUESTION4_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question4'.self::LABEL_TYPE;

    const STEP2_TITLE_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'step2_title'.self::LABEL_TYPE;
    const Q5_OPTION1_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option1_part1'.self::LABEL_TYPE;
    const Q5_OPTION1_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option1_part2'.self::LABEL_TYPE;
    const Q5_OPTION2_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option2_part1'.self::LABEL_TYPE;
    const Q5_OPTION2_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option2_part2'.self::LABEL_TYPE;
    const Q5_OPTION3_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option3_part1'.self::LABEL_TYPE;
    const Q5_OPTION3_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option3_part2'.self::LABEL_TYPE;
    const Q5_OPTION4_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option4_part1'.self::LABEL_TYPE;
    const Q5_OPTION4_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option4_part2'.self::LABEL_TYPE;

    const STEP3_TITLE_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'step3_title'.self::LABEL_TYPE;
    const Q6_OPTION1_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_option1_part1'.self::LABEL_TYPE;
    const Q6_OPTION1_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_option1_part2'.self::LABEL_TYPE;
    const Q6_OPTION2_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_option2_part1'.self::LABEL_TYPE;
    const Q6_OPTION2_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_option2_part2'.self::LABEL_TYPE;
    const Q6_OPTION3_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_option3_part1'.self::LABEL_TYPE;
    const Q6_OPTION3_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_option3_part2'.self::LABEL_TYPE;
    const Q6_OPTION4_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_option4_part1'.self::LABEL_TYPE;
    const Q6_OPTION4_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_option4_part2'.self::LABEL_TYPE;

    const STEP4_TITLE_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'step4_title'.self::LABEL_TYPE;
    const QUESTION_7_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question_7'.self::LABEL_TYPE;

    const STEP5_TITLE_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'step5_title'.self::LABEL_TYPE;
    const CLASSIFICATION1_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification1_part1'.self::LABEL_TYPE;
    const CLASSIFICATION1_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification1_part2'.self::LABEL_TYPE;
    const CLASSIFICATION2_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification2_part1'.self::LABEL_TYPE;
    const CLASSIFICATION2_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification2_part2'.self::LABEL_TYPE;

    const ALTERNATIVE_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'alternative_part1'.self::LABEL_TYPE;
    const ALTERNATIVE_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'alternative_part2'.self::LABEL_TYPE;

    const LEGAL_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'legal'.self::LABEL_TYPE;

    const HOME_BTN_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'reset_btn'.self::LABEL_TYPE;







}