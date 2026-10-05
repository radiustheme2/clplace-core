<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $hamburger              string
 * @var $search                 string
 * @var $login                  string
 * @var $button                 string
 * @var $has_separator          string
 * @var $button_label           string
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$args = [
	'hamburg'       => $hamburger,
	'search'        => $search,
	'login'         => $login,
	'button'        => $button,
	'has_separator' => $has_separator
];

if ( $button_label ) {
	$args['button_label'] = $button_label;
}

clplace_menu_icons_group( $args );