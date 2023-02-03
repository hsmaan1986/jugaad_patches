<?php
namespace Drupal\nppe_module_where_to_buy;

use Drupal\node\Entity\Node;

class addImportContent {
    public static function addImportContentItem($item, &$context){
        $context['sandbox']['current_item'] = $item;
        $message = 'Creating ' . $item['title'];
        $results = array();
        create_node($item);
        $context['message'] = $message;
        $context['results'][] = $item;
    }
    function addImportContentItemCallback($success, $results, $operations) {
        // The 'success' parameter means no fatal PHP errors were detected. All
        // other error management should be handled using 'results'.
        if ($success) {
            $message = \Drupal::translation()->formatPlural(
                count($results),
                'One item processed.', '@count items processed.'
            );
        }
        else {
            $message = t('Finished with an error.');
        }
        \Drupal::messenger()->addStatus($message);
    }
}

// This function actually creates each item as a node as type 'Page'
function create_node($item) {

    $node_data['type'] = 'store';
    $node_data['title'] = $item['title'];
    $node_data['langcode'] = \Drupal::languageManager()->getDefaultLanguage()->getId();
    $node_data['uid'] = \Drupal::currentUser()->id(); // created by current user
    $node_data['status'] = 1;
    $node_data['field_address'] = $item['address'];
    $node_data['field_country'] = $item['countrycode'];
    $node_data['field_phone'] = $item['phone'];
    $node_data['field_town'] = $item['town'];
    $node_data['field_website'] = $item['website'];
    $node_data['field_zip_code'] = $item['zipcode'];
    $node_data['field_store_type'] = $item['type'];
    $node_data['field_store_continent'] = $item['continent'];
    $node_data['field_store_country'] = $item['country'];
    $node_data['field_location'] = [
        [
            'lat' => $item['lattitude'],
            'lng' => $item['longitude'],
            'lat_sin' => sin(deg2rad($item['lattitude'])),
            'lat_cos' => cos(deg2rad($item['lattitude'])),
            'lng_rad' => deg2rad($item['longitude']),
            'data' => [],
        ]
    ];


    $node = Node::create($node_data);
    $node->setPublished(TRUE);
    $node->save();
}
