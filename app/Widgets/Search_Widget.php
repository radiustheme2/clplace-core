<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Widgets;

use RT\Clplace\Helpers\Fns as ThemeFns;
use \WP_Widget;
use \RT_Widget_Fields;


class Search_Widget extends WP_Widget {

	public function __construct() {
		$id    = CLPLACE_CORE_PREFIX . '_search_widget';
		$title = __( 'Clplace: Search Widget', 'clplace-core' );
		$args  = [
			'description' => esc_html__( 'Search widget', 'clplace-core' )
		];
		parent::__construct( $id, $title, $args );
	}

	public function form( $instance ) {
		$defaults = [
			'title' => __( 'Search', 'clplace-core' ),
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title' => [
				'label' => esc_html__( 'Title', 'clplace-core' ),
				'type'  => 'text',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = !empty($new_instance[ 'title' ]) ? sanitize_text_field($new_instance[ 'title' ]) : '';

		return $instance;
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
		<div class="clplace-search-form">
            <?php
                if ( ! empty( $instance['title'] ) ) {
                    echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
                echo get_search_form();
            ?>
		</div>
    <?php
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}