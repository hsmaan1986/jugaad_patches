<?php

namespace Drupal\hcp_reward_system\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Point entities.
 *
 * @ingroup hcp_reward_system
 */
interface PointInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Point name.
   *
   * @return string
   *   Name of the Point.
   */
  public function getName();

  /**
   * Sets the Point name.
   *
   * @param string $name
   *   The Point name.
   *
   * @return \Drupal\hcp_reward_system\Entity\PointInterface
   *   The called Point entity.
   */
  public function setName($name);

  /**
   * Gets the Point creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Point.
   */
  public function getCreatedTime();

  /**
   * Sets the Point creation timestamp.
   *
   * @param int $timestamp
   *   The Point creation timestamp.
   *
   * @return \Drupal\hcp_reward_system\Entity\PointInterface
   *   The called Point entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Point published status indicator.
   *
   * Unpublished Point are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Point is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Point.
   *
   * @param bool $published
   *   TRUE to set this Point to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\hcp_reward_system\Entity\PointInterface
   *   The called Point entity.
   */
  public function setPublished($published);

}
