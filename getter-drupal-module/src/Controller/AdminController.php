<?php

/**
 * @file
 * Contains \Drupal\getter\Controller\ApiController.
 */

namespace Drupal\getter\Controller;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class AdminController extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'getter_settings_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['getter.settings'];
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        // Get the module configuration
        $config = $this->config('getter.settings');

        $form['export'] = [
            '#type'     => 'html_tag',
            '#tag'      => 'span', 
            // '#value'    => '<a href="' . \Drupal::request()->getSchemeAndHttpHost() . '/getter/drupal/docroot/' .  '/admin/getter/export">Export</a>',
            '#value'    => '<a href="' . \Drupal::request()->getSchemeAndHttpHost() . '/admin/getter/export">Export</a>',
        ];

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config('getter.settings');
    }

    /**
     * Exports all content types for this installation
     *
     * @return file
     */
    public function export(){
        die("HELLO");
    }
}