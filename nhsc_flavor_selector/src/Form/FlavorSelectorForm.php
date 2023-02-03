<?php
/**
 * @file
 * Contains \Drupal\nhsc_flavor_selector\Form\WorkForm.
 */
namespace Drupal\nhsc_flavor_selector\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_flavor_selector\Controller\FlavorController;
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

class FlavorSelectorForm extends FormBase {

    private $controller;
    private $flavors;

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_flavor_selector_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $this->controller = new FlavorController();
        // get conditions list
        // get node object
        $node          = \Drupal::routeMatch()->getParameter('node');

        $flavours      = [];
        if ($node instanceof \Drupal\node\NodeInterface) {
            $nid        = $node->id();
            $flavours   = $node->get('field_flavours')->getValue();
        }

        // loop through products flavours & generate selected for this product
        foreach ($flavours as $flavor) {
            $f_id       = $flavor['target_id'];
            // get term name
            $term       = Term::load($f_id);
            $f_label    = $term->getName();

            $label      = strtolower(str_replace(' ', '-', $f_label));

            $this->flavors[$label] = $f_label;
        }

        $form['flavor'] = [
            '#type' => 'select',
            '#options' => $this->flavors,

            '#ajax' => [
                'callback' => '::updateProduct',
                'event' => 'change',
                'method' => 'replace',
                'progress' => ['type' => 'none'],
                'wrapper' => 'product-gallery',
            ],

            '#empty_option' => t('- Escolha o sabor'),
            '#prefix' => '<div class="form_element">',
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

    /**
     * {@inheritdoc}
     *
     */

    public function updateProduct(array &$form, FormStateInterface $form_state){
        $flavor        = $form_state->getValue('flavor');// get flavor

        if (!empty($flavor)) {

            $ajax_response = new AjaxResponse();
            // hide all items
            foreach ($this->flavors as $field => $value){
                if (!empty($field)){
                    $ajax_response->addCommand(new InvokeCommand('#product-gallery > .field--name-field-product-gallery > .field--item > .' .$field, 'hide'));
                }
            }

            // show selected
            $ajax_response->addCommand(new InvokeCommand('#product-gallery > .field--name-field-product-gallery > .field--item > .' . $flavor, 'show'));
            return $ajax_response;

        }


    }

}