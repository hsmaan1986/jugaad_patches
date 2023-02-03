<?php

namespace Drupal\hcp_advice_booking\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Advice Booking entities.
 *
 * @ingroup hcp_advice_booking
 */
interface BookingEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Advice Booking name.
   *
   * @return string
   *   Name of the Advice Booking.
   */
  public function getName();

  /**
   * Sets the Advice Booking name.
   *
   * @param string $name
   *   The Advice Booking name.
   *
   * @return \Drupal\hcp_advice_booking\Entity\BookingEntityInterface
   *   The called Advice Booking entity.
   */
  public function setName($name);

  /**
   * Gets the Advice Booking creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Advice Booking.
   */
  public function getCreatedTime();

  /**
   * Sets the Advice Booking creation timestamp.
   *
   * @param int $timestamp
   *   The Advice Booking creation timestamp.
   *
   * @return \Drupal\hcp_advice_booking\Entity\BookingEntityInterface
   *   The called Advice Booking entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Advice Booking published status indicator.
   *
   * Unpublished Advice Booking are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Advice Booking is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Advice Booking.
   *
   * @param bool $published
   *   TRUE to set this Advice Booking to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\hcp_advice_booking\Entity\BookingEntityInterface
   *   The called Advice Booking entity.
   */
  public function setPublished($published);

  public function isMember($id);

}
