<?php

namespace Drupal\hcp_calculators\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\hcp_calculators\Form\hcp_calculatorsSettingsForm;


/**
 * Provides a 'BMI Calculator' Block.
 * See BaseCalculatorBlock for all the functionality.
 * This class defines constants the define the fields used in the block and the form used to configure the block
 * All the magic happens in BaseCalculatorBlock which builds the forms and exposes a form for managing the block
 * I did this so that we can simply add a new block by defining constants
 *
 * @Block(
 *   id = "mna_calculator_block",
 *   admin_label = @Translation("MNA Calculator Block"),
 *   category = @Translation("HCP Calculators"),
 * )
 */
class MNACalculatorBlock extends BaseCalculatorBlock {


    const CALCULATOR_FIELD_KEY_PREABMLE = 'mna_calculator_block_';
    const LABEL_TYPE = '_label';
    const THEME_NAME = 'mna_calculator';
    const LIBRARY_NAME = 'hcp_calculators/hcp_calculators';


    const TITLE1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'title1'.self::LABEL_TYPE;
    const TITLE2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'title2'.self::LABEL_TYPE;

    const QUESTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question1'.self::LABEL_TYPE;
    const Q1_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q1_option1'.self::LABEL_TYPE;
    const Q1_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q1_option2'.self::LABEL_TYPE;
    const Q1_OPTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q1_option3'.self::LABEL_TYPE;

    const QUESTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question2'.self::LABEL_TYPE;
    const Q2_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q2_option1'.self::LABEL_TYPE;
    const Q2_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q2_option2'.self::LABEL_TYPE;
    const Q2_OPTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q2_option3'.self::LABEL_TYPE;
    const Q2_OPTION4_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q2_option4'.self::LABEL_TYPE;

    const QUESTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question3'.self::LABEL_TYPE;
    const Q3_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q3_option1'.self::LABEL_TYPE;
    const Q3_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q3_option2'.self::LABEL_TYPE;
    const Q3_OPTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q3_option3'.self::LABEL_TYPE;

    const QUESTION4_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question4'.self::LABEL_TYPE;
    const Q4_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q4_option1'.self::LABEL_TYPE;
    const Q4_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q4_option2'.self::LABEL_TYPE;

    const question5_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question5'.self::LABEL_TYPE;
    const Q5_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option1'.self::LABEL_TYPE;
    const Q5_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option2'.self::LABEL_TYPE;
    const Q5_OPTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q5_option3'.self::LABEL_TYPE;

    const question6_1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question6_1'.self::LABEL_TYPE;
     const Q6_1_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_1_option1'.self::LABEL_TYPE;
     const Q6_1_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_1_option2'.self::LABEL_TYPE;
     const Q6_1_OPTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_1_option3'.self::LABEL_TYPE;
     const Q6_1_OPTION4_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_1_option4'.self::LABEL_TYPE;

     const QUESTION6_2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'question6_2'.self::LABEL_TYPE;
     const Q6_2_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_2_option1'.self::LABEL_TYPE;
     const Q6_2_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'q6_2_option2'.self::LABEL_TYPE;

     const SWITCHLINK_1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'switchlink_1'.self::LABEL_TYPE;
     const SWITCHLINK_2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'switchlink_2'.self::LABEL_TYPE;

     const RESULT_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'result'.self::LABEL_TYPE;
     const CLASSIFICATION1_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification1_part1'.self::LABEL_TYPE;
     const CLASSIFICATION1_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification1_part2'.self::LABEL_TYPE;

     const CLASSIFICATION2_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification2_part1'.self::LABEL_TYPE;
     const CLASSIFICATION2_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification2_part2'.self::LABEL_TYPE;

     const CLASSIFICATION3_PART1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification3_part1'.self::LABEL_TYPE;
     const CLASSIFICATION3_PART2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'classification3_part2'.self::LABEL_TYPE;

     const LEGAL_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'legal'.self::LABEL_TYPE;

     const HOME_BTN_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'reset_btn'.self::LABEL_TYPE;








    /**
     * {@inheritdoc}
     *
     *
     */







}