<?php

namespace Drupal\schema_breadcrumb_list\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaItemListElementBreadcrumbBase;
use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaTypeBase;

/**
 * Provides a plugin for the 'type' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_breadcrumb_list_type",
 *   label = @Translation("@type"),
 *   description = @Translation("REQUIRED. The type of breadcrumb list."),
 *   name = "@type",
 *   group = "schema_breadcrumb_list",
 *   weight = -10,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaBreadCrumbListType extends SchemaItemListElementBreadcrumbBase {

}
