<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Widgets;

use \WP_Widget;
use \RT_Widget_Fields;
use Rtcl\Helpers\Functions;
use RT\ClplaceCore\Helper\Fns;
use RT\Clplace\Plugins\Listing_Functions;

class Listing_Search_Widget extends WP_Widget {

	public function __construct() {
		$id    = CLPLACE_CORE_PREFIX . '_advanced_search';
		$title = __( 'Clplace: Advanced Search', 'clplace-core' );
		$args  = [
			'description' => esc_html__( 'A Search Feature', 'clplace-core' )
		];
		parent::__construct( $id, $title, $args );
	}

	public function widget( $args, $instance ) {
		$listing_price_range = Listing_Functions::listing_price_range();
		$data                = [
			'orientation'                   => ! empty( $instance['orientation'] ) ? $instance['orientation'] : 'inline',
			'layout'                        => ! empty( $instance['layout'] ) ? $instance['layout'] : '',
			'icon'                          => ! empty( $instance['icon'] ) ? $instance['icon'] : 'icon',
			'can_search_by_keyword'         => ! empty( $instance['search_by_keyword'] ) ? 1 : 0,
			'can_search_by_category'        => ! empty( $instance['search_by_category'] ) ? 1 : 0,
			'can_search_by_location'        => ! empty( $instance['search_by_location'] ) ? 1 : 0,
			'can_search_by_listing_types'   => ! empty( $instance['search_by_listing_types'] ) ? 1 : 0,
			'can_search_by_price'           => ! empty( $instance['search_by_price'] ) ? 1 : 0,
			'category_is_parent'            => ! empty( $instance['category_is_parent'] ) ? 1 : 0,
			'can_search_by_custom_field'    => ! empty( $instance['search_by_custom_field'] ) ? 1 : 0,
			'can_search_by_radius_search'   => ! empty( $instance['search_by_radius_search'] ) ? 1 : 0,
			'can_search_by_radius_distance' => ! empty( $instance['search_by_radius_distance'] ) ? 1 : 0,
			'min_price'                     => ! empty( $instance['min_price'] ) ? $instance['min_price'] : $listing_price_range['min_price'],
			'max_price'                     => ! empty( $instance['max_price'] ) ? $instance['max_price'] : $listing_price_range['max_price'],
			'instance'                      => $instance,
		];

		$data['args'] = $args;
		$data['data'] = $data;

		$widget_class = '';
		if ( $data['layout'] == 'home1' ) {
			$widget_class = "advanced-search-banner custom-bg home1";
		} elseif ( $data['layout'] == 'home2' ) {
			$widget_class = "widget widget_clplace_advanced_search home2";
		} elseif ( $data['layout'] == 'home3' || $data['layout'] == 'home4' ) {
			$widget_class = "advanced-search-banner";
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo "<div class='" . esc_attr( 'orientation-' . $data['orientation'] . ' ' . $widget_class ) . "'>";
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . wp_kses_post( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		$template = $data['orientation'] === 'inline' ? 'listing-search-banner' : 'listing-search-banner';

		Fns::get_template($template, $data, '', get_template_directory() . '/classified-listing/custom/');

		echo "</div>";

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function update( $new_instance, $old_instance ) {
		$instance                              = $old_instance;
		$listing_price_range                   = Listing_Functions::listing_price_range();
		$instance['title']                     = ! empty( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['orientation']               = ! empty( $new_instance['orientation'] ) ? $new_instance['orientation'] : 'inline';
		$instance['layout']                    = ! empty( $new_instance['layout'] ) ? $new_instance['layout'] : '';
		$instance['icon']                      = ! empty( $new_instance['icon'] ) ? $new_instance['icon'] : 'icon';
		$instance['search_by_category']        = ! empty( $new_instance['search_by_category'] ) ? 1 : 0;
		$instance['search_by_location']        = ! empty( $new_instance['search_by_location'] ) ? 1 : 0;
		$instance['search_by_listing_types']   = ! empty( $new_instance['search_by_listing_types'] ) ? 1 : 0;
		$instance['search_by_price']           = ! empty( $new_instance['search_by_price'] ) ? 1 : 0;
		$instance['category_is_parent']        = ! empty( $new_instance['category_is_parent'] ) ? 1 : 0;
		$instance['search_by_keyword']         = ! empty( $new_instance['search_by_keyword'] ) ? 1 : 0;
		$instance['search_by_custom_field']    = ! empty( $new_instance['search_by_custom_field'] ) ? 1 : 0;
		$instance['search_by_radius_search']   = ! empty( $new_instance['search_by_radius_search'] ) ? 1 : 0;
		$instance['search_by_radius_distance'] = ! empty( $new_instance['search_by_radius_distance'] ) ? 1 : 0;
		$instance['min_price']                 = ! empty( $new_instance['min_price'] ) ? absint( $new_instance['min_price'] ) : $listing_price_range['min_price'];
		$instance['max_price']                 = ! empty( $new_instance['max_price'] ) ? absint( $new_instance['max_price'] ) : $listing_price_range['max_price'];

		return $instance;
	}

	public function form( $instance ) {
		// Define the array of defaults
		$listing_price_range = Listing_Functions::listing_price_range();
		$defaults            = [
			'title'                     => __( 'Advanced Search', 'clplace-core' ),
			'orientation'               => 'inline',
			'layout'                    => '',
			'icon'                      => 'icon',
			'search_by_category'        => 1,
			'search_by_location'        => 1,
			'search_by_keyword'         => 1,
			'search_by_listing_types'   => 0,
			'search_by_custom_field'    => 1,
			'search_by_radius_search'   => 1,
			'search_by_radius_distance' => 1,
			'search_by_price'           => 1,
			'category_is_parent'        => 1,
			'min_price'                 => $listing_price_range['min_price'],
			'max_price'                 => $listing_price_range['max_price'],
		];


		if ( 'local' !== Functions::location_type() ) {
			$defaults['search_by_location'] = 0;
		}

		// Parse incoming $instance into an array and merge it with $defaults
		$instance = wp_parse_args(
			(array) $instance,
			$defaults
		);

		$fields = [
			'title'                     => [
				'label' => esc_html__( 'Title', 'clplace-core' ),
				'type'  => 'text',
			],
			'orientation'               => [
				'label'   => esc_html__( 'Orientation', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'inline'   => esc_html__( 'Inline', 'clplace-core' ),
					'vertical' => esc_html__( 'Vertical', 'clplace-core' ),
				],
			],
			'layout'                    => [
				'label'   => esc_html__( 'Layout', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					''      => esc_html__( 'Default', 'clplace-core' ),
					'home1' => esc_html__( 'Layout # 01', 'clplace-core' ),
					'home2' => esc_html__( 'Layout # 02', 'clplace-core' ),
				],
			],
			'icon'                      => [
				'label'   => esc_html__( 'Category Icon / Image', 'clplace-core' ),
				'type'    => 'select',
				'options' => [
					'icon'  => esc_html__( 'Icon', 'clplace-core' ),
					'image' => esc_html__( 'Image', 'clplace-core' ),
				],
			],
			'search_by_keyword'         => [
				'label' => esc_html__( 'Search by Keyword', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'search_by_listing_types'   => [
				'label' => esc_html__( 'Search by Listing Types', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'search_by_location'        => [
				'label' => esc_html__( 'Search by Local Location', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'search_by_radius_search'   => [
				'label' => esc_html__( 'Search by Google Location', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'search_by_radius_distance' => [
				'label' => esc_html__( 'Search by Radius Distance', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'search_by_category'        => [
				'label' => esc_html__( 'Search by Category', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'search_by_custom_field'    => [
				'label' => esc_html__( 'Search by Custom Fields', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'search_by_price'           => [
				'label' => esc_html__( 'Search by Price', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'category_is_parent'        => [
				'label' => esc_html__( 'Search by Parent Category', 'clplace-core' ),
				'type'  => 'checkbox',
			],
			'min_price'                 => [
				'label' => esc_html__( 'Minimum Price', 'clplace-core' ),
				'type'  => 'number',
			],
			'max_price'                 => [
				'label' => esc_html__( 'Maximum Price', 'clplace-core' ),
				'type'  => 'number',
			],

		];

		if ( 'local' !== Functions::location_type() ) {
			unset( $fields['search_by_location'] );
		}

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

}