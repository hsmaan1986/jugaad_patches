<?php

namespace Drupal\nhsc_user_profile\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Login Button' block.
 *
 * @Block(
 *   id = "user_login_button_block",
 *   admin_label = @Translation("User Login Button Block"),
 * )
 */
class LoginButtonBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {

        $user = \Drupal::currentUser();
        if ($user->id() !== 0) {
            return NULL;
        }

        return [
            '#theme' => 'user_login_block',
        ];
    }
}