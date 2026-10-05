<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Abstracts;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

abstract class ElementorBase extends Widget_Base {

	public $rt_name;
	public $rt_base;
	public $rt_category;
	public $rt_icon;
	public $rt_translate;
	public $rt_dir;

	public function __construct( $data = [], $args = null ) {
		$this->rt_category = CLPLACE_CORE_PREFIX . '-widgets'; // Category /@dev
		$this->rt_icon     = 'rdtheme-el-custom';
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return $this->rt_base;
	}

	public function get_title() {
		return $this->rt_name;
	}

	public function get_icon() {
		return $this->rt_icon;
	}

	public function get_categories() {
		return [ $this->rt_category ];
	}

	/**
	 * Getting Custome taxanomy for portfolio - category- single service
	 */
	public static function listing_terms_slug($term) {
		if (class_exists('Rtcl')) {
			$terms = get_terms( $term );
			if(!empty($terms)){
				$category_links = array();
				foreach ($terms as $key => $value) {
					$category_links[$value->term_id] = $value->name;
				}
				return $category_links;
			}
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param string $parent variable.
	 * @param string $taxonomy variable.
	 * @return array
	 */
	protected function taxonomy_list( $parent = 'all', $taxonomy = '' ) {
		if ( ! function_exists( 'rtcl' ) ) {
			return [];
		}
		$args = [
			'taxonomy'   => rtcl()->category,
			'fields'     => 'id=>name',
			'hide_empty' => false,
		];
		if ( ! empty( $taxonomy ) ) {
			$args['taxonomy'] = sanitize_text_field( $taxonomy );
		}
		if ( 'parent' === $parent ) {
			$args['parent'] = 0;
		}
		$terms = get_terms( $args );

		$category_dropdown = [];
		foreach ( $terms as $id => $name ) {
			$category_dropdown[ $id ] = $name;
		}
		return $category_dropdown;
	}

	/**
	 * Getting Custome taxanomy for portfolio - category- single service
	 */
	public static function listing_locations_slug() {
		if (class_exists('Rtcl')) {
			$terms = get_terms( "rtcl_location" );
			if(!empty($terms)){
				$category_links = array();
				foreach ($terms as $key => $value) {
					$category_links[$value->term_id] = $value->name;
				}
				return $category_links;
			}
		}
	}

	/**
	 * @return array
	 */
	public function rt_blog_posts_title() {
		$args = array(
			'post_type'      => 'rtcl_listing',
			'post_status'    => 'publish',
			'taxonomy'       => 'rtcl_category',
			'posts_per_page' => -1,
		);
		$post_title = array();
		$grid_query = new \WP_Query( $args );
		if ( $grid_query->have_posts() ) :
			while ( $grid_query->have_posts() ) : $grid_query->the_post();
				$post_title[get_the_ID()] = get_the_title();
			endwhile; wp_reset_postdata();
		endif;
		return $post_title;
	}

	public function rt_grid_options(){
		return [
			'3'  => __( '4 Columns', 'clplace-core' ),
			'4'  => __( '3 Columns', 'clplace-core' ),
			'6'  => __( '2 Columns', 'clplace-core' ),
			'12' => __( '1 Columns', 'clplace-core' ),
		];
	}

	public function rt_alignment_options(){
		return array(
			'left'    => array(
				'title' => __( 'Left', 'clplace-core' ),
				'icon' => 'eicon-text-align-left',
			),
			'center' => array(
				'title' => __( 'Center', 'clplace-core' ),
				'icon' => 'eicon-text-align-center',
			),
			'right' => array(
				'title' => __( 'Right', 'clplace-core' ),
				'icon' => 'eicon-text-align-right',
			),
			'justify' => array(
				'title' => __( 'Justified', 'clplace-core' ),
				'icon' => 'eicon-text-align-justify',
			),
		);
	}

	/**
	 * @return array
	 */
	public function rt_get_all_image_sizes() {
		global $_wp_additional_image_sizes;
		$image_sizes = [ '0' => __( 'Default Image Size', 'clplace-core' ) ];
		foreach ( $_wp_additional_image_sizes as $index => $item ) {
			$image_sizes[ $index ] = __( ucwords( $index . ' - ' . $item['width'] . 'x' . $item['height'] ), 'clplace-core' );
		}
		$image_sizes['full'] = __( "Full Size", 'clplace-core' );

		return $image_sizes;
	}
}