<?php

namespace Drupal\nhsc_protein_calculator\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'ProteinCalculatorBlock' block.
 *
 * @Block(
 *  id = "protein_calculator_block",
 *  admin_label = @Translation("Protein calculator block"),
 * )
 */
class ProteinCalculatorBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $build = \Drupal::formBuilder()->getForm('Drupal\nhsc_protein_calculator\Form\ProteinCalculatorForm');

    return $build;

  }

}
