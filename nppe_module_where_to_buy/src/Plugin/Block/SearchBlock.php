<?php
/**
* @file
* Contains \Drupal\nppe_module_where_to_buy\Plugin\Block\SearchBlock.
*/
namespace Drupal\nppe_module_where_to_buy\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
* Provides Search Block.
*
* @Block(
* id = "store_search_block",
* admin_label = @Translation("Search Block"),
* category = @Translation("Blocks")
* )
*/
class SearchBlock extends BlockBase {

/**
* {@inheritdoc}
*/
	public function build() {
		$build = array();
		//$build['#markup'] = '' . t('Search Store') . '';
		$build['form'] = \Drupal::formBuilder()->getForm('Drupal\nppe_module_where_to_buy\Form\SearchForm');

		return $build;
	}

}