<?php

namespace Drupal\editor_audio\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "drupalaudiofile" plugin.
 *
 * @CKEditorPlugin(
 *   id = "drupalaudiofile",
 *   label = @Translation("Audio upload"),
 *   module = "ckeditor"
 * )
 */
class DrupalAudioFile extends CKEditorPluginBase implements CKEditorPluginConfigurableInterface {

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return drupal_get_path('module', 'editor_audio') . '/js/plugins/drupalaudiofile/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [
      'core/drupal.ajax',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [
      'drupalAudioFile_dialogTitleAdd' => t('Add Audio'),
      'drupalAudioFile_dialogTitleEdit' => t('Edit Audio'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    $path = drupal_get_path('module', 'editor_audio') . '/js/plugins/drupalaudiofile';
    return [
      'DrupalAudioFile' => [
        'label' => t('Audio'),
        'image' => $path . '/icons/hidpi/audio32.png',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   *
   * @see \Drupal\editor\Form\EditorFileDialog
   * @see editor_audio_upload_settings_form()
   */
  public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor) {
    $form_state->loadInclude('editor_audio', 'admin.inc');
    $form['file_upload'] = editor_audio_upload_settings_form($editor);
    $form['file_upload']['#attached']['library'][] = 'editor_audio/drupal.ckeditor.drupalaudiofile.admin';
    $form['file_upload']['#element_validate'][] = [$this, 'validateAudioFileUploadSettings'];
    return $form;
  }

  /**
   * Validates the "file_upload" form element in settingsForm().
   *
   * Moves the text editor's file upload settings from the DrupalAudioFile plugin's
   * own settings into $editor->file_upload.
   *
   * @see \Drupal\editor\Form\EditorFileDialog
   * @see editor_audio_upload_settings_form()
   */
  public function validateAudioFileUploadSettings(array $element, FormStateInterface $form_state) {
    $settings = &$form_state->getValue($element['#parents']);
    $editor = $form_state->get('editor');

    $keys = [
      'status',
      'scheme',
      'directory',
      'extensions',
      'max_size',
    ];
    foreach ($keys as $key) {
      if (array_key_exists($key, $settings)) {
        $editor->setThirdPartySetting('editor_audio', $key, $settings[$key]);
      }
      else {
        $editor->unsetThirdPartySetting('editor_audio', $key);
      }
    }

    $form_state->unsetValue(array_slice($element['#parents'], 0, -1));
  }

}
