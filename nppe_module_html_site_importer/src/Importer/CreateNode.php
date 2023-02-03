<?php

namespace Drupal\nppe_module_html_site_importer\Importer;


use Drupal\Core\Entity\EntityStorageException;
use Drupal\node\Entity\Node;

class CreateNode
{
    private $path;
    private $html;
    private $title;
    private $textFormat;

    /**
     * CreateNode constructor.
     * @param $path
     * @param $html
     * @param $title
     */
    public function __construct($title, $html = '', $path = null, $textFormat = 'full_html')
    {
        $this->path = $path;
        $this->html = $html;
        $this->title = $title;
        $this->textFormat = $textFormat;
    }

    public function save()
    {
        try {
            $node = Node::create(['type' => 'scraper']);
            $node->set('title', $this->title);
            $node->set('body', ['value' => $this->html, 'format' => $this->textFormat]);
            $node->set('path', ['alias' => $this->path]);
            $node->set('status', 1);

            $node->setPublished(TRUE);
            $node->set('moderation_state', "published");

            $node->enforceIsNew();
            $node->save();
        } catch (EntityStorageException $entityStorageException) {
            \Drupal::logger('importer')->error('Could not import: ' . $this->path);
        }
    }
}