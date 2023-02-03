<?php


namespace Drupal\nppe_module_where_to_buy\Controller;


use Drupal\Core\Controller\ControllerBase;
use \Drupal\taxonomy\Entity\Term;

class SearchController extends ControllerBase
{
    /**
     * @var $level
     * @var $tid
     * @var $default_value
     * @var $tax_term
     * @return array of all vocabulary of conditions taxonomy
     *
     */

    public function getOptions ($default_value, $tax_term, $level = 1, $tid = 0){

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
     * @return array
     */
    public function getOfficeSearchForm() {

        $form = \Drupal::formBuilder()->getForm('Drupal\nppe_module_where_to_buy\Form\OfficeSearchForm');

        return [
            '#theme' => 'office_search_form',
            '#form' => $form,
        ];
    }
}