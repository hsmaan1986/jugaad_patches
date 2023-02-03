<?php

namespace Drupal\hcp_webinar_enroll\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Subscription entity.
 *
 * @ingroup hcp_webinar_enroll
 *
 * @ContentEntityType(
 *   id = "subscription",
 *   label = @Translation("Subscription"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\hcp_webinar_enroll\SubscriptionListBuilder",
 *     "views_data" = "Drupal\hcp_webinar_enroll\Entity\SubscriptionViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\hcp_webinar_enroll\Form\SubscriptionForm",
 *       "add" = "Drupal\hcp_webinar_enroll\Form\SubscriptionForm",
 *       "edit" = "Drupal\hcp_webinar_enroll\Form\SubscriptionForm",
 *       "delete" = "Drupal\hcp_webinar_enroll\Form\SubscriptionDeleteForm",
 *     },
 *     "access" = "Drupal\hcp_webinar_enroll\SubscriptionAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\hcp_webinar_enroll\SubscriptionHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "subscription",
 *   admin_permission = "administer subscription entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/subscription/{subscription}",
 *     "add-form" = "/admin/structure/subscription/add",
 *     "edit-form" = "/admin/structure/subscription/{subscription}/edit",
 *     "delete-form" = "/admin/structure/subscription/{subscription}/delete",
 *     "collection" = "/admin/structure/subscription",
 *   },
 *   field_ui_base_route = "subscription.settings"
 * )
 */
class Subscription extends ContentEntityBase implements SubscriptionInterface {

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
  public function getNodeId() {
    return $this->get('node_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function getNode() {
    return $this->get('node_id')->entity;
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
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Subscription entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Subscription entity.'))
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



            $fields['points'] = BaseFieldDefinition::create('integer')
              ->setLabel(t('Points'))
              ->setDescription(t('points of the Subscription entity.'))
              ->setRevisionable(TRUE)
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



                $fields['node_id'] = BaseFieldDefinition::create('entity_reference')
                ->setLabel(t('Content'))
                ->setDescription(t('The Content of the associated user.'))
                ->setSetting('target_type', 'node')
                ->setSetting('handler', 'default')
                ->setDisplayOptions('view', array(
                'label' => 'above',
                'type' => 'node',
                'weight' => -3,
                ))
                ->setDisplayOptions('form', array(
                'type' => 'entity_reference_autocomplete',
                'settings' => array(
                'match_operator' => 'CONTAINS',
                'size' => 60,
                'placeholder' => '',
                ),
                'weight' => -3,
                ))
                ->setDisplayConfigurable('form', TRUE)
                ->setDisplayConfigurable('view', TRUE);


    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Subscription is published.'))
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
