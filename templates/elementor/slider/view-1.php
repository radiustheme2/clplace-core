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
?>
<div class="rt-main-slider-wrapper style1">
    <div class="rt-slider-wrapper rt-swiper-slider swiper" data-slider-options='<?php echo esc_attr(wp_json_encode( $swiper_data )); ?>'">

        <div class="rt-slider swiper-wrapper">
			<?php if ( $sliders ) : foreach ( $sliders as $slide ) : ?>
                <div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ) ?>">
                    <div class="slider-inner-wrapper">
                        <?php if ( $slide['slider_title'] ) : ?>
                            <div class="slider-title-wrap rt-slider-content-wrap">
                                <h2>
                                    <?php echo esc_html( $slide['slider_title'] ); ?>
                                </h2>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; endif; ?>
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