<?php

namespace Drupal\hcp_reward_system\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Component\Plugin\ConfigurablePluginInterface;
use Drupal\Core\Plugin\PluginFormInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines an interface for Reward plugins.
 */
interface RewardInterface extends PluginInspectionInterface,  PluginFormInterface {



    /**
     * Return the label of the reward.
     *
     * @return string
     */
    public function label();

    /**
     * Returns a render array summarizing the configuration of the image effect.
     *
     * @return array
     *   A render array.
     */
    public function getSummary();

    /**
     * Return the price per scoop of the ice cream flavor.
     *
     * @return float
     */
    public function getPoints();

    public function setPoints($points);
    public function getNode();

    public function setNode($node);

    /**
     * A description.
     *
     * @return string
     */
    public function getDescription();


}
