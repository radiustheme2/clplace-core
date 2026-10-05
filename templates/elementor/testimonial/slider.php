<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\ClplaceCore\Helper\Fns;

$template_style = 'style-'.$style;

?>

<div class="rt-el-testimonial slider-layout testimonial-<?php echo esc_attr( $template_style ); ?>-wrapper">
    <div class="slide-wrap">
        <div class="rt-swiper-slider" data-slider-options="<?php echo esc_attr( $slider_data); ?>">
            <div class="swiper-wrapper">
	            <?php foreach ( $items as $item ): ?>
                    <div class="swiper-slide slider-item">
                        <div class="text-<?php echo esc_attr( $align ); ?>">
	                        <?php Fns::get_template( "elementor/testimonial/style-" . $style, $item ); ?>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>


	        <?php if ( $display_arrow == 'yes' ) { ?>
                <div class="swiper-navigation">
                    <div class="swiper-button swiper-button-prev"></div>
                    <div class="swiper-button swiper-button-next"></div>
                </div>
	        <?php } ?>
	        <?php if ( $display_pagination == 'yes' ) { ?>
                <div class="swiper-pagination"></div>
	        <?php } ?>
        </div>
    </div>
</div>

