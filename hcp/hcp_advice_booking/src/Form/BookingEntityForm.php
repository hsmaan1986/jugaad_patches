<?php

namespace Drupal\hcp_advice_booking\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Advice Booking edit forms.
 *
 * @ingroup hcp_advice_booking
 */
class BookingEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\hcp_advice_booking\Entity\BookingEntity */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        \Drupal::messenger()->addMessage($this->t('Created the %label Advice Booking.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        \Drupal::messenger()->addMessage($this->t('Saved the %label Advice Booking.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.booking_entity.canonical', ['booking_entity' => $entity->id()]);
  }

}
