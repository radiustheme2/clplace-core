<?php
/*
Plugin Name: Clplace Core
Plugin URI: https://www.radiustheme.com
Description: Clplace Theme Core Plugin
Version: 1.2.0
Author: RadiusTheme
Author URI: https://www.radiustheme.com
Text Domain: clplace-core
Domain Path: /languages
License: GPLv2 or later
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'CLPLACE_CORE' ) ) {
	define( 'CLPLACE_CORE', '1.2.0' );
	define( 'CLPLACE_ITEM', 'rt1224' );
	define( 'CLPLACE_CORE_PREFIX', 'clplace' );
	define( 'CLPLACE_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'CLPLACE_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
	define( 'CLPLACE_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . 'demo-content/' );
	define( 'CLPLACE_CORE_DEMO_URL', plugin_dir_url( __FILE__ ) . 'demo-content/' );


	define( 'CLPLACE_CORE_DEMO_IMP_CONTENT', plugin_dir_path( __FILE__ ) . 'demo-importer/' );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'RT\\ClplaceCore\\Init' ) ) :
	RT\ClplaceCore\Init::instance();
endif;

require_once CLPLACE_CORE_DEMO_IMP_CONTENT . 'init.php';