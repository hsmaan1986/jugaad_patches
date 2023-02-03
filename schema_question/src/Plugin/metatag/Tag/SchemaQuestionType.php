<?php

namespace Drupal\schema_question\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaTypeBase;

/**
 * Provides a plugin for the 'schema_question_type' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_question_type",
 *   label = @Translation("@type"),
 *   description = @Translation("REQUIRED. The type of item list."),
 *   name = "@type",
 *   group = "schema_question",
 *   weight = -10,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */
class SchemaQuestionType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return ['Question'];
  }

}
