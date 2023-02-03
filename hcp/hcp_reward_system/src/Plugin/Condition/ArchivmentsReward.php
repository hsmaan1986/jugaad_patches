<?php

namespace Drupal\hcp_reward_system\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\Context\ContextDefinition;

/**
* Provides a 'Archivments reward' condition to enable a condition based in module selected status.
*
* @Condition(
*   id = "archivments_reward",
*   label = @Translation("Archivments reward"),
*   context = {
*     "field_config" = @ContextDefinition("entity:field_config", required = TRUE , label = @Translation("field_config"))
*   }
* )
*
*/
class ArchivmentsReward extends ConditionPluginBase {

/**
* {@inheritdoc}
*/
public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
{
    return new static(
    $configuration,
    $plugin_id,
    $plugin_definition
    );
}

/**
 * Creates a new ArchivmentsReward object.
 *
 * @param array $configuration
 *   The plugin configuration, i.e. an array with configuration values keyed
 *   by configuration option name. The special key 'context' may be used to
 *   initialize the defined contexts by setting it to an array of context
 *   values keyed by context names.
 * @param string $plugin_id
 *   The plugin_id for the plugin instance.
 * @param mixed $plugin_definition
 *   The plugin implementation definition.
 */
 public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
 }

 /**
   * {@inheritdoc}
   */
 public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
     // Sort all modules by their names.
     $modules = \Drupal::service('extension.list.module')->getList();;
     uasort($modules, 'system_sort_modules_by_info_name');

     $options = [NULL => t('Select a module')];
     foreach($modules as $module_id => $module) {
         $options[$module_id] = $module->info['name'];
     }

     $form['module'] = [
         '#type' => 'select',
         '#title' => $this->t('Select a module to validate'),
         '#default_value' => $this->configuration['module'],
         '#options' => $options,
         '#description' => $this->t('Module selected status will be use to evaluate condition.'),
     ];

     return parent::buildConfigurationForm($form, $form_state);
 }

/**
 * {@inheritdoc}
 */
 public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
     $this->configuration['module'] = $form_state->getValue('module');
     parent::submitConfigurationForm($form, $form_state);
 }

/**
 * {@inheritdoc}
 */
 public function defaultConfiguration() {
    return ['module' => ''] + parent::defaultConfiguration();
 }

/**
  * Evaluates the condition and returns TRUE or FALSE accordingly.
  *
  * @return bool
  *   TRUE if the condition has been met, FALSE otherwise.
  */
  public function evaluate() {
      if (empty($this->configuration['module']) && !$this->isNegated()) {
          return TRUE;
      }

      $module = $this->configuration['module'];
      $modules = \Drupal::service('extension.list.module')->getList();;

      return $modules[$module]->status;
  }

/**
 * Provides a human readable summary of the condition's configuration.
 */
 public function summary()
 {
     $module = $this->getContextValue('module');
     $modules = \Drupal::service('extension.list.module')->getList();;

     $status = ($modules[$module]->status)?t('enabled'):t('disabled');

     return t('The module @module is @status.', ['@module' => $module, '@status' => $status]);
 }

}
