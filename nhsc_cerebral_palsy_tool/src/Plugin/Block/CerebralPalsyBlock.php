<?php

namespace Drupal\nhsc_cerebral_palsy_tool\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\taxonomy\Entity\Term;

/**
 * Provides a 'CerebralPalsyBlock' block.
 *
 * @Block(
 *  id = "cerebral_palsy_block",
 *  admin_label = @Translation("Cerebral palsy block"),
 * )
 */
class CerebralPalsyBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    return [
      '#theme' => 'nhsc_cerebral_palsy_tool',
    ];

  }

  /**
   * Builds the taxonomy tree into an associative array
   *
   * @param array $tree           The tree array passed by reference
   * @param object $object        The current object
   * @param string $vocabulary    The vocabulary name
   */
  protected function buildTree(&$tree, $object, $vocabulary, $level) {
    if ($object->depth != 0) {
      return;
    }

    $tree_data = [];

    $term_object = Term::load($object->tid);

    $tree[$object->tid]['id'] = $object->tid;
    $tree[$object->tid]['level'] = $level;
    $tree[$object->tid]['name'] = $object->name;

    // Load the paragraphs
    if ($term_object->field_cerebral_palsy_paragraphs->target_id  != NULL){
      $target_id = $term_object->field_cerebral_palsy_paragraphs->target_id;

      $paragraph = Paragraph::load($target_id);

      // Recommended description
      if ($paragraph->field_cerebral_palsy_product_des->value  != NULL){
        $tree[$object->tid]['recommendation_description'] = $paragraph->field_cerebral_palsy_product_des->value;
      }

      // Recommended title
      if ($paragraph->field_cerebral_palsy_title->value  != NULL){
        $tree[$object->tid]['recommendation_title'] = $paragraph->field_cerebral_palsy_title->value;
      }

      // Recommended sizes
      if ($paragraph->field_cerebral_palsy_size->value  != NULL){
        $tree[$object->tid]['recommendation_size'] = $paragraph->field_cerebral_palsy_size->value;
      }

      // Load the image
      if ($paragraph->field_cerebral_palsy_image->target_id !== NULL){
        $image_target_id = $paragraph->field_cerebral_palsy_image->target_id;
        $image_file = File::load($image_target_id);
        $image_absolute_path = file_create_url($image_file->getFileUri());
        $tree[$object->tid]['product_image'] = $image_absolute_path;
      }

      // Recommended Intake
      if ($paragraph->field_recommended_intake->target_id !== NULL){
        $intake_target_id = $paragraph->field_recommended_intake->target_id;

        foreach ($paragraph->field_recommended_intake as $intake) {
          $intakeParagraph = Paragraph::load($intake->target_id);

          // Recommended Intake Icon
          if ($paragraph->field_cerebral_palsy_icon->value  != NULL){
            $tree[$object->tid]['intake_icon'][] = $paragraph->field_cerebral_palsy_icon->value;
          }

          // Recommended Intake Percentage
          if ($paragraph->field_cerebral_palsy_percentage->value  != NULL){
            $tree[$object->tid]['percentage_icon'][] = $paragraph->field_cerebral_palsy_percentage->value;
          }

        }

      }

    }

    // Load the title
    if ($term_object->field_title->value  != NULL){
      $tree[$object->tid]['title'] = $term_object->field_title->value;
    }

    // Load the author
    if ($term_object->field_author->value  != NULL){
      $tree[$object->tid]['author'] = $term_object->field_author->value;
    }

    // Load the image
    // Author image
    if ($term_object->field_author_image->entity !== NULL){
      $absolute_path = file_create_url($term_object->field_author_image->entity->getFileUri());
      $tree[$object->tid]['image_author'] = $absolute_path;
    }

    // Load the image
    // Body image
    if ($term_object->field_image->entity !== NULL){
      $absolute_path = file_create_url($term_object->field_image->entity->getFileUri());
      $tree[$object->tid]['image'] = $absolute_path;
    }

    $children = \Drupal::entityTypeManager()
      ->getStorage('taxonomy_term')
      ->loadChildren($object->tid);

    if (!$children) {
      return;
    }

    $object_children = &$tree[$object->tid]['children'];
    $tree[$object->tid]['children'] = [];

    $child_tree_objects = \Drupal::entityTypeManager()
      ->getStorage('taxonomy_term')
      ->loadTree($vocabulary, $object->tid);

    $level++;
    foreach ($children as $child) {
      foreach ($child_tree_objects as $child_tree_object) {
        if ($child_tree_object->tid == $child->id()) {
          $this->buildTree($object_children, $child_tree_object, $vocabulary, $level);
        }
      }
    }
  }

}
