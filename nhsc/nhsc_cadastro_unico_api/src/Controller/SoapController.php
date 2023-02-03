<?php
/**
 * @file
 * Contains \Drupal\nhsc_cadastro_unico_api\Controller\SoapController.
 */
namespace Drupal\nhsc_cadastro_unico_api\Controller;

class SoapController extends \SoapClient {
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        $response = parent::__doRequest($request, $location, $action, $version, $one_way);
        // parse $response, extract the multipart messages and so on

        //this part removes stuff
        $start=strpos($response,'<s:');
        $end=strrpos($response,'>');
        $response_string=substr($response,$start,$end-$start+1);
        return($response_string);
    }
}