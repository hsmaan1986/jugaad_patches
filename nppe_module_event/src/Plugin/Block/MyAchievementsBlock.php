<?php
/**
 * Created by PhpStorm.
 * User: mashabat
 * Date: 2018/03/19
 * Time: 2:54 PM
 */

namespace Drupal\nppe_module_event\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\nppe_module_event\Controller\EventController;

/**
 * Provides a 'My Achievements List' block.
 *
 * @Block(
 *   id = "nppe_module_my_achievements_list",
 *   admin_label = @Translation("My Achievements List")
 * )
 */
class MyAchievementsBlock extends BlockBase
{

    public function build()
    {
        $controller = new EventController();
        $renderInBlock = $controller->myachievements();
        return $renderInBlock;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheMaxAge()
    {
        return 0;
    }
}