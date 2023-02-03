<?php
/**
 * Created by PhpStorm.
 * User: nzimandes
 * Date: 03/04/19
 * Time: 11:43
 */

namespace Drupal\nhsc_user_profile_via\Controller;

use Drupal\Console\Bootstrap\Drupal;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\taxonomy\Entity\Term;

class AutoCompleteController extends ControllerBase
{
    public function handleAutocomplete(Request $request) {
        $string     = $request->query->get('q');
        $matches    = [];

        if ($string) {

            $query = \Drupal::entityQuery('taxonomy_term')
                ->condition('vid', 'nhs_organisations')
                ->condition('name', '%'. $string.'%', 'LIKE')
                ->execute();

            $terms = Term::loadMultiple($query);

            foreach ($terms as $term) {
                $name = $term->getName();
                $matches[] = [
                    'value' => $name,
                    'label' => $name
                ];
            }
        }

        return new JsonResponse($matches);
    }
}