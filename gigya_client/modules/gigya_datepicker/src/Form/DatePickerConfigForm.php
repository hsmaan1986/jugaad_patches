<?php

namespace Drupal\gigya_datepicker\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 */
class DatePickerConfigForm extends ConfigFormBase
{
	/**
	 * {@inheritdoc}
	 */
	public function getFormId()
	{
		return 'gigya_datepicker_config_form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state)
	{
		$config = $this->config('gigya_datepicker.config');

		$form['settings'] = array(
			'#type' => 'vertical_tabs',
			'#title' => t('Settings'),
		);

		$form['date_settings'] = [
			'#type' => 'details',
			'#title' => t('Date Field Settings'),
			'#group' => 'settings',
		];

		$form['date_settings']['field_html_selector'] = [
			'#type' => 'textarea',
			'#rows' => 10,
			'#cols' => 60,
			'#title' => $this->t('Date field HTML selector(s)'),
			'#description' => $this->t('Enter list of selectors separeted by newline that you need the 
			datepicker to show'),
			'#default_value' => $config->get('field_html_selector'),
			'#size' => 100,
		];

		$form['date_settings']['date_format'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Date Format'),
			"#description" => "Default - mm/dd/yy <br>ISO 8601 - yy-mm-dd <br>Short - d M, y<br>
			Medium - d MM, y<br>Full - DD, d MM, yy",
			'#default_value' => $config->get('date_format'),
		];

		$form['date_settings']['date_locale'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Date Localization'),
			"#description" => "Language code to localize the date picker ie: pl, en",
			'#default_value' => $config->get('date_locale'),
		];


		return parent::buildForm($form, $form_state);
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateForm(array &$form, FormStateInterface $form_state)
	{
		parent::validateForm($form, $form_state);
	}

	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state)
	{
		parent::submitForm($form, $form_state);

		$this->config('gigya_datepicker.config')
			->set('field_html_selector', $form_state->getValue('field_html_selector'))
			->set('date_format', $form_state->getValue('date_format'))
			->set('date_locale', $form_state->getValue('date_locale'))
			->save();
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getEditableConfigNames()
	{
		return [
			'gigya_datepicker.config',
		];
	}
}