<?php

namespace Drupal\nppe_module_where_to_buy\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\Entity\Node;

/**
 * Implements the AddReview form controller.
 *
 *
 * @see \Drupal\Core\Form\FormBase
 */
class ImportForm extends FormBase {

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


//    $form['#attributes']['enctype'] = 'multipart/form-data';
    $form['upload_csv'] = array(
          '#type' => 'managed_file',
          '#title' => t('Upload File'),
          '#required' => TRUE,
          '#description' => t('Upload a file, allowed extension: CSV'),
          '#upload_validators'  => array(
                'file_validate_extensions' => array('csv'),
                'file_validate_size' => array(25600000),
                ),
          '#upload_location' => 'public://myfiles/',
        );

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Import'),
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
    return 'nppe_module_where_to_buy_import_form';
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

      /* Fetch the array of the file stored temporarily in database */
      $csv_file = $form_state->getValue('upload_csv');

      /* Load the object of the file by it's fid */
      $file     = File::load( $csv_file[0] );

      /* Set the status flag permanent of the file object */
      $file->setPermanent();

      /* Save the file in database */
      $file->save();

      // You can use any sort of function to process your data. The goal is to get each 'row' of data into an array
      // If you need to work on how data is extracted, process it here.
      $data = $this->csvtoarray(',', $file->getFileUri());
      foreach($data as $row) {
          // fix taxonomy ids
          $continent = $row['continent'];
          $country   = $row['country'];

          if ($this->getIDTermByName($continent)) {
              $row['continent'] = $this->getIDTermByName($continent);
          }

          if ($this->getIDTermByName($country)) {
              $row['country'] = $this->getIDTermByName($country);
          }

          $operations[] = ['\Drupal\nppe_module_where_to_buy\addImportContent::addImportContentItem', [$row]];
      }

      $batch = [
          'title' => t('Importing Data...'),
          'operations' => $operations,
          'init_message' => t('Import is starting.'),
          'finished' => '\Drupal\nppe_module_where_to_buy\addImportContent::addImportContentItemCallback',
      ];

      batch_set ($batch);

  }

    public function csvtoarray($delimiter, $filename=''){

        if(!file_exists($filename) || !is_readable($filename)) return FALSE;
        $header = NULL;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE ) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header){
                    $header = $row;
                }else{
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }

    public function getIDTermByName($name) {

        $term_continent = \Drupal::entityTypeManager()
            ->getStorage('taxonomy_term')
            ->loadByProperties(['name' => $name]);

//        $term_continent = reset($term_continent);

        return $term_continent;
    }

}
