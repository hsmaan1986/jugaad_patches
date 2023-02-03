<?php

namespace Drupal\nhsc_sticky_buttons\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Floating Social Icon' Block.
 *
 * @Block(
 *   id = "floating_icons",
 *   admin_label = @Translation("Sticky Buttons Block"),
 *   category = @Translation("Sticky Button"),
 * )
 */
class FloatingSocialIconsBlock extends BlockBase {

	/**
	 * {@inheritdoc}
	 */
	public function build() {

		// Load the configuration from the form.
		$config = $this->getConfiguration();

		$configs        = \Drupal::config('nhsc_kwit.config');
		$kwit_brand_id  = $configs->get('brand_widget_id');

		$facebook = isset($config['facebook']) ? $config['facebook'] : '';
		$google_plus = isset($config['google_plus']) ? $config['google_plus'] : '';
		$linkedIn = isset($config['linkedIn']) ? $config['linkedIn'] : '';
		$twitter = isset($config['twitter']) ? $config['twitter'] : '';
		$pinterest = isset($config['pinterest']) ? $config['pinterest'] : '';
		$instagram = isset($config['instagram']) ? $config['instagram'] : '';
		$mail = isset($config['mail']) ? $config['mail'] : '';
		$youtube = isset($config['youtube']) ? $config['youtube'] : '';
		$customlink = isset($config['customlink']) ? $config['customlink'] : '';
		$fusepumpbutton = isset($config['fusepumpbutton']) ? $config['fusepumpbutton'] : '';
		$kwitbutton = isset($config['kwitbutton']) ? $config['kwitbutton'] : '';
		$kwitbutton_widget = isset($config['kwitbutton_widget']) ? $config['kwitbutton_widget'] : '';
		$icons = isset($config['place']) ? $config['place'] : '';
		$count = isset($config['count']) ? $config['count'] : '';
		$target = isset($config['target']) ? $config['target'] : '';
		$hover = isset($config['hover']) ? $config['hover'] : '';
		$customlink_fa_icon = isset($config['customlink_fa_icon']) ? $config['customlink_fa_icon'] : '';
		$fusepumpbutton_fa_icon = isset($config['fusepumpbutton_fa_icon']) ? $config['fusepumpbutton_fa_icon'] : '';
		$kwitbutton_fa_icon = isset($config['kwitbutton_fa_icon']) ? $config['kwitbutton_fa_icon'] : '';

		// Check title field for empty.
		$facebook_title = $config['facebook_title'] ?: 'Facebook';
		$google_plus_title = $config['google_plus_title'] ?: 'GooglePlus';
		$linkedIn_title = $config['linkedIn_title'] ?: 'LinkedIn';
		$twitter_title = $config['twitter_title'] ?: 'Twitter';
		$pinterest_title = $config['pinterest_title'] ?: 'Pinterest';
		$instagram_title = $config['instagram_title'] ?: 'Instagram';
		$mail_title = $config['mail_title'] ?: 'Mail';
		$youtube_title = $config['youtube_title'] ?: 'Youtube';
		$customlink_title = $config['customlink_title'] ?: 'CustomLink';
		$fusepumpbutton_title = $config['fusepumpbutton_title'] ?: 'FusepumpButton';
		$kwitbutton_title = $config['kwitbutton_title'] ?: 'KwitButton';

		$facebook_fa_icon = $config['facebook_fa_icon'] ?: 'fa-facebook';
		$twitter_fa_icon = $config['twitter_fa_icon'] ?: 'fa-twitter';
		$google_plus_fa_icon = $config['google_plus_fa_icon'] ?: 'fa-google-plus';
		$linkedIn_fa_icon = $config['linkedIn_fa_icon'] ?: 'fa-linkedin';
		$pinterest_fa_icon = $config['pinterest_fa_icon'] ?: 'fa-pinterest';
		$instagram_fa_icon = $config['instagram_fa_icon'] ?: 'fa-instagram';
		$mail_fa_icon = $config['mail_fa_icon'] ?: 'fa-envelope';
		$youtube_fa_icon = $config['youtube_fa_icon'] ?: 'fa-youtube';

		$facebook_bg_color = $config['facebook_bg_color'] ?: '#3b5998';
		$google_plus_bg_color = $config['google_plus_bg_color'] ?: '#dd4b39';
		$linkedIn_bg_color = $config['linkedIn_bg_color'] ?: '#007bb6';
		$twitter_bg_color = $config['twitter_bg_color'] ?: '#00aced';
		$pinterest_bg_color = $config['pinterest_bg_color'] ?: '#cb2027';
		$instagram_bg_color = $config['instagram_bg_color'] ?: 'linear-gradient(#683dc0, #f46833, #fcb050)';
		$mail_bg_color = $config['mail_bg_color'] ?: 'linear-gradient(#5a84fd, #6fe9ff)';
		$youtube_bg_color = $config['youtube_bg_color'] ?: '#f23f29';
		$customlink_bg_color = $config['customlink_bg_color'] ?: '#D598DE';
		$pumpbutton_bg_color = $config['pumpbutton_bg_color'] ?: '#d93fba';
		$kwitbutton_bg_color = $config['kwitbutton_bg_color'] ?: '#832E77';


		$social_values = [
			'facebook' => $facebook,
			'google_plus' => $google_plus,
			'linkedIn' => $linkedIn,
			'twitter' => $twitter,
			'pinterest' => $pinterest,
			'instagram' => $instagram,
			'mail' => $mail,
			'youtube' => $youtube,
			'customlink' => $customlink,
			// fa icons
			'facebook_fa_icon' => $facebook_fa_icon,
			'twitter_fa_icon' => $twitter_fa_icon,
			'google_plus_fa_icon' => $google_plus_fa_icon,
			'linkedIn_fa_icon' => $linkedIn_fa_icon,
			'pinterest_fa_icon' => $pinterest_fa_icon,
			'instagram_fa_icon' => $instagram_fa_icon,
			'mail_fa_icon' => $mail_fa_icon,
			'youtube_fa_icon' => $youtube_fa_icon,

			// background color
			'facebook_bg_color' => $facebook_bg_color,
			'google_plus_bg_color' => $google_plus_bg_color,
			'linkedIn_bg_color' => $linkedIn_bg_color,
			'twitter_bg_color' => $twitter_bg_color,
			'pinterest_bg_color' => $pinterest_bg_color,
			'instagram_bg_color' => $instagram_bg_color,
			'mail_bg_color' => $mail_bg_color,
			'youtube_bg_color' => $youtube_bg_color,
			'customlink_bg_color' => $customlink_bg_color,
			'pumpbutton_bg_color' => $pumpbutton_bg_color,
			'kwitbutton_bg_color' => $kwitbutton_bg_color,

			'fusepumpbutton' => $fusepumpbutton,
			'kwitbutton' => $kwitbutton,
			'customlink_fa_icon' => $customlink_fa_icon,
			'fusepumpbutton_fa_icon' => $fusepumpbutton_fa_icon,
			'kwitbutton_fa_icon' => $kwitbutton_fa_icon,
			'icons' => $icons,
			'count' => $count,
			'target' => $target,
			'hover' => $hover,
			'kwit_brand_id' => $kwitbutton_widget,
		];

		$social_titles = [
			'facebook_title' => $facebook_title,
			'google_plus_title' => $google_plus_title,
			'linkedIn_title' => $linkedIn_title,
			'twitter_title' => $twitter_title,
			'pinterest_title' => $pinterest_title,
			'instagram_title' => $instagram_title,
			'youtube_title' => $youtube_title,
			'customlink_title' => $customlink_title,
			'fusepumpbutton_title' => $fusepumpbutton_title,
			'kwitbutton_title' => $kwitbutton_title,
			'mail_title' => $mail_title,
		];


		// Fusepump button
		$fusepump_id    = $fusepumpbutton;
		$html_id        = 'fusepump-' . $fusepump_id;

		// kwit
		$kwit_id        = $kwitbutton;
		$kwit_html_id   = 'kwit-' . $kwit_id;

		return [
			'#theme' => 'nhsc_sticky_buttons_display',
			'#social_values' => $social_values,
			'#social_titles' => $social_titles,
			'#attached' => [
				'library' => [
					'nhsc_sticky_buttons/nhsc_sticky_buttons',
					'ln_fusepump/fusepump-library', // fusepump library
					'ln_fusepump/fusepump-connector', // fusepump library

					'nhsc_kwit/kwit-library', // kwit library
					'nhsc_kwit/kwit-connector', // kwit library
				],
				'drupalSettings' => [
					'ln_fusepump' => [
						$html_id => $fusepump_id
					],
					'nhsc_kwit' => [
						$kwit_html_id => $kwit_id
					]
				],
			]
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function blockForm($form, FormStateInterface $form_state) {
		$form = parent::blockForm($form, $form_state);

		// Facebook details.
		$form['floating_facebook'] = [
			'#type' => 'details',
			'#title' => $this->t('Facebook settings'),
			'#collapsible' => TRUE,
			'#open' => TRUE,
			'#description' => '',
		];

		$form['floating_facebook']['facebook_link'] = [
			'#type' => 'url',
			'#title' => $this->t('Facebook Link'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['facebook']) ? $this->configuration['facebook'] : '',
		];

		$form['floating_facebook']['facebook_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Facebook title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['facebook_title']) ? $this->configuration['facebook_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_facebook']['facebook_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Facebook Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['facebook_fa_icon']) ? $this->configuration['facebook_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_facebook']['facebook_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Facebook Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['facebook_bg_color']) ? $this->configuration['facebook_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// Twitter details.
		$form['floating_twitter'] = [
			'#type' => 'details',
			'#title' => $this->t('Twitter settings'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_twitter']['twitter_link'] = [
			'#type' => 'url',
			'#title' => $this->t('Twitter Link'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['twitter']) ? $this->configuration['twitter'] : '',
		];

		$form['floating_twitter']['twitter_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Twitter title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['twitter_title']) ? $this->configuration['twitter_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_twitter']['twitter_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Twitter Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['twitter_fa_icon']) ? $this->configuration['twitter_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_twitter']['twitter_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Twitter Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['twitter_bg_color']) ? $this->configuration['twitter_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// Google Plus details.
		$form['floating_google_plus'] = [
			'#type' => 'details',
			'#title' => $this->t('Google Plus settings'),
			'#collapsible' => TRUE,
			'#collapsed' => FALSE,
			'#description' => '',
		];

		$form['floating_google_plus']['google_plus_link'] = [
			'#type' => 'url',
			'#title' => $this->t('Google Link'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['google_plus']) ? $this->configuration['google_plus'] : '',
		];



		$form['floating_google_plus']['google_plus_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('GooglePlus title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['google_plus_title']) ? $this->configuration['google_plus_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_google_plus']['google_plus_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Google Plus Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['google_plus_fa_icon']) ? $this->configuration['google_plus_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_google_plus']['google_plus_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Google Plus Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['google_plus_bg_color']) ? $this->configuration['google_plus_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// LinkedIn details.
		$form['floating_linkedIn'] = [
			'#type' => 'details',
			'#title' => $this->t('LinkedIn settings'),
			'#collapsible' => TRUE,
			'#collapsed' => FALSE,
			'#description' => '',
		];

		$form['floating_linkedIn']['linkedIn_link'] = [
			'#type' => 'url',
			'#title' => $this->t('LinkedIn Link'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['linkedIn']) ? $this->configuration['linkedIn'] : '',
		];

		$form['floating_linkedIn']['linkedIn_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('LinkedIn title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['linkedIn_title']) ? $this->configuration['linkedIn_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_linkedIn']['linkedIn_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('LinkedIn Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['linkedIn_fa_icon']) ? $this->configuration['linkedIn_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_linkedIn']['linkedIn_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('LinkedIn Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['linkedIn_bg_color']) ? $this->configuration['linkedIn_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// Pinterest details.
		$form['floating_pinterest'] = [
			'#type' => 'details',
			'#title' => $this->t('Pinterest settings'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_pinterest']['pinterest_link'] = [
			'#type' => 'url',
			'#title' => $this->t('Pinterest Link'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['pinterest']) ? $this->configuration['pinterest'] : '',
		];

		$form['floating_pinterest']['pinterest_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Pinterest title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['pinterest_title']) ? $this->configuration['pinterest_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_pinterest']['pinterest_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Pinterest Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['pinterest_fa_icon']) ? $this->configuration['pinterest_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_pinterest']['pinterest_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Pinterest Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['pinterest_bg_color']) ? $this->configuration['pinterest_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// Instagram details.
		$form['floating_instagram'] = [
			'#type' => 'details',
			'#title' => $this->t('Instagram settings'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_instagram']['instagram_link'] = [
			'#type' => 'url',
			'#title' => $this->t('Instagram Link'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['instagram']) ? $this->configuration['instagram'] : '',
		];

		$form['floating_instagram']['instagram_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Instagram title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['instagram_title']) ? $this->configuration['instagram_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_instagram']['instagram_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Instagram Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['instagram_fa_icon']) ? $this->configuration['instagram_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_instagram']['instagram_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Instagram Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['instagram_bg_color']) ? $this->configuration['instagram_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// YouTube details.
		$form['floating_youtube'] = [
			'#type' => 'details',
			'#title' => $this->t('Youtube settings'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_youtube']['youtube_link'] = [
			'#type' => 'url',
			'#title' => $this->t('Youtube Link'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['youtube']) ? $this->configuration['youtube'] : '',
		];

		$form['floating_youtube']['youtube_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Youtube title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['youtube_title']) ? $this->configuration['youtube_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_youtube']['youtube_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Youtube Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['youtube_fa_icon']) ? $this->configuration['youtube_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_youtube']['youtube_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Youtube Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['youtube_bg_color']) ? $this->configuration['youtube_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// Mail details.
		$form['floating_mail'] = [
			'#type' => 'details',
			'#title' => $this->t('mail settings'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_mail']['mail_link'] = [
			'#type' => 'email',
			'#title' => $this->t('Mail Link'),
			'#size' => 60,
			'#description' => $this->t('Please type only the e-mail id'),
			'#default_value' => isset($this->configuration['mail']) ? $this->configuration['mail'] : '',
		];

		$form['floating_mail']['mail_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Mail title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['mail_title']) ? $this->configuration['mail_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_mail']['mail_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Mail Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['mail_fa_icon']) ? $this->configuration['mail_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];


		$form['floating_mail']['mail_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Mail Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['mail_bg_color']) ? $this->configuration['mail_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// Custom Link
		$form['floating_customlink'] = [
			'#type' => 'details',
			'#title' => $this->t('Custom Link settings'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_customlink']['customlink'] = [
			'#type' => 'url',
			'#title' => $this->t('Custom Link'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['customlink']) ? $this->configuration['customlink'] : '',
		];

		$form['floating_customlink']['customlink_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Custom Link title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['customlink_title']) ? $this->configuration['customlink_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_customlink']['customlink_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['customlink_fa_icon']) ? $this->configuration['customlink_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_customlink']['customlink_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Custom Link Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['customlink_bg_color']) ? $this->configuration['customlink_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		// Fusepump Link
		$form['floating_fusepumpbutton'] = [
			'#type' => 'details',
			'#title' => $this->t('Fusepump Button settings'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_fusepumpbutton']['fusepumpbutton'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Fusepump ID'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['fusepumpbutton']) ? $this->configuration['fusepumpbutton'] : '',
		];

		$form['floating_fusepumpbutton']['fusepumpbutton_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Fusepump Button title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['fusepumpbutton_title']) ? $this->configuration['fusepumpbutton_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_fusepumpbutton']['fusepumpbutton_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['fusepumpbutton_fa_icon']) ? $this->configuration['fusepumpbutton_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_fusepumpbutton']['fusepumpbutton_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Fusepump Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['fusepumpbutton_bg_color']) ? $this->configuration['fusepumpbutton_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];


		// Kwit Button
		$form['floating_kwitbutton'] = [
			'#type' => 'details',
			'#title' => $this->t('Kwit Button settings'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_kwitbutton']['kwitbutton'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Kwit ID'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['kwitbutton']) ? $this->configuration['kwitbutton'] : '',
		];

		$form['floating_kwitbutton']['kwitbutton_widget'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Kwit Widget ID'),
			'#size' => 60,
			'#default_value' => isset($this->configuration['kwitbutton_widget']) ? $this->configuration['kwitbutton_widget'] : '',
		];

		$form['floating_kwitbutton']['kwitbutton_title'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Kwit Button title'),
			'#description' => $this->t('Text to display when in active or hover state'),
			'#default_value' => isset($this->configuration['kwitbutton_title']) ? $this->configuration['kwitbutton_title'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_kwitbutton']['kwitbutton_fa_icon'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Font Awesome icon'),
			'#description' => $this->t('Font Awesome icon to show on the button ie: fa-envelop '),
			'#default_value' => isset($this->configuration['kwitbutton_fa_icon']) ? $this->configuration['kwitbutton_fa_icon'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];

		$form['floating_kwitbutton']['kwitbutton_bg_color'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Kwit Button Background Color'),
			'#description' => $this->t('HEX Background Color to show on the button ie: #FF0080'),
			'#default_value' => isset($this->configuration['kwitbutton_bg_color']) ? $this->configuration['kwitbutton_bg_color'] : '',
			'#size' => 60,
			'#maxlength' => 128,
		];


		// Block details.
		$form['floating_icons'] = [
			'#type' => 'details',
			'#title' => $this->t('Display Icons'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
			'#description' => '',
		];

		$form['floating_icons']['hover'] = [
			'#type' => 'radios',
			'#title' => $this->t('Select the Hover Effects'),
			'#required' => TRUE,
			'#default_value' => isset($this->configuration['hover']) ? $this->configuration['hover'] : 'grow',
			'#options' => [
				'grow' => $this->t('Grow'),
				'shrink' => $this->t('Shrink'),
				'black-white' => $this->t('Black and white'),
				'white-black' => $this->t('White and black'),
				'rotate' => $this->t('Rotate 360'),
			],
		];

		$form['floating_icons']['place'] = [
			'#type' => 'radios',
			'#title' => $this->t('Where do you want to display the icons?'),
			'#required' => TRUE,
			'#default_value' => isset($this->configuration['place']) ? $this->configuration['place'] : 2,
			'#options' => [
				1 => $this->t('Top'),
				2 => $this->t('Right'),
				3 => $this->t('Bottom'),
				4 => $this->t('Left'),
			],
		];

		$form['floating_icons']['target'] = [
			'#type' => 'select',
			'#title' => $this->t('Target Attribute'),
			'#default_value' => isset($this->configuration['target']) ? $this->configuration['target'] : '_self',
			'#options' => [
				'_self' => $this->t('_Self'),
				'_blank' => $this->t('_Blank'),
			],
		];

		$form['floating_icons']['count'] = [
			'#title' => $this->t('Count'),
			'#value' => isset($this->configuration['count']) ? $this->configuration['count'] : 0,
			'#type' => 'hidden',
		];

		return $form;
	}

	/**
	 * {@inheritdoc}
	 */
	public function blockValidate($form, FormStateInterface $form_state) {

		$values = $form_state->getValues();

		$links = [];
		$links[] = $values['floating_facebook']['facebook_link'];
		$links[] = $values['floating_twitter']['twitter_link'];
		$links[] = $values['floating_google_plus']['google_plus_link'];
		$links[] = $values['floating_linkedIn']['linkedIn_link'];
		$links[] = $values['floating_pinterest']['pinterest_link'];
		$links[] = $values['floating_instagram']['instagram_link'];
		$links[] = $values['floating_mail']['mail_link'];
		$links[] = $values['floating_youtube']['youtube_link'];
		$links[] = $values['floating_customlink']['customlink'];
		$links[] = $values['floating_fusepumpbutton']['fusepumpbutton'];
		$links[] = $values['floating_kwitbutton']['kwitbutton'];

		$count = 0;
		if ($links) {
			foreach ($links as $link) {
				if (!empty($link)) {
					$count = $count + 1;
				}
			}
		}
		if ($count < 1) {
			$form_state->setErrorByName('floatingsocialblock', $this->t('At least one field should be filled.'));
		}
		// Setting count value.
		$this->configuration['count'] = $count;
	}

	/**
	 * {@inheritdoc}
	 */
	public function blockSubmit($form, FormStateInterface $form_state) {

		parent::blockSubmit($form, $form_state);

		$values = $form_state->getValues();

		$this->configuration['facebook'] = $values['floating_facebook']['facebook_link'];
		$this->configuration['google_plus'] = $values['floating_google_plus']['google_plus_link'];
		$this->configuration['linkedIn'] = $values['floating_linkedIn']['linkedIn_link'];
		$this->configuration['twitter'] = $values['floating_twitter']['twitter_link'];
		$this->configuration['pinterest'] = $values['floating_pinterest']['pinterest_link'];
		$this->configuration['instagram'] = $values['floating_instagram']['instagram_link'];
		$this->configuration['mail'] = $values['floating_mail']['mail_link'];
		$this->configuration['youtube'] = $values['floating_youtube']['youtube_link'];
		$this->configuration['customlink'] = $values['floating_customlink']['customlink'];
		$this->configuration['fusepumpbutton'] = $values['floating_fusepumpbutton']['fusepumpbutton'];
		$this->configuration['kwitbutton'] = $values['floating_kwitbutton']['kwitbutton'];
		$this->configuration['kwitbutton_widget'] = $values['floating_kwitbutton']['kwitbutton_widget'];
		$this->configuration['place'] = $values['floating_icons']['place'];
		$this->configuration['target'] = $values['floating_icons']['target'];
		$this->configuration['hover'] = $values['floating_icons']['hover'];


		// Setting Config for Titles.
		$this->configuration['facebook_title'] = $values['floating_facebook']['facebook_title'];
		$this->configuration['google_plus_title'] = $values['floating_google_plus']['google_plus_title'];
		$this->configuration['linkedIn_title'] = $values['floating_linkedIn']['linkedIn_title'];
		$this->configuration['twitter_title'] = $values['floating_twitter']['twitter_title'];
		$this->configuration['pinterest_title'] = $values['floating_pinterest']['pinterest_title'];
		$this->configuration['instagram_title'] = $values['floating_instagram']['instagram_title'];
		$this->configuration['mail_title'] = $values['floating_mail']['mail_title'];
		$this->configuration['youtube_title'] = $values['floating_youtube']['youtube_title'];
		$this->configuration['customlink_title'] = $values['floating_customlink']['customlink_title'];
		$this->configuration['fusepumpbutton_title'] = $values['floating_fusepumpbutton']['fusepumpbutton_title'];
		$this->configuration['kwitbutton_title'] = $values['floating_kwitbutton']['kwitbutton_title'];

		// custom fa icons
		$this->configuration['customlink_fa_icon'] = $values['floating_customlink']['customlink_fa_icon'];
		$this->configuration['fusepumpbutton_fa_icon'] = $values['floating_fusepumpbutton']['fusepumpbutton_fa_icon'];
		$this->configuration['kwitbutton_fa_icon'] = $values['floating_kwitbutton']['kwitbutton_fa_icon'];
		$this->configuration['facebook_fa_icon'] = $values['floating_facebook']['facebook_fa_icon'];
		$this->configuration['twitter_fa_icon'] = $values['floating_twitter']['twitter_fa_icon'];
		$this->configuration['google_plus_fa_icon'] = $values['floating_google_plus']['google_plus_fa_icon'];
		$this->configuration['linkedIn_fa_icon'] = $values['floating_linkedIn']['linkedIn_fa_icon'];
		$this->configuration['pinterest_fa_icon'] = $values['floating_pinterest']['pinterest_fa_icon'];
		$this->configuration['instagram_fa_icon'] = $values['floating_instagram']['instagram_fa_icon'];
		$this->configuration['mail_fa_icon'] = $values['floating_mail']['mail_fa_icon'];
		$this->configuration['youtube_fa_icon'] = $values['floating_youtube']['youtube_fa_icon'];

		// custom colors
		$this->configuration['facebook_bg_color'] = $values['floating_facebook']['facebook_bg_color'];
		$this->configuration['google_plus_bg_color'] = $values['floating_google_plus']['google_plus_bg_color'];
		$this->configuration['linkedIn_bg_color'] = $values['floating_linkedIn']['linkedIn_bg_color'];
		$this->configuration['twitter_bg_color'] = $values['floating_twitter']['twitter_bg_color'];
		$this->configuration['pinterest_bg_color'] = $values['floating_pinterest']['pinterest_bg_color'];
		$this->configuration['instagram_bg_color'] = $values['floating_instagram']['instagram_bg_color'];
		$this->configuration['mail_bg_color'] = $values['floating_mail']['mail_bg_color'];
		$this->configuration['youtube_bg_color'] = $values['floating_youtube']['youtube_bg_color'];
		$this->configuration['customlink_bg_color'] = $values['floating_customlink']['customlink_bg_color'];
		$this->configuration['fusepumpbutton_bg_color'] = $values['floating_fusepumpbutton']['fusepumpbutton_bg_color'];
		$this->configuration['kwitbutton_bg_color'] = $values['floating_kwitbutton']['kwitbutton_bg_color'];


	}

}
