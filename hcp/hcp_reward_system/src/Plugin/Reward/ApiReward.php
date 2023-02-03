<?php

namespace Drupal\hcp_reward_system\Plugin\Reward;

use Drupal\hcp_reward_system\Plugin\RewardBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a ham sandwich.
 *
 * @Reward(
 *   id = "API Response",
 *    label = @Translation("API Response"),
 *   description = @Translation("API Response.")
 *)
 */
class ApiReward extends RewardBase {
  /**
   * {inheritdoc}
   */
  public function validate($user) {

    if ($user->isSuscribed() && $user->alreadyRewarded($reward)) {
        $valid = true;

     }
    return $valid;
  }

  /**
   * {inheritdoc}
   */
  public function giveRewardToUser($user, $reason, $quantity) {

      parent::giveRewardToUser($user);


    return true;
  }




        /**
         * {@inheritdoc}
         */
        public function buildConfigurationForm(array $form, FormStateInterface $form_state) {

          $form['endpoint'] = [
            '#type' => 'textfield',
            '#title' => t('Endpoint'),
            '#default_value' => $this->configuration['endpoint'],
            '#required' => TRUE,
          ];


          return $form;
        }

        /**
         * {@inheritdoc}
         */
        public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
          parent::submitConfigurationForm($form, $form_state);
          $this->configuration['endpoint'] = $form_state->getValue('endpoint');
        }
}
