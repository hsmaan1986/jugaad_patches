<?php

namespace Drupal\mobile_search\Controller;

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
class SearchController extends ControllerBase implements ContainerInjectionInterface
{

    protected $search_url;
    private $config;


    public function __construct($search_url = NULL){
        // use block or module's configs
        $this->search_url = (empty($search_url)) ? $this->getConfigs()->get('search_url') : $search_url;
    }
    /**
     * @return array
     */
    public function getSearch()
    {

        return [
            '#theme' => 'nhsc_mobile_search',
            '#form' => NULL,
            '#url' => $this->search_url,
        ];
    }

    /**
     * @return object
     */
    public function getConfigs() {
        $this->config = $this->config('mobile_search.config');

        return $this->config;
    }
}