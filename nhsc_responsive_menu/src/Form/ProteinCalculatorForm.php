<?php

namespace Drupal\nhsc_protein_calculator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Class ProteinCalculatorForm.
 */
class ProteinCalculatorForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'protein_calculator_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::config('nhsc_protein_calculator.settings');
    $heading = $config->get('heading');
    $heading_active = $config->get('heading_active');
    $description = $config->get('description');
    $description_active = $config->get('description_active');
    $us_units = ($config->get('us_units')) ? $config->get('us_units') : t('US Units');
    $metric_units = ($config->get('metric_units')) ? $config->get('metric_units') : t('Metric Units');

    $form['units'] = [
      '#type' => 'radios',
      '#options' => [
        'us_units' => $us_units,
        'metric_units' => $metric_units,
      ],
      '#attributes' => [
        'class' => 'units_option',
      ],
      '#required' => true,
    ];

    $form['gender'] = [
      '#type' => 'fieldset',
      '#title' => t('Gender'),
    ];

    $form['gender']['gender'] = [
      '#type' => 'radios',
      // '#title' => t('Poll status'),
      '#options' => [
        1 => t('Male'),
        2 => t('Female'),
      ],
      '#required' => true,
      '#attributes' => [
          'class' => 'gender_option'
      ],
    ];

    $form['weight'] = [
      '#type' => 'fieldset',
      '#title' => t('Weight'),
    ];

    $form['weight']['weight'] = [
      '#type' => 'number',
      '#title' => t('kg'),
      '#max' => 300,
      '#min' => 1,
      '#required' => false,
      '#states' => [
        'visible' => [
          ':input[name="units"]' => [
            ['value' => 'metric_units'],
          ],
        ],
      ],
    ];

    $form['weight']['us_weight'] = [
      '#type' => 'number',
      '#title' => t('lbs'),
      '#max' => 670,
      '#min' => 1,
      '#required' => false,
      '#states' => [
        'visible' => [
          ':input[name="units"]' => [
            ['value' => 'us_units'],
          ],
        ],
      ],
    ];

    $form['age'] = [
      '#type' => 'fieldset',
      '#title' => t('Age'),
    ];

    $form['age']['years'] = [
      '#type' => 'number',
      '#required' => true,
      '#min' => 20,
      '#max' => 150,
      '#title' => t('years'),
      '#states' => [
        'visible' => [
          ':input[name="units"]' => [
            ['value' => 'us_units'],
            'or',
            ['value' => 'metric_units'],
          ],
        ],
      ],
    ];

    $form['height'] = [
      '#type' => 'fieldset',
      '#title' => t('Height'),
    ];

    $form['height']['meter'] = [
      '#type' => 'number',
      '#max' => 2,
      '#min' => 0,
      '#title' => t('m'),
      '#required' => false,
      '#states' => [
        'visible' => [
          ':input[name="units"]' => [
            ['value' => 'metric_units'],
          ],
        ],
      ],
    ];

    $form['height']['centimeter'] = [
      '#type' => 'number',
      '#max' => 99,
      '#min' => 0,
      '#title' => t('cm'),
      '#required' => false,
      '#states' => [
        'visible' => [
          ':input[name="units"]' => [
            ['value' => 'metric_units'],
          ],
        ],
      ],
    ];

    $form['height']['feet'] = [
      '#type' => 'number',
      '#max' => 7,
      '#min' => 1,
      '#title' => t('ft'),
      '#required' => false,
      '#states' => [
        'visible' => [
          ':input[name="units"]' => [
            ['value' => 'us_units'],
          ],
        ],
      ],
    ];

    $form['height']['inches'] = [
      '#type' => 'number',
      '#max' => 11,
      '#min' => 0,
      '#title' => t('in'),
      '#required' => false,
      '#states' => [
        'visible' => [
          ':input[name="units"]' => [
            ['value' => 'us_units'],
          ],
        ],
      ],
    ];

    $form['very_active'] = [
      '#type' => 'radios',
      '#description' => t('30+ min vigorous daily'),
      '#smart_description' => FALSE,
      '#options' => [
        4 => t('Very Active'),
      ],
      '#attributes' => [
        'class' => [
          'how_active_are_you',
          'how_active_are_you-class',
        ],
      ],
    ];

    $form['active'] = [
      '#type' => 'radios',
      '#description' => t('30+ min moderate to vigorous 3+ times a week'),
      '#smart_description' => FALSE,
      '#options' => [
        3 => t('Active'),
      ],
      '#attributes' => [
        'class' => [
          'how_active_are_you',
          'how_active_are_you-class',
        ],
      ],
    ];

    $form['low_active'] = [
      '#type' => 'radios',
      '#description' => t('Low to moderate 2+ times a week'),
      '#smart_description' => FALSE,
      '#options' => [
        2 => t('Low Active'),
      ],
      '#attributes' => [
        'class' => [
          'how_active_are_you',
          'how_active_are_you-class',
        ],
      ],
    ];

    $form['sedentary'] = [
      '#type' => 'radios',
      '#description' => t('Little to no physical activity'),
      '#smart_description' => FALSE,
      '#options' => [
        1 => t('Sedentary'),
      ],
      '#attributes' => [
        'class' => [
          'how_active_are_you',
          'how_active_are_you-class',
        ],
      ],
    ];

    $form['message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="protein-calculator-results"></div>',
    ];

    $form['button'] = [
      '#type' => 'button',
      '#value' => t('See the result'),
      '#ajax' => [
        'callback' => '::promptCallback',
      ],
    ];

    $form['heading'] = [
      '#type' => 'markup',
      '#markup' => '<span>'. $heading . '</span>',
    ];

    $form['heading_active'] = [
      '#type' => 'markup',
      '#markup' => '<span>'. $heading_active . '</span>',
    ];

    $form['description'] = [
      '#type' => 'markup',
      '#markup' => '<span>'. $description . '</span>',
    ];

    $form['description_active'] = [
      '#type' => 'markup',
      '#markup' => '<span>'. $description_active . '</span>',
    ];

    $form['#theme'] = 'nhsc_protein_calculator';

    return $form;
  }

  /**
   * Callback for submit_driven example.
   *
   * Select the 'box' element, change the markup in it, and return it as a
   * renderable array.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   *   Renderable array (the box element)
   */
  public function promptCallback(array $form, FormStateInterface $form_state) {
    $config = \Drupal::config('nhsc_protein_calculator.settings');
    $read_more = $config->get('read_more');
    $read_more_url = $config->get('read_more_url');
    $results_heading = $config->get('results_heading');
    $results_body = $config->get('results_body');
    $results_measurement = $config->get('results_measurement');

    $us_weight = $form_state->getValue('us_weight');
    $feet = $form_state->getValue('feet');
    $inches = $form_state->getValue('inches');

    $gender = $form_state->getValue('gender');
    $weight = $form_state->getValue('weight');
    $years = $form_state->getValue('years');
    $meter = $form_state->getValue('meter');
    $centimeter = $form_state->getValue('centimeter');

    $very_active = $form_state->getValue('very_active');
    $active = $form_state->getValue('active');
    $low_active = $form_state->getValue('low_active');
    $sedentary = $form_state->getValue('sedentary');

    $protein_units = $form_state->getValue('units');

    if ($protein_units == 'us_units') {
      $poundsToKg = round($us_weight / 2.205, 0);
      $inchesToCentimeters = round($inches * 2.54, 0);
      $feetToMeters = round($feet / 3.281, 0);

      $finalWeight = $poundsToKg;
      $finalCm = (int)$inchesToCentimeters;
      $finalM = (int)$feetToMeters;
    }  else  {

      $finalWeight = $weight;
      $finalCm = $centimeter;
      $finalM = $meter;
    }

    if ($very_active) {
      $activity = $very_active;
    } elseif ($active) {
      $activity = $active;
    } elseif ($low_active) {
      $activity = $low_active;
    } elseif ($sedentary) {
      $activity = $sedentary;
    } else {
      $activity = 1;
    }

    $response = new AjaxResponse();
    $response->addCommand(
      new HtmlCommand(
        '.protein-calculator-results',
        '<div class="calculator-results  my_top_message">' .
        '<div class="small-page">' .
        '<h2 class="results-title">' . t(' YOUR') . '<br> <strong>' .t('PROTEIN NUMBER IS:') . '</strong></h2>' .
        '<div class="protein-resullt__number">' . $this->calculateProteinInternal($gender, $years, $finalM, $finalCm, $finalWeight, $activity) .
        '<span>' . $results_measurement . '</span>' .
        '<div class="protein-resullt__header">' . $results_heading . '</div>'.
        '</div>' .
        '<div class="protein-resullt__body">' . $results_body . '</div>' .
        '</div>' . '<a href="#">'. $read_more . '</a>'
      )
    );

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) { }

  public function calculateBmi($weight, $height) {

    return $weight / ($height * $height);
  }

  public function getProteinFormula($age, $activity, $weight) {
    $age = (int)$age;
    $weight = (int)$weight;
    $activity = (int)$activity;
    $formula = 0;

    switch ($activity) {

      case 1: // Sedentary
        if ($age >= 20 && 64 >= $age) {
          $formula = .8 * $weight;
        }
        elseif ($age >= 65) {
          $formula = 1.1 * $weight;
        }
        break;

      case 2: //LowActive
        if ($age >= 20 && 64 >= $age) {
          $formula = 1 * $weight;
        }
        elseif ($age >= 65) {
          $formula = 1.2 * $weight;
        }
        break;

      case 3: // Active
        $formula = 1.3 * $weight;
        break;

      default: // VeryActive
        $formula = 1.5 * $weight;
        break;
    }

    return $formula;
  }

  function calculateProteinInternal($gender, $age, $finalM, $finalCm, $finalWeight, $activity) {
    $gender = (int)$gender;
    $age = (int)$age;
    $convertHeight = ($finalM . '.' . $finalCm);
    $height = (float)$convertHeight;
    $weight = (int)$finalWeight;
    $activity = (int)$activity;
    $protein = 0;

    $bmi = $this->calculateBmi($weight, $height);

    if (20 >= $bmi) {
      $protein = $this->getProteinFormula($age, $activity, $weight);
    } else if ($bmi > 20 && 30 >= $bmi) {
      $protein = $this->getProteinFormula($age, $activity, $weight);
    }
    else {
      $protein = $this->getProteinFormula($age, $activity, $weight);
    }

    return round($protein, 0);

  }

}


