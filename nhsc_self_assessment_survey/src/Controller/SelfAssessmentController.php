<?php


namespace Drupal\nhsc_self_assessment_survey\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\Entity\Webform;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Dompdf\Options;

class SelfAssessmentController extends ControllerBase implements ContainerInjectionInterface
{

    private $config;

    /**
     * @return array
     */
    public function getSelfAssessmentForm()
    {
        $configs    = $this->getConfigs();

        $webform    = $this->getWebform();
        // get banner
        $main_banner_image = $configs->get('main_banner_image');

        try {
            $elements   = $webform->getElementsDecoded();
        } catch (Exception $e){
            $elements = [];
        }

        $survey_data = $elements;

        $result_data = [
            'results_a' => [
                'total_score' => $configs->get('result_a_score'),
                'banner_image' => $configs->get('result_a_banner_image'),
                'result_copy' => $configs->get('result_a_copy'),
            ],
            'results_b' => [
                'total_score' => $configs->get('result_b_score'),
                'banner_image' => $configs->get('result_b_banner_image'),
                'result_copy' => $configs->get('result_b_copy'),
            ],
            'results_c' => [
                'total_score' => $configs->get('result_c_score'),
                'banner_image' => $configs->get('result_c_banner_image'),
                'result_copy' => $configs->get('result_c_copy'),
            ],

        ];

        return [
            '#theme' => 'nhsc_self_assessment_survey',
            '#survey_data' => $survey_data,
            '#main_bunner' => $main_banner_image,
            '#result_data' => $result_data,
            '#cache' => [
                'max-age' => 0
            ],
        ];
    }


    public function getWebform() {
        $configs = $this->getConfigs();
        $webform_name = $configs->get('self_assessment_webform_name');

        $webform       = Webform::load($webform_name);

        return $webform;
    }


    /**
     * @return object
     */
    public function getConfigs() {
        $this->config = $this->config('nhsc_self_assessment_survey.config');

        return $this->config;
    }

}