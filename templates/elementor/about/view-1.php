<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * top_sub_title
 * title
 * subtitle
 * bg_title
 * top_title_icon
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Icons_Manager;
?>

<div class="about-us-widget">
    <div class="about-logo">
        <?php
        if ( ! empty( $logo_image['id'] ) ) {
	        echo wp_get_attachment_image( $logo_image['id'], 'full' );
        } else {
            echo wp_kses_post( clplace_site_logo() );
        }
        ?>
    </div>

    <?php
        if ( ! empty( $description ) ) {
            echo "<p class='description'>" .esc_html( $description ) . "</p>";
        }
    ?>

    <span class="app-btn-title"><?php echo esc_html( $title ); ?></span>

    <div class="app-download-area">
	    <?php if ( ! empty( $play_store_link['url'] ) ) : ?>
            <a href="<?php echo esc_url($play_store_link['url']); ?>" target="_blank">
			    <?php Icons_Manager::render_icon( $play_store_icon ); ?>
            </a>
	    <?php endif; ?>

        <?php if ( ! empty( $app_store_link['url'] ) ) : ?>
            <a href="<?php echo esc_url($app_store_link['url']); ?>" target="_blank">
	            <?php Icons_Manager::render_icon( $app_store_icon ); ?>
            </a>
        <?php endif; ?>
    </div>
</div>