<?php

namespace RT\ClplaceCore\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\ClplaceCore\Traits\SingletonTraits;
use \RT_Posts;

class PostTypeController {
	use SingletonTraits;

	public $post_type;

	public function __construct() {
		$this->post_type = RT_Posts::getInstance();
		add_action('init', [ $this, 'register_post_types_and_taxonomies'], 10 );
	}

	/**
	 * Register post_type and custom taxonomies
	 *
	 * @return void
	 */
	public function register_post_types_and_taxonomies() {
		$this->register_custom_taxonomies();
		$this->register_custom_post_types();
	}

	/**
	 * Register custom post type
	 * @return void
	 */
	private function register_custom_post_types() {
		$custom_posts = [
			[
				'id'            => 'rt-team',
				'slug'          => 'team',
				'singular'      => 'Team',
				'plural'        => 'Teams',
				'menu_icon'     => 'dashicons-admin-customizer',
				'menu_position' => 18,
				'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ],
				'description'   => 'Teams Custom Post Type',
			]
		];

		$this->post_type->add_post_types( $custom_posts );
	}

	/**
	 * Register custom taxonomy
	 * @return void
	 */
	private function register_custom_taxonomies() {
		$custom_posts = [
			[
				'id'        => 'team-designation',
				'post_type' => [ 'rt-team' ],
				'slug'      => 'team-designation',
				'singular'  => 'Designation',
				'plural'    => 'Designations',
			],
			[
				'id'        => 'team-department',
				'post_type' => [ 'rt-team' ],
				'slug'      => 'team-department',
				'singular'  => 'Department',
				'plural'    => 'Departments',
			]
		];

		$this->post_type->add_taxonomies( $custom_posts );
	}
}

