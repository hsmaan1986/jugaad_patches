<?php


namespace Drupal\schema_faq_page\Plugin\metatag\Tag;

/**
 * Provides a plugin for the 'image' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_faq_page_main_entity",
 *   label = @Translation("Main Entity"),
 *   description = @Translation("REQUIRED BY GOOGLE."),
 *   name = "mainEntity",
 *   group = "schema_faq_page",
 *   weight = 2,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */

class SchemaFAQPageMainEntity extends FAQPageMainEntityBase
{

}