<?php
/**
 * Created by PhpStorm.
 * User: Sboniso
 * Date: 2018/10/08
 */

namespace Drupal\mobile_search\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\mobile_search\Controller\SearchController;

/**
 * Provides a 'Mobile Search' block.
 *
 * @Block(
 *   id = "nhsc_mobile_search",
 *   admin_label = @Translation("Mobile Search Block")
 * )
 */

class SearchControllerBlock extends BlockBase
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
    public function blockForm($form, FormStateInterface $form_state)
    {
        $config = $this->getConfiguration();

        $form['mobile_search_url'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Search Url'),
            '#description' => $this->t('i.e: /searchcontent'),
            '#default_value' => $config['mobile_search_url'],
        ];

        return $form;
    }

    public function build()
    {
        $config                 = $this->getConfiguration();
        $mobile_search_url      = $config['mobile_search_url'];

        $controller     = new SearchController($mobile_search_url);
        $renderInBlock  = $controller->getSearch();

        return $renderInBlock;
    }

    public function blockSubmit($form, FormStateInterface $form_state)
    {
        // Get the form values
        $form_values = $form_state->getValues();
        $this->setConfigurationValue("mobile_search_url", $form_values['mobile_search_url']);

    }
}