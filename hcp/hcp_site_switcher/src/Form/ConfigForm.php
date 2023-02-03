<?php

namespace Drupal\hcp_site_switcher\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\file\Entity\File;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase
{

	/**
	 * {@inheritdoc}
	 */
	public function __construct(ConfigFactoryInterface $config_factory) {
		parent::__construct($config_factory);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create(ContainerInterface $container) {

		return new static(
			$container->get('config.factory')
		);
	}

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'hcp_site_switcher.config',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'config_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('hcp_site_switcher.config');

        $form['settings'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Settings'),
        ];

        $form['configs'] = [
            '#type' => 'details',
            '#title' => t('Configs'),
            '#group' => 'settings',
        ];

        $form['configs']['switcher_id'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Switcher ID'),
            '#default_value' => $config->get('switcher_id'),
        ];

        $form['configs']['logo'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Modal Logo'),
            '#upload_location' => 'public://images',
            '#description' => $this->t('Modal Logo Image'),
           /* '#multiple' => FALSE,
            '#default_value' => explode($config->get('logo'),','),*/
        ];


        $form['configs']['default_copy'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Default Copy'),
            '#default_value' => $config->get('default_copy'),
        ];

        $form['configs']['footer_copy'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Footer Copy'),
            '#default_value' => $config->get('footer_copy'),
        ];

        $form['configs']['redirect_copy_hcp'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Redirect Copy HCP'),
            '#default_value' => $config->get('redirect_copy_hcp'),
        ];

        $form['configs']['redirect_copy_patient'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Redirect Copy Patient'),
            '#default_value' => $config->get('redirect_copy_patient'),
        ];

        $form['configs']['yes_button_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Yes Button Text'),
            '#default_value' => $config->get('yes_button_text'),
        ];

        $form['configs']['no_button_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('No Button Text'),
            '#default_value' => $config->get('no_button_text'),
        ];



	    $language_manager = \Drupal::service('language_manager');

	    $installed_lang   = $language_manager->getLanguages();

	    $languages = [];

		foreach ($installed_lang as $l){
			$id = $l->getId();
			$name = $language_manager->getLanguageName($id);

			$languages[$id] = $name;
		}


	    $form['configs']['language'] = [
		    '#type' => 'select',
		    '#title' => $this->t('Select Language'),
		    '#options' => $languages,
		    '#default_value' => $config->get('language'),
	    ];

      $form['configs']['enable_disable'] = [
        '#type' => 'select',
        '#title' => $this->t('Global Enable/Disable'),
        '#description' => $this->t('This will enable/disable HCP on this website'),
        '#options' => [
          '1' => $this->t('Enable'),
          '0' => $this->t('Disable'),
        ],
        '#default_value' => $config->get('enable_disable'),
      ];

	    $form['configs']['prompt_once'] = [
		    '#type' => 'checkbox',
		    '#title' => $this->t('Prompt once only'),
		    '#description' => $this->t('Check this to enable prompt only once feature'),
		    '#default_value' => $config->get('prompt_once'),
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

	   // $config = $this->configFactory->getEditable('hcp_site_switcher.config');
       $config =  $this->config('hcp_site_switcher.config');

       if (isset($form_state->getValue('logo')[0])){
        // get images
        $logo = $form_state->getValue('logo')[0];
        // save images permanent
        $logo_file = File::load($logo);
        $logo_file->setPermanent();
        $logo_file->save();

        $config->set('logo', $logo_file->createFileUrl());
    }


    $config
        ->set('switcher_id', $form_state->getValue('switcher_id'))
        ->set('default_copy', $form_state->getValue('default_copy'))
        ->set('footer_copy', $form_state->getValue('footer_copy'))
        ->set('redirect_copy_hcp', $form_state->getValue('redirect_copy_hcp'))
        ->set('redirect_copy_patient', $form_state->getValue('redirect_copy_patient'))
        ->set('yes_button_text', $form_state->getValue('yes_button_text'))
        ->set('no_button_text', $form_state->getValue('no_button_text'))
        ->set('language', $form_state->getValue('language'))
        ->set('enable_disable', $form_state->getValue('enable_disable'))
        ->set('prompt_once', $form_state->getValue('prompt_once'))
        
        ->save();

        // $values = $form_state->cleanValues()->getValues();

        // $config->setData($values)
	    //     ->save();
        // \Drupal::messenger()->addMessage('Changes saved.', 'status');
    }

}
