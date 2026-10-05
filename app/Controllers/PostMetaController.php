<?php

namespace RT\ClplaceCore\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\Clplace\Helpers\Fns;
use \RT_Postmeta;
use RT\ClplaceCore\Traits\SingletonTraits;
use RT\ClplaceCore\Builder\Builder;
use RT\ClplaceCore\Helper\FnsBuilder;

class PostMetaController {
	use SingletonTraits;

	public $postmeta;

	public function __construct() {
		$this->postmeta = RT_Postmeta::getInstance();
//		$this->add_meta_box();
		add_action( 'init', [ $this, 'add_meta_box' ] );
	}

	/**
	 * Add all metabox
	 * @return void
	 */
	function add_meta_box() {

		$this->postmeta->add_meta_box(
			"rt_page_settings",
			__( 'Layout Settings', 'clplace-core' ),
			[ 'page', 'post' ],
			'',
			'',
			'high',
			[
				'fields' => [
					"rt_layout_meta_data" => [
						'label' => __( 'Layouts', 'clplace-core' ),
						'type'  => 'group',
						'value' => $this->get_post_page_meta_args(),
					],
				],
			]
		);

		$this->postmeta->add_meta_box(
			"rt_el_builder_settings",
			__( 'Header - Footer Builder Settings', 'clplace-core' ),
			[ 'elementor-rt-hfb' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_el_builder_meta_args(),
			] );

	}

	function get_el_builder_meta_args() {

		return apply_filters( 'clplace_layout_meta_field', [
			'template_type' => [
				'label'   => __( 'Template Type', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Choose Options', 'clplace-core' ),
					'header'  => __( 'Header', 'clplace-core' ),
					'footer'  => __( 'Footer', 'clplace-core' ),
				],
				'default' => 'default',
			],

			'show_on' => [
				'label'   => __( 'Show On', 'clplace-core' ),
				'type'    => 'multi_select2',
				'options' => FnsBuilder::get_builder_type(),
				'default' => [],
				'class'   => 'rt-header-footer-select'
			],

			'choose_post' => [
				'label'       => __( 'Choose posts or pages', 'clplace-core' ),
				'type'        => 'ajax_select',
				'data_source' => 'post',
				'default'     => [],
			],

		] );
	}

	function get_post_page_meta_args() {
		$sidebars = [ 'default' => __( 'Default from customizer', 'clplace-core' ) ] + Fns::sidebar_lists();

		return apply_filters( 'clplace_layout_meta_field', [
			'layout'            => [
				'label'   => __( 'Layout', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default'       => __( 'Default from customizer', 'clplace-core' ),
					'full-width'    => __( 'Full Width', 'clplace-core' ),
					'left-sidebar'  => __( 'Left Sidebar', 'clplace-core' ),
					'right-sidebar' => __( 'Right Sidebar', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'single_post_style' => [
				'label'   => __( 'Post View Style', 'clplace-core' ),
				'type'    => 'select',
				'options' => [ 'default' => __( 'Default from customizer', 'clplace-core' ) ] + Fns::single_post_style(),
				'default' => 'default',
			],
			'header_style'      => [
				'label'   => __( 'Header Style', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'1'       => __( 'Layout 1', 'clplace-core' ),
					'2'       => __( 'Layout 2', 'clplace-core' ),
					'3'       => __( 'Layout 3', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'sidebar'           => [
				'label'   => __( 'Custom Sidebar', 'clplace-core' ),
				'type'    => 'select',
				'options' => $sidebars,
				'default' => 'default',
			],
			'top_bar'           => [
				'label'   => __( 'Top Bar Visibility', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'on'      => __( 'ON', 'clplace-core' ),
					'off'     => __( 'OFF', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'topbar_style'      => [
				'label'   => __( 'Topbar Style', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'1'       => __( 'Layout 1', 'clplace-core' ),
					'2'       => __( 'Layout 2', 'clplace-core' ),
					'3'       => __( 'Layout 3', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'header_width'      => [
				'label'   => __( 'Header Width', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default'   => __( 'Default from customizer', 'clplace-core' ),
					'box-width' => __( 'Box Width', 'clplace-core' ),
					'fullwidth' => __( 'Full Width', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'menu_alignment'    => [
				'label'   => __( 'Menu Alignment', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default'     => __( 'Default from customizer', 'clplace-core' ),
					'menu-left'   => __( 'Left Alignment', 'clplace-core' ),
					'menu-center' => __( 'Center Alignment', 'clplace-core' ),
					'menu-right'  => __( 'Right Alignment', 'clplace-core' ),
				],
				'default' => 'default',
			],

			'tr_header'         => [
				'label'   => __( 'Transparent Header', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'on'      => __( 'ON', 'clplace-core' ),
					'off'     => __( 'OFF', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'tr_header_color' => [
				'label'   => __( 'Transparent color', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'tr-header-light'    => __( 'Light Color', 'clplace-core' ),
					'tr-header-dark'     => __( 'Dark Color', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'banner'      => [
				'label'   => __( 'Banner Visibility', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'on'      => __( 'ON', 'clplace-core' ),
					'off'     => __( 'OFF', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'banner_style'      => [
				'label'   => __( 'Banner Style', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'1'       => __( 'Layout 1', 'clplace-core' ),
					'2'       => __( 'Layout 2', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb'        => [
				'label'   => __( 'Banner Content (Breadcrumb) Visibility', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'on'      => __( 'ON', 'clplace-core' ),
					'off'     => __( 'OFF', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'banner_height'     => [
				'label'   => __( 'Banner Height (px)', 'clplace-core' ),
				'type'    => 'number',
				'default' => 'default',
			],
			'footer_style'      => [
				'label'   => __( 'Footer Layout', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'clplace-core' ),
					'1'       => __( 'Layout 1', 'clplace-core' ),
					'2'       => __( 'Layout 2', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'footer_schema'     => [
				'label'   => __( 'Footer Schema', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'default'      => __( 'Default from customizer', 'clplace-core' ),
					'footer-light' => __( 'Light Footer', 'clplace-core' ),
					'footer-dark'  => __( 'Dark Footer', 'clplace-core' ),
				],
				'default' => 'default',
			],
			'rt_padding_top'    => [
				'label' => __( 'Padding Top (Page Content)', 'clplace-core' ),
				'type'  => 'number',
			],
			'rt_padding_bottom' => [
				'label' => __( 'Padding Bottom (Page Content)', 'clplace-core' ),
				'type'  => 'number',
			],
		] );
	}
}

