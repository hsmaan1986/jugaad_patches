<?php

namespace Drupal\lcp_migrations;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\File\FileSystem;
use Drupal\media\Entity\Media;
use GuzzleHttp\Exception\RequestException;
Use Drupal\Core\File\FileSystemInterface;

/**
 * Helper service for migrations.
 */
class MigrationsHelper {

  /**
   * {@inheritdoc}
   */
  protected $typeManager;

  /**
   * {@inheritdoc}
   */
  public function __construct($typeManager, $defaultCache, $state, $fileSystem, $httpClient, $loggerFactory, $configFactory) {
    $this->typeManager = $typeManager;
    $this->cache = $defaultCache;
    $this->state = $state;
    $this->file_system = $fileSystem;
    $this->httpClient = $httpClient;
    $this->logger = $loggerFactory->get('lcp_migrations');
    $this->geolocationConfig = $configFactory->get('geolocation.settings');
  }

  /**
   * {@inheritdoc}
   */
  public function getSourceUrls($migration_id, $contentType = NULL, $filter_path = NULL) {
    $urls = [];
    if (!empty($contentType)) {
      $cid = 'lcp_migrations:migrations_helper:source_urls:' . $migration_id;
      if ($cache = $this->cache->get($cid)) {
        $urls = $cache->data;
      }
      else {
        $urls = $this->getFilesByContentType($contentType);
        if (!empty($filter_path)) {
          $urls = array_filter($urls, function ($url) use ($filter_path) {
            return strpos($url, $filter_path) !== FALSE;
          });
          $urls = array_values($urls);
        }

        $this->cache->set($cid, $urls, CacheBackendInterface::CACHE_PERMANENT);
      }
    }
    return $urls;
  }

  /**
   * {@inheritdoc}
   */
  public function getFilesByContentType($contentType) {
    $list = [];
    $items = $this->getAllFiles();

    foreach ($items as $path) {
      $json = $this->readJsonFromPath($path);
      if (isset($json['Fields']['ContentType']) && $json['Fields']['ContentType'] == $contentType) {
        $list[] = $path;
      }
    }
    return $list;
  }

  /**
   * {@inheritdoc}
   */
  public function getAllFiles($type = 'json') {
    $files = [];
    $cid = 'lcp_migrations:migrations_helper:source_files';
    if ($cache = $this->cache->get($cid)) {
      $files = $cache->data;
    }
    else {
      $path = $this->getSourceFullPath();
      $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
      $objects = new \RegexIterator($objects, '/^.+\.' . $type . '$/i');
      foreach ($objects as $name => $object) {
        $files[] = $name;
      }
      $this->cache->set($cid, $files, CacheBackendInterface::CACHE_PERMANENT);
    }
    return $files;
  }

  /**
   * {@inheritdoc}
   */
  public function getSourceFullPath() {
    $dir = $this->state->get('lcp_migrations.source_directory', '');
    return $this->file_system->realpath('private://' . $dir);
  }

  /**
   * {@inheritdoc}
   */
  public function readJsonFromPath($path) {
    $data = file_get_contents($path);
    return json_decode($data, TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function getUidbyFilePath($path) {
    $url = NULL;
    if (!empty($path)) {
      $data = $this->readJsonFromPath($path);
      $url_path = $data['Url'] ?? '';
      $full_path = $this->getSourceFullPath();
      $url = str_replace($full_path, '', $path);
      $url = explode('/', $url);
      // Remove last two components of Url.
      array_pop($url);
      array_pop($url);
      $url = implode('/', $url) . $url_path;
      $trims = ['Pages', '.aspx'];
      $url = str_replace($trims, '', $url);
      // Urls need to be lowercase.
      $url = strtolower($url);
    }
    return $url;
  }

  /**
   * {@inheritdoc}
   */
  public function updateUidInSourceJson($path) {
    $uid = $this->getUidbyFilePath($path);
    $object = $this->readJsonFromPath($path);
    $object['Fields']['uid'] = $uid;
    $data = json_encode($object, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    FileSystemInterface::saveData($data, $path, FileSystemInterface::EXISTS_REPLACE);
  }

  /**
   * {@inheritdoc}
   */
  public function createReusableMediaFromImageTag($value) {
    $file = NULL;
    if (preg_match('/src="([^"]*)"/', $value, $matches)) {
      $image_path = $matches[1];
      // Cleaning image path.
      $image_path = urldecode($image_path);
      $image_path = strtolower($image_path);
      $path = $this->getSourceFullPath() . $image_path;
      $image_data = file_get_contents($path);
      $filename = FileSystem::basename($path);
      if ($file = file_save_data($image_data, 'public://' . $filename, FileSystemInterface::EXISTS_RENAME)) {
        $media = Media::create([
          'bundle' => 'image',
          'image' => ['entity' => $file],
          'status' => TRUE,
          'field_media_in_library' => TRUE,
          'uid' => 1,
        ]);
        $media->save();
      }
    }
    return $file;
  }

  /**
   * {@inheritdoc}
   */
  public function reverseGeolocationLookup($lat, $lng) {
    $address = [];
    $key = $this->geolocationConfig->get('google_map_api_key');
    if (!empty($key)) {
      $request_url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lng . '&key=' . $key;
      try {
        $data = $this->httpClient->request('GET', $request_url)->getBody();
      }
      catch (RequestException $e) {
        $this->logger->error('Error requesting Geolocation API: @url, @message', ['@url' => $request_url, '@message' => $e->getMessage()]);
      }
      if (!empty($data)) {
        $data = json_decode($data, TRUE);
        if (empty($data['error_message']) && !empty($data['results'])) {
          $results = $data['results'];
          foreach ($results[0]['address_components'] as $item) {
            if ($item['types'][0] == 'country') {
              $address[$item['types'][0]] = $item['short_name'];
              continue;
            }
            $address[$item['types'][0]] = $item['long_name'];
          }
        }
      }
    }

    return $address;
  }

}
