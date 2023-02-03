<?php

namespace Drupal\hcp_reward_system\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;
use Drupal\hcp_reward_system\Plugin\RewardInterface;


/**
 * Provides an interface for defining Achivements entity entities.
 */
interface AchivementsEntityInterface extends ConfigEntityInterface {

  // Add get/set methods for your configuration properties handlers
  public function getContentTypes();

  public function getPointTypes();

  public function getDescription();
  public function getStatus();

  public function getImage();

  /**
   * Returns the achievement.
   *
   * @return string
   *   The name of the achievement.
   */
  public function getName();

  /**
   * Sets the name of the achievement.
   *
   * @param string $name
   *   The name of the achievement.
   *
   * @return \Drupal\hcp_reward_system\Plugin\AchivementEntityInterface
   *   The class instance this method is called on.
   */
  public function setName($name);
  /**
   * Returns a specific reward.
   *
   * @param string $reward
   *   The reward ID.
   *
   * @return \Drupal\hcp_reward_system\RewardInterface
   *   The reward object.
   */
  public function getReward($reward);

  /**
   * Returns the rewards for this achivement.
   *
   * @return \Drupal\hcp_reward_system\RewardPluginCollection|\Drupal\hcp_reward_system\RewardInterface[]
   *   The reward plugin collection.
   */
  public function getRewards();

  /**
   * Saves an reward for this achivement.
   *
   * @param array $configuration
   *   An array of reward configuration.
   *
   * @return string
   *   The reward ID.
   */
  public function addReward(array $configuration);

  /**
   * Deletes an reward from this achivement.
   *
   * @param \Drupal\hcp_reward_system\RewardInterface $reward
   *   The reward object.
   *
   * @return $this
   */
  public function deleteReward(RewardInterface $reward);

}
