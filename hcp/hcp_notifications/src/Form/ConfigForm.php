<?php

namespace Drupal\hcp_notifications\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase
{

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'hcp_notifications.config',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'config_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('hcp_notification.config');

        $form['configuration'] = [
            '#type' => 'vertical_tabs',
            '#weight' => 99,
        ];
        $form['#tree'] = TRUE;

        $node_types = \Drupal\node\Entity\NodeType::loadMultiple();

        foreach ($node_types as $node_type) {
            $node_type_id = $node_type->id();
            $settings = \Drupal::configFactory()->get('hcp_notification.config')->get('configuration.' . $node_type_id);

            $settings = $settings ?: [
                'enable_notifications' => '',
                'email_subject' => '',
                'email_body' => '',
            ];
            $form[$node_type_id] = [
                '#type' => 'details',
                '#title' => $this->t('@label', ['@label' => $node_type->label()]),
                '#group' => 'configuration',
            ];
            $form[$node_type_id]['enable_notifications'] = [
                '#type' => 'checkbox',
                '#title' => $this->t('Enable Notifications'),
                '#default_value' => $settings['enabled'],
            ];
            $form[$node_type_id]['email_subject'] = [
                '#type' => 'textfield',
                '#title' => $this->t('Email Subject'),
                '#maxlength' => 255,
                '#size' => 64,
                '#default_value' => $settings['subject'],
            ];
            $form[$node_type_id]['email_body'] = [
                '#type' => 'textarea',
                '#title' => $this->t('Email Body'),
                '#default_value' => $settings['body'],
            ];
            // Add the token tree UI.
            $form[$node_type_id]['token_tree'] = array(
                '#theme' => 'token_tree_link',
                '#token_types' => array('node','user'),
                '#show_restricted' => FALSE,
                '#global_types' => FALSE,
            );
        }

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        parent::submitForm($form, $form_state);

        $config = $this->config('hcp_notification.config');

        $node_types = \Drupal\node\Entity\NodeType::loadMultiple();
        $values = $form_state->getValues();
        foreach ($node_types as $node_type) {
            $node_type_id = $node_type->id();
            $subject = $values[$node_type_id]['email_subject'];
            $enabled = $values[$node_type_id]['enable_notifications'];
            $body = $values[$node_type_id]['email_body'];

            \Drupal::configFactory()->getEditable('hcp_notification.config')
                ->set('configuration.' . $node_type_id , [
                    'enabled' => $enabled,
                    'subject' => $subject,
                    'body' => $body,
                ])
                ->save();
        }
    }

}
