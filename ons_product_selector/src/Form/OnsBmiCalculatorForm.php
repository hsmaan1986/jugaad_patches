<?php

namespace Drupal\ons_product_selector\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class OnsBmiCalculatorForm extends FormBase {
  public function getFormId() {
    return 'ons_bmi_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['body_age'] = array(
      '#type' => 'select',
      '#title' => $this->t('Age'),
      '#options' => range(18, 99)
    );
    $form['body_height'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Height'),
      '#maxlength' => 3,
      '#size' => 10
    );
    $form['body_weight'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Weight'),
      '#maxlength' => 3,
      '#size' => 10
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }
}