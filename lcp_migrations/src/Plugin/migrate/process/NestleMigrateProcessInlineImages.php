<?php

namespace Drupal\lcp_migrations\Plugin\migrate\process;

use Drupal\media\Entity\Media;
use Drupal\migrate_process_inline_images\Plugin\migrate\process\MigrateProcessInlineImages;
use Drupal\Core\StreamWrapper\PublicStream;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;
use Symfony\Component\DomCrawler\Crawler;
use Drupal\Core\Url;

/**
 * Provides a 'NestleMigrateProcessInlineImages' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "nestle_inline_images"
 * )
 */
class NestleMigrateProcessInlineImages extends MigrateProcessInlineImages {

  /**
   * {@inheritdoc}
   */
  protected function downloadFile($imagePath) {

    $file = parent::downloadFile($imagePath);

    // Create media entity referencing image file.
    $media = Media::create([
      'bundle' => 'image',
      'image' => ['entity' => $file],
      'status' => TRUE,
      'field_media_in_library' => TRUE,
      'uid' => 1,
    ]);
    $media->save();

    return $file;
  }

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $domCrawler = new Crawler($value, NULL, Url::fromRoute('<front>')->setAbsolute()->toString());
    // Search for all <img> tag in the value (usually the body).
    if ($images = $domCrawler->filter('img')->images()) {
      foreach ($images as $image) {
        // Cleaning image path.
        $image_path = urldecode($image->getUri());
        $image_path = strtolower($image_path);
        $new_url = $this->getUpdatedUrl($image_path);
        $image->getNode()->setAttribute('src', $new_url);
        $this->cleanUpImageAttributes($image, $migrate_executable);
        $new_url = parse_url($new_url);
        $image->getNode()->setAttribute('src', $new_url['path']);

      }
      return $domCrawler->html();
    }

    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public function getUpdatedUrl($old_value) {
    $url = parse_url($old_value);
    $public_path = '/' . PublicStream::basePath();
    $new_value = str_replace($url['path'], $public_path . $url['path'], $old_value);
    return $new_value;
  }

}
