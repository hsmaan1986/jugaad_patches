<?php

namespace Drupal\nhsc_custom_xml\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Code\Database\Database;

use Drupal\nhsc_custom_xml\Controller\Sitemaps\DefaultCountrySitemap;



/**
 * Class CountrySitemapsController.
 */
class CountrySitemapsController extends ControllerBase {

  /**
   * Xml.
   *
   * @return string
   *   Return Hello string.
   */

  public function load()
  {
    $form= \Drupal::formBuilder()->getForm('Drupal\nhsc_custom_xml\Form\siteMapsSettingsForm');

    return [
      '#theme'=> 'countrysitemaps',
      '#items'=> $form,
      '#title'=> 'Country Sitemaps Form'
    ];
  }

  public function xml() {
 
    $current_path = \Drupal::service('path.current')->getPath();
    $query=\Drupal::database();

    $current_path = substr($current_path, 1, strpos($current_path, ".") -1);

       
    $results=$query->select('customxml','e')->condition('country_xml',$current_path,'=')
        ->fields('e',['country_xml_body'])
        ->execute()
    ->fetchAll(\PDO::FETCH_OBJ);


    if($results==false)
    {
      return $this->getDefaultSiteMap($current_path);
    }
    else
    {
      foreach($results as $row)
      {
        $country_xml_body= $row->country_xml_body;
      }
     
      $response = new Response($country_xml_body);
      $response->headers->set('Content-Type', 'text/xml');
      return $response;
    }     
  }


  private function getDefaultSiteMap($region)
  {
    $data=new DefaultCountrySitemap;
    $response = new Response($data->$region());
    
    $response->headers->set('Content-Type', 'text/xml');
    return $response;
  }
  

}
