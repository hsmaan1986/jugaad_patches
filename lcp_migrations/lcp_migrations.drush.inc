<?php

/**
 * @file
 * Contains drush commands for lcp_migrations module.
 */

/**
 * Implements hook_drush_command().
 */
function lcp_migrations_drush_command() {
  $commands = [];
  $commands['generate-unique-id'] = [
    'description' => 'Fixes missing uuid in migration source JSON files.',
    'arguments' => [],
    'options' => [],
    'drupal dependencies' => ['lcp_migrations', 'migrate_tools'],
    'aliases' => ['guid'],
  ];
  return $commands;
}

/**
 * Fixes missing uuid in migration source JSON files.
 */
function drush_lcp_migrations_generate_unique_id() {
  $helper = \Drupal::service('lcp_migrations.migrations_helper');
  $list = $helper->getAllFiles();
  foreach ($list as $path) {
    $helper->updateUidInSourceJson($path);
  }
  Drush::output()->writeln(dt("Updated JSON files with correct UIDs."), 'debug');
}
