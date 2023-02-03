<?php

namespace Drupal\nhsc_missing_alt_text;

class MissingAltTextService {

  public function updateAltText() {

    $type = '';
    if (strlen($type) == 0) {
      $type = 'image';
    }

    if (!$fields = \Drupal::entityTypeManager()
      ->getStorage('field_config')
      ->loadByProperties(
        array(
          'field_type' => $type,
          'status' => true,
          'deleted' => false))) {
      return;
    }

    if (!empty($fields)) {
      $batchId = 0;
      $numOperations = 0;

      foreach ($fields as $field) {

        $field_name = $field->getName();
        $bundle = $field->getTargetBundle();
        $entity_type_id = $field->getTargetEntityTypeId();

        $entity_storage = \Drupal::entityTypeManager()
          ->getStorage($entity_type_id);

        $query_result = $entity_storage->getQuery()
          ->condition('status', '1')
          ->condition($field_name, '', '<>')
          ->Exists($field_name)
          ->execute();

        if (!empty($query_result)) {
          if(!empty($entities = $entity_storage->loadMultiple($query_result))) {


            $operations[] = [
              '\Drupal\nhsc_missing_alt_text\BatchService::processMyNode',
              [
                $batchId,
                $entities,
                $entity_type_id,
                $field_name
              ],
            ];

            $batchId++;
            $numOperations++;
          }
        }

      }

    }

    $batch = [
      'title' => t('Updating @num node(s)', ['@num' => $numOperations]),
      'operations' => $operations,
      'finished' => '\Drupal\nhsc_missing_alt_text\BatchService::processMyNodeFinished',
    ];

    batch_set($batch);
  }
}
