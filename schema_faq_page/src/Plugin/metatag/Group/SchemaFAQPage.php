<?php

namespace Drupal\schema_faq_page\Plugin\metatag\Group;

use Drupal\schema_metatag\Plugin\metatag\Group\SchemaGroupBase;

/**
 * Provides a plugin for the 'FAQPage' meta tag group.
 *
 * @MetatagGroup(
 *   id = "schema_faq_page",
 *   label = @Translation("Schema.org: FAQPage"),
 *   description = @Translation("See Schema.org definitions for this Schema type at <a href="":url"">:url</a>. Also see <a href="":url2"">Google's requirements</a>.", arguments = {
 *     ":url" = "https://schema.org/FAQPage",
 *     ":url2" = "https://developers.google.com/search/docs/guides/mark-up-listings",
 *   }),
 *   weight = 10,
 * )
 */
class SchemaFAQPage extends SchemaGroupBase {
  // Nothing here yet. Just a placeholder class for a plugin.
}
