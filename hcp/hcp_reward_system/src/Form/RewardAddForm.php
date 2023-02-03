<?php

namespace Drupal\hcp_reward_system\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\hcp_reward_system\Plugin\RewardManager;
use Drupal\hcp_reward_system\Entity\AchivementsEntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an add form for rewards.
 */
class RewardAddForm extends RewardFormBase {

  /**
   * The reward manager.
   *
   * @var \Drupal\hcp_reward_system\RewardManager
   */
  protected $rewardManager;

  /**
   * Constructs a new RewardAddForm.
   *
   * @param \Drupal\hcp_reward_system\Plugin\RewardManager $reward_manager
   *   The reward manager.
   */
  public function __construct(RewardManager $reward_manager) {
    $this->rewardManager = $reward_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.reward')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, AchivementsEntityInterface $achivements_entity = NULL, $reward = NULL) {
    $form = parent::buildForm($form, $form_state, $achivements_entity, $reward);

    $form['#title'] = $this->t('Add %label reward', ['%label' => $this->reward->label()]);
    $form['actions']['submit']['#value'] = $this->t('Add reward');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function prepareReward($reward) {
    $reward = $this->rewardManager->createInstance($reward);
    // Set the initial weight so this reward comes last.
    //$reward->setPoints(0);
    return $reward;
  }

}
