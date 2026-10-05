<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $display_arrow              string
 * @var $display_pagination         string
 * @var icon_display             string
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
<div class="rt-listing-cats-slider-wrapper rt-cats-slider-<?php echo esc_attr( $layout ) ?>">
    <div class="rt-swiper-slider" data-slider-options="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper">
			<?php foreach ($items as $key => $item) {
				$term_id = $item['listing_cat_id'];
                if (!empty( $term_id )) {
                    $term_icon = get_term_meta( $term_id, '_rtcl_icon', true );
	                $count = Listing_Functions::rt_term_post_count($term_id, 'rtcl_category');
                ?>
                <div class="swiper-slide">
                    <div class="category-box bgGradient50">
                        <div class="category-box-img">
	                        <?php if ( $item['image']['id'] ) { ?>
		                        <?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
	                        <?php } ?>
                        </div>
                        <div class="category-box-content icon-display-<?php echo esc_attr( $icon_display ); ?>">
                            <?php if ( $icon_display ){ ?>
                                <div class="category-icon">
                                    <?php echo wp_kses_post( Listing_Functions::listing_cat_icon( $term_id, $item['icon_type'] ) ); ?>
                                </div>
                             <?php } ?>
                            <h3 class="listing-category">
                                <a href="<?php echo esc_url( get_term_link( get_term( $term_id ), get_term( $term_id )->name ) ); ?>">
                                    <?php echo esc_html( get_term( $term_id )->name ); ?>
                                </a>
                            </h3>
                            <?php if (!empty($count || $item['counter_label']) && $count_display){ ?>
                                <div class="listing-count">
		                            <?php if (!empty( $count )){ ?>
                                        <span class="count"><?php echo esc_html( $count ); ?></span>
	                                <?php } if (!empty( $item['counter_label'] )){ ?>
                                        <span class="count-label"><?php echo esc_html( $item['counter_label'] ); ?></span>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="catagory-layer"></div>
                        </div>
                    </div>
                </div>
			<?php } } ?>
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