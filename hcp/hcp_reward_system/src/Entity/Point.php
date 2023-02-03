<?php

namespace Drupal\hcp_reward_system\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Point entity.
 *
 * @ingroup hcp_reward_system
 *
 * @ContentEntityType(
 *   id = "point",
 *   label = @Translation("Point"),
 *   bundle_label = @Translation("Point type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\hcp_reward_system\PointListBuilder",
 *     "views_data" = "Drupal\hcp_reward_system\Entity\PointViewsData",
 *     "translation" = "Drupal\hcp_reward_system\PointTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\hcp_reward_system\Form\PointForm",
 *       "add" = "Drupal\hcp_reward_system\Form\PointForm",
 *       "edit" = "Drupal\hcp_reward_system\Form\PointForm",
 *       "delete" = "Drupal\hcp_reward_system\Form\PointDeleteForm",
 *     },
 *     "access" = "Drupal\hcp_reward_system\PointAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\hcp_reward_system\PointHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "point",
 *   data_table = "point_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer point entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/point/{point}",
 *     "add-page" = "/admin/structure/point/add",
 *     "add-form" = "/admin/structure/point/add/{point_type}",
 *     "edit-form" = "/admin/structure/point/{point}/edit",
 *     "delete-form" = "/admin/structure/point/{point}/delete",
 *     "collection" = "/admin/structure/point",
 *   },
 *   bundle_entity_type = "point_type",
 *   field_ui_base_route = "entity.point_type.edit_form"
 * )
 */
class Point extends ContentEntityBase implements PointInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
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
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User ID'))
      ->setDescription(t('The user ID of author of the Point entity.'))
      ->setRevisionable(FALSE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(FALSE)
      ->setReadOnly(TRUE)
      // ->setDisplayOptions('view', [
      //   'label' => 'hidden',
      //   'type' => 'author',
      //   'weight' => 0,
      // ])
      // ->setDisplayOptions('form', [
      //   'type' => 'entity_reference_autocomplete',
      //   'weight' => 5,
      //   'settings' => [
      //     'match_operator' => 'CONTAINS',
      //     'size' => '60',
      //     'autocomplete_type' => 'tags',
      //     'placeholder' => '',
      //   ],
      // ])
    //  ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Point entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

      $fields['reward_points'] = BaseFieldDefinition::create('decimal')
        ->setLabel(t('Reward points'))
        ->setReadOnly(TRUE)
        ->setDisplayConfigurable('view', TRUE);

        $fields['reason'] = BaseFieldDefinition::create('string')
          ->setLabel(t('Reason'))
          ->setDescription(t('Reason for reward points given to a user.'))
          ->setSettings([
            'max_length' => 256,
            'text_processing' => 0,
          ])
          ->setDefaultValue('')
          ->setDisplayOptions('view', [
            'label' => 'inline',
            'type' => 'string',
            'weight' => -4,
          ])
          ->setDisplayOptions('form', [
            'type' => 'string_textfield',
            'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);


    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Point is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
