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
 * Provides a 'Agenda List' block.
 *
 * @Block(
 *   id = "nppe_block_agenda_list",
 *   admin_label = @Translation("Agenda List")
 * )
 */
class MyAgendaListBlock extends BlockBase
{

    public function build()
    {
        $tkn = !empty(\Drupal::request()->query->get('tkn')) ? \Drupal::request()->query->get('tkn') : null;
        $fltr = !empty(\Drupal::request()->query->get('fltr')) ? \Drupal::request()->query->get('fltr') : null;

        $controller = new EventController();
        $renderInBlock = $controller->agendalist($tkn, $fltr);
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