<?php

namespace Drupal\schema_medical_condition\Plugin\metatag\Group;

use Drupal\schema_metatag\Plugin\metatag\Group\SchemaGroupBase;

/**
 * Provides a plugin for the 'ItemList' meta tag group.
 *
 * @MetatagGroup(
 *   id = "schema_medical_condition",
 *   label = @Translation("Schema.org: Medical Condition"),
 *   description = @Translation("See Schema.org definitions for this Schema type at <a href="":url"">:url</a>. Also see <a href="":url2"">Google's requirements</a>.", arguments = {
 *     ":url" = "https://schema.org/Question",
 *     ":url2" = "https://developers.google.com/search/docs/guides/mark-up-listings",
 *   }),
 *   weight = 10,
 * )
 */
class SchemaMedicalCondition extends SchemaGroupBase {
  // Nothing here yet. Just a placeholder class for a plugin.
}
