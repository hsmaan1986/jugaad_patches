<?php

/**
 * @file
 * Contains booking_entity.page.inc.
 *
 * Page callback for Advice Booking entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Advice Booking templates.
 *
 * Default template: booking_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_booking_entity(array &$variables) {
  // Fetch BookingEntity Entity Object.
  $booking_entity = $variables['elements']['#booking_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
