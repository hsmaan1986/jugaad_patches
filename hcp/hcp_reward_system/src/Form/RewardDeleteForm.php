<?php

namespace Drupal\hcp_reward_system\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\hcp_reward_system\Plugin\RewardInterface;
use Drupal\hcp_reward_system\Entity\AchivementsEntityInterface;

/**
 * Form for deleting an achivementsEntity.
 */
class RewardDeleteForm extends ConfirmFormBase {

  /**
   * The  achivement containing the achivementsEntity to be deleted.
   *
   * @var \Drupal\hcp_reward_system\Entity\AchivementsEntityInterface
   */
  protected $achivementsEntity;

  /**
   * The achivementsEntity to be deleted.
   *
   * @var \Drupal\hcp_reward_system\RewardInterface
   */
  protected $reward;

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the @reward reward from the %achivement achivement?', ['%achivement' => $this->achivementsEntity->label(), '@reward' => $this->reward->label()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return $this->achivementsEntity->toUrl('edit-form');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'image_reward_delete_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, AchivementsEntityInterface $achivements_entity = NULL, $reward = NULL) {
    $this->achivementsEntity = $achivements_entity;
    $this->reward = $this->achivementsEntity->getReward($reward);

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->achivementsEntity->deleteReward($this->reward);
    \Drupal::messenger()->addMessage($this->t('The achivementsEntity %name has been deleted.', ['%name' => $this->reward->label()]));
    $form_state->setRedirectUrl($this->achivementsEntity->toUrl('edit-form'));
  }

}
