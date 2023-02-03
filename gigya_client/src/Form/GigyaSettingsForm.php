<?php

/**
 * Created by PhpStorm.
 * User: rawdreeg
 * Date: 2018/04/25
 * Time: 10:18 PM
 */

namespace Drupal\gigya_client\Form;


use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\AliasStorage;
/**
 * Class GigyaSettingsForm
 * @package Drupal\gigya_client\Form
 */
const SETTINGS_KEY = 'gigya_client.settings';

class GigyaSettingsForm extends ConfigFormBase{
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return "gigya_client_settings";
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $config = $this->config("gigya_client.settings");

        $form["gigya_raas_settings"] = array(
            "#type" => "details",
            "#title" => t("raas screen settings"),
            "#description" => t("Sets default screenset and starting screen"),
            '#open' => TRUE,
        );

        $form["gigya_config_settings"] = array(
            "#type" => "details",
            "#title" => t("Extra gigya config settings"),
            '#open' => TRUE,
        );

        $form["gigya_config_settings"]["extra"] = array(
            '#title' => t('Config settings'),
            "#type" => "details",
            '#description' => $this->t('<b>ENCRYPTION KEY</b><br/>Click <a href=/admin/config/services/gigya-client/key>here</a> to upload a new encryption key for the implementation.'),
            '#open' => TRUE,
        );

        $form["gigya_config_settings"]["landing_pages"] = array(
            '#title' => t('Extra screen settings'),
            "#type" => "details",
            '#open' => TRUE,
        );

        $form["gigya_config_settings"]["css_stylesheet_options"] = array(
          '#title' => t('CSS Stylesheet Settings'),
          "#type" => "details",
          '#open' => TRUE,
        );

        $form["gigya_config_settings"]["email_settings"] = array(
            '#title' => t('Welcome email settings'),
            "#type" => "details",
            '#open' => TRUE,
        );

        $form["gigya_config_settings"]["css_stylesheet_options"]['gigya_default_stylesheet'] = array(
          '#title' => t('Default Stylesheet'),
          '#type' => 'select',
          '#options' => $this->getModuleStylesheets(),
          '#default_value' => $config->get('gigya_client.gigya_default_stylesheet')
        );

        $form["gigya_raas_settings"]['raas_login_screenset'] = array(
            '#title' => t('RAAS login screenset'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.raas_login_screenset')

        );

        $form["gigya_raas_settings"]['raas_login_startscreen'] = array(
            '#title' => t('RAAS login starting screen'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.raas_login_startscreen')

        );

        $form["gigya_raas_settings"]['raas_register_screenset'] = array(
            '#title' => t('RAAS register screenset'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.raas_register_screenset')

        );

        $form["gigya_raas_settings"]['raas_register_startscreen'] = array(
            '#title' => t('RAAS register starting screen'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.raas_register_startscreen')

        );

        $form["gigya_raas_settings"]['raas_profile_screenset'] = array(
            '#title' => t('RAAS profile screenset'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.raas_profile_screenset')

        );

        $form["gigya_raas_settings"]['raas_profile_startscreen'] = array(
            '#title' => t('RAAS profile starting screen'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.raas_profile_startscreen')

        );

        $form["gigya_config_settings"]["extra"]['gigya_lang'] = array(
            '#title' => t('Language'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_lang')

        );

        $form["gigya_config_settings"]["extra"]['gigya_lang_2'] = array(
            '#title' => t('Secondary Language (if any)'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_lang_2')

        );

        $form["gigya_config_settings"]['extra']['gigya_pages_list'] = array(
            '#title' => t('List of gigya pages'),
            '#type' => 'textarea',
            '#default_value' => $config->get('gigya_client.gigya_pages_list')
        );


        //thank_you page

        $form["gigya_config_settings"]["landing_pages"]['gigya_thankyou_screen'] = array(
            '#title' => t('Thank you screen'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_thankyou_screen')

        );

        $form["gigya_config_settings"]["landing_pages"]['gigya_thankyou_page_alias'] = array(
            '#title' => t('Thank you alias'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_thankyou_page_alias')

        );

        //change pwd page

        $form["gigya_config_settings"]["landing_pages"]['gigya_reset_pwd_screen'] = array(
            '#title' => t('reset password screen'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_reset_pwd_screen')

        );

        $form["gigya_config_settings"]["landing_pages"]['gigya_reset_pwd_alias'] = array(
            '#title' => t('reset password alias'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_reset_pwd_alias')

        );

        //Request pwd page

        $form["gigya_config_settings"]["landing_pages"]['gigya_request_pwd_screen'] = array(
            '#title' => t('Request password screen'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_request_pwd_screen')

        );

        $form["gigya_config_settings"]["landing_pages"]['gigya_request_pwd_alias'] = array(
            '#title' => t('Request password alias'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_request_pwd_alias')

        );


        //Change pwd page

        $form["gigya_config_settings"]["landing_pages"]['gigya_change_pwd_screen'] = array(
            '#title' => t('Change password screen'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_change_pwd_screen')

        );

        $form["gigya_config_settings"]["landing_pages"]['gigya_change_pwd_alias'] = array(
            '#title' => t('Change password alias'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_change_pwd_alias')

        );


        // profile page

      $form["gigya_config_settings"]["landing_pages"]['gigya_profile_page_alias'] = array(
        '#title' => t('Profile page alias'),
        '#type' => 'textfield',
        '#default_value' => $config->get('gigya_client.gigya_profile_page_alias')

      );

      // Login page

      $form["gigya_config_settings"]["landing_pages"]['gigya_login_page_alias'] = array(
        '#title' => t('Login page alias'),
        '#type' => 'textfield',
        '#default_value' => $config->get('gigya_client.gigya_login_page_alias')

      );

      // Update interest.
	    $form["gigya_config_settings"]["landing_pages"]['gigya_update_interest_alias'] = array(
		    '#title' => t('Interest page alias'),
		    '#type' => 'textfield',
		    '#default_value' => $config->get('gigya_client.gigya_update_interest_alias')
	    );
	    $form["gigya_config_settings"]["landing_pages"]['gigya_interest_screen_id'] = array(
		    '#title' => t('Interest screen id'),
		    '#type' => 'textfield',
		    '#default_value' => $config->get('gigya_client.gigya_interest_screen_id')
	    );

	    // Update Preferences.
	    $form["gigya_config_settings"]["landing_pages"]['gigya_update_preferences_alias'] = array(
		    '#title' => t('Preferences page alias'),
		    '#type' => 'textfield',
		    '#default_value' => $config->get('gigya_client.gigya_update_preferences_alias')
	    );
	    $form["gigya_config_settings"]["landing_pages"]['gigya_update_preferences_id'] = array(
		    '#title' => t('Preferences screen id'),
		    '#type' => 'textfield',
		    '#default_value' => $config->get('gigya_client.gigya_update_preferences_id')
	    );

      // additional email settings

        $form["gigya_config_settings"]['email_settings']['gigya_secret_key'] = array(
            '#title' => t('Secret Key'),
            '#type' => 'textfield',
            '#default_value' => $config->get('gigya_client.gigya_secret_key')

        );

        $form["gigya_config_settings"]['email_settings']['gigya_send_welcome_email'] = array(
            '#title' => t('Send welcome email'),
            '#type' => 'checkbox',
            '#default_value' => $config->get('gigya_client.gigya_send_welcome_email')

        );

        $form["gigya_config_settings"]['email_settings']['gigya_email_template'] = array(
            '#title' => t('HTML email template'),
            '#type' => 'textarea',
            '#default_value' => $config->get('gigya_client.gigya_email_template')

        );

        $form["gigya_config_settings"]['email_settings']['gigya_email_template_2'] = array(
            '#title' => t('Second language HTML email template'),
            '#type' => 'textarea',
            '#default_value' => $config->get('gigya_client.gigya_email_template_2')

        );



        $form['actions']["populate"] = array(
            "#type" => "submit",
            "#title" => $this->t("Create default pages"),
            "#value" => $this->t("Create default pages"),
            "#submit" => array([$this, 'populatepages']),
        );


        return parent::buildForm($form, $form_state);

    }

    function getModuleStylesheets() {

      $module_css_path = drupal_get_path('module', 'gigya_client') . '/libraries/css';
      $css_stylesheets = array_diff(scandir($module_css_path), array('.', '..', 'style.css'));

      $stylesheet_options = array();
      foreach ($css_stylesheets as $stylesheet_name)
      {
        $stylesheet_options[$stylesheet_name] = $this->t($stylesheet_name);
      }

      return $stylesheet_options;
    }

    function populatepages(){

        $listPages=\Drupal::config(SETTINGS_KEY)->get("gigya_client.gigya_pages_list");
        $pagesAliases  =  isset($listPages)? preg_split ('/\s*\R\s*/', rtrim($listPages)) : array();

        $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
        $aliasStorage = \Drupal::service('path_alias.manager');
        $pageURL = null;
        $blockID = null;
        $themeConfig = \Drupal::config('system.theme');

        $theme = $themeConfig->get('default');



        foreach ($pagesAliases as $page){
            $screenType =  explode(' ', $page);
            $pageURL = $screenType[0];
            

            if(!empty($aliasStorage->getAliasByPath($pageURL, $language))){
                if($this->createPage('page', t($page), $pageURL)){
                    if(in_array('login',$screenType)){
                        $blockID = 'gigya_raas_login';
                        $this->createBlock($blockID. '_' .$this->generateRandomString(),$blockID, $page, $theme, $pageURL);
                    }elseif (in_array('register', $screenType)){
                        $blockID = 'gigya_raas_register';
                        $this->createBlock($blockID. '_' .$this->generateRandomString(),$blockID, $page, $theme, $pageURL);
                    }elseif (in_array('profile', $screenType)){
                        $blockID = 'gigya_raas_profile';
                        $this->createBlock($blockID.'_'.$this->generateRandomString(),$blockID, $page, $theme, $pageURL);
                    }
                }
            }
        }

    }

    function createPage($type, $title, $alias){

        $page = \Drupal\node\Entity\Node::create([
            'type'                 => $type,
            'title'                => $title,
            'body'                 => '',
            'path' =>  [
                'alias' => $alias]

        ]);
        $page->setPublished();
        $res=$page->save();

        if ($res) {
          \Drupal::messenger()->addMessage("Pages created", 'status');
            return true;
        }else{
            return false;
        }
    }

    function createBlock($id, $plugin, $label, $theme, $pages=null){

        $values = array(
            // A unique ID for the block instance.
            'id' => $id,
            // The plugin block id as defined in the class.
            'plugin' => $plugin,
            // The machine name of the theme region.
            'region' => 'content',
            'settings' => array(
                'label' => $label,
                'label_display'=> '0',
            ),
            // The machine name of the theme.
            'theme' => $theme,
            'weight' => 100,
            'visibility' => array('request_path'=> [
                'id'=>'request_path',
                'pages' => $pages
                ]
            )
        );
        $block = \Drupal\block\Entity\Block::create($values);
        $res = $block->save();
        if ($res) {
          \Drupal::messenger()->addMessage("Block created", 'status');
        }
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

        $config = \Drupal::service("config.factory")->getEditable("gigya_client.settings");

        // BEGIN CONFIG VALUES WHEN FORM SAVED
        $raas_login_screenset= $form_state->getValue("raas_login_screenset");
        $raas_login_startscreen = $form_state->getValue("raas_login_startscreen");
        $raas_register_screenset = $form_state->getValue("raas_register_screenset");
        $raas_register_startscreen = $form_state->getValue("raas_register_startscreen");
        $raas_profile_screenset = $form_state->getValue("raas_profile_screenset");
        $raas_profile_startscreen = $form_state->getValue("raas_profile_startscreen");

        //extra settings
        $gigya_thankyou_screen = $form_state->getValue("gigya_thankyou_screen");
        $gigya_thankyou_page_alias = $form_state->getValue("gigya_thankyou_page_alias");
        $gigya_reset_pwd_screen = $form_state->getValue("gigya_reset_pwd_screen");
        $gigya_reset_pwd_alias = $form_state->getValue("gigya_reset_pwd_alias");
        $gigya_request_pwd_screen = $form_state->getValue("gigya_request_pwd_screen");
        $gigya_request_pwd_alias = $form_state->getValue("gigya_request_pwd_alias");
        $gigya_change_pwd_screen = $form_state->getValue("gigya_change_pwd_screen");
        $gigya_change_pwd_alias = $form_state->getValue("gigya_change_pwd_alias");
        $gigya_profile_page_alias = $form_state->getValue("gigya_profile_page_alias");
        $gigya_login_page_alias = $form_state->getValue("gigya_login_page_alias");

        $gigya_update_interest_alias = $form_state->getValue("gigya_update_interest_alias");
        $gigya_interest_screen_id= $form_state->getValue("gigya_interest_screen_id");

        $gigya_update_preferences_alias = $form_state->getValue("gigya_update_preferences_alias");
	    $gigya_update_preferences_id = $form_state->getValue("gigya_update_preferences_id");

        $gigya_default_stylesheet = $form_state->getValue("gigya_default_stylesheet");

        $gigya_lang = $form_state->getValue("gigya_lang");
        $gigya_lang_2 = $form_state->getValue("gigya_lang_2");
        $gigya_pages_list = $form_state->getValue("gigya_pages_list");
        $gigya_send_welcome_email = $form_state->getValue("gigya_send_welcome_email");
        $gigya_email_template = $form_state->getValue("gigya_email_template");
        $gigya_email_template_2 = $form_state->getValue("gigya_email_template_2");
        $gigya_secret_key = $form_state->getValue("gigya_secret_key");



        // END CONFIG VALUES WHEN FORM SAVED
        // BEGIN SET VALUE ON CONFIG DATABASE
        $config->set("gigya_client.raas_login_screenset", $raas_login_screenset);
        $config->set("gigya_client.raas_login_startscreen", $raas_login_startscreen);
        $config->set("gigya_client.raas_register_screenset", $raas_register_screenset);
        $config->set("gigya_client.raas_register_startscreen", $raas_register_startscreen);
        $config->set("gigya_client.raas_profile_screenset", $raas_profile_screenset);
        $config->set("gigya_client.raas_profile_startscreen", $raas_profile_startscreen);
        $config->set("gigya_client.gigya_thankyou_screen", $gigya_thankyou_screen);
        $config->set("gigya_client.gigya_thankyou_page_alias", $gigya_thankyou_page_alias);
        $config->set("gigya_client.gigya_reset_pwd_screen", $gigya_reset_pwd_screen);
        $config->set("gigya_client.gigya_reset_pwd_alias", $gigya_reset_pwd_alias);
        $config->set("gigya_client.gigya_request_pwd_screen", $gigya_request_pwd_screen);
        $config->set("gigya_client.gigya_request_pwd_alias", $gigya_request_pwd_alias);
        $config->set("gigya_client.gigya_change_pwd_screen", $gigya_change_pwd_screen);
        $config->set("gigya_client.gigya_change_pwd_alias", $gigya_change_pwd_alias);
        $config->set("gigya_client.gigya_profile_page_alias", $gigya_profile_page_alias);
        $config->set("gigya_client.gigya_update_interest_alias", $gigya_update_interest_alias);
        $config->set("gigya_client.gigya_interest_screen_id", $gigya_interest_screen_id);

        $config->set("gigya_client.gigya_update_preferences_alias", $gigya_update_preferences_alias);
        $config->set("gigya_client.gigya_update_preferences_id", $gigya_update_preferences_id);

        $config->set("gigya_client.gigya_login_page_alias", $gigya_login_page_alias);
        $config->set("gigya_client.gigya_lang", $gigya_lang);
        $config->set("gigya_client.gigya_lang_2", $gigya_lang_2);
        $config->set("gigya_client.gigya_pages_list", $gigya_pages_list);
        $config->set("gigya_client.gigya_default_stylesheet", $gigya_default_stylesheet);
        $config->set("gigya_client.gigya_send_welcome_email", $gigya_send_welcome_email);
        $config->set("gigya_client.gigya_email_template", $gigya_email_template);
        $config->set("gigya_client.gigya_email_template_2"  , $gigya_email_template_2);
        $config->set("gigya_client.gigya_secret_key", $gigya_secret_key);



        //Save all
        $config->save();

        parent::submitForm($form, $form_state);

    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['gigya_client.settings'];
    }

}
