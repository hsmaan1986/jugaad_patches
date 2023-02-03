<?php


namespace Drupal\nhsc_learn_to_grow_survey\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormState;
use Drupal\webform\Entity\Webform;
use Drupal\Core\Form;

class LearnToGrowController extends ControllerBase implements ContainerInjectionInterface
{
    private $config;

    /**
     * @return array
     */
    public function surveyForm()
    {
        // get menu
        $menu = $this->getMenu('learn-to-grow-menu');
        $configs = $this->getConfigs();
        $survey_title = $configs->get('survey_title');
        $survey_sub_title = $configs->get('survey_sub_title');
        $instructions_copy = $configs->get('instructions_copy');
        $intro_title = $configs->get('intro_form_title');

        $webform    = $this->getWebform();

        $elements   = (isset($webform)) ? $webform->getElementsDecoded() : [];

        $survey_data = $elements;
        $survey_data['survey_title'] = $survey_title;
        $survey_data['survey_sub_title'] = $survey_sub_title;
        $survey_data['instructions_copy'] = $instructions_copy;

        // construct info form
        $intro_form = \Drupal::formBuilder()->getForm('Drupal\nhsc_learn_to_grow_survey\Form\IntroductionForm');

        // get tabs
        $questions = [];
        foreach ($elements as $k => $element) {
            // pages
            $search = 'page_';
            if(preg_match("/{$search}/i", $k)) {
                $q_num = explode('_', $k)[1];// get page number
                $q_count = 1;
                $w_count = 1;
                $q_selector = 'question_' . $q_num;
                $q_selector_w = 'a_week_' . $q_num;

                // get question list
                $q_list = [];
                $a_week = [];
                foreach ($element as $e => $quest) {

                    if(preg_match("/{$q_selector_w}/i", $e)) {
                        $a_week[$w_count] = [
                            'title' => $quest['#title'],
                            'sub-title' => $quest['#description'],
                        ];
                        $w_count++;
                    }

                    if(preg_match("/{$q_selector}/i", $e)) {

                        $q_list[$q_count] = [
                            'name' => $e,
                            'field' => $quest,

                        ];

                        $q_count++;
                    }

                }

                $questions[$q_num] = [
                    'title' => $element['#title'],
                    'questions' => $q_list,
                    'switchers' => $a_week,
                ];


            }

        }


        $survey_data['intro_form'] = $intro_form;

        return [
            '#theme' => 'nhsc_learn_to_grow_survey',
            '#survey_data' => $survey_data,
            '#intro_title' => $intro_title,
            '#intro_form' => $intro_form['introduction_form'],
            '#submit_button_form' => $intro_form['results_button'],
            '#questions' => $questions,
            '#menu' => $menu,
            '#cache' => [
                'max-age' => 0
            ],
        ];
    }

    public function getIntroFormElements() {
        $webform    = $this->getWebform();
        $elements   = (isset($webform)) ? $webform->getElementsDecoded() : [];

        $intro_form = [];
        foreach ($elements as $k => $element){
            // INTRO KEY
            if ($k === 'introduction_form'){
                foreach ($element as $e => $form) {
                    if(is_array($form)){
                        $intro_form[$e] = $form;
                    }
                }
            }
        }
        return $intro_form;
    }

    public function getResultsPage (){
        return [
            '#theme' => 'nhsc_learn_to_grow_survey_results',
            '#cache' => [
                'max-age' => 0
            ],
        ];
    }

    public function getMenu($menu_name) {
        $tree = $this->loadMenu($menu_name);
        return $this->constructMenu($tree);
    }

    public function loadMenu($menu_name) {
        $menu_tree = \Drupal::menuTree();
        $parameters = $menu_tree->getCurrentRouteMenuTreeParameters($menu_name);
        $tree = $menu_tree->load($menu_name, $parameters);

        $manipulators = [
            ['callable' => 'menu.default_tree_manipulators:checkAccess'],
            ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
        ];
        return $menu_tree->transform($tree, $manipulators);
    }

    public function constructMenu($tree) {
        $items = [];

        foreach ($tree as $element) {
            $link = $element->link;

            $record = $link->getPluginDefinition();

            $menu_title = $record['title'];
            $menu_id = $record['metadata']['entity_id'];
            $items[$menu_id] = [
                'menu_title' => $menu_title,
                'weight' => $record['weight'],
                'url' => str_replace('base:', '/', $record['url']),
            ];


        }
        return $items;
    }

    public function getWebform() {
        $configs = $this->getConfigs();
        $webform_name = $configs->get('webform_name');

        $webform       = (is_string($webform_name)) ? Webform::load($webform_name) : NULL;

        return $webform;
    }

    /**
     * @return object
     */
    public function getConfigs() {
        $this->config = $this->config('nhsc_learn_to_grow_survey.config');

        return $this->config;
    }
}