<?php


namespace Drupal\schema_question\Plugin\metatag\Tag;

/**
 * Provides a plugin for the 'image' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_question_accepted_answer",
 *   label = @Translation("answer"),
 *   description = @Translation("REQUIRED BY GOOGLE. The accepted answer for this item."),
 *   name = "acceptedAnswer",
 *   group = "schema_question",
 *   weight = 2,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */

class SchemaQuestionAcceptedAnswer extends SchemaAcceptedAnswerBase
{

}