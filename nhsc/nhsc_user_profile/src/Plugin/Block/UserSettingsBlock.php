<?php

namespace Drupal\nhsc_user_profile\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'User Settings Form' block.
 *
 * @Block(
 *   id = "user_settings_block",
 *   admin_label = @Translation("User Settings Block"),
 * )
 */
class UserSettingsBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        $builtForm = \Drupal::FormBuilder()->getForm('Drupal\nhsc_user_profile\Form\UserSettingsForm');
        $renderArray['form'] = $builtForm;

        return $renderArray;
    }
}