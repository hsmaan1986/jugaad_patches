<?php

namespace Drupal\hcp_reward_system\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\SubformState;
use Drupal\hcp_reward_system\Plugin\RewardInterface;
use Drupal\hcp_reward_system\Entity\AchivementsEntityInterface;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Provides a base form for hcp_reward_system rewards.
 */
abstract class RewardFormBase extends FormBase {

  /**
   * The reward.
   *
   * @var \Drupal\hcp_reward_system\Entity\AchivementsEntityInterface
   */
  protected $achivementsEntity;

  /**
   * The hcp_reward_system reward.
   *
   * @var \Drupal\hcp_reward_system\RewardInterface|\Drupal\hcp_reward_system\ConfigurableRewardInterface
   */
  protected $reward;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'reward_form';
  }

  /**
   * {@inheritdoc}
   *
   * @param \Drupal\hcp_reward_system\Entity\AchivementsEntityInterface $achivements_entity
   *   The reward.
   * @param string $reward
   *   The hcp_reward_system reward ID.
   *
   * @return array
   *   The form structure.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
   */
  public function buildForm(array $form, FormStateInterface $form_state, AchivementsEntityInterface $achivements_entity = NULL, $reward = NULL) {

     $this->achivementsEntity = $achivements_entity;
    try {
      $this->reward = $this->prepareReward($reward);
    }
    catch (PluginNotFoundException $e) {
      throw new NotFoundHttpException("Invalid reward id: '$reward'.");
    }
    $request = $this->getRequest();

    if (!($this->reward instanceof RewardInterface)) {
      throw new NotFoundHttpException();
    }

    $form['#attached']['library'][] = 'hcp_reward_system/admin';
    $form['uuid'] = [
      '#type' => 'value',
      '#value' => $this->reward->getUuid(),
    ];
    $form['id'] = [
      '#type' => 'value',
      '#value' => $this->reward->getPluginId(),
    ];

$form['data'] = [];

        $form['data']['points'] = [
          '#type' => 'textfield',
          '#title' => t('points'),
          '#size'=> 10,
          '#default_value' => $request->query->has('points') ? (int) $request->query->get('points') : $this->reward->getPoints(),
          '#required' => TRUE,
        //  '#options' => $options,
        ];

        $form['data']['node'] = [
          '#type' => 'entity_autocomplete',
          '#target_type' => 'node',
          '#title' => $this->t('Contenido '),
           '#size' => 50,
           '#default_value' => \Drupal\node\Entity\Node::load($this->reward->getNode()),

          '#attributes' => [
            'class' => ['reward-order-node'],
          ],
        ];

    $subform_state = SubformState::createForSubform($form['data'], $form, $form_state);
    $form['data'] = $this->reward->buildConfigurationForm($form['data'], $subform_state);
    $form['data']['#tree'] = TRUE;




    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#button_type' => 'primary',
    ];
    $form['actions']['cancel'] = [
      '#type' => 'link',
      '#title' => $this->t('Cancel'),
    '#url' => $this->achivementsEntity->toUrl('edit-form'),
      '#attributes' => ['class' => ['button']],
    ];



    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // The hcp_reward_system reward configuration is stored in the 'data' key in the form,
    // pass that through for validation.

    $this->reward->validateConfigurationForm($form['data'], SubformState::createForSubform($form['data'], $form, $form_state));
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {




    $form_state->cleanValues();
    $this->reward->setNode($form_state->getValue('data')['node']);
     $this->reward->setPoints($form_state->getValue('data')['points']);
    // The hcp_reward_system reward configuration is stored in the 'data' key in the form,
    // pass that through for submission.
    $this->reward->submitConfigurationForm($form['data'], SubformState::createForSubform($form['data'], $form, $form_state));

   \Drupal::logger('reward_system')->notice(print_r($this->reward->getConfiguration(),true));


    if (!$this->reward->getUuid()) {
      $this->achivementsEntity->addReward($this->reward->getConfiguration());
    }else {
  //    $this->reward->save();

    }
    $this->achivementsEntity->save();

    \Drupal::messenger()->addMessage('The reward was successfully applied.', 'status');
    $form_state->setRedirectUrl($this->achivementsEntity->toUrl('edit-form'));
  }

  /**
   * Converts an hcp_reward_system reward ID into an object.
   *
   * @param string $hcp_reward_system_reward
   *   The hcp_reward_system reward ID.
   *
   * @return \Drupal\hcp_reward_system\RewardInterface
   *   The reward object.
   */
  abstract protected function prepareReward($reward);

}
