<?php

namespace Drupal\hcp_reward_system\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\hcp_reward_system\Plugin\RewardManager;
use Drupal\hcp_reward_system\Entity\AchivementsEntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an add form for rewards.
 */
class RewardEditForm extends RewardFormBase {


  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, AchivementsEntityInterface $achivements_entity = NULL, $reward = NULL) {
    $form = parent::buildForm($form, $form_state, $achivements_entity, $reward);

    $form['#title'] = $this->t('Edit %label reward', ['%label' => $this->reward->label()]);
    $form['actions']['submit']['#value'] = $this->t('Update reward');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function prepareReward($reward) {
    $reward = $this->achivementsEntity->getReward($reward);

    return $reward;
  }

}
