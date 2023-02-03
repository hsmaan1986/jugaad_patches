<?php
/**
 * @file
 * Contains \Drupal\nhsc_module_buynow\Plugin\Block\nhsc_module_buynowBlock.
 */
namespace Drupal\nhsc_module_buynow\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Routing\RouteMatchInterface;
/**
 * Provides a 'nhsc_module_fusepumpBlock' block.
 *
 * @Block(
 *   id = "nhsc_module_fusepumpBlock",
 *   admin_label = @Translation("Buy now button block"),
 * )
 */
class nhsc_module_buynowBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {

        $config = \Drupal::config('nhsc_module_buynow.settings');
        //$fusepump_rangeid = $config->get('fusepump_rangeid');
        $buynow_rangebtn_status = $config->get('buynow_rangebtn_status');
        $buynow_rangebtn_label = $config->get('buynow_rangebtn_label');
        $buynow_rangebtn_id = $config->get('buynow_rangebtn_id');
        $buynow_rangebtn_class = $config->get('buynow_rangebtn_class');
        $buynow_rangebtn_buttonid= $config->get('buynow_rangebtn_buttonid');
        $buynow_rangebtn_ext_url = $config->get('buynow_rangebtn_ext_url');

        return array(
            '#theme' => 'nhsc_module_buynow_html',
            '#buynow_rangebtn_status' => $buynow_rangebtn_status,
            '#buynow_rangebtn_label' => $buynow_rangebtn_label,
            '#buynow_rangebtn_id' => $buynow_rangebtn_id,
            '#buynow_rangebtn_class' => $buynow_rangebtn_class,
            '#buynow_rangebtn_buttonid' => $buynow_rangebtn_buttonid,
            '#buynow_rangebtn_ext_url' => $buynow_rangebtn_ext_url,
            '#cache' => array(
                'contexts' => array('url'),
            ),
        );
    }
}