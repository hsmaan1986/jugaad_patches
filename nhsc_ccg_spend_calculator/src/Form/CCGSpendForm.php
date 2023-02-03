<?php


namespace Drupal\nhsc_ccg_spend_calculator\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_ccg_spend_calculator\Controller\CCGSpendController;
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
use Drupal\media\Entity\Media;
use Drupal\image\Entity\ImageStyle;
use Drupal\media_entity\MediaInterface;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;


class CCGSpendForm extends FormBase
{

    private $controller;
    public $config;
    public $ccg_currency;
    public $product1_title;
    public $product2_title;
    public $product1_image;
    public $product2_image;
    public $ccg_footer_copy;

    /**
     * {@inheritdoc}
     */
    public function __construct () {
        $this->config       = \Drupal::config('nhsc_ccg_spend_calculator.config');
        $this->controller   = new CCGSpendController();
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_ccg_spend_calculator_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(
        array $form,
        FormStateInterface $form_state,
        $ccg_currency = NULL,
        $product1_title = NULL,
        $product2_title = NULL,
        $product1_image = NULL,
        $product2_image = NULL,
        $ccg_footer_copy = NULL
    ) {

        $this->ccg_currency = $ccg_currency;
        $this->product1_title = $product1_title;
        $this->product2_title = $product2_title;
        $this->product1_image = $product1_image;
        $this->product2_image = $product2_image;
        $this->ccg_footer_copy = $ccg_footer_copy;

        $form['search_box'] = [
            '#type' => 'textfield',
            '#title' => t('Search for your local CCG, LHB or HSCP:'),
            '#autocomplete_route_name' => 'nhsc_ccg_spend_calculator.autocomplete',
            '#attributes' => [
                'id' => 'ccg-input'
            ]
        ];

        $form['actions']['#type'] = 'actions';
        $form['actions']['button'] = [
            '#type' => 'button',
            '#value' => t('Find Your Local Cost Saving Potential'),
            '#ajax' => [
                'callback' => '::ajaxSubmitCallback',
                'event' => 'click',
                'effect' => 'fade',
            ],
            '#attributes' => [
                'class' => ['ccg-submit-button'],
            ],
            '#executes_submit_callback' => FALSE,
            '#button_type' => 'primary',
            '#prefix' => '<div class="col-xs-12 text-center ccg-filter-button-padding">',
            '#suffix' => '</div>',
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        return false;
    }

    public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state)
    {
        $ajax_responce     = new AjaxResponse();
        $this->controller  = new CCGSpendController();

        $ccg_input         = $form_state->getValue('search_box');
        // get taxonomy term
        $ccg_id            = $this->controller->getTidByName($ccg_input);
        // get node
        $node              = $this->controller->getProductInfo($ccg_id);

        $ccg_currency      = (!is_null($this->ccg_currency)) ? $this->ccg_currency :
            $this->config->get('ccg_currency');

        $product1_title    = (!is_null($this->product1_title)) ? $this->product1_title :
            $this->config->get('product1_title');

        $product2_title    = (!is_null($this->product2_title)) ? $this->product2_title :
            $this->config->get('product2_title');

        $product1_image_name     = (!is_null($this->product1_image)) ? $this->product1_image :
            $this->config->get('product1_image');

        $product2_image_name     = (!is_null($this->product2_image)) ? $this->product2_image :
            $this->config->get('product2_image');

        $product1_image    = File::load ($product1_image_name[0])->createFileUrl();
        $product2_image    = File::load ($product2_image_name[0])->createFileUrl();


        if ($node) {
            // get node fields
            $ccg_total_spend        = $node->field_ccg_total_spend->value;
            $total_product_spent    = $node->field_ccg_total_est_cost->value;
            $city_title    = $node->title->value;

            // get products paragraph
            $product_data           = [];
            foreach ($node->field_ccg_product_information as $product) {

                /** @var Entity (i.e. Node, Paragraph, Term) $referenced_product **/
                $referenced_product     = $product->entity;

                $product_spend          = $referenced_product->field_ccg_product_spend->value;

                $product_data[] = [
                    'product_spend' => $product_spend,
                ];
            }

            $product1_spend = $product_data[0]['product_spend'];
            $product2_spend = $product_data[1]['product_spend'];

            $total_product_spent = (float) $product1_spend + (float) $product2_spend;

            // total spent
            $ajax_responce->addCommand(new HtmlCommand('.total-spent', $ccg_currency . $ccg_total_spend));

            $ajax_responce->addCommand(new HtmlCommand('.product1', $product1_title));
            $ajax_responce->addCommand(new HtmlCommand('.product2', $product2_title));

            $ajax_responce->addCommand(new HtmlCommand('.city', $city_title));

            $ajax_responce->addCommand(new HtmlCommand('.product1cost', $ccg_currency.$product1_spend));
            $ajax_responce->addCommand(new HtmlCommand('.product2cost', $ccg_currency.$product2_spend));

            $ajax_responce->addCommand(new HtmlCommand('#totalproductcost', $ccg_currency.$total_product_spent));

            $ajax_responce->addCommand(new InvokeCommand('#product1image', 'attr', ['src', $product1_image]));
            $ajax_responce->addCommand(new InvokeCommand('#product2image', 'attr', ['src', $product2_image]));

            $ajax_responce->addCommand(new InvokeCommand ('.ccg-cost-savings-calculator',
                'openPopup'
            ));
        }


        return $ajax_responce;
    }
}
