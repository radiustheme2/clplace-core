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
<div class="rt-listing-category-box layout-1">
    <div class="category-box">
        <div class="category-box-img">
            <?php if ( $image['id'] ) { ?>
                <?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
            <?php } ?>
        </div>
        <div class="category-box-content icon-display-<?php echo esc_attr( $icon_display ); ?>">
            <?php if ( $icon_display && $term_id ){ ?>
                <div class="category-icon">
                    <?php echo wp_kses_post( Listing_Functions::listing_cat_icon( $term_id, $icon_type ) ); ?>
                </div>
             <?php } ?>
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
        <?php if ( $button_switch == 'yes' && $term_id ){ ?>
            <a class="button-link" href="<?php echo esc_url( $permalink ) ?>">
                <i class="icon-arrow-right-two"></i>
            </a>
        <?php } ?>
    </div>
</div>