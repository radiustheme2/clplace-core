<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Widgets;

use RT\Clplace\Helpers\Fns;
use \WP_Widget;
use \RT_Widget_Fields;

class About_Widget extends WP_Widget {

	public function __construct() {
		$id    = CLPLACE_CORE_PREFIX . '_about';
		$title = __( 'Clplace: About', 'clplace-core' );
		$args  = [
			'description' => __( 'Displays Contact Info', 'clplace-core' ),
		];
		parent::__construct( $id, $title, $args );
	}

	public function widget( $args, $instance ) {

		echo wp_kses_post( $args['before_widget'] );

		?>
        <div class="about-logo">
			<?php
			if ( ! empty( $instance['logo'] ) ) {
				echo wp_get_attachment_image( $instance['logo'], 'full' );
			} else {
				echo wp_kses_post( clplace_site_logo() );
			}
			?>
        </div>

		<?php
		if ( ! empty( $instance['description'] ) ) {
			echo "<p class='description'>" .esc_html( $instance['description'] ) . "</p>";
		}
		clplace_about_apps( $instance );
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance                = [];
		$instance['title']       = Fns::sanitize( $new_instance['title'] );
		$instance['description'] = !empty( $new_instance['description'] ) ? sanitize_textarea_field( $new_instance['description']) : '';
		$instance['logo']        = !empty( $new_instance['logo'] ) ?  Fns::sanitize( $new_instance['logo']) : '';
		$instance['app_store_link'] = !empty( $new_instance['app_store_link'] ) ? esc_url( $new_instance['app_store_link']) : '';
		$instance['play_store_link'] = !empty( $new_instance['play_store_link'] ) ? esc_url( $new_instance['play_store_link']) : '';

		return $instance;
	}

	public function form( $instance ) {
		$defaults = [
			'title'       => '',
			'logo'        => '',
			'description' => '',
			'app_store_link'    => '',
			'play_store_link'     => '',
		];
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'       => [
				'label' => esc_html__( 'Title', 'clplace-core' ),
				'type'  => 'text',
			],
			'logo'        => [
				'label' => esc_html__( 'Logo', 'clplace-core' ),
				'type'  => 'image',
				'desc'  => esc_html__( 'Conditionally display the light or dark logo based on the chosen footer style; refrain from preselecting any logo. ', 'clplace-core' ),
			],
			'description' => [
				'label' => esc_html__( 'Description', 'clplace-core' ),
				'type'  => 'textarea',
			],
			'app_store_link'    => [
				'label' => esc_html__( 'App Store URL', 'clplace-core' ),
				'type'  => 'url',
			],
			'play_store_link'     => [
				'label' => esc_html__( 'Play Store URL', 'clplace-core' ),
				'type'  => 'url',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

}