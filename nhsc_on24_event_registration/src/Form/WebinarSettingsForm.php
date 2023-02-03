<?php

/**
 * @file
 * Contains \Drupal\nhsc_on24_event_registration\Form\WebinarSettingsForm.
 */

namespace Drupal\nhsc_on24_event_registration\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WebinarSettingsForm
 * @package Drupal\nhsc_on24_event_registration\Form
 */
class WebinarSettingsForm extends ConfigFormBase {
	/**
	 * {@inheritdoc}
	 */
	public function getFormId() {
		return 'nhsc_on24_event_registration_settings';
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getEditableConfigNames() {
		return ['nhsc_on24_event_registration.settings'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		$config = $this->config('nhsc_on24_event_registration.settings');

		$form['APIdisplay'] = [
			'#type' => 'details',
			'#title' => t('ON24 Webinar API Settings'),
			'#open' => TRUE,
		];

		$form['APIdisplay']['endpoint'] = [
			'#type' => 'textfield',
			'#title' => $this->t('End-Point'),
			'#default_value' => $config->get('endpoint'),
		];

		$form['APIdisplay']['site_key'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Site key'),
			'#default_value' => $config->get('site_key'),
		];

		$form['APIdisplay']['session_id'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Session ID'),
			'#default_value' => $config->get('session_id'),
		];

		$form['APIdisplay']['log_reg_hits'] = [
			'#type' => 'select',
			'#title' => $this->t('Log Registration Hits'),
			'#default_value' => $config->get('log_reg_hits'),
			'#options' => [
				'y' => 'Yes',
				'n' => 'No'
			]
		];

		$form['APIdisplay']['re_cookie'] = [
			'#type' => 'select',
			'#title' => $this->t('Re Cookie'),
			'#default_value' => $config->get('log_reg_hits'),
			'#options' => [
				'y' => 'Yes',
				'n' => 'No'
			]
		];

		$form['APIdisplay']['auto_reg'] = [
			'#type' => 'select',
			'#title' => $this->t('Auto Registration'),
			'#default_value' => $config->get('auto_reg'),
			'#options' => [
				true => 'True',
				false => 'False'
			]
		];




		return parent::buildForm($form, $form_state);
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm($form, $form_state);
	}

	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$this->config('nhsc_on24_event_registration.settings')
			->set('site_key', $form_state->getValue('site_key'))
			->set('endpoint', $form_state->getValue('endpoint'))
			->set('session_id', $form_state->getValue('session_id'))
			->set('log_reg_hits', $form_state->getValue('log_reg_hits'))
			->set('re_cookie', $form_state->getValue('re_cookie'))
			->set('auto_reg', $form_state->getValue('auto_reg'))

			->save();

		parent::submitForm($form, $form_state);
	}
}
