<?php
/**
 * @file
 * Contains \Drupal\hcp_webinar_enroll\Plugin\Block\EnrollBlock.
 */
namespace Drupal\hcp_webinar_enroll\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\hcp_webinar_enroll\Controller\EnrollController;

/**
 * Provides a 'Enroll' block.
 *
 * @Block(
 *   id = "enroll_block",
 *   admin_label = @Translation("Enroll block"),
 *   category = @Translation("Enroll")
 * )
 */
class EnrollBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

  //  $form = \Drupal::formBuilder()->getForm('Drupal\hcp_webinar_enroll\Form\EnrollForm');

if ( $node = \Drupal::routeMatch()->getParameter('node')) {





  $enrollController = new EnrollController();
  // get the actual node and user.
  //$node = \Drupal::routeMatch()->getParameter('node');
  $user = \Drupal::currentUser();
  $status = $enrollController->search_user_subscription($user->id(), $node->id());

  if (\Drupal::currentUser()->isAnonymous()) {


    $url = Url::fromRoute('user.register');


  }else{

     if ($status) {

    //Build an a url to the current node.

    $options = ['absolute' => TRUE];
    $url = Url::fromRoute('hcp_webinar_enroll.remove_user_subscription', ['node' => $node->id(), 'user' => $user->id()], $options);


  } else {

    //Build an a url with paramters to make a subscription
    $url = Url::fromRoute('hcp_webinar_enroll.enroll_user', ['user' => $user->id(), 'node' => $node->id()]);
  }

}


 


  // get the actual node and user.

  $user = \Drupal::currentUser();

}else{

  return false;

}

   return array(
    '#url' => $url,
     '#user' => $user,
     '#node' => $node,
     '#cache'  =>['max-age' => 0 ],
     '#status' => $status ,
     '#theme' => 'enroll_block',

      );
   }


 /**
 * {@inheritdoc}
 */
//public function access(AccountInterface $account) {
  //return $account->hasPermission('access content');
//}

}
