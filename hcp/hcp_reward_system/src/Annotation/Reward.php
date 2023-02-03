<?php

namespace Drupal\hcp_reward_system\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Reward item annotation object.
 *
 * @see \Drupal\hcp_reward_system\Plugin\RewardManager
 * @see plugin_api
 *
 * @Annotation
 */
class Reward extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $type;

  /**
   * The type of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $points;


  /**
   * The node of the reward.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $node;

}
