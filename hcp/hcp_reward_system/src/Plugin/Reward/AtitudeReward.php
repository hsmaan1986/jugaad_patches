<?php

namespace Drupal\hcp_reward_system\Plugin\Reward;

use Drupal\hcp_reward_system\Plugin\RewardBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a rukles integration.
 *
 * @Reward(
 *   id = "atitude_reward",
 *   label = @Translation("Atitude Reward"),
 *   description = @Translation("Get Remote server webhooks to validate th reward"),
 * )
 */
class AtitudeReward extends RewardBase {

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

        $form['percentage'] = [
          '#type' => 'textfield',
          '#title' => t('Percentage'),
          '#size'=> 10,
          '#default_value' => $this->configuration['percentage'],
          '#required' => TRUE,
        //  '#options' => $options,
        ];

        $form['rewards']['new']['file'] = [
          '#type' => 'file',
          '#title' => $this->t('PDF Template '),
          '#title_display' => 'invisible',
        //  '#default_value' => $reward->getPoints(),
          '#attributes' => [
            'class' => ['image-reward-order-node'],
          ],
        ];

        return $form;
      }

      /**
       * {@inheritdoc}
       */
      public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
      parent::submitConfigurationForm($form, $form_state);


        $this->configuration['percentage'] = $form_state->getValue('percentage');
      }
}
