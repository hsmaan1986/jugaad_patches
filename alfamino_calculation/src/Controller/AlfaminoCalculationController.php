<?php

namespace Drupal\alfamino_calculation\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for alfamino_calculation routes.
 */
class AlfaminoCalculationController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    return [
      '#theme' => 'alfamino-calculation',
      '#test_var' => $this->t('Test Value'),
    ];
  }

}
