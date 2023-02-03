<?php


namespace Drupal\nhsc_learn_to_grow_survey\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\nhsc_learn_to_grow_survey\Controller\LearnToGrowController;


/**
 * Provides a 'Learn to Grow Results' Block.
 *
 * @Block(
 *   id = "learn_to_grow_results_block",
 *   admin_label = @Translation("Learn To Grow Results Block"),
 *   status = 1,
 *   region = "hiddenblocks"
 *
 * )
 */


class LearnToGrowResultsBlock extends BlockBase
{
    public function build()
    {
        $controller     = new LearnToGrowController();
        $renderInBlock  = $controller->getResultsPage();

        return $renderInBlock;
    }
}