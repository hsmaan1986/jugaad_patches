<?php

namespace Drupal\schema_medical_condition\Plugin\metatag\Group;

use Drupal\schema_metatag\Plugin\metatag\Group\SchemaGroupBase;

/**
 * Provides a plugin for the 'ItemList' meta tag group.
 *
 * @MetatagGroup(
 *   id = "schema_multiple_products",
 *   label = @Translation("Schema.org: Multiple Product"),
 *   description = @Translation("See Schema.org definitions for this Schema type at <a href="":url"">:url</a>. Also see <a href="":url2"">Google's requirements</a>.", arguments = {
 *     ":url" = "https://schema.org/Product",
 *     ":url2" = "https://developers.google.com/search/docs/guides/mark-up-listings",
 *   }),
 *   weight = 10,
 * )
 */
class SchemaMultipleProducts extends SchemaGroupBase {
    // Nothing here yet. Just a placeholder class for a plugin.
}