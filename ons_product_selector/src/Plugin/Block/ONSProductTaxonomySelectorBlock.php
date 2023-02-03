<?php

namespace Drupal\ons_product_selector\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\ons_product_selector\ContentSelector;
use Drupal\taxonomy\Entity\Term;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\ons_product_selector\Controller\OnsProductController;

/**
 * Provides a 'Cult Recipe Search Results' Block.
 *
 * @Block(
 *   id = "ons_product_taxonomy_selector_block",
 *   admin_label = @Translation("ONS Product Taxonomy Search Block"),
 * )
 */

class ONSProductTaxonomySelectorBlock extends BlockBase
{
  private $fields = [
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
      'Flavour'   => ['field_relation' => 'field_ons_flavours',       'taxonomy' => 'flavour']
    ]
  ];

  private function processTaxonomies($data)
  {
    //$this->setTaxonomyLabel($this->fields);
    return array_map(function ($block) {
      return array_map(function ($item) {
        return $this->getData($item);
      }, $block);
    }, $data);
  }

  private function getFields() {
    $config = \Drupal::config('ons_product_selector.settings');
    $filters['simple_filters'] = $config->get('ons_product_selector.filters');
    $filters['advanced_search'] = $config->get('ons_product_selector.more_filters');
    $fields = [];
    foreach($filters as $filterType => $filter) {
      foreach($filter as $key => $data) {
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

  private function setTaxonomyLabel($fields)
  {
    $data = array_walk($fields, function (&$data, $key) {
      foreach ($data as $key => $value) {
        $query = \Drupal::entityQuery('taxonomy_term');
        $query->condition('vid', $value['taxonomy']);
        $tids = $query->execute();
      }
    });
  }

  private function getData($definition)
  {
    
    return array_map(function ($el) use ($definition) {
      $query = \Drupal::entityQuery('node')->condition($definition['field_relation'], $el['tid'])->sort($definition['field_relation']);
      $query = $query->condition('field_ons_product', NULL, 'IS NOT NULL');
      $ct = $query->count()->execute();
      return array_merge($el, ['count' => $ct]);
    }, ContentSelector::find(ContentSelector::TYPE_TAXONOMY, $definition['taxonomy']));
  }

  // private function getSearchFields()
  // {
  //   $this->getFields();
  //   $config = \Drupal::config('ons_product_selector.settings');
  //   $langcode = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
  //   $filters['simple_filters'] = $config->get('ons_product_selector.filters');
  //   $filters['advanced_search'] = $config->get('ons_product_selector.more_filters');
  //   uasort($filters['simple_filters'], 'Drupal\Component\Utility\SortArray::sortByWeightElement');
  //   uasort($filters['advanced_search'], 'Drupal\Component\Utility\SortArray::sortByWeightElement');
  //   $dataFilters = array();
  //   foreach ($filters as $position => $filter) {
  //     foreach ($filter as $key => $item) {
  //       $vocabulary = $this->getTaxonomyByName($item['filter']['filter_machine_name']);
  //       $query = \Drupal::entityQuery('taxonomy_term');
  //       $query->condition('vid', $item['filter']['filter_machine_name']);
  //       $query->sort('weight');
  //       $tids = $query->execute();
  //       $terms = \Drupal\taxonomy\Entity\Term::loadMultiple($tids);
  //       $termList = array();
  //       $k = 0;
  //       foreach ($terms as $term) {
  //         if ($term->hasTranslation($langcode)) {
  //           $tid = $term->id();
  //           $translated_term = \Drupal::service('entity.repository')->getTranslationFromContext($term, $langcode);
  //           $termList[$k]['formName'] = $item['filter']['filter_machine_name'];
  //           $termList[$k]['name'] = $translated_term->getName();
  //           $termList[$k]['tid'] = $tid;
  //           //$this->getFieldRelation($item['filter']['filter_machine_name']);
  //           // $termList[$k]['count'] = $this->getData([
  //           //         'taxonomy' => $item['filter']['filter_machine_name'],
  //           //         'field_relation' => $this->getFieldRelation($item['filter']['filter_machine_name']),
  //           // ]);
  //           $k++;
  //         }
  //       }
  //       $dataFilters[$position][$vocabulary->get('name')] = $termList;
  //     }
  //   }

  //   return $dataFilters;
  // }

  private function getFieldRelation($item){
    $definitions = \Drupal::service('entity_field.manager')->getFieldDefinitions('node', 'ons_product_selector');
    foreach($definitions as $key => $def) {
      // var_dump(get_class($def));
      if($def instanceof \Drupal\field\Entity\FieldConfig) {
        if(is_array($def->getSettings()["handler_settings"]["target_bundles"]) && array_values($def->getSettings()["handler_settings"]["target_bundles"])[0] == $item) return $def->getName();
      }
    }
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

  public function build()
  {
    //$taxonomies = $this->getSearchFields();
    // var_dump(\Drupal::request()->getBaseUrl());
  
    return [
      '#taxonomies' => array_merge($this->processTaxonomies($this->getFields()),
        ['hide_filters' => OnsProductController::getHideFilters()],
        ['hide_advanced' => OnsProductController::getHideAdvancedFilters()],
        ['disable_compare' => OnsProductController::getDisableCompare()]
      ),
      '#theme' => 'ons_product_taxonomy_selector_block'
    ];
  }

  protected function getTidByName($name = NULL, $vid = NULL)
  {
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
