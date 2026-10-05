<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $listing_cat_id             string
 * @var $display_pagination         string
 * @var $icon_display               string
 * @var $designation_display        string
 * @var $thumb_display              string
 * @var $layout                     string
 * @var $swiper_data                string
 * @var $items                      string
 * @var $quote_icon                 string
 * @var $quote_display              string
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\Clplace\Plugins\Listing_Functions;

?>
<div class="rt-listing-category-box layout-3">
    <div class="category-box">
        <?php if ( $image['id'] ) { ?>
            <div class="category-box-img">
                <?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
            </div>
        <?php } ?>
        <div class="category-box-content icon-display-<?php echo esc_attr( $icon_display ); ?>">
            <div class="content-top">
                <?php if ( $icon_display && $term_id ){ ?>
                    <div class="category-icon">
                        <?php echo wp_kses_post( Listing_Functions::listing_cat_icon( $term_id, $icon_type ) ); ?>
                    </div>
                 <?php } ?>
                <div class="name-count">
                    <h3 class="listing-category">
                        <a href="<?php echo esc_url( $permalink ) ?>">
                            <?php echo esc_html( $title ); ?>
                        </a>
                    </h3>
                    <?php if (!empty( $count || $counter_label ) && $count_display ){ ?>
                        <div class="listing-count">
                            <?php if (!empty( $count )){ ?>
                                <span class="count"><?php echo esc_html( $count ); ?></span>
                            <?php } if (!empty( $counter_label )){ ?>
                                <span class="count-label"><?php echo esc_html( $counter_label ); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (!empty( $cats_desc || $button_switch )){ ?>
                <div class="content-bottom">
                    <?php if (!empty( $cats_desc )){ ?>
                        <div class="desc">
                            <p><?php echo esc_html( $cats_desc ); ?></p>
                        </div>
                    <?php } if (!empty( $button_switch )){ ?>
                        <a class="button-link" href="<?php echo esc_url( $permalink ) ?>">
                            <?php esc_html_e( 'Read More', 'clplace-core' ); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>