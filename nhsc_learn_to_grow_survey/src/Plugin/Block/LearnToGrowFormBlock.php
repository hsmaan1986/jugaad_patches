<?php


namespace Drupal\nhsc_learn_to_grow_survey\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\nhsc_comiss_score_survey\Controller\ComissScoreController;
use Drupal\nhsc_learn_to_grow_survey\Controller\LearnToGrowController;


/**
 * Provides a 'Learn to Grow' Block.
 *
 * @Block(
 *   id = "learn_to_grow_survey_block",
 *   admin_label = @Translation("Learn To Grow Survey Block"),
 *   status = 1,
 *
 * )
 */


class LearnToGrowFormBlock extends BlockBase
{
    public function build()
    {
        $controller     = new LearnToGrowController();
        $renderInBlock  = $controller->surveyForm();

        return $renderInBlock;
    }
}