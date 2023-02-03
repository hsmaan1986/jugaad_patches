<?php

namespace Drupal\custom_schema_product\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'id' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_product_id",
 *   label = @Translation("id"),
 *   description = @Translation("The id of the product."),
 *   name = "productID",
 *   group = "schema_product",
 *   weight = 0,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaProductID extends SchemaNameBase {

}
