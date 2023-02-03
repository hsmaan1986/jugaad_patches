<?php

namespace Drupal\hcp_reward_system\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Reward plugin manager.
 */
class RewardManager extends DefaultPluginManager {


  /**
   * Constructs a new RewardManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */


  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/Reward', $namespaces, $module_handler, 'Drupal\hcp_reward_system\Plugin\RewardInterface', 'Drupal\hcp_reward_system\Annotation\Reward');

    $this->alterInfo('hcp_reward_system_reward_info');
    $this->setCacheBackend($cache_backend, 'hcp_reward_system_reward_plugins');
  }

}
