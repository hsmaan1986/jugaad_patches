<?php
/**
 * Created by PhpStorm.
 * User: raswiswia
 * Date: 2017/10/18
 * Time: 15:36
 */

namespace Drupal\nppe_module_html_site_importer\Form;

use Drupal\Core\Archiver\Zip;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StreamWrapper\PublicStream;
use Drupal\Core\StreamWrapper\StreamWrapperManagerInterface;
use Drupal\Core\StreamWrapper\TemporaryStream;
use Drupal\nppe_module_html_site_importer\Importer\CreateNode;
use Drupal\nppe_module_html_site_importer\Importer\HtmlImporter;
use Sunra\PhpSimple\HtmlDomParser;

class SiteImporterConfigForm extends ConfigFormBase
{
    /**
     * @return string
     */
    public function getFormId()
    {
        return 'site_importer_config';
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     * @return array
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        parent::buildForm($form, $form_state);

        $config = $this->config('site_importer.settings');
        $dir = base_path() . '/sites/default/files/importer_sites/';

        $form['file'] = array(
            '#type' => 'file',
            '#title' => t('Choose  File'),
//            '#upload_location' => file_prepare_directory($dir, FILE_CREATE_DIRECTORY),
            '#default_value' => $config->get('site_importer.filename'),
            '#description' => t('Upload file with site assets'),
            '#states' => array(
                'visible' => array(
                    ':input[name="File_type"]' => array('value' => t('Upload Your File')),
                ),
            ),
        );


      $form['site-name'] = array(
        '#type' => 'textfield',
        '#required' => true,
        '#default_value' => $config->get('site_importer.site-name'),
        '#title' => t('Site name'),
        '#description' => t('Upload file with site assets'),
      );

      $default_css_path_to_replace= $config->get('site_importer.css-paths-to-replace')? $config->get('site_importer.css-paths-to-replace'):'/\.\/fonts|\.\/images|\.\/media\/font/';

      $form['css-paths-to-replace'] = array(
            '#type' => 'textfield',
            '#required' => true,
            '#default_value' => $default_css_path_to_replace,
            '#title' => t('Paths to replace in CSS'),
            '#description' => t('Paths to replace in CSS'),
        );

      $default_external_paths_to_ignore = $config->get('site_importer.external-paths-to-ignore')? $config->get('site_importer.external-paths-to-ignore'):'/cdn/';

      $form['external-paths-to-ignore'] = array(
        '#type' => 'textfield',
        '#required' => true,
        '#default_value' => $default_external_paths_to_ignore,
        '#title' => t('External Paths to Ignore'),
        '#description' => t('External Paths to Ignore'),
      );

      $form['symlinks-to-ignore'] = array(
        '#type' => 'textfield',
        '#default_value' => $config->get('site_importer.symlinks-to-ignore'),
        '#title' => t('Symlinks to Ignore'),
        '#description' => t('Symlinks Paths to Ignore normally animal/brand'),
      );

        $form['node-text-format'] = array(
            '#type' => 'select',
            '#title' => $this->t('Text Format'),
            '#default_value' => $config->get('full_html'),
            '#description' => $this->t('Text Format - CKEditor'),

        );
        $formats['all'] = \Drupal::entityTypeManager()->getStorage('filter_format')->loadByProperties(['status' => TRUE],['editor' => "ckeditor"]);
        foreach ($formats['all'] as $format) {
            $form['node-text-format']['#options'][$format->id()] = $format->id();
        }

    $form['remove-header'] = array(
        '#type' => 'select',
        '#title' => $this->t("Remove Header Tag"),
        '#default_value' => $config->get('no'),
        '#description' => $this->t('Remove header tag from html page'),
        '#options' => array('no' => $this->t('No') , 'yes' => $this->t('Yes')),
    );

    $form['remove-footer'] = array(
        '#type' => 'select',
        '#title' => $this->t('Remove Footer Tag'),
        '#default_value' => $config->get('No'),
        '#description' => $this->t('Remove footer tag from html page'),
        '#options' => array('no' => $this->t('No') , 'yes' => $this->t('Yes')),
    );

        $form['create-main-nav'] = array(
            '#type' => 'select',
            '#title' => $this->t('Create Main NAV'),
            '#default_value' => $config->get('no'),
            '#description' => $this->t('Populate Main Navigation with links'),
            '#options' => array('no' => $this->t('No') , 'yes' => $this->t('Yes')),
        );

      $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => t('Import site')
        );

        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $all_files = $this->getRequest()->files->get('files', []);
        if (!empty($all_files['file'])) {
            $file_upload = $all_files['file'];
            if ($file_upload->isValid()) {
                $form_state->setValue('file', $file_upload->getRealPath());
                return;
            }
        }

        $form_state->setErrorByName('file', $this->t('The file could not be uploaded.'));
    }


    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $tempStream = new TemporaryStream();
        $tempFolder= $tempStream->getDirectoryPath();
        $publicStream = new PublicStream();
        $publicFolder = $publicStream->getDirectoryPath();
        $validators = ['file_validate_extensions' => ['zip']];
        $file = file_save_upload('file', $validators, "temporary://", 0, FileSystemInterface::EXISTS_REPLACE);
        if (!$file) {
            return;
        }


        $zip = new Zip($tempFolder.'/'. StreamWrapperManagerInterface::getTarget($file->getFileUri()));
        $zipfile = $zip->extract($tempFolder);
        $importer = (new HtmlImporter($tempFolder . '/' . $form_state->getValue('site-name'),$publicFolder,$form_state->getValue('css-paths-to-replace'),$form_state->getValue('external-paths-to-ignore')))->mapFiles();

        $files = $importer->getMapped()['html'];

        foreach ($files as $index => $file) {
            /* Only create menu from index.html */
            /*
             if (strpos($file, 'index.html') !== false) {
                drupal_set_message(t('$nav$file : ' . $file), 'error');
                drupal_set_message(t('$nav$fileContent : ' . file_get_contents($file)), 'error');
                $importer->createNavFromHtml(file_get_contents($file));
            }
            */

            $body = $importer->clean(file_get_contents($file));
            if($form_state->getValue('remove-header') === "yes") {
                \Drupal::messenger()->addMessage(t('remove-header' ), 'error');
                $body = $importer->removeTagHtml("header", $body);
            }
            if($form_state->getValue('remove-footer') === "yes") {
                \Drupal::messenger()->addMessage(t('remove-footer'), 'error');
                $body = $importer->removeTagHtml("footer", $body);
            }
            $title = HtmlDomParser::str_get_html($body)->find('title')[0]->text();
            $url = str_replace('.html', '', preg_replace("/^.*?" . preg_quote($importer->getDir(), '/') . "/", '', $file));
            $symlinksToReplace = trim($form_state->getValue('symlinks-to-ignore'));
            if(!empty( $symlinksToReplace))
            {
              $url = preg_replace($symlinksToReplace,"",$url);

            }

            (new CreateNode($title, $body, $url, $form_state->getValue('node-text-format')))->save();
        }

        $importer->copyAssets(DRUPAL_ROOT.'/'.$publicFolder,$tempFolder . '/' . $form_state->getValue('site-name'));
        $config = $this->config('site_importer.settings');
        $config->set('site_importer.site-name', $form_state->getValue('site-name'));
        $config->set('site_importer.filename', $form_state->getValue('file'));
        $config->set('site_importer.css-paths-to-replace', $form_state->getValue('css-paths-to-replace'));
        $config->set('site_importer.external-paths-to-ignore', $form_state->getValue('external-paths-to-ignore'));
        $config->set('site_importer.symlinks-to-ignore', $form_state->getValue('symlinks-to-ignore'));
        $config->set('site_importer.remove-header', $form_state->getValue('remove-header'));
        $config->set('site_importer.remove-footer', $form_state->getValue('remove-footer'));
        $config->set('site_importer.create-main-nav', $form_state->getValue('create-main-nav'));
        $config->set('site_importer.node-text-format', $form_state->getValue('node-text-format'));
        $config->save();

        drupal_flush_all_caches();

        parent::submitForm($form, $form_state);
    }

    /**
     * @return array
     */
    protected function getEditableConfigNames()
    {
        return [
            'site_importer.settings'
        ];
    }
}
