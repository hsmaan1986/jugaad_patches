<?php

namespace Drupal\hcp_reward_system\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class RewardSubscriber.
 */
class RewardSubscriber implements EventSubscriberInterface {


  /**
   * Constructs a new RewardSubscriber object.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events['kernel.view'] = ['kernel_view'];

    return $events;
  }

  public function addPointsToUser(){

    //
    // $add_loyalty_points = Points::create([
    //   'uid' => $user_id,
    //   'loyalty_points' => $loyalty_points->getNumber(),
    //   'reason' => $reason,
    //   'created' => time(),
    // ]);
    // $add_loyalty_points->save();

  }

  /**
   * This method is called whenever the kernel.view event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function kernel_view(Event $event) {
    \Drupal::messenger()->addMessage('Event kernel.view thrown by Subscriber in module hcp_reward_system.', 'status', TRUE);
  }

}
