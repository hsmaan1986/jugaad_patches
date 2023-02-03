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
 *   id = "protein_calculator_block",
 *   admin_label = @Translation("Protein Calculator Block"),
 *   category = @Translation("HCP Calculators"),
 * )
 */
class ProteinCalculatorBlock extends BaseCalculatorBlock {

    const CALCULATOR_FIELD_KEY_PREABMLE = 'protein_calculator_block_';
    const LABEL_TYPE = '_label';
    const THEME_NAME = 'protein_calculator';
    const LIBRARY_NAME = 'hcp_calculators/hcp_calculators';


    const TITLE1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'title1'.self::LABEL_TYPE;
    const TITLE2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'title2'.self::LABEL_TYPE;
    const TITLE3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'title3'.self::LABEL_TYPE;
    const TITLE4_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'title4'.self::LABEL_TYPE;
    const HB_Q1_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q1_option1'.self::LABEL_TYPE;
    const HB_Q1_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q1_option2'.self::LABEL_TYPE;
    const HB_QUESTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_question2'.self::LABEL_TYPE;
    const HB_Q2_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q2_placeholder'.self::LABEL_TYPE;
    const HB_QUESTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_question3'.self::LABEL_TYPE;
    const HB_Q3_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q3_placeholder'.self::LABEL_TYPE;
    const HB_QUESTION4_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_question4'.self::LABEL_TYPE;
    const HB_Q4_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q4_placeholder'.self::LABEL_TYPE;
    const HB_QUESTION5_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_question5'.self::LABEL_TYPE;
    const HB_Q5_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q5_placeholder'.self::LABEL_TYPE;
    const HB_Q5_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q5_option1'.self::LABEL_TYPE;
    const HB_Q5_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q5_option2'.self::LABEL_TYPE;
    const HB_Q5_OPTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q5_option3'.self::LABEL_TYPE;
    const HB_QUESTION6_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_question6'.self::LABEL_TYPE;
    const HB_Q6_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_placeholder'.self::LABEL_TYPE;
    const HB_Q6_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option1'.self::LABEL_TYPE;
    const HB_Q6_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option2'.self::LABEL_TYPE;
    const HB_Q6_OPTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option3'.self::LABEL_TYPE;
    const HB_Q6_OPTION4_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option4'.self::LABEL_TYPE;
    const HB_Q6_OPTION5_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option5'.self::LABEL_TYPE;
    const HB_Q6_OPTION6_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option6'.self::LABEL_TYPE;
    const HB_Q6_OPTION7_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option7'.self::LABEL_TYPE;
    const HB_Q6_OPTION8_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option8'.self::LABEL_TYPE;
    const HB_Q6_OPTION9_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option9'.self::LABEL_TYPE;
    const HB_Q6_OPTION10_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option10'.self::LABEL_TYPE;
    const HB_Q6_OPTION11_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option11'.self::LABEL_TYPE;
    const HB_Q6_OPTION12_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q6_option12'.self::LABEL_TYPE;
    const HB_QUESTION7_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_question7'.self::LABEL_TYPE;
    const HB_Q7_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q7_placeholder'.self::LABEL_TYPE;
    const HB_Q7_OPTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q7_option1'.self::LABEL_TYPE;
    const HB_Q7_OPTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q7_option2'.self::LABEL_TYPE;
    const HB_Q7_OPTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q7_option3'.self::LABEL_TYPE;
    const HB_Q7_OPTION4_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'hb_q7_option4'.self::LABEL_TYPE;
    const PF_QUESTION1_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'pf_question1'.self::LABEL_TYPE;
    const PF_Q1_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'pf_q1_placeholder'.self::LABEL_TYPE;
    const PF_QUESTION2_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'pf_question2'.self::LABEL_TYPE;
    const PF_Q2_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'pf_q2_placeholder'.self::LABEL_TYPE;
    const PF_QUESTION3_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'pf_question3'.self::LABEL_TYPE;
    const PF_Q3_PLACEHOLDER_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'pf_q3_placeholder'.self::LABEL_TYPE;
    const EERLABEL_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'eerlabel'.self::LABEL_TYPE;
    const PROTEIN_LABEL_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'protein_label'.self::LABEL_TYPE;
    const LEGAL_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'legal'.self::LABEL_TYPE;
    const HOME_BTN_LABEL_KEY = self::CALCULATOR_FIELD_KEY_PREABMLE.'reset_btn'.self::LABEL_TYPE;





}