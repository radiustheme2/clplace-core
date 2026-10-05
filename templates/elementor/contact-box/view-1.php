<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/infobox/view-1.php
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

<div class="rt-contact-box rt-contact-box-1 <?php echo esc_attr( $css_classes.' '.$icon_position); ?> contact-box">
    <?php if ($icon_image['url'] || $icon['value']) { ?>
        <div class="item-icon-box">
            <?php 
                if ($icon_image['url']) {
                    echo wp_get_attachment_image( $icon_image['id'], 'full' ); 
                } else {
                    Icons_Manager::render_icon( $icon );
                }
            ?>
	        <?php if ( $number_text ){ ?>
                <span class="number"><?php echo esc_html( $number_text ); ?></span>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="content">
        <?php echo wp_kses_post( wp_kses_stripslashes( $heading_tag_html ) ); ?>
        <?php if (!empty($desc)){ ?>
            <div class="description-text">
                <?php echo esc_html( $desc ); ?>
            </div>
        <?php } ?>
    </div>
    <div class="contact-info-list">
        <ul>
	        <?php foreach($info_list as $item) {
		        $data_type = $item['info_text'];
                ?>
                <li class="elementor-repeater-item-<?php echo esc_attr($item['_id']) ?>">
			        <?php Icons_Manager::render_icon( $item['info_icon'], [ 'aria-hidden' => 'true' ] ); ?>
	                <?php if( filter_var( $data_type, FILTER_VALIDATE_EMAIL ) ){ ?>
                    <a href="mailto:<?php echo esc_attr($item['info_text']) ?>" class="list-item"><?php echo esc_html($item['info_text']) ?></a>
	                <?php } elseif ( preg_match('/^[0-9\-\(\)\/\+\s]*$/', $data_type ) ) { ?>
                        <a href="tel:<?php echo esc_attr($item['info_text']) ?>" class="list-item"><?php echo esc_html($item['info_text']) ?></a>
	                <?php } elseif (filter_var($data_type, FILTER_VALIDATE_URL)) { ?>
                        <a href="<?php echo esc_url($item['info_text']) ?>" class="list-item"><?php echo esc_html($item['info_text']) ?></a>
                    <?php } else { ?>
                        <span class="list-item"><?php echo esc_html($item['info_text']) ?></span>
                    <?php } ?>
                </li>
	        <?php }  ?>
        </ul>
    </div>
    <?php if ( !empty( $url['url'] ) && $infobox_btn_visibility == 'visible' ) { ?>
        <div class="btn-wrap">
            <a <?php echo wp_kses_post( wp_kses_stripslashes( $attr ) ); ?> class="item-btn">
                <?php Icons_Manager::render_icon( $btnicon, [ 'aria-hidden' => 'true' ] ); ?>
                <?php echo esc_html( $btntext); ?>
            </a>
        </div>
    <?php }
        if (!empty($icon2['value'])) {
    ?>
    <div class="icon-2">
        <?php Icons_Manager::render_icon( $icon2 );  ?>
    </div>
    <?php } ?>
</div>