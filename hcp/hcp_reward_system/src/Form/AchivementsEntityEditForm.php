<?php

namespace Drupal\hcp_reward_system\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\hcp_reward_system\Plugin\RewardManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
* Class AchivementsEntityForm.
*/
class AchivementsEntityEditForm extends EntityForm {

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
        //  $container->get('entity_type.manager')->getStorage('image_style'),
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
      $form['id'] = [
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


  // Build the list of existing image rewards for this image style.
  $form['rewards'] = [
    '#type' => 'table',
    '#header' => [
      $this->t('Content'),
      $this->t('Plugin/Behaivor'),
      $this->t('Points'),
      $this->t('Tools'),

    ],

    '#empty' => t('There are currently no rewards in this acivement. Add one by selecting an option below.'),

  ];

  //  kint($this->entity);
  foreach ($this->entity->getRewards() as $reward) {


    $key = $reward->getUuid();
     //  $form['rewards'][$key]['#points'] = isset($user_input['rewards']) ? $user_input['rewards'][$key]['points'] : NULL;

    $summary = $reward->getSummary();
    $node = \Drupal\node\Entity\Node::load($reward->getNode());
    $node_link = !empty($node) ? $node->title->value : 'PLEASE SELECT THE CONTENT FOR THIS REWARD';
    if (!empty($summary)) {
      $summary['#prefix'] = ' ';
  //    $form['rewards'][$key]['reward']['data']['summary'] = $summary;
    }

    $form['rewards'][$key]['node'] = [
      '#tree' => FALSE,
      'data' => [
        'label' => [
          '#plain_text' => $node_link  ,
        ],
      ],
    ];

    $form['rewards'][$key]['reward'] = [
      'data' => [
        'label' => [
          '#plain_text' => $reward->label(),
        ],
      ],
    ];
    $form['rewards'][$key]['points'] = [
      'data' => [
        'label' => [
          '#plain_text' => $reward->getPoints(),
        ],
      ],
    ];
    kint($reward);



    $links = [];
    //  if ($is_configurable) {
    $links['edit'] = [
      'title' => $this->t('Edit'),
      'url' => Url::fromRoute('hcp_reward_system.reward_edit_form', [
        'achivements_entity' => $this->entity->id(),
        'reward' => $key,
      ]),
    ];
    //  }
    $links['delete'] = [
      'title' => $this->t('Delete'),
      'url' => Url::fromRoute('hcp_reward_system.reward_delete', [
        'achivements_entity' => $this->entity->id(),
        'reward' => $key,
      ]),
    ];
    $form['rewards'][$key]['tools'] = [
      '#type' => 'operations',
      '#links' => $links,
    ];
  }

  // Build the new image reward addition form and add it to the reward list.
  $new_reward_options = [];
  $rewards = $this->rewardManager->getDefinitions();
  uasort($rewards, function ($a, $b) {
    //  return Unicode::strcasecmp($a['label'], $b['label']);
  });
  foreach ($rewards as $reward => $definition) {
    $new_reward_options[$reward] = $definition['label'];
  }
  $form['rewards']['new'] = [
    '#tree' => FALSE,
    //'#points' => isset($user_input['points']) ? $user_input['points'] : NULL,
    '#attributes' => ['class' => ['draggable']],
  ];
  $form['rewards']['new']['reward'] = [
    'data' => [
      'new' => [
        '#type' => 'select',
        '#title' => $this->t('Reward behavior'),
        '#title_display' => 'invisible',
        '#options' => $new_reward_options,
        '#empty_option' => $this->t('Select a new reward behavior'),
      ],

    ],
    '#prefix' => '<div class="image-style-new">',
    '#suffix' => '</div>',
  ];

  $form['rewards']['new']['tools'] = [
    'add' => [
      '#type' => 'submit',
      '#value' => $this->t('Add new Reward'),
      '#validate' => ['::rewardValidate'],
      '#submit' => ['::submitForm', '::rewardSave'],
    ],
  ];

  // $form['rewards']['new']['node'] = [
  //   '#type' => 'entity_autocomplete',
  //   '#target_type' => 'node',
  //   '#title' => $this->t('Node '),
  //   '#title_display' => 'invisible',
  //   '#size' => 50,
  // //  '#default_value' => $reward->getPoints(),
  //   '#attributes' => [
  //     'class' => ['image-reward-order-node'],
  //   ],
  // ];




  return $form;
  }

  /**
  * Validate handler for image reward.
  */
  public function rewardValidate($form, FormStateInterface $form_state) {
    if (!$form_state->getValue('new')) {
      $form_state->setErrorByName('new', $this->t('Select an reward to add.'));
    }
  }

  /**
  * Submit handler for  reward.
  */
  public function rewardSave($form, FormStateInterface $form_state) {
    $this->save($form, $form_state);


    // Check if this field has any configuration options.
    $reward = $this->rewardManager->getDefinition($form_state->getValue('new'));
    // Load the configuration form for this option.
    $form_state->setRedirect(
      'hcp_reward_system.reward_add_form',
      [
        'achivements_entity' => $this->entity->id(),
        'reward' => $form_state->getValue('new'),
      ],
      ['query' => ['points' => $form_state->getValue('points')]]
    );


  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Update points.
    if (!$form_state->isValueEmpty('rewards')) {
      $this->updateRewardsPoints($form_state->getValue('rewards'));
    }

    parent::submitForm($form, $form_state);


  }


  /**
  * {@inheritdoc}
  */
  public function save(array $form, FormStateInterface $form_state) {
    $achivements_entity = $this->entity;
    $status = '';
    $status =  parent::save($form, $form_state);


    switch ($status) {
      case SAVED_NEW:
      \Drupal::messenger()->addMessage($this->t('Created the %label Achivements entity.', [
        '%label' => $achivements_entity->label(),
      ]));
      break;

      default:
      \Drupal::messenger()->addMessage($this->t('Saved the %label Achivements entity.', [
        '%label' => $status,
      ]));
      $form_state->setRedirectUrl($this->entity->urlInfo('edit-form'));

    }

    $form_state->setRedirectUrl($this->entity->urlInfo('edit-form'));
    //  $form_state->setRedirectUrl($achivements_entity->toUrl('collection'));
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
    $actions['submit']['#value'] = $this->t('Update Reward');

    return $actions;
  }


  /**
  * Updates image effect weights.
  *
  * @param array $effects
  *   Associative array with effects having effect uuid as keys and array
  *   with effect data as values.
  */
  protected function updateRewardsPoints(array $rewards) {
    foreach ($rewards as $uuid => $reward_data) {
      \Drupal::logger('reward_system')->notice(print_r( $reward_data,true));


      if ($this->entity->getRewards()->has($uuid)) {
        $this->entity->getReward($uuid)->setPoints($reward_data['points']);
      }
    }
  }


}
