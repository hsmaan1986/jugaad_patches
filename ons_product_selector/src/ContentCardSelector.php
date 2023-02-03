<?php

namespace Drupal\ons_product_selector;


use Drupal\Core\Url;
use Drupal\file\Entity\File;

class ContentCardSelector extends ContentSelector {
    const TYPE_TAXONOMY = 'taxonomy_term';
    const TYPE_NODE = 'node';

    private static function getImageData($fieldname, &$node) {
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

    public static function getFieldAttributeValue($fieldList, $node) {
        $rec = [];
        $fieldNameList = array_keys($fieldList);
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

                case 'entity_reference':
                    foreach ($node->get($fieldName) as $item)
                        $rec[$fieldName][] = $item->getValue()['target_id'];
                    break;

                case 'dynamic_entity_reference':
                    $rec[$fieldName] = 'Not Supported';
                    break;

                default:
                    $rec[$fieldName] = $node->get($fieldName)->value;
            }
        }
        return $rec;
    }

    public static function nodelistToFlatArray($fieldList, array $nodeList) {
        $recs = [];
        foreach ($nodeList as $k=>&$node) {
            $recs[] = self::getFieldAttributeValue($fieldList, $node);
        }
        return $recs;
    }

    public static function getQuery($type, $name) {
        $conditionField = $type == self::TYPE_TAXONOMY ? 'vid' :'type';
        return \Drupal::entityQuery($type)->condition($conditionField, $name);
    }

    public static function applyConditions(\Drupal\Core\Entity\Query\Sql\Query $query, array $conditions = []) {
        foreach ($conditions as $field=>$value) {
            $query = $query->condition($field, $value);
        }
        return $query;
    }

    public static function find($type, $name, array $conditions = [], $toArray = true) {
        $fieldList = \Drupal::service('entity_field.manager')->getFieldDefinitions($type, $name);
        $query = self::getQuery($type, $name);
        $query = self::applyConditions($query, $conditions);
        $references = $query->execute();
        $storage = \Drupal::entityTypeManager()->getStorage($type);
        if($toArray) {
            return self::nodelistToFlatArray($fieldList, $storage->loadMultiple($references));
        } else {
            return $storage->loadMultiple($references);
        }

        // return $data;
    }
}
