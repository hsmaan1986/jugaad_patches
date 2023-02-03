<?php

/**
 * @file
 * Contains \Drupal\nhsc_content_manager\Form\AddArticleContentForm.
 */

namespace Drupal\nhsc_content_manager\Form;
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
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;


/**
 * Class AddArticleContentForm
 * @package Drupal\nhsc_content_manager\Form
 */
class AddArticleContentForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_cm_add_aritcle_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        // get speciality
        $route_match = \Drupal::service('current_route_match');
        $speciality = $route_match->getParameter('speciality');

        $validators = array(
            'file_validate_extensions' => array('pdf'),
        );

        $form = array(
            '#attributes' => ['enctype' => 'multipart/form-data'],
        );

        $form['speciality'] = [
            '#type' => 'textfield',
            '#title' => t('Speciality'),
            '#default_value' => $speciality,
            '#required' => true,
            '#disabled' => true,
        ];

        $form['title'] = [
            '#type' => 'textfield',
            '#title' => t('Title'),
            '#required' => true,
        ];

        $form['body'] = [
            '#type' => 'textarea',
            '#title' => t('Body'),
            '#required' => false,
        ];

        $form['document'] = [
            '#type' => 'managed_file',
            '#title' => t('Document'),
            '#required' => true,
            '#description' => t('PDF format only'),
            '#upload_validators' => $validators,
        ];

        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];


        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if ($form_state->getValue('document') == NULL) {
            $form_state->setErrorByName('document', $this->t('Uplaoad Document.'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $uid    = \Drupal::currentUser()->id();

        $speciality  = $form_state->getValue('speciality');

        $speciality_format = str_replace('-', ' ', $speciality);
        $speciality_format = str_replace('cao', 'ção', $speciality_format);
        $speciality_format = str_replace('coes', 'ções', $speciality_format);
        $speciality_format = str_replace('Criticas', 'Críticas', $speciality_format);

        $title  = $form_state->getValue('title');
        $body   = $form_state->getValue('body');

        // In this variable you will have file entity
        $file = \Drupal::entityTypeManager()->getStorage('file')
            ->load($form_state->getValue('document')[0]);

        $speciality_id = $this->getTidByName($speciality_format);


        $node = Node::create([
            'type' => 'dsu_article',
            'title' => $title,
            'body' => array(
                'value' => $body,
                'format' => 'basic_html',
            ),
            'field_documents' => ['target_id' => $file->id()],
            'field_dsu_tags' => ['target_id' => $speciality_id],
            'uid' => $uid,
        ]);

        $node->set('moderation_state', "review");

        if ($node->save()){
            \Drupal::messenger()->addMessage(t('Article was saved successfully for admin approval'), 'status');
        }else{
            \Drupal::messenger()->addMessage(t('There was a problem creating your article.'), 'error');
        }


    }

    protected function getTidByName($name = NULL, $vid = NULL) {
        $properties = [];
        if (!empty($name)) {
            $properties['name'] = $name;
        }
        if (!empty($vid)) {
            $properties['vid'] = $vid;
        }
        $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties($properties);
        $term = reset($terms);

        return !empty($term) ? $term->id() : 0;
    }
}
