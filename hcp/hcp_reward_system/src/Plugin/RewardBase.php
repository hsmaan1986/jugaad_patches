<?php

namespace Drupal\hcp_reward_system\Plugin;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Plugin\PluginBase;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a base class for rewards plugins.
 *
 * @see \Drupal\hcp_reward_system\Annotation\Reward
 * @see \Drupal\hcp_reward_system\RewardInterface
 * @see \Drupal\hcp_reward_system\ConfigurableRewardInterface
 * @see \Drupal\hcp_reward_system\ConfigurableRewardBase
 * @see \Drupal\hcp_reward_system\RewardManager
 * @see plugin_api
 */
abstract class RewardBase extends PluginBase implements RewardInterface, ContainerFactoryPluginInterface {

  /**
   * A logger instance.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * The reward ID.
   *
   * @var string
   */
  protected $uuid;


  /**
   * The node of the reward.
   *
   * @var int|string
   */

  protected $node = '';

  /**
   * The points of the reward.
   *
   * @var int|string
   */
  protected $points = '';

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, LoggerInterface $logger) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->setConfiguration($configuration);
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('logger.factory')->get('reward')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function validate($user) {
    // Most image effects will not change the dimensions. This base
    // implementation represents this behavior. Override this method if your
    // image effect does change the dimensions.

    return true;
  }

  /**
   * {@inheritdoc}
   */
  public function giveRewardToUser($user, $reason, $quantity) {



    $add_reward_points = Point::create([
      'uid' => $user_id,
      'reward_points' =>$quantity,
      'reason' => $reason,
      'created' => time(),
    ]);
    $add_reward_points->save();


    return true;
  }

  /**
   * {@inheritdoc}
   */
  public function getSummary() {
    return [
      '#markup' => '',
      '#reward' => [
        'id' => $this->pluginDefinition['id'],
        'label' => $this->label(),
        'description' => $this->pluginDefinition['description'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function label() {
    return $this->pluginDefinition['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function setPoints($points) {

    $this->points = $points;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getPoints() {
    return $this->points;
  }


  /**
   * {@inheritdoc}
   */
  public function setNode($node) {

    $this->node = $node;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getNode() {
    return $this->node;
  }

  /**
   * {@inheritdoc}
   */
  public function getUuid() {
    return $this->uuid;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfiguration() {
    return [
      'uuid' => $this->getUuid(),
      'id' => $this->getPluginId(),
      'points' => $this->getPoints(),
      'data' => $this->configuration,

      'node' =>$this->getNode(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setConfiguration(array $configuration) {
    $configuration += [
      'data' => [],
      'uuid' => '',
      'points' => '',
      'node' => '',


    ];
    $this->configuration = $configuration['data'] + $this->defaultConfiguration();
    $this->uuid = $configuration['uuid'];
    $this->points = $configuration['points'];
    $this->node = $configuration['node'];


    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    return [];
  }


    /**
     * {@inheritdoc}
     */
    public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    }

    /**
     * {@inheritdoc}
     */
    public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    }
}
