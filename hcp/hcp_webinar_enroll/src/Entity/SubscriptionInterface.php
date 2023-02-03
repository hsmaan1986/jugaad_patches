<?php

namespace Drupal\hcp_webinar_enroll\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Subscription entities.
 *
 * @ingroup enroll
 */
interface SubscriptionInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Subscription Node ID .
   *
   * @return string
   *   Node ID of the Subscription.
   */
  public function getNodeId();


  /**
   * Gets the Subscription Node Entity .
   *
   * @return string
   *   Node Entity of the Subscription.
   */
  public function getNode();
  /**
   * Gets the Subscription name.
   *
   * @return string
   *   Name of the Subscription.
   */
  public function getName();

  /**
   * Sets the Subscription name.
   *
   * @param string $name
   *   The Subscription name.
   *
   * @return \Drupal\hcp_webinar_enroll\Entity\SubscriptionInterface
   *   The called Subscription entity.
   */
  public function setName($name);

  /**
   * Gets the Subscription creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Subscription.
   */
  public function getCreatedTime();

  /**
   * Sets the Subscription creation timestamp.
   *
   * @param int $timestamp
   *   The Subscription creation timestamp.
   *
   * @return \Drupal\hcp_webinar_enroll\Entity\SubscriptionInterface
   *   The called Subscription entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Subscription published status indicator.
   *
   * Unpublished Subscription are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Subscription is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Subscription.
   *
   * @param bool $published
   *   TRUE to set this Subscription to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\hcp_webinar_enroll\Entity\SubscriptionInterface
   *   The called Subscription entity.
   */
  public function setPublished($published);

}
