<?php


namespace Drupal\nhsc_self_assessment_survey\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\nhsc_self_assessment_survey\Controller\SelfAssessmentController;



/**
 * Provides a 'Self Assessment Survey' Block.
 *
 * @Block(
 *   id = "self_assessment_survey_block",
 *   admin_label = @Translation("Self Assessment Survey Block"),
 *   status = 1,
 * )
 */

class SelfAssessmentSurveyFormBlock extends BlockBase
{
    public function build()
    {
        $controller     = new SelfAssessmentController();
        $renderInBlock  = $controller->getSelfAssessmentForm();

        return $renderInBlock;
    }
}