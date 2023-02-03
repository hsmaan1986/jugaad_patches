<?php

namespace Drupal\nhsc_webform_email_handler\Plugin\WebformHandler;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\Plugin\WebformHandlerBase;
use Drupal\Component\Utility\Html;
use Drupal\webform\WebformSubmissionInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Webform validate handler.
 *
 * @WebformHandler(
 *   id = "nhsc_webform_email_handler",
 *   label = @Translation("Alter webform to validate it"),
 *   category = @Translation("Settings"),
 *   description = @Translation("Form alter to validate it."),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_SINGLE,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 *   submission = \Drupal\webform\Plugin\WebformHandlerInterface::SUBMISSION_OPTIONAL,
 * )
 */
class EmailWebformHandler extends WebformHandlerBase {
     /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state, WebformSubmissionInterface $webform_submission) {
        $this->validateDisclaimer($form_state);
    }

    /**
   * Validate phone.
   */
  private function validateDisclaimer(FormStateInterface $formState) {
    $value = !empty($formState->getValue('email_address')) ? Html::escape($formState->getValue('email_address')) : NULL;

    // Skip empty unique fields or arrays (aka #multiple).
    if (empty($value) || is_array($value)) {
      return;
    }
    if (!\Drupal::service('email.validator')->isValid($value)) {
      $formState->setErrorByName('email_address', $this->t('Please enter a valid email address'));
    }
    else {
      $formState->setValue('email_address', $value);
    }
  }


}