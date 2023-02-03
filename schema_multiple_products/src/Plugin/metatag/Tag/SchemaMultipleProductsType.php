<?php

namespace Drupal\schema_multiple_products\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaItemListElementBreadcrumbBase;
use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaTypeBase;

/**
 * Provides a plugin for the 'schema_medical_condition_type' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_multiple_products_type",
 *   label = @Translation("@type"),
 *   description = @Translation("REQUIRED. The type of product."),
 *   name = "@type",
 *   group = "schema_multiple_products",
 *   weight = -10,
 *   type = "BreadcrumbList",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */

class SchemaMultipleProductsType extends SchemaTypeBase
{
    /**
     * {@inheritdoc}
     */
    public static function labels() {
        return ['BreadcrumbList'];
    }
}