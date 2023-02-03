<?php

namespace Drupal\hcp_advice_booking;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Advice Booking entities.
 *
 * @ingroup hcp_advice_booking
 */
class BookingEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['name'] = $this->t('Name');
    $header['date'] = $this->t('Date & Time');
    $header['booked_by'] = $this->t('Booked By');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\hcp_advice_booking\Entity\BookingEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.booking_entity.edit_form',
      ['booking_entity' => $entity->id()]
    );
      $row['date'] = $entity->booking_start->getValue()[0]['value'];
      $row['booked_by'] = 'Not booked';
      $uid = $entity->booked_user_id->getValue();
      if(!empty($uid)) {
          $user = \Drupal\user\Entity\User::load($uid[0]['target_id']);
          $row['booked_by'] = $user->getEmail();
      }
    return $row + parent::buildRow($entity);
  }

}
