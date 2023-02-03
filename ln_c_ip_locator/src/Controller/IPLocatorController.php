<?php

namespace Drupal\ln_c_ip_locator\Controller;

use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use GeoIp2\WebService\Client;
use GeoIp2\Database\Reader;

/**
 * IP locator Controller class.
 *
 * @package Drupal\ln_c_ip_locator\Controller
 */
class IPLocatorController extends ControllerBase {

    /**
     * Current Request.
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $currentRequest;

    /**
     * Config Factory services object.
     *
     * @var \Drupal\Core\Config\ConfigFactoryInterface
     */
    protected $config;

    /**
     * Creates a custom Flickr controller instance.
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $request
     *   Current request object.
     */
    public function __construct(RequestStack $request) {
        $this->currentRequest = $request->getCurrentRequest();
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('request_stack')
        );
    }

    /**
     * Returns a tabular overview of all IP locator configurations.
     */
    public function getConfigOverview() {
        // Get all the country based IP relocator configurations.
        $country_config = $this->config('geolocation.settings')->get('country_based_configurations');

        // Create rows data for table.
        $rows = [];
        if ($country_config) {
            foreach ($country_config as $country => $config) {
                $rows[$country] = [
                    'title' => $config['title'],
                    'country_code' => $config['country_code'],
                    'language_code' => $config['language_code'],
                    'url' => $config['url'],
                    // Add edit button containing url for redirecting to edit page.
                    'edit' => Link::fromTextAndUrl($this->t('Edit'), Url::fromUserInput('/admin/config/lightnest/ipredirection?country=' . $country)),
                ];
            }
        }

        // Prepare an overview table of given configurations.
        $build['table'] = [
            '#type' => 'table',
            '#caption' => $this->t('IP re-locator configuartions overview'),
            '#header' => [
                $this->t('Title'),
                $this->t('Country Code'),
                $this->t('Language Code'),
                $this->t('Website URL'),
                $this->t('Operations'),
            ],
            '#rows' => $rows,
        ];

        // Finally add the pager.
        $build['pager'] = [
            '#type' => 'pager',
        ];

        return $build;
    }

    /**
     * Returns a non-cacheable current user's country code response.
     */
    public function ping() {
        global $_SERVER;
        $code = '';
        $ln_ip_locator_config = \Drupal::config('country_code_header.settings');
        
        if (!empty($ln_ip_locator_config)) {
            $country_code = $ln_ip_locator_config->get('cdn_country_code');
            $code = $this->currentRequest->server->get($country_code);
        }

        // Remove this line before deploying changes on production.
        // For now I'm testing with harcoded country code.
        $code = $code ?? $this->get_current_country_code_from_ip($_SERVER['REMOTE_ADDR']);
        // dump($code);
        
        return new Response($code, 200, ['Cache-Control:' => 'no-cache']);
    }

    /**
     * Retrieves country code of current IP.
     *
     * @param string $current_ip
     * @return string $country_code
     */
    public function get_current_country_code_from_ip(string $current_ip) {
        // $current_ip = '43.239.178.7'; // China
        // $current_ip = '185.150.2.234'; // Turkey
        // $current_ip = '81.31.151.128'; // Italy
        // dump($current_ip);
        // HTTP_CF_IPCOUNTRY
        $country_code = '';
        if (!empty($current_ip)) {
            $config = \Drupal::config('geoip_country_code_header.settings')->get('service_option');
            if ($config !== NULL || !empty($config)) {
                
                switch ($config) {
                case 'GeoPluginWebService':
                    // Use geoPlugin.
                    $result = $this->geoPlugin($current_ip);
                    $country_code = $result['country_code'];
                    break;
                case 'GeoIp2WebService':
                    // Use geoIp2WebService.
                    $account_id = \Drupal::config('geoip_country_code_header.settings')->get('maxmind_webservice_user_id');
                    $license_key = \Drupal::config('geoip_country_code_header.settings')->get('maxmind_webservice_license_key');
                    $result = $this->geoIp2WebService($account_id, $license_key, $current_ip);
                    $country_code = $result['country_code'];
                    break;
                case 'GeoIp2Database':
                    // Use geoIp2Database.
                    $result = $this->geoIp2Database($current_ip);
                    $country_code = $result['country_code'];
                    break;
                }

            }
            // dump($country_code);
        }
        // dump($country_code);
        return $country_code;
    }

    /**
     * Geolocate an IP address using Databases
     *
     * @param string $ip_address
     * @return array $response
     */
    public function geoIp2Database(string $ip_address) {
        $response = ['country_code' => null,'country_name' => null];
        $reader = new Reader(\Drupal::moduleHandler()->loadInclude('ln_c_ip_locator', 'mmdb', 'GeoLite2-Country'));
        $record = $reader->country($ip_address);
        // return ['country_code' => 'GB'];
        $response = ['country_code' => $record->country->isoCode,'country_name' => $record->country->name];
        
        return $response;
    }


    /**
     * Geolocate an IP address using Web Services
     *
     * @param string $account_id
     * @param string $license_key
     * @param string $ip
     * @return array $country_code
     */
    public function geoIp2WebService(string $account_id, string $license_key, string $ip_address) {
        $response = ['country_code' => null,'country_name' => null];

        // Cannot use Client inteface due to account permissions
        // $client = new Client($account_id, $license_key);
        // $res = $client->country($ip_address);

        $url = 'https://geolite.info/geoip/v2.1/country/'.$ip_address.'';
        $ch = \curl_init();
        \curl_setopt($ch, CURLOPT_URL, $url);
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        \curl_setopt($ch, CURLOPT_USERPWD, "$account_id:$license_key");
        \curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = \curl_exec($ch);
        \curl_close($ch);

        $res = json_decode($output, true);
        $response = [
            'country_code' => $res['country']['iso_code'],
            'country_name' => $res['country']['names']['en']
        ];

        return $response;
    }


    /**
     * Country data using geoPlugin service request method.
     *
     * Allows a free lookup of about 120 request per minute and blocks you for about 1hr thereafter.
     * 
     * @param string $ip
     * @return array $response
     */
    public function geoPlugin(string $ip) {

        $response = ['country_code' => null,'country_name' => null];

        $geoplugin_config = \Drupal::config('geoip_country_code_header.settings')->get('geoplugin_webservice');
        if ($geoplugin_config !== NULL && !empty($ip)) {
            $host_link = rtrim($geoplugin_config,'/').'/php.gp?ip='.$ip;
            // dump($host_link);
            if (\function_exists('curl_init')) {
                $ch = \curl_init();
                \curl_setopt($ch, CURLOPT_URL, $host_link);
                \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                \curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.1');
                $output = \curl_exec($ch);
                \curl_close($ch);
            } else if (ini_get('allow_url_fopen')) {
                $output = \file_get_contents($host_link, 'r');
            } else {
                \trigger_error('geoPlugin class error: Cannot retrieve data', E_USER_ERROR);
            }
            $result = \unserialize($output);
            /**
             * @todo Simplify response when deployig to production
             */
            $response = [
                'country_code' => $result['geoplugin_countryCode'],
                'country_name' => $result['geoplugin_countryName'],
            ];
        }

        return $response;
    }

}
