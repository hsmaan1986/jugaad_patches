<?php


namespace Drupal\nhsc_ccg_spend_calculator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\Entity\Node;
use Drupal\nhsc_ccg_spend_calculator\Controller\CCGSpendController;
use Drupal\nhsc_ccg_spend_calculator\addImportContent;



/**
 * Implements the Import form controller.
 *
 *
 * @see \Drupal\Core\Form\FormBase
 */
class ImportForm extends FormBase
{

    private $controller;
    public $config;

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
        return 'nhsc_ccg_spend_calculator_import_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['upload_csv'] = [
            '#type' => 'managed_file',
            '#title' => t('Upload File'),
            '#required' => TRUE,
            '#description' => t('Upload a file, allowed extension: CSV'),
            '#upload_validators'  => [
                'file_validate_extensions' => ['csv'],
                'file_validate_size' => [25600000],
            ],
            '#upload_location' => 'public://myfiles/',
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
            '#value' => t('Import'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        parent::validateForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->controller   = new CCGSpendController();
        /* Fetch the array of the file stored temporarily in database */
        $csv_file   = $form_state->getValue('upload_csv');
        $delimiter  = $this->config->get('ccg_csv_delimiter');

        /* Load the object of the file by it's fid */
        $file       = File::load( $csv_file[0] );

        /* Set the status flag permanent of the file object */
        $file->setPermanent();

        /* Save the file in database */
        $file->save();



        // You can use any sort of function to process your data. The goal is to get each 'row' of data into an array
        // If you need to work on how data is extracted, process it here.
        $data = $this->controller->csvtoarray($delimiter, $file->getFileUri());
        $operations = [];

        foreach($data as $row) {
            // get row data
            $ccg_title          = $row['ccg_name'];


            if ($ccg_title_taxonomy = $this->controller->getTidByName($ccg_title)) {
                $row['ccg_taxonomy_name'] = $ccg_title_taxonomy;
            }

            $operations[] = ['Drupal\nhsc_ccg_spend_calculator\addImportContent::addImportContentItem', [$row]];
        }

        $batch = [
            'title' => t('Importing Data...'),
            'operations' => $operations,
            'init_message' => t('Import is starting.'),
            'finished' => '\Drupal\nhsc_ccg_spend_calculator\addImportContent::addImportContentItemCallback',
        ];

        batch_set ($batch);
    }
}