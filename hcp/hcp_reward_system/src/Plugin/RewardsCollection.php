<?php

namespace Drupal\hcp_reward_system\Plugin;

use Drupal\Core\Plugin\DefaultLazyPluginCollection;

/**
 * A collection of rewards.
 */
class RewardsCollection extends DefaultLazyPluginCollection {

  /**
   * {@inheritdoc}
   *
   * @return \Drupal\hcp_reward_system\Plugin\RewardInterface
   */
  public function &get($instance_id) {
    return parent::get($instance_id);
  }

  /**
   * {@inheritdoc}
   */
  public function sortHelper($aID, $bID) {
    $a_points = $this->get($aID)->getPoints();
    $b_points = $this->get($bID)->getPoints();
    if ($a_points == $b_points) {
      return 0;
    }

    return ($a_points < $b_points) ? -1 : 1;
  }

}
