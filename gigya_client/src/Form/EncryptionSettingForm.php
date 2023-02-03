<?php

namespace Drupal\gigya_client\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\StreamWrapper\StreamWrapperManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class EncryptionSettingForm.
 *
 * @package Drupal\gigya_client\Form
 */
class EncryptionSettingForm extends ConfigFormBase {
  const GIGYA_KEY_PATH = 'private://';
  protected $gigyaEncryptionConfig;
  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  /**
   * Protected entity manager field.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;
  /**
   * The stream wrapper manager.
   *
   * @var \Drupal\Core\StreamWrapper\StreamWrapperManagerInterface
   */
  protected $streamWrapperManager;

  /**
   * EncryptionSettingForm constructor.
   */
  public function __construct(ConfigFactoryInterface $config_factory,
  EntityTypeManagerInterface $entity_type_manager,
  StreamWrapperManagerInterface $stream_wrapper_manager) {
    $this->configFactory = $config_factory;
    $this->entityTypeManager = $entity_type_manager;
    $this->gigyaEncryptionConfig = $this->config('gigya_client.encryption_settings');
    $this->streamWrapperManager = $stream_wrapper_manager;
  }

  /**
   * Create Encryption form.
   *
   * @inheritDoc
   */
  public static function create(ContainerInterface $container) {
    return new static(
    $container->get('config.factory'),
    $container->get('entity_type.manager'),
    $container->get('stream_wrapper_manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return "gigya_client_encryption_settings";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['gigya_client_ext_encryption_key'] = [
      '#title' => $this->t('Encryption Key'),
      '#type' => 'managed_file',
      '#upload_location' => self::GIGYA_KEY_PATH,
      '#description' => $this->t('Upload Key'),
      '#upload_validators' => [
        'file_validate_extensions' => ['key txt'],
      ],
      '#default_value' => $this->gigyaEncryptionConfig->get('gigya_client.gigya_client_ext_encryption_key'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->gigyaEncryptionConfig;

    // BEGIN CONFIG VALUES WHEN FORM SAVED.
    $encryption_key = $form_state->getValue("gigya_client_ext_encryption_key");
    // END CONFIG VALUES WHEN FORM SAVED.
    // BEGIN SET VALUE ON CONFIG DATABASE.
    $config->set("gigya_client.gigya_client_ext_encryption_key", $encryption_key);

    // Force file to be permanent.
    $this->fixPermanentFile('gigya_client.gigya_client_ext_encryption_key');

    // Update gigya keyPath.
    $this->updateGigyaKeyPath('gigya_client.gigya_client_ext_encryption_key');

    // Save all.
    $config->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * Check and save the uploaded key.
   */
  public function fixPermanentFile($file_config_name) {
    $fid = $this->gigyaEncryptionConfig->get($file_config_name);
    $fid = is_array($fid) ? $fid[0] : 0;

    if ($fid > 0) {
      /** @var \Drupal\file\Entity\File $file */
      $file = $this->entityTypeManager->getStorage('file')->load($fid);
      if (is_object($file) && $file->get('status')->value == 0) {
        $file->setPermanent();
        $file->save();
      }
    }
  }

  /**
   * Set key path to gigya.global setting.
   */
  public function updateGigyaKeyPath($file_config_name) {
    $fid = $this->gigyaEncryptionConfig->get($file_config_name);
    $fid = is_array($fid) ? $fid[0] : 0;
    $gigyaConfig = $this->configFactory->getEditable('gigya.global');

    if ($fid > 0) {
      /** @var \Drupal\file\Entity\File $file */
      $file = $this->entityTypeManager->getStorage('file')->load($fid);
      if (is_object($file)) {
        $uri = $file->getFileUri();
        $stream_wrapper_manager = $this->streamWrapperManager->getViaUri($uri);
        $file_path = $stream_wrapper_manager->realpath();

        if (!empty($file_path)) {
          $gigyaConfig->set('gigya.keyPath', $file_path)
            ->save();

          return TRUE;
        }

      }
    }

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['gigya_client.encryption_settings'];
  }

}
