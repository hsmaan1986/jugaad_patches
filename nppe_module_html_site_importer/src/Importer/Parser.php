<?php

namespace Drupal\nppe_module_html_site_importer\Importer;

class Parser {

    private $elements = [];

    public function parse($html) {
        $doc = new \DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->loadHTML($html);

        $this->parseChildNodes($doc, $this->elements);
    }

    private function parseChildNodes($node, & $arrayToPush) {
        $indexPushed = count($arrayToPush);

        if ($node->nodeName == "li") {
            $representation = [
                "key" => $this->getDisplayValueFromNode($node),
                "items" => []
            ];
            array_push($arrayToPush, $representation);
            $arrayToPush = & $arrayToPush[$indexPushed]["items"];
        }

        if ($node->childNodes == null) {
            return;
        }
        foreach ($node->childNodes as $child) {
            $this->parseChildNodes($child, $arrayToPush);
        }
    }

    /**
     * Get the value of the node's first element
     * In our case this is the text value of the anchor tag
     *
     * @param $node
     * @return String
     */
    private function getDisplayValueFromNode($node) {
        return $node->firstChild->nodeValue;
    }

    public function getElements() {
        return $this->elements;
    }
}
