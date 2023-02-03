<?php

namespace Drupal\nhsc_missing_alt_text\Commands;

use Drush\Commands\DrushCommands;
use Drupal\Core\Entity\Entity;
use mysql_xdevapi\Exception;
use Drupal\field\Entity\FieldConfig;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\node\Entity\Node;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 */
class MissingAltTextDrushCommands extends DrushCommands {


	/**
	 * Entity type service.
	 *
	 * @var \Drupal\Core\Entity\EntityTypeManagerInterface
	 */
	private $entityTypeManager;

	/**
	 * Logger service.
	 *
	 * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
	 */
	private $loggerChannelFactory;

	/**
	 * Constructs a new UpdateVideosStatsController object.
	 *
	 * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
	 *   Entity type service.
	 * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $loggerChannelFactory
	 *   Logger service.
	 */
	public function __construct(EntityTypeManagerInterface $entityTypeManager, LoggerChannelFactoryInterface $loggerChannelFactory) {
		$this->entityTypeManager = $entityTypeManager;
		$this->loggerChannelFactory = $loggerChannelFactory;
	}

	/**
	 * Update Node.
	 *
	 * @param string $type
	 *   Type of node to update
	 *   Argument provided to the drush command.
	 *
	 * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
	 * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
	 * @command update:alt scraper
	 * @aliases update-alt-scraper
	 *
	 * @usage update:alt foo
	 *   foo is the type of node to update
	 */
	public function updateScraper ($type = '') {


		try {
			// Get all scrapper nodes
			if (!$nodes = $this->entityTypeManager
				->getStorage('node')
				->getQuery()
				->condition('type', 'scraper')
				->execute()) {
				$this->output()->writeln('Error getting nodes of this type ');
				return;
			}

		}
		catch (\Exception $e) {
			$this->output()->writeln($e);
			$this->loggerChannelFactory->get('nhsc_missing_alt_text')->warning('Error found @e', ['@e' => $e]);
		}

		// 3. Create the operations array for the batch.
		$operations = [];
		$numOperations = 0;
		$batchId = 1;

		if (!empty($nodes)) {
			foreach ($nodes as $nid) {
				// get node
				$node = Node::load($nid);
				$this->output()->writeln('Preparing batch: ' . $batchId);

				// 3. Create batch operations.
				$operations[] = [
					'\Drupal\nhsc_missing_alt_text\BatchService::processNodeScraper',
					[
						$batchId,
						$node
					],
				];

				$batchId++;
				$numOperations++;
			}

		}
		else {
			$this->logger()->warning('No nodes of this type @type', ['@type' => 'scraper']);
		}

		// 4. Create the batch.
		$batch = [
			'title' => t('Updating @num node(s)', ['@num' => $numOperations]),
			'operations' => $operations,
			'finished' => '\Drupal\nhsc_missing_alt_text\BatchService::processMyNodeFinished',
		];

		// 5. Add batch operations as new batch sets.
		batch_set($batch);

		// 6. Process the batch sets.
		drush_backend_batch_process();

		// 7. Show some information.
		$this->logger()->notice('Batch operations end.');
		// 8. Log some information.
		$this->loggerChannelFactory->get('nhsc_missing_alt_text')->info('Update batch operations end.');

	}

	/**
	 * Update Node.
	 *
	 * @param string $type
	 *   Type of node to update
	 *   Argument provided to the drush command.
	 *
	 * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
	 * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
	 * @command update:alt:text
	 * @aliases update-alt-text
	 *
	 * @usage update:node foo
	 *   foo is the type of node to update
	 */
	public function updateNode($type = '') {

		ini_set('memory_limit', '0');

		// 1. Log the start of the script.
		$this->loggerChannelFactory->get('nhsc_missing_alt_text')->info('Update nodes batch operations start');

		// Check the type of node given as argument, if not, set article as default.
		if (strlen($type) == 0) {
			$type = 'image';
		}

		// 2. Retrieve all nodes of this type.
		try {
			// Get all image fields
			if (!$fields = $this->entityTypeManager
				->getStorage('field_config')
				->loadByProperties(
					[
						'field_type' => $type,// get field of type image
						'status' => true,// field active
						'deleted' => false// fields not deleted
				])) {
				return;
			}

		}
		catch (\Exception $e) {
			$this->output()->writeln($e);
			$this->loggerChannelFactory->get('nhsc_missing_alt_text')->warning('Error found @e', ['@e' => $e]);
		}

		// 3. Create the operations array for the batch.
		$operations = [];
		$numOperations = 0;
		$batchId = 1;



		if (!empty($fields)) {
			foreach ($fields as $field) {

				$field_name = $field->getName();
				$bundle = $field->getTargetBundle();
				$entity_type_id = $field->getTargetEntityTypeId();

				$entity_storage = $this->entityTypeManager->getStorage($entity_type_id);// get entity storage with type

				$query_result = $entity_storage->getQuery()
					->condition('status', '1')// published node
					->condition($field_name, '', '<>') // get if field is not empty
					->Exists($field_name)// check if entity has field
					->execute();

				if (!empty($query_result)) {
					if(!empty($entities = $entity_storage->loadMultiple($query_result))) {
						// return $entities; for example
						$this->output()->writeln('Preparing batch: ' . $batchId);

						// 3. Create batch operations.
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
		else {
			$this->logger()->warning('No nodes of this type @type', ['@type' => $type]);
		}

		// 4. Create the batch.
		$batch = [
			'title' => t('Updating @num node(s)', ['@num' => $numOperations]),
			'operations' => $operations,
			'finished' => '\Drupal\nhsc_missing_alt_text\BatchService::processMyNodeFinished',
		];

		// 5. Add batch operations as new batch sets.
		batch_set($batch);

		// 6. Process the batch sets.
		drush_backend_batch_process();

		// 7. Show some information.
		$this->logger()->notice('Batch operations end.');
		// 8. Log some information.
		$this->loggerChannelFactory->get('nhsc_missing_alt_text')->info('Update batch operations end.');
	}




}
