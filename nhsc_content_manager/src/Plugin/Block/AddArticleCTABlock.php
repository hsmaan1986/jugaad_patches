<?php
/**
 * Created by PhpStorm.
 * User: Sboniso
 * Date: 2018/12/08
 */

namespace Drupal\nhsc_content_manager\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Url;

/**
 * Provides a 'Product Selector' block.
 *
 * @Block(
 *   id = "add_article_button_block",
 *   admin_label = @Translation("Add Article Button Block")
 * )
 */

class AddArticleCTABlock extends BlockBase
{
    public function build()
    {

        $route_match = \Drupal::service('current_route_match');

        $speciality = $route_match->getParameter('arg_0');

        $url = Url::fromRoute('nhsc_content_manager.add_content', ['speciality' => $speciality], ['absolute' => TRUE]);

        return [
            '#description' => t('Gostaria de compartilhar algum conteúdo desse assunto no nosso site? Clique no botão abaixo.'),
            '#link_text' => 'Upload conteúdo',
            '#link_url' => $url,
            '#theme' => 'add_article_button_block'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheMaxAge() {
        return 0;
    }
}