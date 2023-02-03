<?php
/**
 * @file
 * Contains \Drupal\nhsc_product_selector\Form\WorkForm.
 */
namespace Drupal\nhsc_product_selector\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_product_selector\Controller\ProductController;
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

class ProductSelectorForm extends FormBase {

    private $controller;

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_product_selector_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $this->controller = new ProductController();
        // get conditions list
        $conditions = $this->controller->getConditionOptions(t('- Selecione a condição'), 'condition', 1, 0);

        $form['condition'] = [
            '#type' => 'select',
            '#title' => t('Condições:'),
            '#options' => $conditions,
            '#ajax' => [
                'callback' => '::updateConditions',
                'event' => 'change',
                'method' => 'replace',
                'progress' => ['type' => 'none'],
                'wrapper' => 'specific-condition-wrapper',
            ],
            '#empty_option' => t('- Selecione a condição'),
            '#prefix' => '<div class="form_element col-md-3 col-sm-12 col-xs-12">',
            '#suffix' => '</div>',
        ];

        // add specific conditions wrapper
        $form['specific_condition_wrapper'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'specific-condition-wrapper'],
        ];

        // get condition id
        $condition = $form_state->getValue('condition');

        $form['specific_condition_wrapper']['specific_condition'] = [
            '#type' => 'select',
            '#title' => t('Condições específicas:'),
            '#options' => (!empty($condition)) ? $this->getLevelOptions(1, $condition) : [],
            '#empty_option' => t('- Selecione a condição específicao'),
            '#disabled' => (!empty($condition))? FALSE : TRUE,
            '#ajax' => [
                'callback' => '::updatePresentation',
                'event' => 'change',
                'progress' => ['type' => 'none'],
                'wrapper' => 'presentation-wrapper'

            ],
            '#prefix' => '<div class="form_element col-md-3 col-sm-12 col-xs-12">',
            '#suffix' => '</div>',
        ];

        // add presentation wrapper
        $form['presentation_wrapper'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'presentation-wrapper'],
        ];

        // get specific condition
        $specific_condition = $form_state->getValue('specific_condition');

        $form['presentation_wrapper']['presentation'] = [
            '#type' => 'select',
            '#title' => t('Apresentação:'),
            '#options' => (!empty($specific_condition)) ? $this->getLevelOptions(1, $specific_condition) : [],
            '#disabled' => (!empty($specific_condition)) ? FALSE : TRUE,

            '#ajax' => [
                'callback' => '::updateFlavor',
                'event' => 'change',
                'progress' => ['type' => 'none'],
                'wrapper' => 'flavor-wrapper'

            ],

            '#empty_option' => t('- Selecione as apresentações'),
            '#prefix' => '<div class="form_element col-md-3 col-sm-12 col-xs-12">',
            '#suffix' => '</div>',
        ];

        // get presentation
        $presentation = $form_state->getValue('presentation');

        // add flavor wrapper
        $form['flavor_wrapper'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'flavor-wrapper'],
        ];

        $form['flavor_wrapper']['flavors'] = array(
            '#type' => 'select',
            '#title' => t('Sabor:'),
            '#options' => (!empty($presentation)) ? $this->getLevelOptions(1, $presentation) : [],
            '#disabled' => (!empty($presentation)) ? FALSE : TRUE,

            '#attributes' => [
                'id' => 'edit-flavors',
            ],

            '#empty_option' => t('- Selecione os sabores'),
            '#prefix' => '<div class="form_element col-md-3 col-sm-12 col-xs-12">',
            '#suffix' => '</div>',
        );

        $form['actions']['#type'] = 'actions';
        $form['actions']['button'] = array(
            '#type' => 'button',
            '#value' => $this->t('Descubra nossos produtos'),
            '#ajax' => [
                'callback' => [$this, 'filterSubmit'],
                'event' => 'click',
                'effect' => 'fade',
                'wrapper' => 'product-results',
            ],
            '#attributes' => [
                'class' => ['product-filter-button'],
            ],
            '#executes_submit_callback' => FALSE,
            '#button_type' => 'primary',
            '#prefix' => '<div class="col-xs-12 text-center product-filter-button-padding">',
            '#suffix' => '</div>',
        );

        $form['actions']['reset_filters'] = [
            '#type' => 'button',
            '#value' => t('Redefinir filtros'),
            '#attributes' => [
                'class' => ['product-reset-button', 'btn-link', 'btn'],
            ],
            '#ajax' => [
                'callback' => '::resetForm',
                'event' => 'click',
            ],
            '#prefix' => '<div class="col-xs-12 text-center button-padding">',
            '#suffix' => '</div>'
        ];

        $form['container'] = [
            '#type' => 'container',
            '#prefix' => '<div class="col-sm-12 col-xs-12 product-results text-center">',
            '#suffix' => '</div>'
        ];

        return $form;
    }

    protected function getLevelOptions($level, $condition_id) {
        $specific_condition = $this->controller->getConditionOptions(t('- Selecione a condição específica'), 'condition', $level, $condition_id);
        return $specific_condition;
    }

    protected function getOptionsbySpecificCondition($specific_condition_id) {
        $presentation = $this->controller->getConditionOptions(t('- Selecione as apresentações'), 'condition', 2, $specific_condition_id);
        return $presentation;
    }

    /**
     * Ajax callback for the specific dropdown.
     */
    public function updateConditions(array $form, FormStateInterface $form_state) {
        $ajax_response = new AjaxResponse();

        // reset flavor and presentation fields
        $this->resetFormField ($ajax_response, "[name='flavors']");
        $this->resetFormField ($ajax_response, "[name='presentation']");

        $ajax_response->addCommand(new HtmlCommand('#specific-condition-wrapper', $form['specific_condition_wrapper']));

        return $ajax_response;
    }

    /**
     * Ajax callback for the presentation dropdown.
     */
    public function updatePresentation(array $form, FormStateInterface $form_state) {
        $ajax_response = new AjaxResponse();

        // reset flavor fields
        $this->resetFormField ($ajax_response, "[name='flavors']");

        $ajax_response->addCommand(new HtmlCommand('#presentation-wrapper', $form['presentation_wrapper']));

        return $ajax_response;
    }

    /**
     * Ajax callback for the presentation dropdown.
     */
    public function updateFlavor(array $form, FormStateInterface $form_state) {
        $ajax_response = new AjaxResponse();

        // reset flavor fields
        $this->resetFormField ($ajax_response, "[name='flavors']");

        $ajax_response->addCommand(new HtmlCommand('#flavor-wrapper', $form['flavor_wrapper']));

        return $ajax_response;


    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        return false;
    }

    /**
     * Ajax callback for the reset a dropdown.
     */

    public function resetFormField ($ajax_response, $selector) {
        // clear results
        $ajax_response->addCommand(new HtmlCommand('.product-results', ''));
        // select empty option
        $ajax_response->addCommand(new InvokeCommand($selector, 'val', ['']));
        // disable field
        $ajax_response->addCommand(new InvokeCommand($selector, 'attr', ['disabled', 'true']));

        return $ajax_response;
    }

    /**
     * {@inheridoc}
     */
    public function resetForm (array &$form, FormStateInterface $form_state){
        $ajax_response = new AjaxResponse();
        $ajax_response->addCommand(new HtmlCommand('.product-results', ''));
        $ajax_response->addCommand(new InvokeCommand('#nhsc-product-selector-form', 'trigger', ['reset']));

        $ajax_response->addCommand(new InvokeCommand("[name='specific_condition']", 'attr', ['disabled', 'true']));
        $ajax_response->addCommand(new InvokeCommand("[name='presentation']", 'attr', ['disabled', 'true']));
        $ajax_response->addCommand(new InvokeCommand("[name='flavors']", 'attr', ['disabled', 'true']));

        $form_state->setRebuild(TRUE);
        return $ajax_response;
    }

    /**
     * {@inheritdoc}
     */
    public function filterSubmit(array &$form, FormStateInterface $form_state) {

        $ajax_response      = new AjaxResponse();
        // get view
        $condition          = $form_state->getValue('condition');
        $specific_condition = $form_state->getValue('specific_condition');

        // validate
        if(empty($condition)){
            $ajax_response->addCommand(new HtmlCommand('.product-results', t('<div class="alert alert-danger alert-dismissible">Condition is required</div>')));

            return $ajax_response;
        }

        if(empty($specific_condition)){
            $ajax_response->addCommand(new HtmlCommand('.product-results', t('<div class="alert alert-danger alert-dismissible">Specific Condition is required</div>')));

            return $ajax_response;
        }

        $presentation       = (!empty($form_state->getValue('presentation'))) ?
                                $form_state->getValue('presentation') : 'all';

        $flavor             = (!empty($form_state->getValue('flavors'))) ?
                                $form_state->getValue('flavors') : 'all';

        $filters    = [$condition, $specific_condition, $presentation, $flavor];

        $view_name  = 'product_list';
        $selector   = '.product-results';
        $view       = Views::getView($view_name);

        $content    = '';

        if (is_object($view)) {
            $view->setArguments($filters);
            $view->setDisplay('block_1');
            $view->preExecute();
            $view->execute();
            $content = $view->buildRenderable('block_1', $filters);
        }



        $ajax_response->addCommand(new HtmlCommand($selector, $content));

        return $ajax_response;
    }
}
