<?php


namespace Drupal\nhsc_cerebral_palsy_tool\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'CerebralPalsyBackBlock' block.
 *
 * @Block(
 *  id = "cerebral_palsy_back_block",
 *  admin_label = @Translation("Cerebral palsy Back Button"),
 * )
 */
class CerebralPalsyBackBlock extends BlockBase
{
  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

  /**
   * {@inheritdoc}
   *
   */
  public function build()
  {

    return [
      '#theme' => 'nhsc_my_child_with_cp_back',
      '#url' => '#',
    ];
  }

}
