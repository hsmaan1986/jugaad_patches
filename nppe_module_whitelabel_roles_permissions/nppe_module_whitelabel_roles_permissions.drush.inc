<?php

/**
 * @file Contains the code to generate the custom drush commands.
 */

use Drush\Drush;

/**
 * Implements hook_drush_command().
 */

function nppe_module_whitelabel_roles_permissions_drush_command() {
    $items = array();
    $items['reinstall_config'] = [
        'description' => 'Regenerates role config for whilelabel users',
        'drupal dependencies' => ['nppe_module_whitelabel_roles_permissions'],
        'arguments' => [
            'module' => 'Machine name of module',
        ],
        'aliases' => ['recreate-config'],
    ];
    return $items;
}
/**
 * Call back function drush_custom_drush_command_say_hello()
 * The call back function name in the  following format
 *   drush_{module_name}_{item_id_for_command}()
 */
function drush_nppe_module_whitelabel_roles_permissions_reinstall_config($module = 'nppe_module_whitelabel_roles_permissions') {
    try {
        \Drupal::service('config.installer')->installDefaultConfig('module', $module);
        Drush::output()->writeln('Config has been reset');

    } catch (\Exception $e) {
        Drush::output()->writeln('Error applying the config');
    }

}
?>
