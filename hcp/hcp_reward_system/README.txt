CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Troubleshooting

 INTRODUCTION
------------

The Reward System module gives the possibility to give a  reward to users. Using points
followed by specific  behavior has made by the user, providing to the administrators
control which content and with what behavior  the user its going to be rewarded.

The behaviors are implemented  using Plugin API for make it expandable and easy
for customize.

 * For a good description of how the Plugin API  works in Drupal 8, visit the project page:
   https://www.drupal.org/docs/8/api/plugin-api/plugin-api-overview

REQUIREMENTS
------------

This module requires the following modules:

* Views (https://drupal.org/project/views)

INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module. Visit:
   https://drupal.org/documentation/install/modules-themes/modules-8
   for further information.

ADD CUSTOM BEHAVIORS
-----------------------

1. Create a file in /Plugin/Reward folder in you custom module.

1. Write  you custom Class extending the RewardBase from the Reward System module
following the included template:

REWARD_PLUGIN_TEMPLATE.txt


CONFIGURATION
-------------

The module has no menu or modifiable settings. There is no configuration. When
enabled, the module will prevent the links from appearing. To get the links
back, disable the module and clear caches.

HOW TO USE
---------------

 * Go to the Achivements page (admin/config/hcp_reward_system/achivements) and click in add new :

   - Select the Achivement general information

   - Add each reward by content.
