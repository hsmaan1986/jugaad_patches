<?php


namespace Drupal\schema_medical_condition\Plugin\metatag\Tag;

/**
 * Provides a plugin for the 'image' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_medical_condition_associated_anatomy",
 *   label = @Translation("Associated Anatomy"),
 *   description = @Translation("REQUIRED BY GOOGLE. Associated Anatomy"),
 *   name = "associatedAnatomy",
 *   group = "schema_medical_condition",
 *   weight = -8,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */

class SchemaMedicalCauseAssociatedAnatomy extends SchemaAssociatedAnatomyBase
{

}