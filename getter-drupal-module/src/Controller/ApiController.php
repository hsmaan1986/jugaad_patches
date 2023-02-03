<?php

/**
 * @file
 * Contains \Drupal\getter\Controller\ApiController.
 */

namespace Drupal\getter\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;
use Drupal\paragraphs\Entity\Paragraph;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
Use Drupal\Core\File\FileSystemInterface;

class ApiController extends ControllerBase
{

    /**
     * Array of Drupal fields to exlude in the export content type
     */
    const EXCLUDE_FIELDS = [
        "id",
        "revision_id",
        "parent_id",
        "parent_type",
        "parent_field_name",
        "behavior_settings",
        "uuid",
        "vid",
        "langcode",
        "type",
        "revision_timestamp",
        "revision_uid",
        "revision_log",
        "status",
        "uid",
        "created",
        "changed",
        "promote",
        "sticky",
        "default_langcode",
        "revision_default",
        "revision_translation_affected",
        "moderation_state",
        "scheduled_transition_date",
        "scheduled_transition_state",
        "metatag",
        "path",
        "menu_link",
        "nid",
        "field_meta_tags",
        "panelizer",
    ];

    const GC_FIELD_TYPE_IMAGE = "image";

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        ini_set('max_execution_time', 300);
        header('Access-Control-Allow-Origin: *');
    }

    /**
     * @return string
     */
    public function createContent()
    {

        // For testing
        $post_data = [
            "items" => [
                "article_section" => [
                    "id" => 31,
                    "value" => "Hello World",
                    "type" => "Hello World",
                    "paragraph" => "Hello World",
                    "children" => [
                        "field_p_content" => [
                            "value" => "Content goes here",
                            "type" => "string",
                        ],

                        "field_p_image" => [
                            "value" => "https://www.bakersdogfood.co.uk/media/1871/dog-about-to-catch-ball.jpg",
                            "type" => "image",
                        ],

                        "field_p_title" => [
                            "value" => "This is the title",
                            "type" => "string",
                        ],
                    ],
                ],
            ],
            "type" => "article",
        ];

        $config = $this->config('getter.settings');

        $config->get('token');

        if ($config->get('token') !== $_SERVER['HTTP_X_AUTH_TOKEN']) {
            throw new AccessDeniedHttpException();
        }

        $post_body = file_get_contents('php://input');
        $post_data = json_decode($post_body, true);

        if (!isset($post_data['lang']) || $post_data['lang'] == '') {
            $post_data['lang'] = \Drupal::languageManager()->getCurrentLanguage()->getId();
        }

        $node = [
            "type" => strtolower($post_data['type']),
            "langcode" => $post_data['lang'],
            "uid" => $config->get('default_user'),
        ];
        $fields = $this->processFields($post_data['items'], 'node', $post_data['type'], $post_data['lang']);

        $node = array_merge($node, $fields);

        $entity = Node::create($node);
        $entity->set('field_meta_tags', serialize([
            'title' => $post_data['items']['meta']['title'],
            'description' => $post_data['items']['meta']['description'],
            'original_source' => $post_data['items']['meta']['base_domain'],
            'canonical_url' => $post_data['items']['meta']['canonical'],
            'og_url' => $post_data['items']['meta']['og:url'],
            'og_title' => $post_data['items']['meta']['og:title'],
            'og_description' => $post_data['items']['meta']['og:description'],
            'og_type' => $post_data['items']['meta']['og:type'],
            'og_site_name' => $post_data['items']['meta']['og:site_name'],
            'twitter_cards_type' => $post_data['items']['meta']['twitter:card'],
        ]));
        $entity->set('moderation_state', "published");
        $entity->save();

        return new JsonResponse([
            'nid' => $entity->id(),
        ]);
    }

    private function getFile($url)
    {
        // Create the image
        $file = file_save_data(
            file_get_contents($url),
            'public://' . uniqid() . '.jpg',
            FileSystemInterface::EXISTS_REPLACE
        );

        return $file;
    }

    /**
     * @param $fields
     * @param $entity_type
     * @param $entity_name
     * @param $langcode
     * @return array
     */
    private function processFields($fields, $entity_type, $entity_name, $langcode)
    {
        $data = [];

        foreach ($fields as $key => $item) {
            if ($key == 'meta') {
                $data['path'][0] = [
                    'alias' => $item['path'],
                ];
            } else {
                $data[$key] = $this->processField($item, $key, $entity_type, $entity_name, $langcode);
            }
        }

        return $data;
    }

    /**
     * @param $field_data
     * @param $field_name
     * @param $entity_type
     * @param $entity_name
     * @param $langcode
     * @return array
     * @throws \Drupal\Core\Entity\EntityStorageException
     */
    private function processField($field_data, $field_name, $entity_type, $entity_name, $langcode)
    {
        switch ($field_data['type']) {
            case 'file':
                if (isset($field_data['value'])) {
                    $file = $this->getFile($field_data['value'][0]);

                    return [
                        'target_id' => $file->id(),
                    ];
                }
                return '';
            case 'image':
                if (isset($field_data['value'])) {
                    $file = $this->getFile($field_data['value'][0]['src']);

                    return [
                        'target_id' => $file->id(),
                        'alt' => $field_data['value'][0]['alt'],
                        'title' => $field_data['value'][0]['title'],
                    ];
                }
                return '';
            case 'link':
                if (isset($field_data['value'])) {
                    return [
                        'uri' => $field_data['value'][0]['href'],
                        'title' => $field_data['value'][0]['title'],
                        'options' => ['attributes' => [
                            'target' => $field_data['value'][0]['target'],
                        ]]
                    ];
                }
                return '';
            case 'paragraph':
                //loop through fields
                $paragraphs = [];

                foreach ($field_data['children'] as $paragraph_type => $paragraph_data) {
                    foreach ($paragraph_data as $paragraph_datum) {
                        $paragraphs[] = $this->createParagraph($paragraph_type, $paragraph_datum, $entity_type, $entity_name, $langcode);
                    }
                }

                return $paragraphs;
                break;
            case 'entity_reference':
                $entity_manager = \Drupal::service('entity_type.manager');
                $entity_fields = $entity_manager->getFieldDefinitions($entity_type, $entity_name);
                $field_settings = $entity_fields[$field_name]->getSettings();

                switch ($field_settings['target_type']) {
                    case 'taxonomy_term':
                        $taxonomy_terms = [];

                        if ($field_settings['handler_settings']['auto_create'] == 1) {
                            $vocab = $field_settings['handler_settings']['auto_create_bundle'];
                        } else {
                            $vocab = current($field_settings['handler_settings']['target_bundles']);
                        }

                        foreach ($field_data["value"] as $term_name) {
                            $terms = $entity_manager->getStorage('taxonomy_term')->loadByProperties(['name' => $term_name]);
                            $term = reset($terms);

                            if (!empty($term)) {
                                $taxonomy_terms[] = ['target_id' => $term->id()];
                            } else {
                                $term = Term::create([
                                    'name' => $term_name,
                                    'vid' => $vocab,
                                    'langcode' => $langcode,
                                ]);
                                $term->save();

                                $taxonomy_terms[] = ['target_id' => $term->id()];
                            }
                        }

                        return $taxonomy_terms;
                    default:
                        return '';
                }

                return $field_data["value"][0];
            case 'dynamic_entity_reference':
                $entity_manager = \Drupal::service('entity_type.manager');
                $entity_fields = $entity_manager->getFieldDefinitions($entity_type, $entity_name);
                $field_settings = $entity_fields[$field_name]->getSettings();

                $taxonomy_terms = $entity_manager->getStorage('taxonomy_term')->loadByProperties(['name' => "_none"]);

                if ($field_settings['taxonomy_term']['handler_settings']['auto_create'] == 1) {
                    $vocab = $field_settings['taxonomy_term']['handler_settings']['auto_create_bundle'];
                } else {
                    $vocab = current($field_settings['taxonomy_term']['handler_settings']['target_bundles']);
                }

                foreach ($field_data["value"] as $term_name) {
                    $terms = $entity_manager->getStorage('taxonomy_term')->loadByProperties(['name' => $term_name]);
                    $term = reset($terms);

                    if (!empty($term)) {
                        $taxonomy_terms = $term;
                    } else {
                        $term = Term::create([
                            'name' => $term_name,
                            'vid' => $vocab,
                            'langcode' => $langcode,
                        ]);
                        $term->save();

                        $taxonomy_terms = $term;
                    }
                }

                return $taxonomy_terms;
            case 'text':
            case 'text_long':
            case 'text_with_summary':
                return [
                    'value' => $field_data["value"][0],
                    'format' => 'full_html',
                ];
            case 'string':
            default:
                return $field_data["value"][0];
        }
    }

    /**
     * @param $type
     * @param $data
     * @param $entity_type
     * @param $entity_name
     * @param $langcode
     * @return array
     * @throws \Drupal\Core\Entity\EntityStorageException
     */
    private function createParagraph($type, $data, $entity_type, $entity_name, $langcode)
    {
        $paragraph = [
            'type' => $type,
            'langcode' => $langcode,
        ];

        $fields = $this->processFields($data, $entity_type, $entity_name, $langcode);

        $paragraph = array_merge($paragraph, $fields);

        $entity = Paragraph::create($paragraph);
        $entity->save();

        return [
            'target_id' => $entity->id(),
            'target_revision_id' => $entity->getRevisionId(),
        ];
    }

    /**
     * Exports all content types for this installation
     *
     * @return file
     */
    public function exportContent()
    {
        $entity_manager = \Drupal::service('entity_type.manager');
        $response = [];

        // Export Content Types
        $content_types = $entity_manager->getStorage('node_type')->loadMultiple();
        foreach ($content_types as $type) {
            $response[] = [
                "name" => $type->label(),
                "machine_name" => $type->id(),
                "type" => 'node',
                "fields" => $this->_exportFields('node', $type->id()),
            ];
        }

        // Export Paragraph Types
        $paragraph_types = $entity_manager->getBundleInfo('paragraph');
        foreach ($paragraph_types as $paragraph_type => $paragraph_name) {
            $response[] = [
                "name" => $paragraph_name['label'],
                "machine_name" => $paragraph_type,
                "type" => 'paragraph',
                "fields" => $this->_exportFields('paragraph', $paragraph_type),
            ];
        }

        header('Content-disposition: attachment; filename=ContentTypes' . time() . '.json');
        header('Content-type: application/json');
        return new JsonResponse($response);
    }

    /**
     * Get list of fields
     *
     * @param $entity_type
     * @param $entity_name
     * @return array
     */
    private function _exportFields($entity_type, $entity_name)
    {
        $entity_manager = \Drupal::service('entity_type.manager');
        $entity_fields = $entity_manager->getFieldDefinitions($entity_type, $entity_name);

        $fields = [];
        foreach ($entity_fields as $field) {
            $field_name = $field->toArray()['field_name'];

            $settings = [];
            if (!in_array($field_name, self::EXCLUDE_FIELDS)) {
                $settings['type'] = $field->getType();
                $field_settings = $field->getSettings();
                $cardinality = $field->getFieldStorageDefinition()->getCardinality();

                switch ($cardinality <=> 1) {
                    case -1:
                        $settings['multiple'] = 1;
                        break;
                    case 0:
                        $settings['multiple'] = 0;
                        break;
                    case 1:
                        $settings['multiple'] = 1;
                        break;
                }

                switch ($settings['type']) {
                    case "string":
                        $settings['max_length'] = $field_settings['max_length'];
                        break;
                    case "entity_reference":
                        $settings['target'] = $field_settings['target_type'];
                        break;
                    case "entity_reference_revisions":
                        if ($field_settings['target_type'] == 'paragraph') {
                            $settings['target'] = $field_settings['target_type'];
                            $settings['is_paragraph_field'] = 1;
                            $settings['paragraphs'] = $field_settings['handler_settings']['target_bundles'];
                        }
                        break;
                }

                $fields[] = [
                    "name" => $field_name,
                    "required" => $field->toArray()['required'],
                    "settings" => $settings,
                ];
            }
        }

        return $fields;
    }

    /**
     * Saves out any html image paths to the drupal server
     *
     * @param $html
     * @param $find
     * @param $replace
     * @return string
     */
    private static function setImagePaths($html, $find, $replace)
    {
        $doc = new \DOMDocument();
        @$doc->loadHTML($html);

        $tags = $doc->getElementsByTagName('img');

        foreach ($tags as $tag):
            $target = 'public://' . uniqid() . '.jpg';

            $src = $tag->getAttribute('src');
            $original = $find . ltrim($src, "/");

            $file = file_save_data(
                file_get_contents($original),
                $target,
                FileSystemInterface::EXISTS_REPLACE
            );

            $html = str_replace($src, $file->toUrl(), $html);

        endforeach;

        return $html;
    }


    /**
     * Creates a new content item from the GC api
     *
     * @return void
     */
    public function createContentFromGC()
    {
        $post_data = $_POST;
        //file_put_contents(getcwd() . '/temp.txt', print_r(["time"=>time(), "data"=>$post_data], true));

        $data = [
            "type" => $post_data['machine_name']
        ];

        // Handle fields
        foreach ($post_data['fields'] as $key => $value):
            if (self::GC_FIELD_TYPE_IMAGE == $value['type']) {
                // Field is an image, save from URL
                $file = file_save_data(
                    file_get_contents($value['value']),
                    'public://' . uniqid() . '.jpg',
                    FileSystemInterface::EXISTS_REPLACE
                );

                $data[$value['machine_name']] = [
                    'target_id' => $file->id(),
                ];
            } else {
                $data[$value['machine_name']] = $value['value'];
            }
        endforeach;

        // Create the node
        $node = Node::create($data);
        $node->save();

        // Handle paragraphs
        foreach ($post_data['paragraphs'] as $key => $value):
            // Loop the first paragraph index ONLY
            // We get all subsequent indexes during this iteration
            $paragraph_data = [];

            foreach ($value['children'] as $c_key => $c_value):
                foreach ($c_value['values'] as $paragraph_key => $paragraph_value):

                    // Init an empty array at this key is not exists
                    if (!array_key_exists($paragraph_key, $paragraph_data)) {
                        $paragraph_data[$paragraph_key] = [
                            "type" => $value['machine_name']
                        ];
                    }

                    if (self::GC_FIELD_TYPE_IMAGE == $paragraph_value["value"]) {
                        $file = file_save_data(
                            file_get_contents($paragraph_value['value']),
                            'public://' . uniqid() . '.jpg',
                            FileSystemInterface::EXISTS_REPLACE
                        );

                        $paragraph_data[$paragraph_key][$c_value['machine_name']] = [
                            'target_id' => $file->id(),
                        ];
                    } else {
                        $paragraph_data[$paragraph_key][$c_value['machine_name']] = $paragraph_value["value"];
                    }

                endforeach;
            endforeach;

            // Save the paragraphs onto the node
            foreach ($paragraph_data as $new_paragraph):
                $paragraph = Paragraph::create($new_paragraph);
                $paragraph->save();
                $node->get($value['machine_name'])->appendItem($paragraph);
                $node->save();
            endforeach;

        endforeach;

        $response = [
            "success" => true,
            "data" => $post_data,
        ];

        return new JsonResponse($response);
    }
}

