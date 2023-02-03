<?php

namespace Drupal\persentil_calculation\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for persentil_calculation routes.
 */
class PersentilCalculationController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    return [
      '#theme' => 'persentil-calculation',
      '#test_var' => $this->t('Test Value'),
    ];
  }

}
