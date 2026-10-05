<?php
/**
 *
 * This theme uses PSR-4 and OOP logic instead of procedural coding
 * Every function, hook and action is properly divided and organized inside related folders and files
 * Use the file `config/custom/custom.php` to write your custom functions
 *
 * @package clplace
 */

namespace RT\ClplaceCore;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\ClplaceCore\Traits\SingletonTraits;

final class Init {

	use SingletonTraits;

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'clplace_theme_init', [ $this, 'after_theme_loaded' ] );
		add_action( 'plugins_loaded', [ $this, 'demo_importer' ], 17 );
	}

	/**
	 * Instantiate all class
	 * @return void
	 */
	public function after_theme_loaded() {
		Hooks\FilterHooks::instance();
		Hooks\ActionHooks::instance();
		Controllers\ScriptController::instance();
		$a = Modules\WidgetOverwrite::instance();
		Api\RestApi::instance();
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			Controllers\PostTypeController::instance();
			Controllers\PostMetaController::instance();
			Controllers\WidgetController::instance();
		}
		if ( did_action( 'elementor/loaded' ) ) {
			Controllers\ElementorController::instance();
			Controllers\ElmentorBuilderController::instance();
		}
	}

	public function demo_importer() {
		$b = Modules\WidgetOverwrite::instance();
	}
}
