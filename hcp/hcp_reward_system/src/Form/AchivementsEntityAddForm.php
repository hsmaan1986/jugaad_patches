<?php

namespace Drupal\hcp_reward_system\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\hcp_reward_system\Plugin\RewardManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Class AchivementsEntityForm.
*/
class AchivementsEntityAddForm extends EntityForm {

  /**
   * The entity being used by this form.
   *
   * @var \Drupal\hcp_reward_system\Plugin\RewardInterface
   */
  protected $entity;

  /**
   * The rewards manager service.
   *
   * @var \Drupal\hcp_reward_system\Plugin\RewardManager
   */
  protected $rewardManager;


  /**
   * Constructs an ImageStyleEditForm object.
   * @param \Drupal\hcp_reward_system\RewardManager $reward_manager
   *   The reward manager service.
   */
  public function __construct( RewardManager $reward_manager) {
  //  $this->achivementsStorage = $achivements_storage;
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
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

  //   kint($form);

    $achivements_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $achivements_entity->label(),
      '#description' => $this->t("Label for the Achievements entity."),
      '#required' => TRUE,
    ];

    // $form['name'] = [
    //   '#type' => 'machine_name',
    //   '#machine_name' => [
    //     'exists' => [$this->achivementsStorage, 'load'],
    //   ],
    //   '#default_value' => $this->entity->id(),
    //   '#required' => TRUE,
    // ];
     $form['name'] = [
       '#type' => 'machine_name',
       '#default_value' => $achivements_entity->id(),
       '#machine_name' => [
         'exists' => '\Drupal\hcp_reward_system\Entity\AchivementsEntity::load',
     ],
    '#disabled' => !$achivements_entity->isNew(),
     ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#maxlength' => 255,
      '#default_value' => $achivements_entity->getDescription(),
      '#description' => $this->t("Description of the Achivements entity."),
    //  '#required' => TRUE,
    ];
  /*  $form['status'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Status'),
      '#maxlength' => 255,
      '#default_value' => $achivements_entity->getStatus(),
      '#description' => $this->t("Status of the Achivements entity."),
    //  '#required' => TRUE,
    ];
    $node_bundles = $this->arrayToOptions(\Drupal::service('entity_type.manager')->getStorage('node_type')->loadMultiple());

    $form['content_types'] = [
      '#type' => 'radios',
      '#title' => $this->t('content_types'),
      '#default_value' => $achivements_entity->label(),
      '#options' => $node_bundles,
      '#default_value' => $achivements_entity->getContentTypes(),
      '#description' => $this->t("Content types related to the Achivements entity."),
    //  '#required' => TRUE,
    ];
    $point_bundles = $this->arrayToOptions(\Drupal::service('entity_type.manager')->getStorage('point_type')->loadMultiple());

    $form['point_types'] = [
      '#type' => 'radios',
      '#title' => $this->t('Point Types'),
      '#options' => $point_bundles,
      '#default_value' => $achivements_entity->getPointTypes(),
      '#description' => $this->t("Point Types of the Achivements entity."),
    //  '#required' => TRUE,
    ];

*/
    $form['image'] = [
      '#type' => 'file',
      '#title' => $this->t('Image'),
      '#default_value' => $achivements_entity->getImage(),
      '#description' => $this->t("Image of the Achievements entity."),
    ];


        return $form;
      }

        /**
         * {@inheritdoc}
         */
    //    public function save(array &$form, FormStateInterface $form_state) {
    //      parent::save($form, $form_state);
    //      drupal_set_message($this->t('Achivement %name was created.', ['%name' => $this->entity->label()]));

    //      $form_state->setRedirectUrl($this->entity->urlInfo('edit-form'));

    //    }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      parent::submitForm($form, $form_state);
      \Drupal::messenger()->addMessage($this->t('Style %name was created.', ['%name' => $this->entity->label()]), 'status');
           $form_state->setRedirectUrl($this->entity->urlInfo('edit-form'));

    }


  private  function arrayToOptions($data)
  {
    $exclude = [];
    foreach ($data as $key => $item) {


      $exclude[ str_replace("node.","",$item->id()) ] = $item->label();
    }


    return $exclude;

  }

    /**
     * {@inheritdoc}
     */
    public function actions(array $form, FormStateInterface $form_state) {
   $actions = parent::actions($form, $form_state);
    //  $actions['submit']['#value'] = $this->t('Update Reward');

      return $actions;
    }





}
