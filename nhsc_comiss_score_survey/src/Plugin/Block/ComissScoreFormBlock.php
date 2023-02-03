<?php


namespace Drupal\nhsc_comiss_score_survey\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\nhsc_comiss_score_survey\Controller\ComissScoreController;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;

/**
 * Provides a 'Comiss Score' Block.
 *
 * @Block(
 *   id = "comiss_score_block",
 *   admin_label = @Translation("Comiss Score Survey Block"),
 *   status = 1,
 *
 * )
 */

class ComissScoreFormBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     *
     * This method defines form elements for custom block configuration. Standard
     * block configuration fields are added by BlockBase::buildConfigurationForm()
     * (block title and title visibility) and BlockFormController::form() (block
     * visibility settings).
     *
     * @see \Drupal\block\BlockBase::buildConfigurationForm()
     * @see \Drupal\block\BlockFormController::form()
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $config = $this->getConfiguration();

        $form['webform_id'] = [
            '#type'   => 'textfield',
            '#title'  => $this->t('Webform ID'),
            '#default_value' => $config['webform_id']
        ];

        $form['block_above_cutoff'] = [
            '#type' => 'text_format',
            '#format' => $config['block_above_cutoff_format'],
            '#title' => $this->t('Above Cut-Off Recommendation'),
            '#default_value' =>  $config['block_above_cutoff'],
        ];

        $form['block_above_first_cta_link'] = [
            '#type' => 'url',
            '#title' => $this->t('First CTA Link'),
            '#default_value' => $config['block_above_first_cta_link'],
        ];

        $form['block_above_first_cta_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First CTA Text'),
            '#default_value' => $config['block_above_first_cta_text'],
        ];

        $form['block_above_second_cta_link'] = [
            '#type' => 'url',
            '#title' => $this->t('Second CTA Link'),
            '#default_value' => $config['block_above_second_cta_link'],
        ];

        $form['block_above_second_cta_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Second CTA Text'),
            '#default_value' => $config['block_above_second_cta_text'],
        ];


        $form['block_comiss_score_below_cutoff'] = [
            '#type' => 'text_format',
            '#format' => $config['block_comiss_score_below_cutoff_format'],
            '#title' => $this->t('Below Cut-Off Recommendation'),
            '#default_value' => $config['block_comiss_score_below_cutoff'],
        ];


        $form['block_below_first_cta_link'] = [
            '#type' => 'url',
            '#title' => $this->t('First CTA Link'),
            '#default_value' => $config['block_below_first_cta_link'],
        ];

        $form['block_below_first_cta_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First CTA Text'),
            '#default_value' => $config['block_below_first_cta_text'],
        ];

        $form['block_below_second_cta_link'] = [
            '#type' => 'url',
            '#title' => $this->t('Second CTA Link'),
            '#default_value' => $config['block_below_second_cta_link'],
        ];

        $form['block_below_second_cta_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Second CTA Text'),
            '#default_value' => $config['block_below_second_cta_text'],
        ];



        $form['block_comiss_score_content'] = [
            '#type' => 'text_format',
            '#format' => $config['block_comiss_score_content_format'],
            '#title' => 'Form Content',
            '#default_value' => $config['block_comiss_score_content'],
        ];

        $form['block_comiss_score_webform_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Form Name'),
            '#description' => $this->t('Name of the webform'),
            '#default_value' => $config['block_comiss_score_webform_name'],
        ];

        $form['block_comiss_survey_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Survey Title'),
            '#description' => $this->t('Survey Title'),
            '#default_value' => $config['block_comiss_survey_title'],
        ];

        $form['block_comiss_score_cutoff_value'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Cut-Off Value'),
            '#default_value' => $config['block_comiss_score_cutoff_value'],
        ];

        $form['block_comiss_score_total_score'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Total Score'),
            '#default_value' => $config['block_comiss_score_total_score'],
        ];



        $form['block_company_logo_location'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Company Logo'),
            '#description' => $this->t('Location Company Logo'),
            '#upload_location' => 'public://images',
        ];

        $form['block_copy_right_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Copy Right Text'),
            '#description' => $this->t('Location Company Logo'),
            '#default_value' => $config['block_copy_right_text'],
        ];

        $form['block_purpose_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Purpose Title'),
            '#description' => $this->t('Purpose Title'),
            '#default_value' => $config['block_purpose_title'],
        ];

        $form['block_purpose_copy'] = [
            '#type' => 'text_format',
            '#format' => $config['block_purpose_copy_format'],
            '#title' => $this->t('Purpose Copy'),
            '#description' => $this->t('Purpose Copy'),
            '#default_value' => $config['block_purpose_copy'],
        ];

        $form['block_instructions_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Scoring Instructions Title'),
            '#description' => $this->t('Scoring Instructions Title'),
            '#default_value' => $config['block_instructions_title'],
        ];


        $form['block_instructions_copy'] = [
            '#type' => 'text_format',
            '#format' => $config['block_instructions_copy_format'],
            '#title' => $this->t('Scoring Instructions Copy'),
            '#description' => $this->t('Instructions Copy'),
            '#default_value' => $config['block_instructions_copy'],
        ];

        $form['block_reading_results_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Reading Results Title'),
            '#description' => $this->t('Reading Results Title'),
            '#default_value' => $config['block_reading_results_title'],
        ];

        $form['block_reading_results_copy'] = [
            '#type' => 'text_format',
            '#format' => $config['block_reading_results_copy_format'],
            '#title' => $this->t('Reading Results Copy'),
            '#description' => $this->t('Reading Results Copy'),
            '#default_value' => $config['block_reading_results_copy'],
        ];

        $form['block_form_print_footer'] = [
            '#type' => 'text_format',
            '#format' => $config['block_form_print_footer_format'],
            '#title' => $this->t('Print Form Footer Copy'),
            '#description' => $this->t('Print Form Footer Copy'),
            '#default_value' => $config['block_form_print_footer'],
        ];

        return $form;
    }

    public function blockSubmit($form, FormStateInterface $form_state)
    {
        // Get the config
        $config = $this->getConfiguration();

        // Get the form
        $form_values = $form_state->getValues();

        $this->setConfigurationValue("webform_id", $form_values['webform_id']);

        $this->setConfigurationValue("block_above_cutoff", $form_values['block_above_cutoff']['value']);
        $this->setConfigurationValue("block_above_cutoff_format", $form_values['block_above_cutoff']['format']);

        $this->setConfigurationValue("block_above_first_cta_link", $form_values['block_above_first_cta_link']);
        $this->setConfigurationValue("block_above_first_cta_text", $form_values['block_above_first_cta_text']);
        $this->setConfigurationValue("block_above_second_cta_link", $form_values['block_above_second_cta_link']);
        $this->setConfigurationValue("block_above_second_cta_text", $form_values['block_above_second_cta_text']);

        $this->setConfigurationValue("block_comiss_score_below_cutoff", $form_values['block_comiss_score_below_cutoff']['value']);
        $this->setConfigurationValue("block_comiss_score_below_cutoff_format", $form_values['block_comiss_score_below_cutoff']['format']);

        $this->setConfigurationValue("block_below_first_cta_link", $form_values['block_below_first_cta_link']);
        $this->setConfigurationValue("block_below_first_cta_text", $form_values['block_below_first_cta_text']);
        $this->setConfigurationValue("block_below_second_cta_link", $form_values['block_below_second_cta_link']);
        $this->setConfigurationValue("block_below_second_cta_text", $form_values['block_below_second_cta_text']);

        $this->setConfigurationValue("block_comiss_score_content", $form_values['block_comiss_score_content']['value']);
        $this->setConfigurationValue("block_comiss_score_content_format", $form_values['block_comiss_score_content']['form']);

        $this->setConfigurationValue("block_comiss_score_webform_name", $form_values['block_comiss_score_webform_name']);

        $this->setConfigurationValue("block_comiss_survey_title", $form_values['block_comiss_survey_title']);
        $this->setConfigurationValue("block_comiss_score_cutoff_value", $form_values['block_comiss_score_cutoff_value']);
        $this->setConfigurationValue("block_comiss_score_total_score", $form_values['block_comiss_score_total_score']);
        $this->setConfigurationValue("block_company_logo_location", $form_values['block_company_logo_location']);
        $this->setConfigurationValue("block_copy_right_text", $form_values['block_copy_right_text']);
        $this->setConfigurationValue("block_purpose_title", $form_values['block_purpose_title']);

        $this->setConfigurationValue("block_purpose_copy", $form_values['block_purpose_copy']['value']);
        $this->setConfigurationValue("block_purpose_copy_format", $form_values['block_purpose_copy']['format']);

        $this->setConfigurationValue("block_instructions_title", $form_values['block_instructions_title']);

        $this->setConfigurationValue("block_instructions_copy", $form_values['block_instructions_copy']['value']);
        $this->setConfigurationValue("block_instructions_copy_format", $form_values['block_instructions_copy']['format']);

        $this->setConfigurationValue("block_reading_results_title", $form_values['block_reading_results_title']);

        $this->setConfigurationValue("block_reading_results_copy", $form_values['block_reading_results_copy']['value']);
        $this->setConfigurationValue("block_reading_results_copy_format", $form_values['block_reading_results_copy']['format']);

        $this->setConfigurationValue("block_form_print_footer", $form_values['block_form_print_footer']['value']);
        $this->setConfigurationValue("block_form_print_footer_format", $form_values['block_form_print_footer']['format']);

    }

    public function build()
    {
        $config         = $this->getConfiguration();

        $webform_id = $config['webform_id'];
        $block_above_cutoff = $config['block_above_cutoff'];
        $block_above_first_cta_link = $config['block_above_first_cta_link'];
        $block_above_first_cta_text = $config['block_above_first_cta_text'];
        $block_above_second_cta_link = $config['block_above_second_cta_link'];
        $block_above_second_cta_text = $config['block_above_second_cta_text'];
        $block_comiss_score_below_cutoff = $config['block_comiss_score_below_cutoff'];
        $block_below_first_cta_link = $config['block_below_first_cta_link'];
        $block_below_first_cta_text = $config['block_below_first_cta_text'];
        $block_below_second_cta_link = $config['block_below_second_cta_link'];
        $block_below_second_cta_text = $config['block_below_second_cta_text'];
        $block_comiss_score_content = $config['block_comiss_score_content'];
        $block_comiss_score_webform_name = $config['block_comiss_score_webform_name'];
        $block_comiss_survey_title = $config['block_comiss_survey_title'];
        $block_comiss_score_cutoff_value = $config['block_comiss_score_cutoff_value'];
        $block_comiss_score_total_score = $config['block_comiss_score_total_score'];
        $block_company_logo_location = $config['block_company_logo_location'];
        $block_copy_right_text = $config['block_copy_right_text'];
        $block_purpose_title = $config['block_purpose_title'];
        $block_purpose_copy = $config['block_purpose_copy'];
        $block_instructions_title = $config['block_instructions_title'];
        $block_instructions_copy = $config['block_instructions_copy'];
        $block_reading_results_title = $config['block_reading_results_title'];
        $block_reading_results_copy = $config['block_reading_results_copy'];
        $block_form_print_footer = $config['block_form_print_footer'];

        $controller     = new ComissScoreController(
            $webform_id,
            $block_above_cutoff,
            $block_above_first_cta_link,
            $block_above_first_cta_text,
            $block_above_second_cta_link,
            $block_above_second_cta_text,
            $block_comiss_score_below_cutoff,
            $block_below_first_cta_link,
            $block_below_first_cta_text,
            $block_below_second_cta_link,
            $block_below_second_cta_text,
            $block_comiss_score_content,
            $block_comiss_score_webform_name,
            $block_comiss_survey_title,
            $block_comiss_score_cutoff_value,
            $block_comiss_score_total_score,
            $block_company_logo_location,
            $block_copy_right_text,
            $block_purpose_title,
            $block_purpose_copy,
            $block_instructions_title,
            $block_instructions_copy,
            $block_reading_results_title,
            $block_reading_results_copy,
            $block_form_print_footer
        );
        $renderInBlock  = $controller->comissScoreForm();

        return $renderInBlock;
    }
}