<?php


namespace Drupal\nhsc_symptom_checker\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\webform\WebformInterface;
use Exception;

class SymptomCheckerController extends ControllerBase implements ContainerInjectionInterface
{
    private $config;

    /**
     * @return array
     */
    public function getSymptomCheckerForm () {
        $configs    = $this->getConfigs();

        if (!empty($this->getWebform())){

          $webform    = $this->getWebform(); // @todo validate if webform is found

          // get banner
          $main_banner_image = $configs->get('main_banner_image');

          try {
            $elements   = $webform->getElementsDecoded();
          } catch (Exception $e){
            $elements = [];
          }

          $survey_data = $elements;

          $first_question = key($survey_data);

          $result_data = [
            'survey_title' => $configs->get('survey_title'),
            'home_copy' => $configs->get('home_copy'),
            'results_copy' => $configs->get('results_copy'),
            'call_to_action_text' => $configs->get('call_to_action_text'),
            'call_to_action_link' => $configs->get('call_to_action_link'),
            'disclaimer_copy' => $configs->get('disclaimer_copy'),
          ];


          return [
            '#theme' => 'nhsc_symptom_checker',
            '#survey_data' => $survey_data,
            '#main_bunner' => $main_banner_image,
            '#result_data' => $result_data,
            '#first_question' => $first_question,
            '#cache' => [
              'max-age' => 0
            ],
          ];
        } else {

          return [
            '#theme' => 'nhsc_symptom_checker',
            '#survey_data' => null,
            '#main_bunner' => null,
            '#result_data' => null,
            '#first_question' => null,
            '#cache' => [
              'max-age' => 0
            ],
          ];
        }


    }

    public function getWebform() {
        $configs = $this->getConfigs();
        $webform_name = $configs->get('webform_name');

        $webform = \Drupal::entityTypeManager()->getStorage('webform')->load($webform_name);

        return $webform;
    }


    /**
     * @return object
     */
    public function getConfigs() {
        $this->config = $this->config('nhsc_symptom_checker.config');

        return $this->config;
    }

}
