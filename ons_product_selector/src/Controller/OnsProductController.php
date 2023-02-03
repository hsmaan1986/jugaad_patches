<?php

namespace Drupal\ons_product_selector\Controller;

use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use \Drupal\node\Entity\Node;
use \Drupal\taxonomy\Entity\Term;
use Drupal\taxonomy;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\taxonomy\TermStorage;


/**
 * Class EventController.
 */
class OnsProductController extends ControllerBase implements ContainerInjectionInterface
{
    /**
     * @var array
     */
    private $events = [],
        $dateFilter = '',
        $controller = '';

    /**
     * @return array
     */
    public function onsProductSelector()
    {
        $form = \Drupal::formBuilder()->getForm('Drupal\ons_product_selector\Form\OnsProductSelectorForm');

        return [
            '#theme' => 'ons_product_selector',
            '#form' => $form,
        ];
    }

    /**
     * @var $level
     * @var $tid
     * @var $default_value
     * @var $tax_term
     * @return array of all vocabulary of conditions taxonomy
     *
     */

    public function getConditionOptions ($default_value, $tax_term, $level = 1, $tid = 0 ){

        $term_data['']  = $default_value;
        $manager    = \Drupal::service('entity_type.manager')->getStorage('taxonomy_term');
        $terms      = $manager->loadTree(
            $tax_term, // This is your taxonomy term vocabulary (machine name).
            $tid, // This is "tid" of parent. Set "0" to get all.
            $level, // Get only 1st level.
            TRUE // Get full load of taxonomy term entity.
        );

        foreach ($terms as $term) {
            $term_data[$term->id()] = $term->label();
        }

        return $term_data;
    }



    /**
     * @param $type
     * @param null $tid
     * @return array
     */
    private function getTaxonomy($type, $tid = null)
    {
        $list = [];
        if ($tid !== null) {
            $tids = \Drupal::entityQuery('taxonomy_term')
                ->condition('vid', $type)
                ->condition('tid', explode(',', $tid), 'in')
                ->execute();
        } else {
            $tids = \Drupal::entityQuery('taxonomy_term')
                ->condition('vid', $type)
                ->execute();
        }

        $terms = Term::loadMultiple($tids);

        foreach ($terms as $term) {
            $list[$term->id()] = $term->getName();
        }

        return $list;
    }
    public static function getHideFilters() {
      $controller = new OnsProductController();
      return !(bool) $controller->config('ons_product_selector.settings')->get()['ons_product_selector']['hide_filters'];
    }

    public static function getHideAdvancedFilters() {
      $controller = new onsProductController();
      return !(bool) $controller->config('ons_product_selector.settings')->get()['ons_product_selector']['hide_advanced_filters'];
    }

    public static function getDisableCompare() {
      $controller = new onsProductController();
      return !(bool) $controller->config('ons_product_selector.settings')->get()['ons_product_selector']['disable_compare'];
    }


}
