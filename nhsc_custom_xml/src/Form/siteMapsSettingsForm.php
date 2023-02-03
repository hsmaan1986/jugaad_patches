<?php

namespace Drupal\nhsc_custom_xml\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Code\Database\Database;


/**
 * My nhsc_protein_calculator basic settings.
 */

class siteMapsSettingsForm extends ConfigFormBase {

    public function getFormId() {
        return 'nhsc_custom_xml';
    }

    protected function getEditableConfigNames() {
        return [
            'nhsc_custom_xml.settings',
        ];
    }


    public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
        
        $xml_option =  static::regions();


        if (empty($form_state->getValue('country_xml'))) {
            // Use a default value.
              $selected_option = key($xml_option);
            } 
            
            else {
              // Get the value if it already exists.
              $selected_option = $form_state->getValue('country_xml');
            }

        $form['xml'] = [
            '#type' => 'fieldset',
            '#title' => t('XML Section'),
            '#group' => 'settings',
        ];


        $form['xml']['country_xml'] = array(
        '#title' => t('country name'),
        '#type' => 'select',
        '#description' => "Select country.",
        '#options' => $xml_option,
        '#default_value' => $form_state->getValue('country_xml'),
        // Bind an Ajax callback to the element.
        '#ajax' => [
        'callback' => '::instrumentDropdownCallback',
        'wrapper' => 'state-fieldset-container',
        'event' => 'change',
        
        ],
        );

        $form['select_fieldset_container'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'state-fieldset-container'],
        
          ];



        $form['select_fieldset_container']['country_xml_body'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Preview xml'),
            '#rows' => 20,
            '#size'=>'100',
            '#disabled'=>true,
            '#default_value'=> static::getXMLbody($selected_option),
            '#value'=> static::getXMLbody($selected_option),   
        ];


        $form['select_fieldset_container']['country_xml_body_save'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Paste your XML here'),
            '#required' => true,
            '#size'=>'100',
        ];



        $form['select_fieldset_container']['submit'] = [
            '#type' => 'submit',
            '#value' => 'Save XML',
            '#button_type'=>'primary'
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->configFactory->getEditable('nhsc_custom_xml.settings');

      //  $form_state->setRebuild(TRUE);
        $fields=$form_state->getValues();
        
        $data=[
            'country_xml'=> $fields['country_xml'],
            'country_xml_body'=>$fields['country_xml_body_save']
        ];

        $query = \Drupal::database();
        $query->insert('customxml')->fields($data)->execute();

        \Drupal::messenger()->addMessage($form_state->getValue('country_xml').' '. 'sitemap saved');        
    }

    public function instrumentDropdownCallback(array $form, FormStateInterface $form_state) {
        $form_state->setRebuild(TRUE);
       return $form['select_fieldset_container'];
    }

    public static function regions()
    {
        return [
            'global' => t('global'),
            'australia' => t('australia'),
            'austria'=> t('austria'),
            'canada' => t('canada'),
            'china' => t('china'),
            'czech' => t('czech'),
            'denmark' => t('denmark'),
            'finland' => t('finland'),
            'france' => ('france'),
            'germany' => t('germany'),
            'hongkong' => t('hongkong'),
            'india' => t('india'),
            'indonesia' => t('indonesia'),
            'italy' => t('italy'),
            'malaysia' => t('malaysia'),
            'mexico' => t('mexico'),
            'netherlands' => t('netherlands'),
            'philippines' => t('philippines'),
            'poland' => t('poland'),
            'portugal' => t('portugal'),
            'romania' => t('romania'),
            'russia' => t('russia'),
            'singapore' => t('singapore'),
            'southafrica' => t('southafrica'),
            'spain' => t('spain'),
            'srilanka' => t('srilanka'),
            'sweden' => t('sweden'),
            'switzerland' => t('switzerland'),
            'taiwan' => t('taiwan'),
            'thailand' => t('thailand'),
            'turkey' => t('turkey'),
            'uae' => t('uae'),
            'unitedkingdom' => t('unitedkingdom'),
            'unitedstates' => t('unitedstates'),
            'vietnam' => t('vietnam'),
        ];
    }

    public static function getXMLbody($key='')
    {

      $host = \Drupal::request()->getSchemeAndHttpHost();
        $url = $host.'/'.$key.'.xml';
          try {
            $response = \Drupal::httpClient()->get($url, array('headers' => array('Accept' => 'text/plain')));
            $data = $response->getBody();
             return $data;
          }
          catch (RequestException $e) {
            return FALSE;
          }
    }
}
