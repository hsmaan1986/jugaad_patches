<?php
/**
 * Created by PhpStorm.
 * User: Sboniso
 * Date: 2018/10/08
 */

namespace Drupal\nhsc_product_selector\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\nhsc_product_selector\Controller\ProductController;

/**
 * Provides a 'Product Selector' block.
 *
 * @Block(
 *   id = "nhsc_product_selector",
 *   admin_label = @Translation("Product Selector")
 * )
 */

class ProductSelectorBlock extends BlockBase
{
    public function build()
    {
        $controller = new ProductController();
        $renderInBlock = $controller->productSelector();

        return $renderInBlock;
    }
}