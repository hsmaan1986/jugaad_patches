<?php


namespace Drupal\schema_multiple_products\Plugin\metatag\Tag;

/**
 * Provides a plugin for the 'name' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_multiple_products_item_list",
 *   label = @Translation("Item List"),
 *   description = @Translation("Item List Elements"),
 *   name = "itemListElement",
 *   group = "schema_multiple_products",
 *   weight = -7,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */

class SchemaMultipleProductItemList extends SchemaMultipleProductsItemListBase
{

}