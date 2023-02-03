<?php

namespace Drupal\nhsc_polling\Plugin\views\filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\filter\FilterPluginBase;

/**
 * Question filter.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("poll_question_filter")
 */
class PollQuestionFilter extends FilterPluginBase {

	/**
	 * Operators.
	 *
	 * This may not be needed, as we don't have more than one operator. But it
	 * is a pattern seen in other filters, 'opStateIs' would be a method that
	 * a parent class calls during the query() method.
	 */
	public function operators() {
		$operators = [
			'is' => [
				'title' => $this->t('The question is'),
				'method' => 'opStateIs',
				'short' => $this->t('Is'),
				'values' => 1,
			],
		];
	}

	/**
	 * The form that is show (including the exposed form).
	 */
	protected function valueForm(&$form, FormStateInterface $form_state) {

		$database   = \Drupal::database();

		$poll_list = $database
			->select('poll_field_data', 'poll')
			->fields('poll', ['id', 'question'])
			->execute()->fetchAllKeyed();

		array_unshift($poll_list,  t('All'));


		$form['value'] = [
			'#tree' => TRUE,
			'question' => [
				'#type' => 'select',
				'#title' => $this->t('Question'),
				'#options' => $poll_list,
				'#default_value' => !empty($this->value['question']) ? $this->value['question'] : 'all',
			]
		];
	}

	/**
	 * Applying query filter. If you turn on views query debugging you should see
	 * these clauses applied. If the filter is optional, and nothing is selected, this
	 * code will never be called.
	 */
	public function query() {
		$this->ensureMyTable();
		$field_name = "$this->tableAlias.$this->realField";
		$field_value =  $this->value['question'];

		if ($field_value){
			$this->query->addWhereExpression($this->options['group'], "$this->tableAlias.pid = '$field_value'");
		}


	}

	/**
	 * Admin summary makes it nice for editors.
	 */
	public function adminSummary() {

		if ($this->isAGroup()) {
			return $this->t('grouped');
		}
		if (!empty($this->options['exposed'])) {
			return $this->t('exposed') . ', ' . $this->t('default question') . ': ' . $this->value['question'];
		}
		else {
			return $this->t('question') . ': ' . $this->value['question'];
		}
	}

}
