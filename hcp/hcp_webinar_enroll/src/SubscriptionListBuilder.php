<?php

namespace Drupal\hcp_webinar_enroll;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Subscription entities.
 *
 * @ingroup enroll
 */
class SubscriptionListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['user_id'] = $this->t('User');
    $header['node_id'] = $this->t('Content');
    $header['created'] = $this->t('Created');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\hcp_webinar_enroll\Entity\Subscription */
    $row['id'] = $entity->id();

    $row['user_id'] = Link::createFromRoute(
      $entity->getOwner()->getUserName(),
      'user.page',
      ['user' =>   $entity->getOwnerId()]
    );
    $row['node_id'] = Link::createFromRoute(
      $entity->getNode()->getTitle(),
      'entity.node.canonical',
      ['node' => $entity->getNodeId()]
    );

    $row['created'] = \Drupal::service('date.formatter')->format($entity->getCreatedTime(), 'custom', 'l j F Y');

    return $row + parent::buildRow($entity);
  }

}
