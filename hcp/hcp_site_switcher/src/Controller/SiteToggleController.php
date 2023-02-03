<?php
/**
 * Created by PhpStorm.
 * User: Sboniso Nzimande
 * Date: 25/04/19
 * Time: 13:52
 */

namespace Drupal\hcp_site_switcher\Controller;

use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Drupal\paragraphs\Entity\Paragraph;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Drupal\node\Entity\Node;
use \Drupal\node\NodeInterface;

class SiteToggleController extends ControllerBase
{
    /**
     * Returns a json object about the current hcp url
     *
     * @return object
     *
     */
    public function checkRedirect() {
        // get curret url

        $return_data = [];
        $redirect = false;

        $url = Url::fromRoute('<current>', [], ['absolute'=>'true']);

        $node = \Drupal::routeMatch()->getParameter('node');
        if ($node instanceof NodeInterface) {
            // You can get nid and anything else you need from the node object.
            $nid = $node->id();
        }


        $return_data = [
            'current_url' => $url,
            'redirect' => $redirect,
            'node_id' => $nid,
        ];

        return new JsonResponse($return_data);
    }

    /**
     * Returns a json object about the current hcp url
     *
     * @return array
     *
     */

    public function getNodeUrlInfo (){
        $redirect = false;

        $config         = $this->config('hcp_site_switcher.config');
        $language       = $config->get('language');
        $prompt_once    = $config->get('prompt_once');
        $enable_disable = ($config->get('enable_disable')) ? (int)$config->get('enable_disable') : 0;

        $node           = \Drupal::routeMatch()->getParameter('node');
        $nid            = 0;
        $alias          = '';
        $redirect_alias = '';
        $current_is_hcp = false;
        $hcp_selected = \Drupal::request()->cookies->all();

        if ($enable_disable == 1) {// new logic
          $page_content = '';
          $items_list = [];

          if ($node instanceof NodeInterface) {

            $menu_name = 'main';
            $storage = \Drupal::entityTypeManager()->getStorage('menu_link_content');
            $tree = $storage->loadByProperties(['menu_name' => $menu_name, 'enabled' => 1 ]);

            // Load the current node.
            $page = Node::load($node->id());
            $hcp_type = '';
            if ($node->hasField('field_site_switcher_settings')) { // check if current page has hcp paragraph
              // Assign the field_site_switcher_settings value for HCP or Patient.
              $page_content = $node->field_site_switcher_settings->target_id;

              if ($node->field_site_switcher_settings->target_id != NULL){

                foreach ($node->field_site_switcher_settings as $item) {
                  $paragraphId = $item->target_id;
                  $paragraph = Paragraph::load($paragraphId);
                  $hcp_type = $paragraph->field_content_type->value;
                }
              }

            }
          }

          if ($node instanceof NodeInterface) {
            // You can get nid and anything else you need from the node object.
            $nid    = $node->id();

            $alias  = \Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);

            // check if its hcp url
            if (strpos($alias, '-hcp') !== false) {
              $redirect_alias = str_replace('-hcp', '', $alias);
              $current_is_hcp = true;
            }else{
              $redirect_alias = $alias . '-hcp';
            }

//            $redirect_alias_exists = \Drupal::service('path.alias_storage')->aliasExists($redirect_alias, $language);

          $redirect_alias_exists = \Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);;


            if ($redirect_alias_exists === true && $current_is_hcp !== true) {
                $redirect = true;
            }
        }


        $return_data = [
            'current_url' => $alias,
            'redirect' => $redirect,
            'redirect_url' => $redirect_alias,
            'current_is_hcp' => $current_is_hcp,
            'hcp_type' => $hcp_type ?? '',
            'prompt_once' => $prompt_once,
            'page_content' => $page_content,
            'hcp_status' => $enable_disable,
          ];
        } else {

          $return_data = [
            'current_url' => $alias,
            'redirect' => $redirect,
            'redirect_url' => $redirect_alias,
            'current_is_hcp' => $current_is_hcp,
            'hcp_status' => $enable_disable,
          ];
        }


        return $return_data;

    }

    /**
     * getNodeHCPType
     * @param object
     * @return string
     */

    public function getNodeHCPType ($node) {

        $hcp_type = '';

        if ($node instanceof NodeInterface) {

            if ($node->hasField('field_site_switcher_settings')) { // check if current page has hcp paragraph
                // Assign the field_site_switcher_settings value for HCP or Patient.

                if ($node->field_site_switcher_settings->target_id != NULL){

                    foreach ($node->field_site_switcher_settings as $item) {
                        $paragraphId = $item->target_id;
                        $paragraph = Paragraph::load($paragraphId);
                        $hcp_type = (isset($paragraph->field_content_type->value))?$paragraph->field_content_type->value:'';
                    }
                }

            }

      }

      return $hcp_type;
    }
}
