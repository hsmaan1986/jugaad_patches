<?php

namespace Drupal\ons_product_selector;

use Drupal\Core\Url;
use Drupal\file\Entity\File;

class ContentSelector
{
  const TYPE_TAXONOMY = 'taxonomy_term';
  const TYPE_NODE = 'node';

  private static function getImageData($fieldname, &$node)
  {
    $res = [];
    $fieldAttributes = $node->get($fieldname)->getValue();
    foreach ($fieldAttributes as $k => $el) {
      $res[$k] = $el;
      if (isset($el['target_id'])) {
        $res[$k]['url'] = File::load($el['target_id'])->getFileUri();
      }
    }

    return $res;
  }

  private static function getFieldAttributeValue($fieldList, $node)
  {
    $rec = [];
    $fieldNameList = array_keys($fieldList);
    $curr_langcode = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
    foreach ($fieldNameList as &$fieldName) {
      $fieldType = $fieldList[$fieldName]->getType();
      switch ($fieldType) {
        case 'image':
          $rec[$fieldName] = self::getImageData($fieldName, $node);
          break;

        case 'path':
          if (is_a($node, 'Drupal\node\Entity\Node'))
            $rec[$fieldName] = Url::fromRoute('entity.node.canonical', ['node' => $node->get('nid')->value])->toString();
          break;

        default:
          if($fieldName == 'name' && $node->hasTranslation($curr_langcode)) {
            $translated_term = \Drupal::service('entity.repository')->getTranslationFromContext($node, $langcode);
            $rec[$fieldName] = $translated_term->getName();
          } else {
            $rec[$fieldName] = $node->get($fieldName)->value;
          }
          break;
      }
      $rec['formName'] = $node->get('vid')->getValue()[0]['target_id'];
    }
    return $rec;
  }

  public static function nodelistToFlatArray($fieldList, array $nodeList)
  {
    $recs = [];
    foreach ($nodeList as $k => &$node) {
      $recs[] = self::getFieldAttributeValue($fieldList, $node);
    }
    return $recs;
  }

  public static function find($type, $name, array $conditions = [])
  {
    $curr_langcode = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
    $conditionField = $type == self::TYPE_TAXONOMY ? 'vid' : 'type';
    $fieldList = \Drupal::service('entity_field.manager')->getFieldDefinitions($type, $name);
    $query = \Drupal::entityQuery($type)
      ->condition($conditionField, $name)
      ->condition('langcode', $curr_langcode)
      ->sort('weight');
    foreach ($conditions as $field => $value) {
      $query = $query->condition($field, $value);
    }
    $query = $query->sort('weight');
    $references = $query->execute();
    $storage = \Drupal::entityTypeManager()->getStorage($type);
    $data = self::nodelistToFlatArray($fieldList, $storage->loadMultiple($references));

    return $data;
  }

  public static function findTaxonomies($name) {
    $curr_langcode = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
    $storage = \Drupal::entityTypeManager()->getStorage(self::TYPE_TAXONOMY);
    $query = \Drupal::entityQuery(self::TYPE_TAXONOMY)
      ->condition('vid', $name)
      ->condition('langcode', $curr_langcode)
      ->sort('weight');
    $query = $query->sort('weight');
    $references = $query->execute();
    $taxonomyReturn = [];
    foreach($storage->loadMultiple($references) as $key => $term) {
      $taxonomyReturn[$key] = [
        'tid' => $term->id(),
        'formName' => $term->bundle(),
        'name' => $term->label()
      ];
    }

    return $taxonomyReturn;
  }
}
