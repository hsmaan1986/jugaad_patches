<?php
/**
 * Created by PhpStorm.
 * User: nzimandes
 * Date: 03/04/19
 * Time: 11:43
 */

namespace Drupal\nhsc_ccg_spend_calculator\Controller;

use Drupal\Console\Bootstrap\Drupal;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\taxonomy\Entity\Term;
use Drupal\Component\Utility\Xss;


class AutoCompleteController extends ControllerBase
{
    public function handleAutocomplete(Request $request) {
        $string     = $request->query->get('q');
        $matches    = [];

        $string     = Xss::filter($string);

        if (!$string) {
            return new JsonResponse($matches);
        }

        $query = \Drupal::entityQuery('taxonomy_term')
            ->condition('vid', 'ccg_list')
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

        if (empty($terms)) {
            $matches[] = [
                'label' => t('No results')
            ];
        }

        return new JsonResponse($matches);
    }
}