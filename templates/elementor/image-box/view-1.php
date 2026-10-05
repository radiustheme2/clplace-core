<?php
/**
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$parallax_class = '';
if ($mouse_effect){
    $parallax_class = 'rt-mouse-parallax';
}

?>

<div class="image-box image-box-1">
    <?php echo wp_get_attachment_image( $main_image['id'], 'full', "", array( "class" => "wow animate__fadeInBottomLeft animate__animated", "data-wow-duration" => "1200ms", "data-wow-delay" => "200ms" ) ); ?>
    <?php if ( $anim_image1['id'] || $anim_image2['id'] || $anim_image3['id'] ){ ?>
        <ul class="image-list">
            <li class="<?php echo esc_attr( $parallax_class ); ?> wow animate__fadeInTopRight animate__animated" data-wow-duration="1200ms" data-wow-delay="300ms">
                <div data-depth="4.00">
                    <?php echo wp_get_attachment_image( $anim_image1['id'], 'full' ); ?>
                </div>
            </li>
            <li class="<?php echo esc_attr( $parallax_class ); ?> wow animate__fadeInBottomRight animate__animated" data-wow-duration="1200ms" data-wow-delay="400ms">
                <div data-depth="4.00">
                    <?php echo wp_get_attachment_image( $anim_image2['id'], 'full' ); ?>
                </div>
            </li>
            <li class="<?php echo esc_attr( $parallax_class ); ?> wow animate__fadeInTopLeft animate__animated" data-wow-duration="1200ms" data-wow-delay="500ms">
                <div data-depth="4.00">
                    <?php echo wp_get_attachment_image( $anim_image3['id'], 'full' ); ?>
                </div>
            </li>
        </ul>
    <?php } if ( $arrow_shape_visibility ){ ?>
        <span class="hero-arrow d-none d-xl-block">
            <svg width="126" height="54" viewBox="0 0 126 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 47.5C4.5 47.5 9.9 20.1 34.1 14.3C58.3 8.49996 62.3 26.3 64.3 34C66.3 41.7 57.2 46.2 53.4 41.4C49.6 36.6 46.7 22.1 63.6 10.1C80.5 -1.90004 108.6 -4.80005 124.1 38.6" stroke="black" stroke-width="3" stroke-miterlimit="10" class="line draw-arrow" stroke-linecap="round"></path>
                <path d="M1.5 26.1001L3.1 51.8001L18.8 37.0001" stroke="black" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" class="line tail-1 draw-arrow" stroke-linejoin="round"></path>
            </svg>
        </span>
    <?php } ?>
</div>