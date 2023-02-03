<?php

namespace Drupal\hcp_reward_system\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PointTypeForm.
 */
class PointTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $point_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $point_type->label(),
      '#description' => $this->t("Label for the Point type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $point_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\hcp_reward_system\Entity\PointType::load',
      ],
      '#disabled' => !$point_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $point_type = $this->entity;
    $status = $point_type->save();

    switch ($status) {
      case SAVED_NEW:
        \Drupal::messenger()->addMessage($this->t('Created the %label Point type.', [
          '%label' => $point_type->label(),
        ]));
        break;

      default:
        \Drupal::messenger()->addMessage($this->t('Saved the %label Point type.', [
          '%label' => $point_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($point_type->toUrl('collection'));
  }

}
