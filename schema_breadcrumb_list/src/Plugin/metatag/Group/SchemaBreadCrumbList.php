<?php

namespace Drupal\schema_breadcrumb_list\Plugin\metatag\Group;

use Drupal\schema_metatag\Plugin\metatag\Group\SchemaGroupBase;

/**
 * Provides a plugin for the 'BreadcrumbList' meta tag group.
 *
 * @MetatagGroup(
 *   id = "schema_breadcrumb_list",
 *   label = @Translation("Schema.org: BreadcrumbList"),
 *   description = @Translation("See Schema.org definitions for this Schema type at <a href="":url"">:url</a>. Also see <a href="":url2"">Google's requirements</a>.", arguments = {
 *     ":url" = "https://schema.org/BreadcrumbList",
 *     ":url2" = "https://developers.google.com/search/docs/data-types/breadcrumb",
 *   }),
 *   weight = 10,
 * )
 */
class SchemaBreadCrumbList extends SchemaGroupBase {
  // Nothing here yet. Just a placeholder class for a plugin.
}
