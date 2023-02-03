<?php

namespace Drupal\hcp_webinar_enroll\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Subscription entities.
 */
class SubscriptionViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
