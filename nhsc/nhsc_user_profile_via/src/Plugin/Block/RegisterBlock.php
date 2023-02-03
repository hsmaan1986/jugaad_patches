<?php

namespace Drupal\nhsc_user_profile_via\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Registration Form' block.
 *
 * @Block(
 *   id = "user_register_block",
 *   admin_label = @Translation("User Register Form Block"),
 * )
 */
class RegisterBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        $builtForm = \Drupal::FormBuilder()->getForm('Drupal\nhsc_user_profile_via\Form\RegisterForm');
        $renderArray['form'] = $builtForm;

        return $renderArray;
    }
}