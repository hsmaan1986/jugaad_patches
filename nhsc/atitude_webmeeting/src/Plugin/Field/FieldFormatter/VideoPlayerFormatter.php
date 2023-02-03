<?php

namespace Drupal\atitude_webmeeting\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\atitude_webmeeting\ClientFactory;
use \Drupal\Core\Field\FieldDefinitionInterface;


/**
 * Plugin implementation of the 'video_player_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "video_player_formatter",
 *   label = @Translation("Video player formatter"),
 *   field_types = {
 *     "atitude_video"
 *   }
 * )
 */

class VideoPlayerFormatter extends FormatterBase implements ContainerFactoryPluginInterface {
  /**
   * The entity manager service
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $client;
  /**
   * Construct a MyFormatter object
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entityManager
   *   The entity manager service
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, ClientFactory $client) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);

    $this->client = $client;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      // Add any services you want to inject here
      $container->get('atitude_webmeeting.client.factory')
    );
  }
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'enroll_enabled' => 0,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
  $form =  parent::settingsForm($form, $form_state);

      $form['enroll_enabled'] = [
        '#type' => 'checkbox',
        '#title' => t('Validate if current user is enrolled.'),
        '#default_value' => $this->getSetting('enroll_enabled'),
      //  '#required' => TRUE,
      //  '#min' => 1,
      ];

      return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $settings = $this->getSettings();

    $has_validation = $this->t('No');

    if ($settings['enroll_enabled']) {
      $has_validation = $this->t('Yes');
    }

    // Implement settings summary.
    $summary[] = $this->t('This field has enroll validation: !has_validation', ['!has_validation' => $has_validation]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

   if ($this->getSetting('enroll_enabled')) {
      $enroll_enabled = true;
    }

    $response_error = 'Error';

     // Render all field values as part of a single <video> tag.
     foreach ($items as $delta => $webmeeting) {
        $wid = $webmeeting->value;

          //check if the Enroll Module is enabled
        if ($enroll_enabled && \Drupal::moduleHandler()->moduleExists('enroll')) {

          //check if current user is enrolled

          $user = \Drupal::currentUser();
          $node = \Drupal::routeMatch()->getParameter('node');
          $validate = new \Drupal\enroll\Controller\EnrollController();
          $validate = $validate->search_user_subscription($user->id(), $node->id());
          \Drupal::logger('atitude')->notice("Validado = ".$validate);

              if ($validate == false) {

              return  [
                '#theme' => 'webmeeting_enroll',
                '#cache'  =>['max-age' => 0 ],
                '#contents' => $this->t('You need enroll for see this  Webmeeting'),
              ];

                }
       try {
         $videoplayer_content[] =  $this->client->getWebmeeting($wid);
        // \Drupal::logger('atitude')->notice("Pr:". $videoplayer_content);


       } catch (Exception $e) {

         $response_error =  'Caught exception: '.  $e->getMessage(). "\n";


       }



 }}
     // Return everything in an array for theming.
  return  [
        '#theme' => 'video_player',
        '#cache'  =>['max-age' => 0 ],
       '#contents' => !empty($videoplayer_content) ? $videoplayer_content : [$response_error],
       '#autoplay' => !empty($wid) ? $wid : '',
     ];



   }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {


  //  $service = \Drupal::service('atitude_webmeeting.client');

  //  return nl2br(Html::escape('testo'));
  }

}
