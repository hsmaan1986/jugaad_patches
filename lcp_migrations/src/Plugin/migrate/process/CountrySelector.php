<?php

namespace Drupal\lcp_migrations\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'CountrySelector' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *   id = "country_selector",
 *   handle_multiples = TRUE
 * )
 */
class CountrySelector extends ProcessPluginBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $countryRepository) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->countryRepository = $countryRepository;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('address.country_repository')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $results = [];
    $multiple = is_array($value);
    $locale = 'en';

    if (!$multiple) {
      $value = [$value];
    }
    $countries = $this->countryRepository->getList($locale);
    foreach ($value as $country) {
      $country = $this->fixCountryName($country);
      if ($code = array_search($country, $countries)) {
        $results[] = ['value' => $code];
      }
    }

    return $multiple ? array_values($results) : reset($results);

  }

  /**
   * {@inheritdoc}
   */
  protected function fixCountryName($name) {
    // Replace 'and' with '&'.
    $name = str_replace([' and ', ' And '], ' & ', $name);
    // Fix country names.
    $map = [
      'Czech Republic' => 'Czechia',
      'Hong Kong' => 'Hong Kong SAR China',
      'Congo' => 'Congo - Kinshasa',
      'Congo, Democratic Republic of' => 'Congo - Kinshasa',
      'Côte d\'Ivoire' => 'Côte d’Ivoire',
      'Polynesia' => 'French Polynesia,',
      'Korea, Republic of' => 'South Korea',
    ];
    $name = $map[$name] ?? $name;
    return $name;
  }

}
