<?php

namespace Drupal\lcp_migrations\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides configurations for Migrations.
 */
class MigrationsConfigurations extends FormBase {

  /**
   * The Drupal state storage service.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * Constructs an NestleEventConfigForm object.
   *
   * @param \Drupal\Core\State\StateInterface $state
   *   The state service.
   */
  public function __construct(StateInterface $state) {
    $this->state = $state;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('state')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'lcp_migrations_configurations_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $source_directory = $this->state->get('lcp_migrations.source_directory', '');

    $form['source_directory'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Source Directory'),
      '#default_value' => $source_directory,
      '#description' => $this->t('Source directory relative to the drupal private folder. Eg: "nestle_it", "source/nestle_it".'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->cleanValues();
    $this->state->set('lcp_migrations.source_directory', $form_state->getValue('source_directory'));
    \Drupal::messenger()->addMessage($this->t('Your configuration have been saved.'), 'status');
  }

}
