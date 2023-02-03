<?php

namespace Drupal\hcp_reward_system\Plugin\Reward;

use Drupal\hcp_reward_system\Plugin\RewardBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Provides a rukles integration.
*
* @Reward(
*   id = "rules_reward",
*   label = @Translation("Rules Reward"),
*   description = @Translation("Get Remote server webhooks to validate th reward"),
* )
*/
class RulesReward extends RewardBase {

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

    $form['rule'] = [
      '#type' => 'textfield',
      '#title' => t('Rule'),
      '#size'=> 10,
      '#default_value' => $this->configuration['rule'],
      '#required' => TRUE,
      //  '#options' => $options,
    ];

    return $form;
  }

  /**
  * {@inheritdoc}
  */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);

    \Drupal::logger('reward_system')->notice(print_r( $form_state->getValue('nde'),true));

    $this->setNode($form_state->getValue('node'));
    $this->configuration['points'] = $form_state->getValue('points');

    $this->configuration['rule'] = $form_state->getValue('rule');
  }
}
