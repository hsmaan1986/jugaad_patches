<?php

namespace Drupal\nhsc_popup\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "nhsc_popup_block",
 *   admin_label = @Translation("Nhsc Popup block"),
 * )
 */
class NhscPopupBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('nhsc_popup.adminsettings');
    $link_url = $config->get('url_name');
    return [
      '#markup' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['nhsc_popup_settings'] = $form_state->getValue('nhsc_popup_settings');
  }
}
