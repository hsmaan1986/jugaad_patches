<?php


namespace Drupal\schema_medical_condition\Plugin\metatag\Tag;


use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'name' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_medical_condition_risk_factor",
 *   label = @Translation("Risk Factor"),
 *   description = @Translation("Risk Factor"),
 *   name = "riskFactor",
 *   group = "schema_medical_condition",
 *   weight = -6,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */

class SchemaMedicalConditionRiskFactor extends SchemaMedicalConditionRiskFactorBase
{

}