<?php

namespace Drupal\nhsc_linked_in_feed;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\File\FileSystemInterface;

/**
 * Class GetLinkedinFeedImport.
 */
class GetLinkedinFeedBase {

  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityManager;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a GetLinkedinFeedBase object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_manager
   *   The entity manager.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(EntityTypeManagerInterface $entity_manager, ConfigFactoryInterface $config_factory, FileSystemInterface $file_system) {
    $this->entityManager = $entity_manager;
    $this->configFactory = $config_factory;
    $this->fileSystem = $file_system;
  }

  /**
   * Import Linkedin Feed.
   */
  public function import() {
    $config = $this->configFactory->get('nhsc_linked_in_feed.settings');

    if ($config->get('linkedin_import')) {

      if ($config->get('linkedin_access_token') && $config->get('linkedin_access_token_expires')) {

        if ($config->get('linkedin_access_token_expires') < time()) {
          \Drupal::logger('nhsc_linked_in_feed')
            ->error('Linkedin access token was expired. Get new token on this module configuration page.');
        }
        else {
          $actual_token = $config->get('linkedin_access_token');
          $posts_qty = $config->get('linkedin_count');

          if ($config->get('linkedin_companies')) {

            $company_array = explode(' ', $config->get('linkedin_companies'));

            foreach ($company_array as $company_val) {
              // get followers
              $number_followers = $this->getFollowers($company_val, $actual_token);
              // get company logo
              $company_image = $this->getCompanyProfile($company_val, $actual_token, 'logo-url');
              $logoURL = $company_image['logoUrl'];
              // get follow button
              $follow_button = $this->getFollowButton($company_val);


              $url = 'https://api.linkedin.com/v1/companies/' . trim($company_val) . '/updates?count=' . $posts_qty . '&type=status-update&format=json';

              try {
                $response = \Drupal::httpClient()->get($url, [
                  'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $actual_token,
                  ],
                ]);

                $data = (string) $response->getBody();
                $posts_array = Json::decode($data);
                if (!isset($posts_array['values'])) {
                  return;
                }

                $linkedin_feeds = $posts_array['values'];


                if ($linkedin_feeds) {
                  $max_timestamp = $this->getMaxNodeTimestamp($company_val);
                  foreach ($linkedin_feeds as $linkedin_feed) {
                    // set followers
                    $linkedin_feed['followers'] = $number_followers;
                    // get company logo
                    $linkedin_feed['company_logo'] = $logoURL;
                    // follow button
                    $linkedin_feed['follow_button'] = $follow_button;
                    // get feed url
                    $linkedin_feed['feed_url'] = $this->getFeedURL($linkedin_feed['updateContent']['companyStatusUpdate']['share']['id']);

                    if ($linkedin_feed['timestamp'] <= $max_timestamp) {
                      continue;
                    }
                    else {
                      $this->createLinkedinNode($linkedin_feed);
                    }
                  }
                  \Drupal::logger('nhsc_linked_in_feed')
                    ->notice('Posts saved from Linkedin.');
                }
              }
              catch (\Exception $exc_linkedin) {
                \Drupal::logger('nhsc_linked_in_feed')
                  ->error('Post save from Linkedin fails. Or member does not have permission to get company.' . $exc_linkedin->getMessage());
              }
            }
          }
        }
      }
      else {
        \Drupal::logger('nhsc_linked_in_feed')
          ->error('You should setup Linkedin access token on this module configuration page.');
      }
    }
  }


    /**
     * Import Linkedin Company Followers.
     */
    public function getFollowers($company, $actual_token) {
        $url = 'https://api.linkedin.com/v1/companies/'.trim($company).'/num-followers?format=json';

        try {
            $response = \Drupal::httpClient()->get($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $actual_token,
                ],
            ]);

            $data = (string) $response->getBody();
            $posts_array = Json::decode($data);

            return $posts_array;
        }
        catch (\Exception $exc_linkedin) {
            \Drupal::logger('nhsc_linked_in_feed')
                ->error('Get followers from Linkedin fails. Or member does not have permission to get company.' . $exc_linkedin->getMessage());
            return 0;
        }
    }

    /**
     * Import Linkedin Company Followers.
     */
    public function getCompanyProfile($company, $actual_token, $fields) {

        $url = 'https://api.linkedin.com/v1/companies/'.trim($company).':('.trim($fields).')?format=json';

        try {
            $response = \Drupal::httpClient()->get($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $actual_token,
                ],
            ]);

            $data = (string) $response->getBody();
            $posts_array = Json::decode($data);

            return $posts_array;
        }
        catch (\Exception $exc_linkedin) {
            \Drupal::logger('nhsc_linked_in_feed')
                ->error('Get profile from Linkedin fails. Or member does not have permission to get company.' . $exc_linkedin->getMessage());
            return 0;
        }
    }

    /**
     * Import Linkedin Follow button.
     */
    public function getFollowButton($company) {
        $button  = ' <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: pt_BR</script>';
        $button .= '<script type="IN/FollowCompany" data-id="'.$company.'"></script>';

        return $button;
    }

    /**
     * Import Linkedin Feed URL.
     */
    public function getFeedURL($share_id) {
        $url  = 'https://www.linkedin.com/feed/update/urn:li:share:'.(str_replace('s','', $share_id).'/');

        return $url;
    }

  /**
   * Create nodes of type Linkedin.
   *
   * @param array $linkedin_feed
   *   Linkedin post.
   */
  public function createLinkedinNode(array $linkedin_feed) {

    $storage = \Drupal::entityTypeManager()->getStorage('node');

    $node = $storage->create([
      'type' => 'linkedin_feed',
      'title' => !empty($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['title']) ? $linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['title'] : $linkedin_feed['updateContent']['company']['name'],
      'field_linkedin_feed_id' => $linkedin_feed['updateContent']['companyStatusUpdate']['share']['id'],
      'field_linkedin_company_name' => $linkedin_feed['updateContent']['company']['name'],
      'field_linkedin_company_id' => $linkedin_feed['updateContent']['company']['id'],
      'field_linkedin_description' => !empty($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['description']) ? $linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['description'] : '',
      'field_linkedin_eyebrowurl' => !empty($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['eyebrowUrl']) ? $linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['eyebrowUrl'] : '',
      'field_linkedin_shortenedurl' => !empty($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['shortenedUrl']) ? $linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['shortenedUrl'] : '',
      'field_linkedin_submittedimageurl' => !empty($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['submittedImageUrl']) ? $linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['submittedImageUrl'] : '',
      'field_linkedin_submittedurl' => !empty($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['submittedUrl']) ? $linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['submittedUrl'] : '',
      'field_linkedin_thumbnailurl' => !empty($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['thumbnailUrl']) ? $linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['thumbnailUrl'] : '',
      'field_linkedin_title' => !empty($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['title']) ? $linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['title'] : '',
      'field_linkedin_feed_content' => [
        'value' => $this->linkedinMakeLinksClickable($linkedin_feed['updateContent']['companyStatusUpdate']['share']['comment']),
        'format' => 'full_html',
      ],
      'field_linkedin_timestamp' => $linkedin_feed['timestamp'],
      'field_linkedin_followers' => $linkedin_feed['followers'],
      'field_linkedin_company_logo' => $linkedin_feed['company_logo'],
      'field_linkedin_follow_button' => [
          'value' => $linkedin_feed['follow_button'],
          'format' => 'full_html',
      ],
      'field_linkedin_feed_url' => $linkedin_feed['feed_url'],
      'created' => ($linkedin_feed['timestamp'] / 1000),
      'uid' => '1',
      'status' => 1,
    ]);

    if (isset($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['submittedImageUrl'])) {
      $data = file_get_contents($linkedin_feed['updateContent']['companyStatusUpdate']['share']['content']['submittedImageUrl']);
      $dir = 'public://linkedin/';
      if ($data && $this->fileSystem->prepareDirectory($dir, FileSystemInterface::CREATE_DIRECTORY)) {
        $file = file_save_data($data, $dir . 'linkedin_image_' . $linkedin_feed['timestamp'], FileSystemInterface::EXISTS_RENAME);
        $node->set('field_linkedin_local_image', $file);
      }
    }

    $node->save();
  }

  /**
   * Remove nodes of type Linkedin depended on expiry settings in the module.
   */
  public function removeOldPosts() {
    $config = $this->configFactory->get('nhsc_linked_in_feed.settings');
    $expiry_period = $config->get('linkedin_expire');

    if ($expiry_period) {
      $storage = $this->entityManager->getStorage('node');
      $query = $storage->getQuery();
      $query->condition('created', time() - $expiry_period, '<');
      $query->condition('type', 'linkedin_feed');
      $result = $query->execute();
      $nodes = $storage->loadMultiple($result);
      $storage->delete($nodes);
    }
  }

  /**
   * Send email to admin and Linkedin user about expiry token.
   */
  public function sendEmailExpiry() {

    $config = $this->configFactory->get('nhsc_linked_in_feed.settings');

    if (!empty($config->get('linkedin_admin_email'))) {
      $send_notification_to = \Drupal::config('system.site')
          ->get('mail') . ',' . $config->get('linkedin_admin_email');
    }
    else {
      $send_notification_to = \Drupal::config('system.site')->get('mail');
    }

    if ($config->get('linkedin_access_token') && $config->get('linkedin_access_token_expires')) {
      $token_expires = $config->get('linkedin_access_token_expires');
      if (($token_expires > time()) && ($token_expires - time() <= 604800) && (\Drupal::state()
            ->get('nhsc_linked_in_feed_letter_sent', 0) != 1)
      ) {

        /** @var \Drupal\Core\Datetime\DateFormatterInterface $formatter */
        $date_formatter = \Drupal::service('date.formatter');

        $expiry_period = $date_formatter->formatDiff(\Drupal::time()
          ->getRequestTime(), $config->get('linkedin_access_token_expires'), [
            'granularity' => 3,
            'return_as_object' => FALSE,
          ]);

        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'nhsc_linked_in_feed';
        $key = 'linkedin_token_expiry';
        $params['message'] = 'Linkedin token will be expired ' . $expiry_period;
        $params['time_to_expiry'] = $expiry_period;
        $langcode = \Drupal::currentUser()->getPreferredLangcode();
        $send = TRUE;

        $result = $mailManager->mail($module, $key, $send_notification_to, $langcode, $params, NULL, $send);

        if ($result['result'] !== TRUE) {
          $nhsc_linked_in_feed_info = $this->t('There was a problem sending expiry token message and it was not sent.');
          \Drupal::logger('nhsc_linked_in_feed')
            ->error($nhsc_linked_in_feed_info);
        }
        else {
          $nhsc_linked_in_feed_info = $this->tt('The expiry token message has been sent.');
          \Drupal::logger('nhsc_linked_in_feed')
            ->notice($nhsc_linked_in_feed_info);

          \Drupal::state()->set('nhsc_linked_in_feed_letter_sent', 1);
        }
      }
    }
    else {
      $expiry_period = $this->t('Linkedin access token was expired or you should to generate new token.');
    }
  }

  /**
   * Select MAX timestamp of present Linkedin node with particular company Name.
   *
   * @param string $company_val
   *   Company ID.
   *
   * @return int
   *   Timestamp max.
   */
  public function getMaxNodeTimestamp($company_val) {

    $storage = $this->entityManager->getStorage('node');
    $query = $storage->getAggregateQuery();
    $query->condition('field_linkedin_company_id', $company_val);
    $query->aggregate('field_linkedin_timestamp', 'MAX');
    $result = $query->execute();

    if (isset($result[0]['field_linkedin_timestamp_max'])) {
      return $result[0]['field_linkedin_timestamp_max'];
    }

    // If you are here - there is no any linkedin node
    // for this company. So let's return 2010-01-01 here.
    return 1262304000;
  }

  /**
   * Replace links.
   *
   * @param string $text
   *   Text for replace.
   *
   * @return mixed
   *   Text with links.
   */
  public function linkedinMakeLinksClickable($text) {
    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', $text);
  }

  /**
   * Run all tasks.
   */
  public function getAll() {
    $config = $this->configFactory->get('nhsc_linked_in_feed.settings');

    if ($config->get('linkedin_import')) {

      if ($config->get('linkedin_access_token') && $config->get('linkedin_access_token_expires')) {
        $this->import();
        $this->removeOldPosts();
        $this->sendEmailExpiry();
      }
    }
    else {
      \Drupal::logger('nhsc_linked_in_feed')
        ->error('You should setup Linkedin access token on this module configuration page.');
    }
  }


}
