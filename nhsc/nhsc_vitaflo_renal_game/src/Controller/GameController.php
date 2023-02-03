<?php
namespace Drupal\nhsc_vitaflo_renal_game\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Renal Game module.
 */
class GameController extends ControllerBase {

    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function gamePage() {
        $element = [
            '#type' => 'markup',
            '#markup' => null,
        ];

        return $element;
    }

}