<?php

/**
 * @file
 * Contains \Drupal\nppe_module_whitelabel_roles_permissions\Form\RolesSettingsForm.
 */

namespace Drupal\nppe_module_whitelabel_roles_permissions\Form;

use Drupal\Core\Config\FileStorage;
use Drupal\Core\Config\PreExistingConfigException;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class RolesSettingsForm
 * @package Drupal\nppe_module_whitelabel_roles_permissions\Form
 */
class RolesSettingsForm extends ConfigFormBase {

    /**
     * @var \Drupal\Core\Entity\EntityTypeManagerInterface
     */
    protected $entityTypeManager ;

    /**
     * @inheritDoc
     */
    public function __construct(ConfigFactoryInterface $config_factory,
                                EntityTypeManagerInterface $entity_type_manager) {
        parent :: __construct( $config_factory );
        $this -> entityTypeManager = $entity_type_manager ;
    }

    /**
     * @inheritDoc
     */
    public static function create(ContainerInterface $container ) {
        return new static (
            $container ->get( 'config.factory' ),
            $container ->get( 'entity_type.manager' )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nppe_module_whitelabel_roles_permissions';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['nppe_module_whitelabel_roles_permissions.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $directory = 'public://nppe_module_whitelabel_roles_settings/';

        $form["nppe_module_whitelabel_roles_settings"]["config_set_form"] = array(
            "#type" => "details",
            "#title" => t("Apply configuration"),
            "#description" => t("Select configuration to create"),
            '#open' => TRUE,
        );

        $form["nppe_module_whitelabel_roles_settings"]["additonal_config"] = array(
            "#type" => "details",
            "#title" => t("Create additional configuration"),
            "#description" => t("Upload additional config"),
            '#open' => TRUE,
        );

        $form["nppe_module_whitelabel_roles_settings"]["config_set_form"]['config_set'] = array(
            '#type' => 'select',
            '#title' => $this->t,('Select config to install'),
            '#options'  =>  $this->getConfigFiles(),
        );
        $form["nppe_module_whitelabel_roles_settings"]["config_set_form"]['apply_config'] = [
            '#type' => 'submit',
            '#value' => 'Apply selected config',
        ];

        $form["nppe_module_whitelabel_roles_settings"]["additonal_config"]['additional'] = array(
            '#type' => 'managed_file',
            '#title' => t('Import additional config'),
            "#description" => t("Upload additional config"),
            '#upload_location' => $directory,
            '#upload_validators' => array(
                'file_validate_extensions' => array('yml'),
            )
        );

        $form["nppe_module_whitelabel_roles_settings"]["additonal_config"]['write_config'] = [
            '#type' => 'submit',
            '#value' => 'Upload config file',
        ];

        $form['actions']["reinstall_default_config"] = array(
            "#type" => "submit",
            "#value" => $this->t("Reinstall default config"),
            "#submit" => array([$this, '_reinstall_config']),
        );


        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        // Trim the text values.

        parent::validateForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     * @var $config \Drupal\Core\Config\Config
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $userInput = $form_state->getUserInput();
        $operation = $userInput['op'];


        if($operation === 'Apply selected config'){
            $base = \Drupal::service('file_system')->realpath("public://");
            $config_path = $base  . "/nppe_module_whitelabel_roles_settings/";
            $config_value = $form_state->getValue('config_set');
            $source = new FileStorage($config_path);
            $config_storage = \Drupal::service('config.storage');

            if(!empty($config_value)){

                try {
                    $config_storage->write(str_replace('_.', '.', $config_value), $source->read($config_value));
                } catch (\Exception $e) {
                  \Drupal::messenger()->addMessage(t('Error applying the config'), 'error');
                }
            }
        }

        //perform default submit for all other calls to submit
        parent::submitForm($form, $form_state);


    }
    public static function _reinstall_config(array &$form, FormStateInterface $form_state){
        // Or, re-import the default config for a module or profile, etc.
        try {
            \Drupal::service('config.installer')->installDefaultConfig('module', 'nppe_module_whitelabel_roles_permissions');
            \Drupal::messenger()->addMessage(t('Config has been reset'), 'status');

        } catch (\Exception $e) {
            \Drupal::messenger()->addMessage(t('Error applying the config'), 'error');
        }
    }

    // Returns an array of config files
    private function getConfigFiles(){
      $base = \Drupal::service('file_system')->realpath("public://");
      $directory = $base  . "/nppe_module_whitelabel_roles_settings";
      $files = array_diff(scandir($directory), array('.', '..'));

      $results = [];

      foreach ($files as $file):
        $key = str_replace(".yml","",$file);
        $results[$key] = $key;
      endforeach;

      return $results;
    }



}
