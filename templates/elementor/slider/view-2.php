<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$show_dots   = ( in_array( $navigation, [ 'dots', 'both' ] ) );
$show_arrows = ( in_array( $navigation, [ 'arrows', 'both' ] ) );

$slides_count  = count( $sliders );
$slider_option = json_encode( $swiper_data );

//wp_enqueue_script('swiper');
?>
<div class="rt-main-slider-wrapper style2">
	<div class="rt-slider-wrapper swiper-container rt-swiper-slider <?php echo esc_attr( $arrow_visibility ) ?>"
	     data-options="<?php echo esc_js( $slider_option ); ?>"
	     data-gallery= <?php echo esc_attr( 'disable' ) ?>>
		<div class="rt-slider swiper-wrapper">
			<?php if ( $carousel_images ) :
				foreach ( $carousel_images as $slide ) : ?>
					<div class="swiper-slide">

						<?php echo wp_get_attachment_image( $slide['id'], $thumbnail_size ) ?>

					</div>
				<?php endforeach;
			endif; ?>
		</div>

		<?php if ( 1 < $slides_count ) : ?>
			<?php if ( $show_dots ) : ?>
				<div class="swiper-pagination"></div>
			<?php endif; ?>
			<?php if ( $show_arrows ) : ?>
				<div class="elementor-swiper-button elementor-swiper-button-prev rt-prev">
					<i class="eicon-chevron-left" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php esc_html_e( 'Previous', 'clplace-core' ); ?></span>
				</div>
				<div class="elementor-swiper-button elementor-swiper-button-next rt-next">
					<i class="eicon-chevron-right" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php esc_html_e( 'Next', 'clplace-core' ); ?></span>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</div>