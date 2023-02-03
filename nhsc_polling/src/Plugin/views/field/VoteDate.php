<?php

namespace Drupal\nhsc_polling\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Class Choice
 * @package Drupal\nhsc_polling\Plugin\views\field
 *
 * @ViewsField("vote_date")
 *
 *
 */

class VoteDate extends FieldPluginBase
{

	/**
	 * {@inheritdoc}
	 *
	 */

	public function render(ResultRow $values)
	{
		$date     = $this->getValue($values);

		return date('Y-m-d h:i:s',$date);
	}
}