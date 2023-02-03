<?php

namespace Drupal\nhsc_polling\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Class Choice
 * @package Drupal\nhsc_polling\Plugin\views\field
 *
 * @ViewsField("vote_choice")
 *
 *
 */

class VoteChoice extends FieldPluginBase
{

	/**
	 * {@inheritdoc}
	 *
	 */

	public function render(ResultRow $values)
	{
		$choice     = $this->getValue($values);
		$database   = \Drupal::database();

		$choice_value = $database
			->select('poll_choice_field_data', 'c')
			->fields('c', ['choice'])
			->condition('id', $choice, '=')
			->execute()->fetchField();


		return $choice_value;
	}
}