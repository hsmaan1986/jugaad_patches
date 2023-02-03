<?php
/**
 * @file
 * Contains \Drupal\nppe_module_where_to_buy\Plugin\Block\OfficeSearchBlock.
 */
namespace Drupal\nppe_module_where_to_buy\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\nppe_module_where_to_buy\Controller\SearchController;

/**
 * Provides Search Block.
 *
 * @Block(
 * id = "office_search_block",
 * admin_label = @Translation("Office Search Block"),
 * category = @Translation("Blocks")
 * )
 */
class OfficeSearchBlock extends BlockBase {

    public function build() {

        $controller = new SearchController();
        $renderInBlock = $controller->getOfficeSearchForm();

        return $renderInBlock;
    }
}