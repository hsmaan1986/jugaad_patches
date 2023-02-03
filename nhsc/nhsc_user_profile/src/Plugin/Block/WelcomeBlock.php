<?php

namespace Drupal\nhsc_user_profile\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'Welcome' block.
 *
 * @Block(
 *   id = "user_welcome_block",
 *   admin_label = @Translation("User Welcome Block"),
 * )
 */
class WelcomeBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        $uid = \Drupal::currentUser()->id();
        $user = \Drupal\user\Entity\User::load($uid);

        $honorific = $user->get('field_honorific')->value;
        $first_name = $user->get('field_first_name')->value;
        $last_name = $user->get('field_last_name')->value;
        $name = sprintf("%s %s %s", $honorific, $first_name, $last_name);

        $job_type = $user->get('field_speciality')->value;

        $city = (isset($user->get('field_address_city')->value)) ?
            $user->get('field_address_city')->value :
            $user->get('field_institution_address_city')->value;

        $state = (isset($user->get('field_address_state')->value)) ?
            $user->get('field_address_state')->value :
            $user->get('field_institution_address_state')->value;


        $location = sprintf("%s, %s", $city, $state);

        $email = $user->get('mail')->value;

        return [
            '#theme' => 'user_welcome_block',
            '#edit_url' => '/my-profile',
            '#name' => $name,
            '#job_type' => $job_type,
            '#location' => $location,
            '#email' => $email,
            '#cache' => [
                'tags' => [
                    'user:' . $uid,
                ],
                'contexts' => [
                    'user',
                ],
            ],
        ];
    }
}