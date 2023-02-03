<?php

namespace Drupal\ons_product_selector\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\HttpFoundation\Response;
use \Drupal\taxonomy\Entity\Term;
use Drupal\media\Entity\Media;
use Drupal\Core\Url;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\ons_product_selector\Controller\OnsProductController;

use Drupal\ons_product_selector\ContentCardSelector;

class OnsProductCardController extends ControllerBase implements ContainerInjectionInterface
{
  const TAXONOMIES = [
    'advanced_search' => [
      'Format'             => ['field_relation' => 'field_ons_format_search',      'taxonomy' => 'format'],
      'Ingredient'         => ['field_relation' => 'field_ons_ingredient',         'taxonomy' => 'ingredient'],
      'Intolerance'        => ['field_relation' => 'field_ons_intolerance',        'taxonomy' => 'intolerance'],
      'Low Glycemic Index' => ['field_relation' => 'field_ons_low_glycemic_index', 'taxonomy' => 'low_glymemic_index'],
      'Taste'              => ['field_relation' => 'field_ons_taste',              'taxonomy' => 'taste'],
    ],
    'simple_filters' => [
      'Pathology' => ['field_relation' => 'field_ons_pathology',      'taxonomy' => 'pathology'],
      'Protein'   => ['field_relation' => 'field_ons_protein_search', 'taxonomy' => 'protein'],
      'Energy'    => ['field_relation' => 'field_ons_energy',         'taxonomy' => 'energy'],
      'Type'      => ['field_relation' => 'field_ons_type',           'taxonomy' => 'type'],
      'Flavour'   => ['field_relation' => 'field_ons_flavours',       'taxonomy' => 'ons_flavours']
    ]
  ];

  private function getConditions($query)
  {

    foreach ($this->getFields() as &$block) {
      foreach ($block as &$definition) {
        if (isset($_GET[$definition['taxonomy']])) {
          if ($definition['taxonomy'] === 'pathology') {
            foreach ($_GET[$definition['taxonomy']] as $patId) {
              $query->condition($query->andConditionGroup()->condition($definition['field_relation'], $patId));
            }
          } else {
            $query = $query->condition($definition['field_relation'], $_GET[$definition['taxonomy']], 'IN');
          }
        }
      }
    }
    if (isset($_GET['id']))
      $query = $query->condition('nid', $_GET['id'], 'IN');
    return $query;
  }

  private function getTaxonomySelectedNames()
  {
    $res = [];
    $language =  \Drupal::languageManager()->getCurrentLanguage()->getId();
    $data = \Drupal::request()->query->all();
    foreach($data as $key => $block) {
      $tids = ContentCardSelector::getQuery(ContentCardSelector::TYPE_TAXONOMY, $key)
              ->condition('tid', $block[0], 'in')
              ->execute();
      $terms = Term::loadMultiple($tids);
      foreach ($terms as $term) {
        if($term->hasTranslation($language)) {
          $translated_term = \Drupal::service('entity.repository')->getTranslationFromContext($term, $language);
          $res[$this->vocabularyTranslate($key)][] = [
            'tid' => $term->id(),
            'name' => $translated_term->getName()
          ];
        }
      }
    }
    return $res;
  }

  private function vocabularyTranslate($vid) {
    $vocab_obj = Vocabulary::loadMultiple();
    $vocabulary = $vocab_obj[$vid];
    // dump($vocabulary);
    return $vocabulary->label();
  }

  public function findProducts()
  {
    $fieldList = \Drupal::entityTypeManager()->getDefinition(ContentCardSelector::TYPE_NODE, 'ons_product_selector');
    $query = ContentCardSelector::getQuery(ContentCardSelector::TYPE_NODE, 'ons_product_selector');

    $query = $query->condition('field_ons_product', NULL, 'IS NOT NULL');
    $query = $this->getConditions($query);
    $query->sort('title', 'ASC');
    $references = $query->execute();

    $storage = \Drupal::entityTypeManager()->getStorage(ContentCardSelector::TYPE_NODE);
    $data = $this->getProducts($storage->loadMultiple($references));
    return $data;
  }



  public function content()
  {
    $build = [
      '#theme' => 'ons_product_selector_card',
      '#data' => ['products' => $this->findProducts(), 'disable_compare' => OnsProductController::getDisableCompare()],
      '#selected_taxonomies' => $this->getTaxonomySelectedNames(),
      '#cache' => [
        'max-age' => 0,
      ]
    ];

    $output = \Drupal::service('renderer')->renderRoot($build);
    $response = new Response();
    $response->setContent($output);
    return $response;
  }

  public function content_json()
  {
    header('Content-Type: application/json');
    $response = new Response();
    $langcode = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
    $data = array();
    $settings = $this->config('ons_product_selector.settings');
    $data['pip_hide'] = $settings->get("ons_product_selector.pip_hide");
    $ids = \Drupal::request()->query->get('id');
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $k = 0;
    foreach($ids as $id) {
      $node = $node_storage->load($id);
      if($node->hasTranslation($langcode)) {
        $translation = $node->getTranslation($langcode);
        $mediaUri= null;
        $media_field = $translation->get('field_ons_product')->referencedEntities()[0]->get('field_images');
        if($media_field->first()){
          $media_target = $media_field->first()->toArray()['target_id'];
          $mediaUri = file_create_url(\Drupal::entityTypeManager()->getStorage('file')->load($media_target)->getFileUri());
        }
        $data[$k]['id'] = $translation->id();
        $data[$k]['title'] = $translation->label();
        //$data[$k]['img'] = $translation->get('field_ons_product')->referencedEntities();
        $data[$k]['media_uri'] = $mediaUri;
        $data[$k]['field_ons_description'] = $translation->get('field_ons_description')->getValue()[0]['value'];
        $data[$k]['field_ons_format_size'] = $translation->get('field_ons_format_size')->getValue()[0]['value'];
        $data[$k]['field_ons_p_cho_f_'] = $translation->get('field_ons_p_cho_f_')->getValue()[0]['value'];
        $data[$k]['field_ons_kcal'] = $translation->get('field_ons_kcal')->getValue()[0]['value'];
        $data[$k]['field_ons_protein'] = $translation->get('field_ons_protein')->getValue()[0]['value'];
        $data[$k]['field_ons_flavours'] = array_values(array_filter(array_map(function($data) use ($langcode){
          if($data->hasTranslation($langcode)) {
             return $data->getTranslation($langcode)->label();
          }
        }, $translation->get('field_ons_flavours')->referencedEntities())));
        $data[$k]['field_ons_pipcode'] = $translation->get('field_ons_pipcode')->getValue()[0]['value'];
        $data[$k]['node_url'] = $translation->get('field_ons_product')->referencedEntities()[0]->toUrl()->toString();
        $k++;
      }
    }


    $response->setContent(json_encode($data));
    return $response;
  }

  public function products_json()
  {
    $references = ContentCardSelector::getQuery(ContentCardSelector::TYPE_NODE, 'ons_product_selector')
      ->condition('field_ons_product', NULL, 'IS NOT NULL')
      ->sort('title', 'ASC')
      ->execute();

    $storage = \Drupal::entityTypeManager()->getStorage(ContentCardSelector::TYPE_NODE);
    $nodes = $storage->loadMultiple($references);
    $data = [];

    foreach ($nodes as $node) {

      $data[] = [
        'id' => $node->id(),
        'name' => $node->get('title')->value
      ];
    }
    header('Content-Type: application/json');
    $response = new Response();
    $response->setContent(json_encode($data));
    return $response;
  }

  private function getProducts(array $data) {
    $dataProduct = array();
    $dataProds = array();
    $config = \Drupal::config('ons_product_selector.settings');
    $jsonProducts = (array) json_decode($config->get('ons_product_selector.product_order'));
    foreach($jsonProducts[0] as $prod) {
      $dataProds[$prod] = $data[$prod];
      unset($data[$prod]);
    }
    $data = $dataProds + $data;
    foreach($data as $node) {
      if(!is_null($node)) {
        $dataProduct[] = $this->getProduct($node);
      }
    }
    return $dataProduct;
  }

  private function getProduct($node) {
    $langcode = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
    $node->hasTranslation($langcode);
    $translation = $node->getTranslation($langcode);
    $data = [];
    $product = $translation->get('field_ons_product')->referencedEntities()[0];
    $data['nid'] = $translation->id();
    $data['id'] = $translation->id();
    $data['title'] = $translation->label();
    if ($product->get('field_images')->referencedEntities()[0])
      $data['media_uri'] = file_create_url($product->get('field_images')->referencedEntities()[0]->getFileUri());
    $data['field_ons_description'] = $translation->get('field_ons_description')->getValue()[0]['value'];
    $data['field_ons_format_size'] = $translation->get('field_ons_format_size')->getValue()[0]['value'];
    $data['field_ons_kcal'] = $translation->get('field_ons_kcal')->getValue()[0]['value'];
    $data['field_ons_protein'] = $translation->get('field_ons_protein')->getValue()[0]['value'];
    $data['field_ons_p_cho_f_'] = $translation->get('field_ons_p_cho_f_')->getValue()[0]['value'];
    $data['field_ons_flavours'] = array_values(array_filter(array_map(function ($data) use ($langcode) {
      if ($data->hasTranslation($langcode)) {
        return $data->getTranslation($langcode)->label();
      }
    }, $translation->get('field_ons_flavours')->referencedEntities())));
    $data['field_ons_intolerance'] = array_map(function (\Drupal\taxonomy\Entity\Term $intolerance) {
      $fid = $intolerance->get('field_image_intolerance')->getValue()[0]['target_id'];
      $file = \Drupal\file\Entity\File::load($fid);
      if(!is_null($file)) {
        return [
          'url' => file_create_url($file->getFileUri()),
          'name' => $intolerance->toArray()['field_image_intolerance'][0]['alt']
        ];
      } else {
        return null;
      }
    }, $translation->get('field_ons_intolerance')->referencedEntities());
    sort($data['field_ons_flavours']);
    $data['field_ons_pipcode'] = $translation->get('field_ons_pipcode')->getValue()[0]['value'];
    $data['node_url'] = $product->toUrl('canonical', [
      'language' => $translation->language(),
    ])->setAbsolute()->toString();
    return $data;
  }

  private function getFields()
  {
    $config = \Drupal::config('ons_product_selector.settings');
    $filters['simple_filters'] = $config->get('ons_product_selector.filters');
    $filters['advanced_search'] = $config->get('ons_product_selector.more_filters');
    $fields = [];
    foreach ($filters as $filterType => $filter) {
      foreach ($filter as $key => $data) {
        $label = $this->getTaxonomyByName($data['filter']['filter_machine_name'])->get('name');
        $fields[$filterType][$label] = [
          'field_relation' => $this->getFieldRelation($data['filter']['filter_machine_name']),
          'taxonomy' => $data['filter']['filter_machine_name']
        ];
        // var_dump($this->getFieldRelation($data['filter']['filter_machine_name']));
      }
    }
    return $fields;
  }

  private function getTaxonomyByName($vocabulary_name)
  {
    $vocabs = Vocabulary::loadMultiple();
    foreach ($vocabs as $vocab_obj) {

      if ($vocab_obj->id() == $vocabulary_name) {
        return $vocab_obj;
      }
    }
    return NULL;
  }
  private function getFieldRelation($item)
  {
    $definitions = \Drupal::service('entity_field.manager')->getFieldDefinitions('node', 'ons_product_selector');
    foreach ($definitions as $key => $def) {
      // var_dump(get_class($def));
      if ($def instanceof \Drupal\field\Entity\FieldConfig) {
        if (isset($def->getSettings()["handler_settings"]) && is_array($def->getSettings()["handler_settings"]["target_bundles"]) && array_values($def->getSettings()["handler_settings"]["target_bundles"])[0] == $item) return $def->getName();
      }
    }
  }
}
