<?php

namespace Drupal\nhsc_ccg_spend_calculator\Controller;

use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;
use Drupal\paragraphs\Entity\Paragraph;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use \Drupal\node\Entity\Node;
use \Drupal\taxonomy\Entity\Term;
use Drupal\taxonomy;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\taxonomy\TermStorage;



class CCGSpendController extends ControllerBase implements ContainerInjectionInterface
{
    private $config;
    protected $ccg_currency;
    protected $product1_title;
    protected $product2_title;
    protected $product1_image;
    protected $product2_image;
    protected $ccg_footer_copy;

    public function __construct(
        $ccg_currency = NULL,
        $product1_title = NULL,
        $product2_title = NULL,
        $product1_image = NULL,
        $product2_image = NULL,
        $ccg_footer_copy = NULL
    ){

        $this->ccg_currency = (empty($ccg_currency)) ? $this->getConfigs()->get('ccg_currency') : $ccg_currency;
        $this->product1_title = (empty($product1_title)) ? $this->getConfigs()->get('product1_title') : $product1_title;
        $this->product2_title = (empty($product2_title)) ? $this->getConfigs()->get('product2_title') : $product2_title;
        $this->product1_image = (empty($product1_image)) ? $this->getConfigs()->get('product1_image') : $product1_image;
        $this->product2_image = (empty($product2_image)) ? $this->getConfigs()->get('product2_image') : $product2_image;
        $this->ccg_footer_copy = (empty($ccg_footer_copy)) ? $this->getConfigs()->get('ccg_footer_copy') : $ccg_footer_copy;
    }

    /**
     * @var $level
     * @var $tid
     * @var $default_value
     * @var $tax_term
     * @return array of all vocabulary of conditions taxonomy
     *
     */
    public function getCCGOptions ($default_value, $tax_term, $level = 1, $tid = 0){

        $term_data['']  = $default_value;
        $manager    = \Drupal::service('entity_type.manager')->getStorage('taxonomy_term');
        $terms      = $manager->loadTree(
            $tax_term, // This is your taxonomy term vocabulary (machine name).
            $tid, // This is "tid" of parent. Set "0" to get all.
            $level, // Get only 1st level.
            TRUE // Get full load of taxonomy term entity.
        );

        foreach ($terms as $term) {
            $term_data[$term->id()] = $term->label();
        }

        return $term_data;
    }

    /**
     * @return array
     */
    public function ccgCalculatorForm()
    {
        $form = \Drupal::formBuilder()->getForm(
                'Drupal\nhsc_ccg_spend_calculator\Form\CCGSpendForm',
                $this->ccg_currency,
                $this->product1_title,
                $this->product2_title,
                $this->product1_image,
                $this->product2_image,
                $this->ccg_footer_copy
            );

        $config = \Drupal::config('nhsc_ccg_spend_calculator.config');


        return [
            '#theme' => 'nhsc_ccg_spend_calculator',
            '#calculatorData' => [
                'ccg_footer_copy' => (!is_null($this->ccg_footer_copy)) ? $this->ccg_footer_copy : $config->get('ccg_footer_copy'),
                'ccg_currency' => $config->get('ccg_currency'),
            ],
            '#form' => $form,
        ];
    }

    function getNodesByTaxonomyTermIds($termIds){
        $termIds = (array) $termIds;
        if(empty($termIds)){
            return NULL;
        }

        $query = \Drupal::database()->select('taxonomy_index', 'ti');
        $query->fields('ti', array('nid'));
        $query->condition('ti.tid', $termIds, 'IN');
        $query->distinct(TRUE);
        $result = $query->execute();

        if($nodeIds = $result->fetchCol()){
            return Node::loadMultiple($nodeIds);
        }

        return NULL;
    }

    /**
     * @return array
     * @param $ccg_id
     */
    public function getProductInfo ($ccg_id){
        $node = $this->getNodesByTaxonomyTermIds($ccg_id);
        // return one node
        return array_values($node)[0];
    }

    /**
     * Utility: find term by name and vid.
     * @param null $name
     *  Term name
     * @param null $vid
     *  Term vid
     * @return int
     *  Term id or 0 if none.
     */
    public function getTidByName($name = NULL, $vid = NULL) {
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

    public function getMediaPath ($image_id){
        $media          = Media::load($image_id);
        $media_field    = $media->get('image')->getValue()[0]['target_id'];
        // Load the image file.
        $file           = File::load($media_field);
        $file_uri       = $file->getFileUri();
        $image_path     = file_url_transform_relative(file_create_url($file_uri));

        return $image_path;
    }

    public function csvtoarray ($delimiter, $filename = ''){

        if(!file_exists($filename) || !is_readable($filename)) return FALSE;
        $header = NULL;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE ) {

            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
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


    // This function actually creates each item as a node as type 'CCG'
    public function create_node($item) {

        $node_data['type']      = 'ccg';
        $node_data['langcode']  = \Drupal::languageManager()->getDefaultLanguage()->getId();
        $node_data['uid']       = \Drupal::currentUser()->id(); // created by current user

        $node_data['title']     = $item['ccg_name'];
        $node_data['field_ccg_name'] = [
            [
                'target_id' => $item['ccg_taxonomy_name']
            ]
        ];

        $node_data['field_ccg_total_spend'] = $item['total_prescribing_cost'];
        $node_data['field_ccg_total_est_cost'] = $item['total_est_saving'];

        $multiParagraph1 = Paragraph::create([
            'type' => 'ccg_product_information',
            'field_ccg_product_spend' => $item['product1_est_saving'],
        ]);

        $multiParagraph2 = Paragraph::create([
            'type' => 'ccg_product_information',
            'field_ccg_product_spend' => $item['product2_est_saving'],
        ]);

        $multiParagraph1->save();
        $multiParagraph2->save();

        $node_data['field_ccg_product_information'] = [
            [
                'target_id' => $multiParagraph1->id(),
                'target_revision_id' => $multiParagraph1->getRevisionId(),
            ],
            [
                'target_id' => $multiParagraph2->id(),
                'target_revision_id' => $multiParagraph2->getRevisionId(),
            ],
        ];

        $node_data['status'] = 1;

        $node = Node::create($node_data);
        $node->setPublished(TRUE);
        $node->save();
    }

    /**
     * @return object
     */
    public function getConfigs() {
        $this->config = $this->config('nhsc_ccg_spend_calculator.config');

        return $this->config;
    }



}
