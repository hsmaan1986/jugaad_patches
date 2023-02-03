<?php

namespace Drupal\nppe_module_where_to_buy\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\views\Views;
use Drupal\Core\Url;
/**
 * Implements the AddReview form controller.
 *
 *
 * @see \Drupal\Core\Form\FormBase
 */
class SearchForm extends FormBase {

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


    $form['search_content'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Content'),
      '#description' => $this->t('Search Content by entering search keyword.'),
      '#required' => TRUE,
    ];
    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
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
    return 'nppe_module_where_to_buy_search_form';
  }

  /**
   * Implements form validation.
   *
   * The validateForm method is the default method called to validate input on
   * a form.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {


          parent::validateForm($form, $form_state);


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
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {


    $view = \Drupal::service('entity_type.manager')->getStorage('view')->load('nppe_store_locator');

    $view_path = $view->getDisplay('page_1')['display_options']['path'];

    $search_content = $form_state->getValue('search_content');

    $search_content = preg_replace('/\s+/', '+', $search_content);

    $host = \Drupal::request()->getHost();

    $search_path = $view_path."/".$search_content;

    $path = "/".$search_path;
    $response = new RedirectResponse($path, 302);
    $response->send();
    return;
    exit();

  }

}
