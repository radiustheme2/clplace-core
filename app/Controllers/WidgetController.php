<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\ClplaceCore\Traits\SingletonTraits;
use RT\ClplaceCore\Widgets\About_Widget;
use RT\ClplaceCore\Widgets\Contact_Widget;
use RT\ClplaceCore\Widgets\Post_Widget;
use RT\ClplaceCore\Widgets\Search_Widget;
use RT\ClplaceCore\Widgets\Listing_Search_Widget;

class WidgetController {
	use SingletonTraits;

	public $widgets;

	public function __construct() {
		add_action( 'widgets_init', [ $this, 'custom_widgets' ] );
	}

	public function custom_widgets() {
		if ( ! class_exists( 'RT_Widget_Fields' ) ) {
			return;
		}
		$widgets = [
			About_Widget::class,
			Contact_Widget::class,
			Post_Widget::class,
			Search_Widget::class,
			Listing_Search_Widget::class,
		];

		foreach ( $widgets as $class ) {
			register_widget( $class );
		}
	}
}