<?php
/**
 * @file
 * Contains \Drupal\nhsc_comiss_score_survey\Form\ComissScoreForm.
 */
namespace Drupal\nhsc_comiss_score_survey\Form;

use Drupal\block\Entity\Block;
use Drupal\Core\Ajax\BeforeCommand;
use Drupal\Core\Ajax\RemoveCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_comiss_score_survey\Controller\ComissScoreController;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\AppendCommand;
use Drupal\Core\Ajax\InsertCommand;
use Drupal\Core\Ajax\PrependCommand;
use Drupal\views\Views;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\taxonomy\Entity\Term;

class ComissScoreForm extends FormBase {

    private $controller;
    private $webform;
    private $elements;
    private $config;
    private $total_score;


    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_comiss_score_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $webform_id = NULL, $total_score = NULL)
    {
        $this->controller   = new ComissScoreController($webform_id);
        $this->total_score = $total_score;


        $this->elements = $this->controller->getElements();

        $form['#prefix'] = '<div id="comiss-form-wrapper">';
        $form['#suffix'] = '</div>';

        $form['symptom_label'] = [
            '#markup' => t('SYMPTOMS'),
            '#prefix' => '<div class="col-xs-6 form-header">',
            '#suffix' => '</div>',
        ];

        $form['score_label'] = [
            '#markup' => t('SCORE'),
            '#prefix' => '<div class="col-xs-6 form-header text-right">',
            '#suffix' => '</div>',
        ];



        /* loop through element */
        $q_num = 1;
        $help_text = '';
        foreach ($this->elements as $element) {

          $required = '';

          if ($element['#required'] == 1) {
            $required = '*';
          }

            // show validation
            $form['validation_'. $q_num] = [
                '#prefix' => '<div class="col-xs-12"> <span class="question-validation error" id="question-validation-' .$q_num. '"></span>',
                '#suffix' => '</div>',
            ];

            // show question
            $form['question_title_'. $q_num] = [
                '#prefix' => '<div class="col-xs-10 col-md-3 col-lg-3 question-title">',
                '#suffix' => '</div>',
                '#markup' => $element['#title'] . $required,
            ];

            // show question help
            $form['question_help_'. $q_num] = [
                '#prefix' => '<div class="col-xs-2 col-md-9 col-lg-8 question-help">',
                '#suffix' => '</div>',
                '#markup' => '<span id="help-icon-' .$q_num. '" class="help-icon">?</span>'
            ];

            // show question and help text
            $form['question_' . $q_num] = [
                '#type' => $element['#type'],
                '#required' => $element['#required'],
                "#options" => $element['#options'],
                '#prefix' => '<div class="col-xs-9 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-3 question-options">',
                '#suffix' => '</div>',

            ];

            // scores
            $scores = '';
            foreach ($element['#options'] as $k => $v){
                $scores .= '<li class="score_label">' .$k. '</li>';
            }

            // show scores list
            $form['scores_list_'. $q_num] = [
                '#markup' => '<ul>&nbsp;</ul>',
                '#prefix' => '<div class="col-xs-3 col-lg-1 question-score">',
                '#suffix' => '</div>',
            ];

            // help modal

            $help_text = $this->controller->getHelpModal ($element, $q_num);

            // help text
            $form['help_text_' .$q_num] = [
                '#markup' => $help_text,
            ];



            // results wrapper
            $form['result_wrapper_' . $q_num] = [
                '#type' => 'container',
                '#attributes' => ['id' => 'result-wrapper-' . $q_num],
                '#prefix' => '<div class="col-xs-12 question-result">',
                '#suffix' => '</div>'
            ];

            $result = $form_state->getValue('question_' . $q_num);
            // result text box
            $form['result_wrapper_' . $q_num]['score_' . $q_num] = [
                '#type' => 'textfield',
                '#title' => t('Result'),
                '#attributes' => [
                    'width' => '10',
                    ' type' => 'number',
                    'class' => ['results-field'],
                    'readonly' => 'readonly',
                ],
                '#default_value' => $result,
            ];

            $q_num ++;

        }


        $form['actions']['#type'] = 'actions';
        $form['actions']['button'] = [
            '#type' => 'submit',
            '#value' => t('total score and results'),
            '#ajax' => [
                'callback' => '::ajaxSubmitCallback',
                'event' => 'click',
                'effect' => 'fade',
                'wrapper' => 'comiss-form-wrapper',
                '#executes_submit_callback' => FALSE,
            ],
            '#attributes' => [
                'class' => ['comiss-score-button'],
            ],
            '#executes_submit_callback' => FALSE,
            '#button_type' => 'primary',
            '#prefix' => '<div class="col-xs-12 text-center product-filter-button-padding">',
            '#suffix' => '</div>',
        ];


        return $form;
    }

    /**
     * Ajax callback for the specific dropdown.
     */
    public function updateScore(array $form, FormStateInterface $form_state) {
        $ajax_response = new AjaxResponse();

        $ajax_response->addCommand(new HtmlCommand('#result-wrapper-1', $form['result_wrapper_1']));

        return $ajax_response;

    }

    /**
     * {@inheritdoc}
     *
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        return false;
    }




    public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state) {
        $ajax_responce = new AjaxResponse();
        $block     = Block::load('comissscoresurveyblock');
        if ($block) {
            $settings = $block->get('settings');
        }

        $q_num      = 1;

        $controler = new ComissScoreController;
        $configs = $controler->getConfigs();

        $has_error  = false;
        $score_result = 0;
        $total_score = (!is_null($this->total_score)) ? $this->total_score :
            $configs->get('comiss_score_total_score');
        foreach ($this->elements as $element) {

            $q_name         = 'question_' . $q_num;
            $score_name     = 'score_' . $q_num;

            $question_value = $form_state->getValue($q_name);
            $score_value    = $form_state->getValue($score_name);
            $text           = '';
            if (!isset($question_value)) {
                $text = '<div class="adage-form-error question-invalid">' . t('Ensure you have answered this section') .'.</div>';
                $has_error = true;
            }

            $ajax_responce->addCommand(new HtmlCommand('#question-validation-' .$q_num, $text));

            if (isset($question_value)) {
                // add scores
                $score_result += $score_value;
            }


            $q_num ++;
        }

        // check if form has error
        if($has_error === false) {
            // results
            $ajax_responce->addCommand(new HtmlCommand('.score-result', $score_result));
            // total score
            $ajax_responce->addCommand(new HtmlCommand('.score-total', ' / ' . $total_score));

            // show results modal
            $ajax_responce->addCommand(new InvokeCommand('#comiss-results-modal', 'modal', ['show']));
        }

        if($has_error === true) {
            // scroll to error
            $ajax_responce->addCommand(new InvokeCommand('.nhsc-comiss-score-form', 'comissScrollToError', ['.question-validation']));

            // push error data layer
            $ajax_responce->addCommand(new InvokeCommand('.nhsc-comiss-score-form', 'comissPush', ['error']));
        }

        return $ajax_responce;
    }
}
