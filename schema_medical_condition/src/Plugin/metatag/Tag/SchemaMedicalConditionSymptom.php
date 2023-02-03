<?php


namespace Drupal\schema_medical_condition\Plugin\metatag\Tag;


use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'name' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_medical_condition_symptom",
 *   label = @Translation("Sign or Symptom"),
 *   description = @Translation("Medical Sign or Symptom"),
 *   name = "signOrSymptom",
 *   group = "schema_medical_condition",
 *   weight = -5,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */

class SchemaMedicalConditionSymptom extends SchemaMedicalConditionSymptomBase
{

}