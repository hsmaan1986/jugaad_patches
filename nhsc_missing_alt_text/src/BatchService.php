<?php

namespace Drupal\nhsc_missing_alt_text;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\Entity\Node;

/**
 * Class BatchService.
 */
class BatchService {


	/**
	 * Batch process callback.
	 *
	 * @param object $id
	 *   Id of the batch.
	 * @param object $bundle
	 *   Id of the batch.
	 * @param string $entity_type_id
	 *   Id of the batch.
	 * @param string $field_name
	 *   Id of the batch.
	 * @param object $context
	 *   Context for operations.
	 * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
	 * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
	 * @throws \Drupal\Core\Entity\EntityStorageException
	 */
	public function processMyNode($id, $entities, $entity_type_id, $field_name, &$context) {

		// Simulate long process by waiting 100 microseconds.
		usleep(100);

		//  loop through entities
		foreach ($entities as $key => $node) {

			$field_alt = $node->$field_name->alt;// get alt-text
			$node_id = $node->id();// node id

			// check if alt is set
			if (empty($field_alt)) {
				// get title
				$entity_title = ($entity_type_id === 'node') ?
					$node->getTitle() : strstr($node->label(), '>', TRUE);

				// Replace the alt text to the title of this entity.
				// Save the value array back to entity.
				$node->$field_name->alt = $entity_title;
				//save to update node
				$node->save();

				$context['message'] = t('Updating Alt Text On @field_name On Node:"@nodeid"',
					[
						'@nodeid' => $node_id,
						'@field_name' => $field_name,
					]
				);
			}
		}


		// Store some results for post-processing in the 'finished' callback.
		// The contents of 'results' will be available as $results in the
		// 'finished' function (in this example, batch_example_finished()).
		$context['results'][] = $id;

	}

	/**
	 * Batch process callback.
	 *
	 * @param object $id
	 *   Id of the batch.
	 * @param object $node
	 *   node object.
	 * @param object $context
	 *   Context for operations.
	 * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
	 * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
	 * @throws \Drupal\Core\Entity\EntityStorageException
	 */
	public function processNodeScraper($id, $node, &$context) {

		// Simulate long process by waiting 100 microseconds.
		usleep(100);

		$title = ($node->getTitle()) ?: 'Alt Placeholder';

		$node_body = $node->body->value;

		if ($node_content = self::add_fix_tags ($node_body, $title)) {

			$node->body->value = $node_content;

			//save to update node
			$node->save();

			$context['message'] = t('Updating Alt Text On NodeID: "@nodeid"',
				[
					'@nodeid' => $node->id()
				]
			);
		}

		// Store some results for post-processing in the 'finished' callback.
		// The contents of 'results' will be available as $results in the
		// 'finished' function (in this example, batch_example_finished()).
		$context['results'][] = $id;

	}

	/**
	 * Batch Finished callback.
	 *
	 * @param bool $success
	 *   Success of the operation.
	 * @param array $results
	 *   Array of results for post processing.
	 * @param array $operations
	 *   Array of operations.
	 */
	public function processMyNodeFinished($success, array $results, array $operations) {
		$messenger = \Drupal::messenger();
		if ($success) {
			// Here we could do something meaningful with the results.
			// We just display the number of nodes we processed...
			$messenger->addMessage(t('@count results processed.', ['@count' => count($results)]));
		}
		else {
			// An error occurred.
			// $operations contains the operations that remained unprocessed.
			$error_operation = reset($operations);
			$messenger->addMessage(
				t('An error occurred while processing @operation with arguments : @args',
					[
						'@operation' => $error_operation[0],
						'@args' => print_r($error_operation[0], TRUE),
					]
				)
			);
		}
	}

	public static function add_fix_tags ($content, $title) {

		preg_match_all('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $content, $images);

		$return = false;


		if(!empty($images)) {
			foreach($images[1] as $index => $value) {
				/* search if img has alt*/
				if(!preg_match('/alt=("|\'|)(.*?)[a-zA-Z]("|\'| )(.*?)/', $value)) {
					$new_img = str_replace('<img', '<img alt="'.$title.'"', $images[0][$index]);
					$content = str_replace($images[0][$index], $new_img, $content);

					$return = $content;
				}
			}

		}

		return $return;

	}


}