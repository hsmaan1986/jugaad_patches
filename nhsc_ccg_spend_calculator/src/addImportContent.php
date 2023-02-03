<?php
namespace Drupal\nhsc_ccg_spend_calculator;

use Drupal\node\Entity\Node;
use Drupal\nhsc_ccg_spend_calculator\Controller\CCGSpendController;
use Drupal\paragraphs\Entity\Paragraph;


class addImportContent {
    public static function addImportContentItem($item, &$context){
        $controller   = new CCGSpendController();
        $context['sandbox']['current_item'] = $item;
        $message = 'Creating ' . $item['title'];
        $results = array();
        $controller->create_node($item);
        $context['message'] = $message;
        $context['results'][] = $item;
    }
    function addImportContentItemCallback($success, $results, $operations) {
        // The 'success' parameter means no fatal PHP errors were detected. All
        // other error management should be handled using 'results'.
        if ($success) {
            $message = \Drupal::translation()->formatPlural(
                count($results),
                'One item processed.', '@count items imported.'
            );
        }
        else {
            $message = t('Finished with an error.');
        }

        \Drupal::messenger()->addStatus($message);

    }
}


