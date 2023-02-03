<?php
/**
 * Created by PhpStorm.
 * User: Sboniso
 */

namespace Drupal\nhsc_ccg_spend_calculator\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Symfony\Component\HttpFoundation\Request;
use Drupal\nhsc_ccg_spend_calculator\Controller\CCGSpendController;

/**
 * Provides a 'CCG Spend Calculator' block.
 *
 * @Block(
 *   id = "nhsc_ccg_spend_calculator",
 *   admin_label = @Translation("CCG Spend Calculator"),
 *   status = 1
 * )
 */

class CCGSpendCalculatorBlock extends BlockBase
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
        $form['calculator'] = [
            '#type' => 'details',
            '#title' => t('Settings'),
            '#group' => 'settings',
            '#open' => TRUE,
        ];

        $form['calculator']['block_ccg_currency'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Currency Symbol'),
            '#description' => $this->t('Currency Symbol'),
            '#default_value' => $config['block_ccg_currency']
        ];

        $form['calculator']['block_ccg_footer_copy'] = [
            '#type' => 'text_format',
            '#format' => 'rich_text',
            '#title' => $this->t('Modal\'s Footer Copy'),
            '#default_value' => $config['block_ccg_footer_copy'],
        ];


        $form['product_info'] = [
            '#type' => 'details',
            '#title' => t('Product Info'),
            '#group' => 'settings',
            '#open' => TRUE,
        ];

        // product 1
        $form['product_info']['product1'] = [
            '#type' => 'details',
            '#title' => t('Product 1 Info'),
            '#group' => 'settings',
            '#open' => TRUE,
        ];

        $form['product_info']['product1']['block_product1_title'] = [
            '#type' => 'textfield',
            '#title' => t('Product 1 Title'),
            '#default_value' => $config['block_product1_title'],
        ];

        $form['product_info']['product1']['block_product1_image'] = [
            '#type' => 'managed_file',
            '#title' => t('Product 1 Image'),
            '#description' => t('Product 1 Image'),
            '#upload_location' => 'public://images',
            '#default_value' => $config['block_product1_image'],
        ];

        // product 2
        $form['product_info']['product2'] = [
            '#type' => 'details',
            '#title' => t('Product 2 Info'),
            '#group' => 'settings',
            '#open' => TRUE,
        ];

        $form['product_info']['product2']['block_product2_title'] = [
            '#type' => 'textfield',
            '#title' => t('Product 2 Title'),
            '#default_value' => $config['block_product2_title'],
        ];

        $form['product_info']['product2']['block_product2_image'] = [
            '#type' => 'managed_file',
            '#title' => t('Product 2 Image'),
            '#description' => t('Product 2 Image'),
            '#upload_location' => 'public://images',
            '#default_value' => $config['block_product2_image'],
        ];

        return $form;
    }

    /**
     *
     * {@inheritdoc}
     *
     */
    public function blockSubmit($form, FormStateInterface $form_state)
    {

        $form_values = $form_state->getValues();


        if ( $product1_image = $form_values['product_info']['product1']['block_product1_image'] ) {
            $product1_image_file = File::load( $product1_image [0] );
            $product1_image_file->setPermanent();
            $product1_image_file->save();
        }

        if ( $product2_image = $form_values['product_info']['product2']['block_product2_image'] ) {
            $product2_image_file = File::load($product2_image [0]);
            $product2_image_file->setPermanent();
            $product2_image_file->save();
        }

        $this->setConfigurationValue("block_ccg_currency", $form_values['calculator']['block_ccg_currency']);
        $this->setConfigurationValue("block_product1_title", $form_values['product_info']['product1']['block_product1_title']);
        $this->setConfigurationValue("block_product2_title", $form_values['product_info']['product2']['block_product2_title']);
        $this->setConfigurationValue("block_product1_image", $product1_image);
        $this->setConfigurationValue("block_product2_image", $product2_image);
        $this->setConfigurationValue("block_ccg_footer_copy", $form_values['calculator']['block_ccg_footer_copy']['value']);

    }

    /**
     * {@inheritdoc}
     *
     */
    public function build()
    {
        $config             = $this->getConfiguration();

        $ccg_currency       = $config['block_ccg_currency'];
        $product1_title     = $config['block_product1_title'];
        $product2_title     = $config['block_product2_title'];
        $product1_image     = $config['block_product1_image'];
        $product2_image     = $config['block_product2_image'];
        $ccg_footer_copy    = $config['block_ccg_footer_copy'];

        $controller     = new CCGSpendController(
            $ccg_currency,
            $product1_title,
            $product2_title,
            $product1_image,
            $product2_image,
            $ccg_footer_copy
        );

        $renderInBlock = $controller->ccgCalculatorForm();

        return $renderInBlock;
    }
}