<?php


namespace Drupal\nhsc_symptom_checker\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\nhsc_symptom_checker\Controller\SymptomCheckerController;

/**
 * Provides a 'Symptom Checker' Block.
 *
 * @Block(
 *   id = "nhsc_symptom_checker",
 *   admin_label = @Translation("Symptom Checker Block"),
 *   status = 1,
 * )
 */

class SymptomCheckerFormBlock extends BlockBase
{
    public function build()
    {
        $controller     = new SymptomCheckerController();
        $renderInBlock  = $controller->getSymptomCheckerForm();

        return $renderInBlock;
    }
}