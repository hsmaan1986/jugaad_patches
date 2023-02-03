<?php

namespace Drupal\hcp_advice_booking\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Advice Booking entity.
 *
 * @ingroup hcp_advice_booking
 *
 * @ContentEntityType(
 *   id = "booking_entity",
 *   label = @Translation("Advice Booking"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\hcp_advice_booking\BookingEntityListBuilder",
 *     "views_data" = "Drupal\hcp_advice_booking\Entity\BookingEntityViewsData",
 *     "translation" = "Drupal\hcp_advice_booking\BookingEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\hcp_advice_booking\Form\BookingEntityForm",
 *       "add" = "Drupal\hcp_advice_booking\Form\BookingEntityForm",
 *       "edit" = "Drupal\hcp_advice_booking\Form\BookingEntityForm",
 *       "delete" = "Drupal\hcp_advice_booking\Form\BookingEntityDeleteForm",
 *     },
 *     "access" = "Drupal\hcp_advice_booking\BookingEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\hcp_advice_booking\BookingEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "booking_entity",
 *   data_table = "booking_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer advice booking entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/people/booking_entity/{booking_entity}",
 *     "add-form" = "/admin/people/booking_entity/add",
 *     "edit-form" = "/admin/people/booking_entity/{booking_entity}/edit",
 *     "delete-form" = "/admin/people/booking_entity/{booking_entity}/delete",
 *     "collection" = "/admin/people/booking_entity",
 *   },
 *   field_ui_base_route = "booking_entity.settings"
 * )
 */
class BookingEntity extends ContentEntityBase implements BookingEntityInterface
{

    use EntityChangedTrait;

    /**
     * {@inheritdoc}
     */
    public static function preCreate(EntityStorageInterface $storage_controller, array &$values)
    {
        parent::preCreate($storage_controller, $values);
        $values += [
            'user_id' => \Drupal::currentUser()->id(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->get('name')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->set('name', $name);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedTime()
    {
        return $this->get('created')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedTime($timestamp)
    {
        $this->set('created', $timestamp);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->get('user_id')->entity;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwnerId()
    {
        return $this->get('user_id')->target_id;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwnerId($uid)
    {
        $this->set('user_id', $uid);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(UserInterface $account)
    {
        $this->set('user_id', $account->id());
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isPublished()
    {
        return (bool)$this->getEntityKey('status');
    }

    /**
     * {@inheritdoc}
     */
    public function setPublished($published)
    {
        $this->set('status', $published ? TRUE : FALSE);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isMember($id)
    {
        $owner_id = $this->get('user_id')->entity;
        return ($id === $owner_id) ? TRUE : FALSE;
    }

    /**
     * {@inheritdoc}
     */
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields = parent::baseFieldDefinitions($entity_type);

        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Name'))
            ->setDescription(t('The name of the Advice Booking entity.'))
            ->setSettings([
                'max_length' => 50,
                'text_processing' => 0,
            ])
            ->setDefaultValue(t('Talk to an Expert'))
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
            ->setDisplayConfigurable('view', TRUE)
            ->setRequired(TRUE);

        $fields['booking_start'] = BaseFieldDefinition::create('datetime')
            ->setLabel(t('Start of Booking'))
            ->setRevisionable(TRUE)
            ->setSettings([
                'datetime_type' => 'datetime'
            ])
            ->setDefaultValue('')
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'datetime_default',
                'settings' => [
                    'format_type' => 'medium',
                ],
                'weight' => 14,
            ])
            ->setDisplayOptions('form', [
                'type' => 'datetime_default',
                'weight' => 1,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE)
            ->setRequired(TRUE);


        $fields['length'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Length of Booking'))
            ->setDescription(t('The time in minutes that the booking should last..'))
            ->setSettings([
                'max_length' => 50,
                'text_processing' => 0,
            ])
            ->setDefaultValue(30)
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'integer',
                'weight' => -4,
            ])
            ->setDisplayOptions('form', [
                'type' => 'integer_textfield',
                'weight' => 2,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE)
            ->setRequired(TRUE);

        $fields['booked_user_id'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('Booked by'))
            ->setDescription(t('The user ID of author of the Advice Booking entity.'))
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

        $fields['phone'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Mobile number (optional)'))
            ->setSettings([
                'max_length' => 50,
                'text_processing' => 0,
            ])
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'string',
                'weight' => 6,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 6,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['booked_about'] = BaseFieldDefinition::create('string')
            ->setLabel(t('What\'s your inquiry about?'))
            ->setSettings([
                'max_length' => 50,
                'text_processing' => 0,
            ])
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'string',
                'weight' => 6,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 6,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['booked_where'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Where do you work?'))
            ->setSettings([
                'max_length' => 50,
                'text_processing' => 0,
            ])
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'string',
                'weight' => 6,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 6,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['five_day_notification'] = BaseFieldDefinition::create('boolean')
            ->setLabel(t('Five day notification'))
            ->setDescription(t('A boolean indicating whether the a five day notification was sent.'))
            ->setDefaultValue(FALSE);

        $fields['one_day_notification'] = BaseFieldDefinition::create('boolean')
            ->setLabel(t('One day notification'))
            ->setDescription(t('A boolean indicating whether the a 24 hour notification was sent.'))
            ->setDefaultValue(FALSE);
        
        $fields['status'] = BaseFieldDefinition::create('boolean')
            ->setLabel(t('Publishing status'))
            ->setDescription(t('A boolean indicating whether the Advice Booking is published.'))
            ->setDefaultValue(TRUE);
        $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('Created by'))
            ->setDescription(t('The user ID of author of the Advice Booking entity.'))
            ->setRevisionable(TRUE)
            ->setSetting('target_type', 'user')
            ->setSetting('handler', 'default')
            ->setTranslatable(TRUE)
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }

}
