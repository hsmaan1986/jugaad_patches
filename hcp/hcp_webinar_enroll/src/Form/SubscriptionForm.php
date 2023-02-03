<?php

namespace Drupal\hcp_webinar_enroll\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Subscription edit forms.
 *
 * @ingroup enroll
 */
class SubscriptionForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\hcp_webinar_enroll\Entity\Subscription */
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
        \Drupal::messenger()->addMessage($this->t('Created the %label Subscription.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        \Drupal::messenger()->addMessage($this->t('Saved the %label Subscription.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.subscription.canonical', ['subscription' => $entity->id()]);
  }

}
