<?php

namespace Drupal\hcp_calculators\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\Config;
use Drupal\hcp_calculators\Form\hcp_calculatorsSettingsForm;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Base Block containing all the logic for a calculator.
 * Makes massive use of static. See difference between static and self : http://php.net/manual/en/language.oop5.late-static-bindings.php
 *
 * @Block(
 *   id = "base_calculator_block",
 *   admin_label = @Translation("Base Calculator Block"),
 *   category = @Translation("HCP Calculators"),
 * )
 */
abstract class BaseCalculatorBlock extends BlockBase {

    private $config;

    public function __construct(array $configuration, $plugin_id, $plugin_definition)
    {
        $this->config = \Drupal::config(hcp_calculatorsSettingsForm::HCP_SETTINGS_KEY);
        parent::__construct($configuration, $plugin_id, $plugin_definition);
    }

    //get all the constants defined.
    protected function getConstants()
    {
        //the use of this will refer to the inherited class
        $reflectionClass = new \ReflectionClass($this);
        return $reflectionClass->getConstants();
    }



    public function build() {


        $blockRenderArray = array();

        //static allows the inheriting child class constant to be used instead of a constant defined
        //using self will point to BaseCalculator block but since the constant is defined in the
        // child class we use static::. See MNACalculatorBlock
        $blockRenderArray['#theme'] = static::THEME_NAME;
        $blockRenderArray['#attached'] = array(
            'library' => array(static::LIBRARY_NAME),
        );
        $definedConsts = $this->definedFormConstants($this->getConstants());


        foreach ($definedConsts as $definedConst)
        {
            $renderArrayKey = '#'.str_replace(array(static::CALCULATOR_FIELD_KEY_PREABMLE,static::LABEL_TYPE),'',$definedConst);

            $blockRenderArray[$renderArrayKey] = $this->configuration[$definedConst];


        }
        return $blockRenderArray;


    }


    public function blockForm($form, FormStateInterface $form_state) {

        $form = parent::blockForm($form, $form_state);
        $formConsts =  $this->definedFormConstants($this->getConstants());


        //I am lazy to write out each for, so what I do is automatically create each from field from the defined constants as  a textfield by default
        foreach ($formConsts as $definedConst)
        {
            //title is the unique part of the defined constant without the preamble
            $title = str_replace(static::CALCULATOR_FIELD_KEY_PREABMLE,'',$definedConst);


            if($definedConst === static::LEGAL_LABEL_KEY)
            {

                $form[$definedConst] = array(
                    '#type' => 'textarea',
                    '#title' => $this->t('Legal notice'),
                    '#description' => $this->t('Enter the  legal disclaimer for calculator'),
                    '#default_value' => isset( $this->configuration[$definedConst]) ? $this->configuration[$definedConst] : '',
                    '#attributes' => ['placeholder' => ['Enter legal notice']],
                    '#rows' => 10,
                    '#cols' =>100
                );

            }
            else {
                $form[$definedConst] = array(
                    '#type' => 'textfield',
                    '#maxlength' => '400',
                    '#title' => $this->t($title),
                    '#description' => $this->t($title),
                    '#default_value' => isset( $this->configuration[$definedConst]) ? $this->configuration[$definedConst] : ''
                );

            }




        }
        return $form;

    }


    private function  definedFormConstants(array $constants)
    {
        $formConstants = array();
        foreach ($constants as $aConstant) {
            //if the constant begins with the field key preamble but is NOT the the field key preamble  then I know that its a field key

            if(strpos($aConstant,static::CALCULATOR_FIELD_KEY_PREABMLE) ===0 && $aConstant !== static::CALCULATOR_FIELD_KEY_PREABMLE ) {
                array_push($formConstants,$aConstant);
            }
        }
        return $formConstants;
    }

    public function blockSubmit($form, FormStateInterface $form_state) {
        // Save our custom settings when the form is submitted.

        $values     = $form_state->getValues();
        $keys       = array_keys($values);

        foreach ($keys as $key){
            if(strpos($key, static::CALCULATOR_FIELD_KEY_PREABMLE) === 0 ){
                $this->configuration[$key] = $form_state->getValue($key);

            }

        }
    }







}