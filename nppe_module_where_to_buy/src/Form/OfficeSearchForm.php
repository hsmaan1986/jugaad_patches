<?php


namespace Drupal\nppe_module_where_to_buy\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nppe_module_where_to_buy\Controller\SearchController;
use Drupal\views\Views;

class OfficeSearchForm extends FormBase {

    private $controller;



    /**
     * Build the Review form.
     *
     * A build form method constructs an array that defines how markup and
     * other form elements are included in an HTML form.
     *
     * @param array $form
     *   Default form array structure.
     * @param FormStateInterface $form_state
     *   Object containing current form state.
     *
     * @return array
     *   The render array defining the elements of the form.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $this->controller = new SearchController();


        $continents = $this->controller->getOptions('Select a continent', 'locations', 1, 0);
        

        $form['continent'] = [
            '#type' => 'select',
            '#title' => t('Continent'),
            '#options' => $continents,
            '#ajax' => [
                'callback' => '::updateContinent',
                'event' => 'change',
                'method' => 'replace',
                'progress' => ['type' => 'none'],
                'wrapper' => 'country-wrapper',
            ],
            '#empty_option' => t('Select a continent'),
            '#prefix' => '<div class="form_element col-md-12 col-sm-12 col-xs-12">',
            '#suffix' => '</div>',
        ];


        // add country wrapper
        $form['country_wrapper'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'country-wrapper'],
        ];

        // get condition id
        $continent = $form_state->getValue('continent');

        $countries = $this->controller->getOptions('Select a country', 'locations', 2, $continent);

        $form['country_wrapper']['country'] = [
            '#type' => 'select',
            '#title' => t('Country'),
            '#options' => (!empty($continent)) ? $countries : [],
            '#empty_option' => 'Select a country',
            '#disabled' => (!empty($continent))? FALSE : TRUE,
            '#prefix' => '<div class="form_element col-md-12 col-sm-12 col-xs-12">',
            '#suffix' => '</div>',
        ];

        $form['action_container'] = [
            '#type' => 'container',
            '#prefix' => '<div class="col-sm-12 col-xs-12 text-center btn-container">',
            '#suffix' => '</div>'
        ];

        $form['action_container']['actions']['#type'] = 'actions';

        $form['action_container']['actions']['reset_filters'] = [
            '#type' => 'button',
            '#value' => t('Clear'),
            '#attributes' => [
                'class' => ['product-reset-button', 'btn-link', 'btn'],
            ],
            '#ajax' => [
                'callback' => '::resetForm',
                'event' => 'click',
            ],
            '#prefix' => '<div class="col-md-6 col-sm-6 col-xs-12 text-center button-padding">',
            '#suffix' => '</div>'
        ];

        $form['action_container']['actions']['button'] = [
            '#type' => 'button',
            '#value' => t('Search'),
            '#ajax' => [
                'callback' => [$this, 'filterSubmit'],
                'event' => 'click',
                'effect' => 'fade',
                'wrapper' => 'office-results',
            ],
            '#attributes' => [
                'class' => ['office-filter-button'],
            ],
            '#executes_submit_callback' => FALSE,
            '#button_type' => 'primary',
            '#prefix' => '<div class="col-md-6 col-sm-6 col-xs-12 text-center office-filter-button-padding">',
            '#suffix' => '</div>',
        ];

        $form['count_container'] = [
            '#type' => 'container',
            '#prefix' => '<div class="col-md-12 col-xs-12 office-results-count text-center">',
            '#suffix' => '</div>'
        ];

        $form['buttons_container'] = [
            '#type' => 'container',
            '#prefix' => '<div class="col-md-12 col-xs-12 text-center btn-container-map-toggle btn-container hidden">',
            '#suffix' => '</div>'
        ];

        $form['buttons_container']['show_map'] = [
            '#type' => 'button',
            '#value' => t('Show Map'),
            '#ajax' => [
                'callback' => [$this, 'showMap'],
                'event' => 'click',
                'effect' => 'fade',
                'wrapper' => 'office-results',
            ],
            '#attributes' => [
                'class' => ['map-toggle-buttons'],
            ],
            '#executes_submit_callback' => FALSE,
            '#button_type' => 'primary',
            '#prefix' => '<div class="col-md-6 col-sm-6 col-xs-12">',
            '#suffix' => '</div>',
        ];

        $form['buttons_container']['show_list'] = [
            '#type' => 'button',
            '#value' => t('Show List'),
            '#ajax' => [
                'callback' => [$this, 'showList'],
                'event' => 'click',
                'effect' => 'fade',
                'wrapper' => 'office-results',
            ],
            '#attributes' => [
                'class' => ['map-toggle-buttons'],
            ],
            '#executes_submit_callback' => FALSE,
            '#button_type' => 'primary',
            '#prefix' => '<div class="col-md-6 col-sm-6 col-xs-12">',
            '#suffix' => '</div>',
        ];

        

        return $form;
    }


    /**
     * Getter method for Form ID.
     *
     * The form ID is used in implementations of hook_form_alter() to allow other
     * modules to alter the render array built by this form controller.  it must
     * be unique site wide. It normally starts with the providing module's name.
     *
     * @return string
     *   The unique ID of the form defined by this class.
     */
    public function getFormId() {
        return 'nppe_module_where_to_buy_office_search_form';
    }

    /**
     * Ajax callback for the specific dropdown.
     */
    public function updateContinent(array $form, FormStateInterface $form_state) {
        $ajax_response = new AjaxResponse();

        $ajax_response->addCommand(new HtmlCommand('#country-wrapper', $form['country_wrapper']));

        return $ajax_response;
    }

    /**
     * Implements a form submit handler.
     *
     * The submitForm method is the default method called for any submit elements.
     *
     * @param array $form
     *   The render array of the currently built form.
     * @param FormStateInterface $form_state
     *   Object describing the current state of the form.
     * @return boolean
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        return false;
    }


    /**
     * {@inheritdoc}
     */
    public function filterSubmit(array &$form, FormStateInterface $form_state) {

        $ajax_response      = new AjaxResponse();
        // get view
        $country            = $form_state->getValue('country');
        $continent          = $form_state->getValue('continent');

        // validate
        if(empty($country)) {
            $ajax_response->addCommand(new HtmlCommand('.office-results', t('<div class="alert alert-danger alert-dismissible">Country is required</div>')));

            return $ajax_response;
        }

        if(empty($continent)) {
            $ajax_response->addCommand(new HtmlCommand('.office-results', t('<div class="alert alert-danger alert-dismissible">Continent is required</div>')));

            return $ajax_response;
        }

        $filters    = [$country]; // filter by country

        $view_name  = 'office_locations';
        $selector   = '.office-results';
        $view       = Views::getView($view_name);

        $content    = '';
        $rows       = 0;

        if (is_object($view)) {
            $view->setArguments($filters);
            $view->get_total_rows = TRUE;


            $view->setDisplay('block_1');
            $view->preExecute();
            $view->execute();
            $content = $view->buildRenderable('block_1', $filters);
            $rows    = $view->total_rows;
        }


        $ajax_response->addCommand(new HtmlCommand($selector, $content));
        $ajax_response->addCommand(new HtmlCommand('.office-results-count', t('@count Results', ['@count' => $rows])));

        // show buttons
        $ajax_response->addCommand(new InvokeCommand(".btn-container-map-toggle", 'removeClass', ['hidden']));

        // hide list
        $ajax_response->addCommand(new InvokeCommand(".geolocation-common-map-locations", 'hide'));

        return $ajax_response;
    }

    /**
     * {@inheridoc}
     */
    public function resetForm (array &$form, FormStateInterface $form_state){
        $ajax_response = new AjaxResponse();
        $ajax_response->addCommand(new HtmlCommand('.office-results', ''));
        $ajax_response->addCommand(new HtmlCommand('.office-results-count', ''));
        $ajax_response->addCommand(new InvokeCommand('#nppe-module-where-to-buy-office-search-form', 'trigger', ['reset']));

        $ajax_response->addCommand(new InvokeCommand("[name='country']", 'attr', ['disabled', 'true']));

        // hide buttons
        $ajax_response->addCommand(new InvokeCommand(".btn-container-map-toggle", 'addClass', ['hidden']));

        $form_state->setRebuild(TRUE);
        return $ajax_response;
    }


    /**
     * {@inheridoc}
     */
    public function showList(){
        $ajax_response = new AjaxResponse();

        $ajax_response->addCommand(new InvokeCommand(".geolocation-common-map-locations", 'css', ['display', 'block']));
        $ajax_response->addCommand(new InvokeCommand(".geolocation-common-map-locations", 'show'));
        $ajax_response->addCommand(new InvokeCommand(".geolocation-common-map-container", 'hide'));
        return $ajax_response;
    }

    /**
     * {@inheridoc}
     */
    public function showMap(){
        $ajax_response = new AjaxResponse();

        $ajax_response->addCommand(new InvokeCommand(".geolocation-common-map-locations", 'hide'));
        $ajax_response->addCommand(new InvokeCommand(".geolocation-common-map-container", 'show'));
        return $ajax_response;

    }

}