<?php

namespace Drupal\hcp_webinar_enroll\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\node\NodeInterface;
use Drupal\node\Entity\Node;
use Drupal\hcp_webinar_enroll\Entity\Subscription;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
/**
* Class EnrollController.
*/
class EnrollController extends ControllerBase {

  /**
  * Enroll_user. Create a Subscription Entity with the related content and date of creation.
  *
  * @return string
  *   Create Subscription  between Actual User and the Content
  */
  public function hcp_webinar_enroll_user($user,$node, Request $request) {
    if ($user && $node && !$nid = $this->search_user_subscription($user, $node)) {
      $subscription = Subscription::create(array(
        'nid' => NULL,
        'type' => 'subscription',
        'uid' => $user,
        'status' => TRUE,
      ));
      $subscription->status = 1;
      $subscription->set('node_id',$node);
      $subscription->enforceIsNew();
      $subscription->save();
      \Drupal::messenger()->addMessage(t('You are now enrolled.'), 'status', FALSE);
    } else {
      \Drupal::messenger()->addMessage(t('You are already enrolled.'), 'status', FALSE);
    }

    $url = \Drupal::toUrl('entity.node.canonical', ['node' => $node], ['absolute' => TRUE]);

    return new RedirectResponse($url);
  }

  /**
  * Remove_user_subscription.
  *
  * @return string
  *   Remve Subscription from content.
  */
  public function remove_user_subscription($user, $node) {

    \Drupal::messenger()->addMessage(t('You have unrolled!'), 'status', FALSE);

    $entity_id = $this->search_user_subscription($user, $node);

    $entity = \Drupal::entityTypeManager()->getStorage('subscription')->load($entity_id);

    if ($entity) {
      $entity->delete();
    }

    $url = \Drupal::toUrl('entity.node.canonical', ['node' => $node], ['absolute' => TRUE]);

    return new RedirectResponse($url);
  }

  public function search_user_subscription($user, $node){

    $query = \Drupal::entityQuery('subscription')
      ->condition('user_id', $user, '=')
      ->condition('node_id', $node , '=');

      $nids = $query->execute();

    foreach ($nids as $nid => $node_info) {
      return $nid;
    }
    return false;
  }
}
