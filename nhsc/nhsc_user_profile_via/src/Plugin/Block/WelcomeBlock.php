<?php

namespace Drupal\nhsc_user_profile_via\Plugin\Block;

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

        $place_of_work  = $user->get('field_region_of_work')->value;
        $city           = $user->get('field_address_city')->value;
        $country        = $user->get('field_country')->value;
        $location       = sprintf("%s, %s", ucwords($place_of_work), ucwords($country));
        $email          = $user->get('mail')->value;

        return [
            '#theme' => 'user_welcome_block',
            '#edit_url' => 'my-profile',
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