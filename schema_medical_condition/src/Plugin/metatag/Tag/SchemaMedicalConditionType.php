<?php

namespace Drupal\schema_medical_condition\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaTypeBase;

/**
 * Provides a plugin for the 'schema_medical_condition_type' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_medical_condition_type",
 *   label = @Translation("@type"),
 *   description = @Translation("REQUIRED. The type of medical conditon."),
 *   name = "@type",
 *   group = "schema_medical_condition",
 *   weight = -10,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaMedicalConditionType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return ['MedicalCondition'];
  }

}
