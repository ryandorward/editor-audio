CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Recommended Modules
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

This module allows you to add an Audio button to the CKEditor toolbar, 
which lets users upload audio files into content, and display it using the Html5 element.

 * For a full description of the module visit:
   https://www.drupal.org/project/editor_audio

 * To submit bug reports and feature suggestions, or to track changes visit:
   https://www.drupal.org/project/issues/editor_audio


REQUIREMENTS
------------

This module requires no modules outside of Drupal core.


INSTALLATION
------------

Install the CKEditor Audio Player upload module as you would normally install a
contributed Drupal module. Visit https://www.drupal.org/node/1897420 for further
information.


CONFIGURATION
-------------

    1. Navigate to Administration > Extend and enable the module.
    2. Navigate to Administration > Content Authoring > Text formats and editors
       and choose which which format to edit.
    3. Drag the speaker icon into the "Active toolbar".
    4. *** IMPORTANT *** If  the "Limit allowed HTML tags and correct faulty HTML" 
       filter is enabled, Add:
       <audio class controls src data-entity-type data-entity-uuid> 
       to "Allowed HTML Tags" in the settings vertical tabs.
    5. In the CKEditor plugin settings vertical tabs configure the settings for Audio upload.    
    6. Save configuration.


MAINTAINERS
-----------

 * Ryan Dorward (ryrye) - https://www.drupal.org/u/ryrye