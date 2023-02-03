<?php

namespace Drupal\hcp_reward_system\Entity;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityWithPluginCollectionInterface;
use Drupal\hcp_reward_system\Plugin\RewardsCollection;
use Drupal\hcp_reward_system\Plugin\RewardInterface;
use Drupal\hcp_reward_system\Entity\AchivementsEntityInterface;

/**
* Defines the Achivements entity entity.
*
* @ConfigEntityType(
*   id = "achivements_entity",
*   label = @Translation("Achivements entity"),
*   handlers = {
*     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
*     "list_builder" = "Drupal\hcp_reward_system\AchivementsEntityListBuilder",
*     "form" = {
*       "add" = "Drupal\hcp_reward_system\Form\AchivementsEntityAddForm",
*       "edit" = "Drupal\hcp_reward_system\Form\AchivementsEntityEditForm",
*       "delete" = "Drupal\hcp_reward_system\Form\AchivementsEntityDeleteForm"
*     },
*     "route_provider" = {
*       "html" = "Drupal\hcp_reward_system\AchivementsEntityHtmlRouteProvider",
*     },
*   },
*   config_prefix = "achivements_entity",
*   admin_permission = "administer site configuration",
*   entity_keys = {
*     "id" = "name",
*     "label" = "label",
*     "uuid" = "uuid"
*   },
*   links = {
*     "edit-form" = "/admin/config/hcp_reward_system/achivements/{achivements_entity}",
*     "delete-form" = "/admin/config/hcp_reward_system/achivements/{achivements_entity}/delete",
*     "collection" = "/admin/config/hcp_reward_system/achivements"
*   },
*   config_export = {
*     "name",
*     "label",
*     "rewards",
*   }
* )
*/
class AchivementsEntity extends ConfigEntityBase implements AchivementsEntityInterface, EntityWithPluginCollectionInterface {

  /**
  * The Achivements entity ID.
  *
  * @var string
  */
  protected $name;

  /**
  * The Achivements entity label.
  *
  * @var string
  */
  public $label;

  /**
  * The Achivements entity title.
  *
  * @var string
  */
  public $title;

  /**
  * The Achivement Description.
  *
  * @var string
  */
  public $description;

  /**
  * The Achivements status.
  *
  * @var string
  */
  public $status;

  /**
  * The Achivements content_types.
  *
  * @var array
  */
  public $content_types;

  /**
  * The array of rewards for this image style.
  *
  * @var array
  */
  public $rewards = [];

  /**
  * Holds the collection of rewards that are used by this image style.
  *
  * @var \Drupal\hcp_reward_system\Plugin\RewardsCollection
  */
  public $rewardsCollection;


  /**
  * The Achivements Point Types.
  *
  * @var array
  */
  public $point_types;

  /**
  * The Achivements image.
  *
  * @var image
  */
  public $image;

  /**
  * {@inheritdoc}
  */
  public function id() {
    return $this->name;
  }

  public function getContentTypes() {
    return $this->content_types;
  }

  public function getPointTypes() {
    return $this->point_types;
  }

  public function getDescription() {
    return $this->description;
  }
  public function getStatus() {
    return $this->status;
  }

  public function getImage() {
    return $this->image;
  }

  /**
  * {@inheritdoc}
  */
  public function getReward($reward) {
    return $this->getRewards()->get($reward);
  }

  /**
  * {@inheritdoc}
  */
  public function getRewards() {
    if (!$this->rewardsCollection) {

      $this->rewardsCollection = new RewardsCollection($this->getRewardPluginManager(), $this->rewards);
      $this->rewardsCollection->sort();
    }


    return $this->rewardsCollection;
  }
  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name');
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }
  /**
  * {@inheritdoc}
  */
  public function getPluginCollections() {
    return ['rewards' => $this->getRewards()];
  }

  /**
  * {@inheritdoc}
  */
  public function addReward(array $configuration) {
    //kint($configuration);
    $configuration['uuid'] = $this->uuidGenerator()->generate();
    $this->getRewards()->addInstanceId($configuration['uuid'], $configuration);
    return $configuration['uuid'];
  }

  /**
  * {@inheritdoc}
  */
  public function deleteReward(RewardInterface $reward) {
    $this->getRewards()->removeInstanceId($reward->getUuid());
    $this->save();
    return $this;
  }




  /**
  * Returns the reward plugin manager.
  *
  * @return \Drupal\Component\Plugin\PluginManagerInterface
  *   The reward plugin manager.
  */
  protected function getRewardPluginManager() {
    return \Drupal::service('plugin.manager.reward');
  }



}
