<?php
/**
 * Created by PhpStorm.
 * User: Sboniso
 * Date: 2018/10/08
 */

namespace Drupal\nhsc_flavor_selector\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\nhsc_flavor_selector\Controller\FlavorController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides a 'Flavor Selector' block.
 *
 * @Block(
 *   id = "nhsc_flavor_selector",
 *   admin_label = @Translation("Flavor Selector")
 * )
 */

class FlavorSelectorBlock extends BlockBase
{
    public function build()
    {
        $controller = new FlavorController();
        $renderInBlock = $controller->flavorSelector();

        return $renderInBlock;
    }
}