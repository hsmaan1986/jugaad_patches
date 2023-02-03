<?php

namespace Drupal\nhsc_mega_menu;
use \Drupal\Core\Url;
use \Drupal\Component\Utility\UrlHelper;
use \Drupal\node\Entity\Node;
use Drupal\hcp_site_switcher\Controller\SiteToggleController;

/**
 * Class DefaultService.
 *
 * @package Drupal\MyTwigModule
 */
class MenuTwigExtension extends \Twig_Extension {

    /**
     * {@inheritdoc}
     * This function must return the name of the extension. It must be unique.
     */
    public function getName() {
        return 'get_node_by_url';
    }

    /**
     * In this function we can declare the extension function
     */
    public function getFunctions() {
        return array(

            new \Twig_SimpleFunction('get_node_by_url',
                array($this, 'get_node_by_url'),
                array('is_safe' => ['html'])

            ),
        );
    }

    /**
     * The php function to get the node information
     * -- check if hcp_site_switcher module is activated
     * -- Check if url is internal
     * -- get node information using url
     * --
     */
    public function get_node_by_url($url) {

        $moduleHandler = \Drupal::service('module_handler');

        $has_hcp = false;

        if ($moduleHandler->moduleExists('hcp_site_switcher')) {// check if hcp_site_switcher module is activated

            $alias = \Drupal::service('path_alias.manager')->getPathByAlias($url);


            if (!empty($alias)) {

                if(preg_match('/node\/(\d+)/', $alias, $matches)) {// Test for node urls
                    $node = Node::load($matches[1]);

                    $hcpType = SiteToggleController::getNodeHCPType($node);// get hcp type

                    // check if link is hcp or patient
                    if (in_array($hcpType, ['hcp', 'patient'])) {
                        $has_hcp = true;
                    }
                }
            }

        }

        return $has_hcp;

    }

}
