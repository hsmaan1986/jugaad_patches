<?php

namespace Drupal\ln_c_ip_locator\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Render\RendererInterface;
use Drupal\filter\FilterPluginManager;
use Drupal\Core\Language\LanguageManager;

/**
 * Provides a 'IP Locator Pop up' configurable block.
 *
 * @Block(
 *   id = "ip_locator",
 *   admin_label = @Translation("IP Locator: Pop Up block")
 * )
 */
class IPLocatorPopUpBlock extends BlockBase implements ContainerFactoryPluginInterface {

    /**
     * ConfigFactory services.
     *
     * @var \Drupal\Core\Config\ConfigFactoryInterface
     */
    protected $configFactory;

    /**
     * Request Stack services.
     *
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $request;

    /**
     * The renderer service.
     *
     * @var \Drupal\Core\Render\RendererInterface
     */
    protected $renderer;

    /**
     * Filter manager.
     *
     * @var \Drupal\filter\FilterPluginManager
     */
    protected $filterManager;

    /**
     * The language manager service.
     *
     * @var \Drupal\Core\Language\LanguageManager
     */
    protected $languageManager;

    /**
     * {@inheritdoc}
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $config_factory, RequestStack $request, RendererInterface $renderer, FilterPluginManager $filterManager, LanguageManager $languageManager) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->configFactory = $config_factory;
        $this->request = $request;
        $this->renderer = $renderer;
        $this->filterManager = $filterManager;
        $this->languageManager = $languageManager;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('config.factory'),
            $container->get('request_stack'),
            $container->get('renderer'),
            $container->get('plugin.manager.filter'),
            $container->get('language_manager')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];
        /**
         * @todo Remove hardcoded country code.
         */
        $cf_country = $this->request->getCurrentRequest()->cookies->get('Drupal_visitor_cf_ipcountry') ?? 'US';
        $redirection_configs = $this->configFactory->get('geolocation.settings')->get('country_based_configurations');
        $popup_configs = $this->configFactory->get('ln_c_ip_locator.settings')->get('country_popup_configs') ?? [];
        $popup_modal_config = $this->configFactory->get('ln_c_ip_locator.settings')->get('modal_popup_block_logo') ?? [];
        $langcode = $this->languageManager->getDefaultLanguage()->getId();
        $entity_embed = $this->filterManager->createInstance('entity_embed', []);
        
        $modal_logo_url = '';
        if ($popup_modal_config && isset($popup_modal_config[0])) {
            $file = \Drupal\file\Entity\File::load($popup_modal_config[0]);
            if ($file) {
                if (!function_exists('file_create_url')) {
                    $modal_logo_url = \Drupal::service('url_generator')->generateAbsoluteString($file->getFileUri());
                } else {
                    $modal_logo_url = file_create_url($file->getFileUri());
                }
            }
        }
        
        foreach ($popup_configs as $code => &$values) {
            $values['redirect_url'] = $redirection_configs[$code]['url'];
            $values['cookie_validity'] = strtotime($values['cookie_validity']);
            $values['body']['value'] = $entity_embed->process($values['body']['value'], $langcode)->__toString();
        }

        $build = [
            'body' => [
                '#markup' => '<div class="popup-body"></div>',
            ],
            '#attached' => [
                'drupalSettings' => [
                    'ln_c_ip_locator' => [
                        'current_country' => $cf_country,
                        'data' => $popup_configs,
                        'modal_logo' => $modal_logo_url,
                    ],
                ],
                'library' => ['ln_c_ip_locator/ln_c_ip_locator'],
            ],
        ];

        $this->renderer->addCacheableDependency($build, 'geolocation.settings');
        $this->renderer->addCacheableDependency($build, 'ln_c_ip_locator.settings');

        return $build;
    }

}
