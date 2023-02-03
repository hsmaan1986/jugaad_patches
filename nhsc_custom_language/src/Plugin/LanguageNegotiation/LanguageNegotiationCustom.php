<?php

namespace Drupal\nhsc_custom_language\Plugin\LanguageNegotiation;

use Drupal\language\LanguageNegotiationMethodBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\node\NodeInterface;

/**
 * Custom class for identifying language.
 *
 * @LanguageNegotiation(
 *   id = Drupal\nhsc_custom_language\Plugin\LanguageNegotiation\LanguageNegotiationCustom::METHOD_ID,
 *   weight = -99,
 *   name = @Translation("Custom Language Switching"),
 *   description = @Translation("Language based on Custom."),
 * )
 */
class LanguageNegotiationCustom extends LanguageNegotiationMethodBase {

    /**
     * The language negotiation method id.
     */
    const METHOD_ID = 'language-custom';

    /**
     * {@inheritdoc}
     */
    public function getLangcode(Request $request = NULL) {
        $langcode = '';

	    /**
	     *
	     * Custom logic for ar language
	     * 1. Get current path
	     * 2. Get the first part of the url assume its a languge code
	     * 3. Check if language code exist
	     * 4. Set language
	     * 5. Set the text direction
	     */

	    $current_path = \Drupal::service('path.current')->getPath();
	    $alias = \Drupal::service('path_alias.manager')->getAliasByPath($current_path);

	    $paths = explode("/", $alias);
	    $url_lang = $paths[1];

	    $availableLanguages = $this->languageManager->getLanguages(); // get active langugaes

	    if ($url_lang && isset($availableLanguages[$url_lang])) {
		    $langcode = $url_lang;
	    }
	    else {
		    // If no other language was found use the default one.
		    $langcode = $this->languageManager->getDefaultLanguage();
	    }

        return $langcode;
    }



}
