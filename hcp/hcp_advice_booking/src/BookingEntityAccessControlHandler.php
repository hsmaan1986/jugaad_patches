<?php

namespace Drupal\hcp_advice_booking;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Advice Booking entity.
 *
 * @see \Drupal\hcp_advice_booking\Entity\BookingEntity.
 */
class BookingEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\hcp_advice_booking\Entity\BookingEntityInterface $entity */
    switch ($operation) {
      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished advice booking entities');
        }

        if ($account->hasPermission('view published advice booking entities')) {
            if ($entity->isMember($account->id())) {
                return AccessResult::allowed();
            }
        }

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit advice booking entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete advice booking entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }
  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add advice booking entities');
  }

}
