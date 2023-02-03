<?php


namespace Drupal\nhsc_comiss_score_survey\Controller;


use Drupal\block\Entity\Block;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormStateInterface;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;
use Drupal\file\Entity\File;
use Dompdf\Dompdf;
use Drupal\Core\Url;
use Dompdf\Options;
use Drupal\Component\Utility\Html;
use Drupal\Core\Block\BlockBase;

class ComissScoreController extends ControllerBase implements ContainerInjectionInterface
{

    private $config;

    protected $webform_id;
    protected $above_cutoff;
    protected $above_first_cta_link;
    protected $above_first_cta_text;
    protected $above_second_cta_link;
    protected $above_second_cta_text;
    protected $comiss_score_below_cutoff;
    protected $below_first_cta_link;
    protected $below_first_cta_text;
    protected $below_second_cta_link;
    protected $below_second_cta_text;
    protected $comiss_score_content;
    protected $comiss_score_webform_name;
    protected $comiss_survey_title;
    protected $comiss_score_cutoff_value;
    protected $comiss_score_total_score;
    protected $company_logo_location;
    protected $copy_right_text;
    protected $purpose_title;
    protected $purpose_copy;
    protected $instructions_title;
    protected $instructions_copy;
    protected $reading_results_title;
    protected $reading_results_copy;
    protected $form_print_footer;
    public $elements;

    public function __construct(
        $webform_id = NULL,
        $above_cutoff = NULL,
        $above_first_cta_link = NULL,
        $above_first_cta_text = NULL,
        $above_second_cta_link = NULL,
        $above_second_cta_text = NULL,
        $comiss_score_below_cutoff = NULL,
        $below_first_cta_link = NULL,
        $below_first_cta_text = NULL,
        $below_second_cta_link = NULL,
        $below_second_cta_text = NULL,
        $comiss_score_content = NULL,
        $comiss_score_webform_name = NULL,
        $comiss_survey_title = NULL,
        $comiss_score_cutoff_value = NULL,
        $comiss_score_total_score = NULL,
        $company_logo_location = NULL,
        $copy_right_text = NULL,
        $purpose_title = NULL,
        $purpose_copy = NULL,
        $instructions_title = NULL,
        $instructions_copy = NULL,
        $reading_results_title = NULL,
        $reading_results_copy = NULL,
        $form_print_footer = NULL)

    {

        $this->webform_id = (empty($webform_id)) ? $this->getConfigs()->get('comiss_score_webform_name') : $webform_id;
        $this->above_cutoff = (empty($above_cutoff)) ? $this->getConfigs()->get('above_cutoff') : $above_cutoff;
        $this->above_first_cta_link = (empty($above_first_cta_link)) ? $this->getConfigs()->get('above_first_cta_link') : $above_first_cta_link;
        $this->above_first_cta_text = (empty($above_first_cta_text)) ? $this->getConfigs()->get('above_first_cta_text') : $above_first_cta_text;
        $this->above_second_cta_link = (empty($above_second_cta_link)) ? $this->getConfigs()->get('above_second_cta_link') : $above_second_cta_link;
        $this->above_second_cta_text = (empty($above_second_cta_text )) ? $this->getConfigs()->get('above_second_cta_text') : $above_second_cta_text;
        $this->comiss_score_below_cutoff = (empty($comiss_score_below_cutoff)) ? $this->getConfigs()->get('comiss_score_below_cutoff') : $comiss_score_below_cutoff;
        $this->below_first_cta_link = (empty($below_first_cta_link )) ? $this->getConfigs()->get('below_first_cta_link') : $below_first_cta_link;
        $this->below_first_cta_text = (empty($below_first_cta_text)) ? $this->getConfigs()->get('below_first_cta_text') : $below_first_cta_text;
        $this->below_second_cta_link = (empty($below_second_cta_link)) ? $this->getConfigs()->get('below_second_cta_link') : $below_second_cta_link;
        $this->below_second_cta_text = (empty($below_second_cta_text)) ? $this->getConfigs()->get('below_second_cta_text') : $below_second_cta_text;
        $this->comiss_score_content = (empty($comiss_score_content)) ? $this->getConfigs()->get('comiss_score_content') : $comiss_score_content;
        $this->comiss_score_webform_name = (empty($comiss_score_webform_name)) ? $this->getConfigs()->get('comiss_score_webform_name') : $comiss_score_webform_name;
        $this->comiss_survey_title = (empty($comiss_survey_title)) ? $this->getConfigs()->get('comiss_survey_title') : $comiss_survey_title;
        $this->comiss_score_cutoff_value = (empty($comiss_score_cutoff_value)) ? $this->getConfigs()->get('comiss_score_cutoff_value') : $comiss_score_cutoff_value;
        $this->comiss_score_total_score = (empty($comiss_score_total_score)) ? $this->getConfigs()->get('comiss_score_total_score') : $comiss_score_total_score;
        $this->company_logo_location = (empty($company_logo_location)) ? $this->getConfigs()->get('company_logo_location') : $company_logo_location;
        $this->copy_right_text = (empty($copy_right_text)) ? $this->getConfigs()->get('copy_right_text') : $copy_right_text;
        $this->purpose_title = (empty($purpose_title)) ? $this->getConfigs()->get('purpose_title') : $purpose_title;
        $this->purpose_copy = (empty($purpose_copy)) ? $this->getConfigs()->get('purpose_copy') : $purpose_copy;
        $this->instructions_title = (empty($instructions_title)) ? $this->getConfigs()->get('instructions_title') : $instructions_title;
        $this->instructions_copy = (empty($instructions_copy)) ? $this->getConfigs()->get('instructions_copy') : $instructions_copy;
        $this->reading_results_title = (empty($reading_results_title)) ? $this->getConfigs()->get('reading_results_title') : $reading_results_title;
        $this->reading_results_copy = (empty($reading_results_copy)) ? $this->getConfigs()->get('reading_results_copy') : $reading_results_copy;
        $this->form_print_footer = (empty($form_print_footer)) ? $this->getConfigs()->get('form_print_footer') : $form_print_footer;

    }

    /**
     * @return array
     */
    public function comissScoreForm()
    {
        $configs    = $this->getConfigs();
        $elements   = $this->getElements();

        $block      = Block::load('comissscoresurveyblock_2');
        if ($block) {
            $settings = $block->get('settings');
            $pluin = $block->getPlugin();
        }


        $responses  = [];
        foreach ($elements  as $element) {
            $responses[] = [
                'question' => $element['#title'],
                'options' => $element['#options'],
            ];
        }


        $questions = [];
        $q_num = 1;
        foreach ($elements  as $e_key => $element) {

            $q_name = explode('_', $e_key);

            // check for level one question
            switch (count($q_name)){
                case 2; // main question number
                    if ($element['#type'] == 'radios') {
                        $questions[$e_key] = [
                            'title' => $element['#title'],
                            'options' => $element['#options'],
                            'description' => $element['#description'],
                            'has_child' => false,
                        ];
                    }

                    if ($element['#type'] == 'fieldset') {
                        $questions[$e_key] = [
                            'title' => $element['#title'],
                            'description' => $element['#description'],
                            'has_child' => true,
                            'sub_questions' => [],
                        ];
                    }
                    break;
                case 3:

                    if ($element['#type'] == 'radios') {

                        $questions['question_' . $q_name[1]]['sub_questions'][$e_key] = [
                            'title' => $element['#title'],
                            'options' => $element['#options'],
                            'has_child' => false,
                        ];

                    }

                    if ($element['#type'] == 'fieldset') {
                        $questions['question_' . $q_name[1]]['sub_questions'][$e_key] = [
                            'title' => $element['#title'],
                            'description' => $element['#description'],
                            'has_child' => true,
                            'sub_questions' => [],
                        ];
                    }

                    break;
                case 4:

                    if ($element['#type'] == 'radios') {

                        $curr_que = 'question_' . $q_name[1] .'_'. $q_name[2];

                        $questions['question_' . $q_name[1]]['sub_questions'][$curr_que]['sub_questions'][$e_key] = [
                            'title' => $element['#title'],
                            'options' => $element['#options'],
                            'has_child' => false,
                        ];


                    }


                    break;

            }


            $q_num ++;
        }


        $form  = \Drupal::formBuilder()->getForm('Drupal\nhsc_comiss_score_survey\Form\ComissScoreForm', $this->webform_id, $this->comiss_score_total_score);

        return [
            '#theme' => 'nhsc_comiss_score_survey',
            '#intro_copy' => $this->comiss_score_content,
            '#survey_title' => $this->comiss_survey_title,
            '#purpose_title' => $this->purpose_title,
            '#purpose_copy' => $this->purpose_copy,
            '#instructions_title' => $this->instructions_title,
            '#instructions_copy' => $this->instructions_copy,
            '#reading_results_title' => $this->reading_results_title,
            '#reading_results_copy' => $this->reading_results_copy,
            '#form_print_footer' => $this->form_print_footer,
            '#footer_logo' => $this->company_logo_location,
            '#copy_right_text' => $this->copy_right_text,
            '#responses' => $responses,
            '#questions' => $questions,
            '#form' => $form,
        ];
    }


    public function getWebform( $id = NULL ) {
        $configs = $this->getConfigs();
        $webform = false;
        $webform_config = $configs->get('comiss_score_webform_name');

        $webform_id = isset($id) ? $id : $webform_config;

        if (!empty($webform_id)) {
        $webform = \Drupal::entityTypeManager()
            ->getStorage('webform')
            ->load($webform_id);
        }

        return $webform;

    }


    /**
     * @return object
     */
    public function getConfigs() {
        $this->config = $this->config('nhsc_comiss_score_survey.config');

        return $this->config;
    }

    /**
     * {@inheritdoc}
     * @todo remove not used
     *
     */
    public function downloadPdf() {

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', TRUE);
        $options->set('isJavascriptEnabled', TRUE);

        $dompdf = new Dompdf($options);
        $host   = \Drupal::request()->getSchemeAndHttpHost();
        $url    = $host . '/comiss-score/generate-pdf';

        /* @todo validation */

        $getData = $this->getURLcontent($url);

        $html    = str_replace('href="//cdn', 'href="https://cdn', $getData['data']);
        $html    = str_replace('media="all" href="/themes', 'media="all" href="'.$host.'/themes/', $html);
        $html    = str_replace('media="all" href="/modules/custom/', 'media="all" href="'.$host.'/modules/custom/', $html);

        $dompdf->loadHtml ($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream("sample.pdf", ["Attachment"=>0]);

    }

    /**
     * {@inheritdoc}
     *
     */
    public function generatePdfUrl() {

        $configs = $this->getConfigs();
        $webform = $this->getWebform();
        $block     = Block::load('comiss_score_block');
        if ($block) {
            $settings = $block->get('settings');
        }

        try {
            $elements = $webform->getElementsDecodedAndFlattened();
        } catch (Exception $e) {
            $elements = [];
        }


        $questions = [];
        foreach ($elements as $element) {
            $questions[] = [
                'question' => $element['#title'],
                'options' => $element['#options'],
            ];
        }


        return  [
            '#theme' => 'nhsc_comiss_score_survey_pdf',
            '#survey_title' => $this->comiss_survey_title,
            '#purpose_title' => $this->purpose_title,
            '#purpose_copy' => $this->purpose_copy,
            '#instructions_title' => $this->instructions_title,
            '#instructions_copy' => $this->instructions_copy,
            '#reading_results_title' => $this->reading_results_title,
            '#reading_results_copy' => $this->reading_results_copy,
            '#form_print_footer' => $this->form_print_footer,
            '#footer_logo' => $this->company_logo_location,
            '#copy_right_text' => $this->copy_right_text,
            '#questions' => $questions,
            '#cache' => ['max-age' => 0],
        ];



    }

    /**
     * {@inheritdoc}
     *
     */
    public function getHelpModal ($element, $q_num)
    {
        $help_text = '<div
                class="modal fade"
                id="comiss-help-modal-'.$q_num.'" 
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel"
                aria-hidden="true"
            >';

        $help_text .= '<div class="modal-dialog modal-lg" role="document" >';
        $help_text .= '<div class="modal-content">';
        $help_text .= '<a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>';

        $help_text .= '<div class="modal-body comiss-score-modal-body">';
        // description
        $help_text .= $element['#description'];
        $help_text .= '</div>';// close modal-body
        $help_text .= '</div>';// close modal-content
        $help_text .= '</div>';// close modal-dialog
        $help_text .= '</div>';// close modal


        return $help_text;
    }

    /**
     * {@inheritdoc}
     *
     */
    public function getURLcontent ($url) {
        $client = \Drupal::httpClient();

        try{
            $request = $client->get($url, [
                'auth' => ['shield','Wunderman123!'],
                'connect_timeout' => 300,
                'timeout' => 300
            ]);

            $status = $request->getStatusCode();
            $transfer_success = $request->getBody()->getContents();

            return [
                'status' => $status,
                'data' => $transfer_success,
            ];
        }
        catch (RequestException $e) {
            $status = 500;
            $transfer_success = false;
            \Drupal::logger('nhsc_comiss_score_survey')->error('Error getting url: ' . $e->getMessage());

            return [
                'status' => $status,
                'error' => $e->getMessage(),
                'data' => $transfer_success,
            ];
        }



    }

    public function getElements() {
        $webform    = $this->getWebform($this->webform_id);
        try {
            $elements = $webform->getElementsDecodedAndFlattened();
        } catch (Exception $e) {
            $elements = [];
        }

        return $elements;
    }
}