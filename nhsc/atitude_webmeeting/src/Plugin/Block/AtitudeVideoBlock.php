<?php

/**
* @file
* Contains \Drupal\atitude_webmeeting\Plugin\Block\AtitudeVideoBlock.
*/

namespace Drupal\atitude_webmeeting\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\atitude_webmeeting\Controller\ApiController;
use Drupal\atitude_webmeeting\ClientFactory;
use GuzzleHttp\Client;
/**
* Provides a 'AtitudeVideo' block.
* Get the actual node and send the webmeeting_id field to the Atitude API asking for a Video PLayer
* @Block(
*   id = "atitude_video_block",
*   admin_label = @Translation("Atitude Video block"),
*   category = @Translation("Custom Atitude Webmeeting Stream")
* )
*/
class AtitudeVideoBlock extends BlockBase {
  /**
  * {@inheritdoc}
  */
  public function build() {

    //  $node = \Drupal::routeMatch()->getParameter('node');
    $user = \Drupal::currentUser();

    //just for testing
    $body = \Drupal::formBuilder()->getForm('Drupal\atitude_webmeeting\Form\VideoForm');

    //API request
    //$content = new ApiController();

    //  $webmeeting_id = $node->site_key;
    $webmeeting_id = 'W4FXV';//TEST DATA


    //  $body = $content->get_webmeeting($webmeeting_id);

    /*
    return array(
    '#type' => 'markup',
    '#cache'  =>['max-age'  => 0 ],
    '#markup' => $body,
  );
  */

  return $body;

}


/**
* {@inheritdoc}
*/
//public function access(AccountInterface $account) {
//return $account->hasPermission('access content');
//}

}
