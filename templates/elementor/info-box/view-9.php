<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/infobox/view-9.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Icons_Manager;

$attr = $tf = '';
if ( !empty( $url['url'] ) ) {
	$attr  = 'href="' . $url['url'] . '"';
	$attr .= !empty( $url['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $url['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( !empty( $url['url'] ) && $infobox_btn_visibility == 'hidden' ) {
	$heading_tag_html = sprintf( '<%1$s class="item-title" data-cursor="-opaque"><a '.$attr.' class="item-btn">%3$s</a></%1$s>', $heading_tag, $title, $title );
} else {
	$heading_tag_html = sprintf( '<%1$s class="item-title" data-cursor="-opaque">%3$s</%1$s>', $heading_tag, $title, $title );
}

?>

<div class="clplace-info-box clplace-info-box-9 <?php echo esc_attr( $css_classes.' '.$icon_position); ?> info-box">
    <?php if ($icon_image['url'] || $data['icon']['value']) { ?>
        <div class="item-icon-box">
            <?php 
                if ($icon_image['url']) {
                    echo wp_get_attachment_image( $icon_image['id'], 'full' ); 
                } else {
                    Icons_Manager::render_icon( $data['icon'] ); 
                }
            ?>
        </div>
    <?php } ?>
    <div class="content">
        <?php echo wp_kses_post( wp_kses_stripslashes( $heading_tag_html ) ); ?>
        <div class="description-text">
	        <?php echo wp_kses_post( $desc ); ?>
        </div>
        <?php if ( !empty( $url['url'] ) && $data['infobox_btn_visibility'] == 'visible' ) { ?>
            <div class="btn-wrap">
                <a <?php echo wp_kses_post( wp_kses_stripslashes( $attr ) ); ?> class="item-btn">
                    <?php echo esc_html( $data['btntext'] ); ?>
                    <?php Icons_Manager::render_icon( $data['btnicon'] ); ?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>