/**
 * @file
 * CKEditor 'drupalaudiofile' plugin admin behavior.
 */

(function ($, Drupal, drupalSettings) {

  "use strict";

  /**
   * Provides the summary for the "drupalaudiofile" plugin settings vertical tab.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches summary behaviour to the "drupalaudiofile" settings vertical tab.
   */
  Drupal.behaviors.ckeditorDrupalAudioFileSettingsSummary = {
    attach: function () {
      $('[data-ckeditor-plugin-id="drupalaudiofile"]').drupalSetSummary(function (context) {
        var root = 'input[name="editor[settings][plugins][drupalaudiofile][file_upload]';
        var $status = $(root + '[status]"]');
        var $extensions = $(root + '[extensions]"]');
        var $maxFileSize = $(root + '[max_size]"]');
        var $scheme = $(root + '[scheme]"]:checked');

        var extensions = $extensions.val() ? $extensions.val().split(', ').length : 1;
        var maxFileSize = $maxFileSize.val() ? $maxFileSize.val() : $maxFileSize.attr('placeholder');

        if (!$status.is(':checked')) {
          return Drupal.t('Uploads disabled');
        }

        var output = '';
        output += Drupal.t('Uploads enabled, max size: @size, @extensions allowed extension(s)', {'@size': maxFileSize, '@extensions': extensions});
        if ($scheme.length) {
          output += '<br />' + $scheme.attr('data-label');
        }
        return output;
      });
    }
  };

})(jQuery, Drupal, drupalSettings);
