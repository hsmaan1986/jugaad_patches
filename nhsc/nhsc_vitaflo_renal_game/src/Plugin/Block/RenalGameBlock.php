<?php

namespace Drupal\nhsc_vitaflo_renal_game\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Renal Game Block' block.
 *
 * @Block(
 *   id = "renal_game_block",
 *   admin_label = @Translation("Renal Game Block"),
 * )
 */
class RenalGameBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        return [
            '#theme' => 'renal_game_block',
        ];
    }
}