<?php

namespace Drupal\hcp_reward_system\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Console\Command\Database\ConnectCommand;
use Drupal\Core\Cache\Context\UserCacheContext;

/**
 * Class RewardSystemForm.
 */
class RewardSystemForm extends ConfigFormBase {

  /**
   * Drupal\Console\Command\Database\ConnectCommand definition.
   *
   * @var \Drupal\Console\Command\Database\ConnectCommand
   */
  protected $consoleDatabaseConnect;
  /**
   * Drupal\Core\Cache\Context\UserCacheContext definition.
   *
   * @var \Drupal\Core\Cache\Context\UserCacheContext
   */
  protected $cacheContextUser;
  /**
   * Constructs a new RewardSystemForm object.
   */
  public function __construct(
    ConfigFactoryInterface $config_factory,
  #    ConnectCommand $console_database_connect,
    UserCacheContext $cache_context_user
    ) {
    parent::__construct($config_factory);
    #    $this->consoleDatabaseConnect = $console_database_connect;
    $this->cacheContextUser = $cache_context_user;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      #      $container->get('console.database_connect'),
      $container->get('cache_context.user')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'hcp_reward_system.rewardsystem',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'reward_system_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hcp_reward_system.rewardsystem');
    $form['enable_system'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable System'),
      '#description' => $this->t('Enable Rewad System in this site'),
      '#default_value' => $config->get('enable_system'),
    ];

    $configured_bundles = $config->get('node_bundles');
   // get list of current Content Types
   $node_bundles = array_keys(\Drupal::service('entity_type.manager')->getStorage('node_type')->loadMultiple());


     $form['node_bundles'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Select Roles included in System'),
      '#options' => $node_bundles,
       '#default_value' => $config->get('node_bundles'),
    ];


    $form['contents'] = [
    '#type' => 'entity_autocomplete',
    '#target_type' => 'node',
    '#title' => $this->t('Contents'),
    '#description' => $this->t('Select some contents.'),
  #  '#default_value' => $default_entities,
    '#tags' => TRUE,
    '#selection_settings' => array(
        'target_bundles' => array('page', 'article'),
    ),
    '#weight' => '0',
];


$form['tags'] = array(
    '#type' => 'entity_autocomplete',
    '#title' => t('Product Category'),
    '#target_type' => 'taxonomy_term',
    '#selection_settings' => [
        'include_anonymous' => FALSE,
        'target_bundles' => array('category'),
    ],
);
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
    parent::submitForm($form, $form_state);

    $this->config('hcp_reward_system.rewardsystem')
      ->set('enable_system', $form_state->getValue('enable_system'))
      ->set('select_roles_included_in_system', $form_state->getValue('select_roles_included_in_system'))
      ->save();
  }

}
