<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Rtcl\Helpers\Functions;
use RT\Clplace\Plugins\Listing_Functions;
use RtclPro\Controllers\Hooks\TemplateHooks as ProTemplateHooks;

$args = [
	'post_type'           => 'rtcl_listing',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $post_limit,
	'post_status'         => 'publish',
];
if ( $orderby ) {
	$args['orderby'] = $orderby;
}
if ( $order ) {
	$args['order'] = $order;
}

if ( $post_source == 'by_category' && $categories ) :
	$args = wp_parse_args(
		[
			'cat' => $categories,
		]
		, $args );
endif;

if ( $post_source == 'by_tags' && $tags ) :
	$args = wp_parse_args(
		[
			'tag_slug__in' => $tags,
		]
		, $args );
endif;

if ( $post_source == 'by_title' && !empty( $titles ) ) {
	$args['post__in'] = $titles;
}


if ( $exclude ) :
	$excluded_ids         = explode( ',', $exclude );
	$args['post__not_in'] = $excluded_ids;
endif;


if ( $offset ) {
	$args['offset'] = $offset;
}

$query = new \WP_Query( $args );

if ( $query->have_posts() ) :
	?>

    <!--=====================================-->
    <!--=      Portfolio Masonry Area Start    =-->
    <!--=====================================-->
    <section class="listing-isotope-filter-layout">
        <div class="isotope-menu">
            <ul class="isotope-menu-list d-flex justify-content-center flex-wrap">
                <li data-filter="*" class="active">
                    <div class="logo-wrap d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="36" viewBox="0 0 30 36" fill="none">
                            <path d="M3.75 22.5H26.25M3.75 13.5H26.25" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span> All</span>
                </li>
                <li data-filter=".plumbing" class="">
                    <div class="logo-wrap d-flex justify-content-center">
                        <i class="icon icon-cleaning"></i>
                    </div>
                    Cleaning</li>
                <li data-filter=".electric" class="">
                    <div class="logo-wrap d-flex justify-content-center">
                        <i class="icon icon-plumbing"></i>
                    </div>
                    Plumbing</li>
                <li data-filter=".repair" >
                    <div class="logo-wrap d-flex justify-content-center">
                        <i class="icon icon-plug"></i>
                    </div>
                    Electric</li>
                <li data-filter=".cctv" class="">
                    <div class="logo-wrap d-flex justify-content-center">
                        <i class="icon icon-air-conditioner"></i>
                    </div>
                    Ac Repair</li>
                <li data-filter=".repairs-2" class="">
                    <div class="logo-wrap d-flex justify-content-center">
                        <i class=" icon icon-cctv-camera"></i>
                    </div>
                    CCTV</li>
                <li data-filter=".repair" class="">
                    <div class="logo-wrap d-flex justify-content-center">
                        <i class=" icon icon-home-repair"></i>
                    </div>
                    Repairs</li>
                <li data-filter=".painting" class="">
                    <div class="logo-wrap d-flex justify-content-center">
                        <i class="icon icon-varnish"></i>
                    </div>
                    Painting
                </li>
                <li data-filter=".landscaping" class="">
                    <div class="logo-wrap d-flex justify-content-center">
                        <i class=" icon icon-nature"></i>
                    </div>
                    Landscaping
                </li>
            </ul>
        </div>
            <div class="isotope-items">
                <?php
                    while ( $query->have_posts() ) : $query->the_post();
	                    global $listing;
                ?>
                        <div <?php Functions::listing_class( [ 'rtcl-widget-listing-item', 'listing-item' ] ); ?>>
                            <!-- Thumbnail Image Box -->
                            <div class="item-img bg--gradient-50">
			                    <?php if ( $rtcl_show_types && $listing->get_ad_type() ) { ?>
                                    <div class="listing-actions-buttons">
					                    <?php
					                    if ( $rtcl_show_types && $listing->get_ad_type() ) {
						                    $listing_type = Listing_Functions::get_listing_type( $listing );

						                    if (!empty($listing_type['label'])) {
							                    ?>
                                                <span class="listing-type-badge">
										<?php
										esc_html_e( 'For', 'clplace-core' );
										echo esc_html($listing_type['label']);
										?>
									</span>
						                    <?php } } ?>

					                    <?php
					                    if ( $instance['rtcl_show_labels'] ) {
						                    $labels = $listing->badges() ? $listing->badges() : '';
						                    echo wp_kses_post($labels);
					                    }
					                    ?>
                                    </div>
			                    <?php } ?>
			                    <?php
			                    if ( $rtcl_show_image ) {
				                    $image_size    = $rtcl_thumb_image_size;
				                    $the_thumbnail = $listing->get_the_thumbnail( $image_size );
				                    if ( $the_thumbnail ) { ?>
                                        <div class='listing-thumb'>
						                    <?php
						                    if ( rtcl()->has_pro() ) {
							                    ProTemplateHooks::sold_out_banner();
						                    }
						                    ?>
                                            <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title() ?>"><?php echo wp_kses_post($the_thumbnail); ?></a>
                                        </div>
				                    <?php }
			                    } ?>
                                <ul class="meta-tags">
				                    <?php if ( $rtcl_show_favourites ) { ?>
					                    <?php if ( is_user_logged_in() ) { ?>
                                            <li class="meta-item meta-favourite">
							                    <?php echo wp_kses_post( Listing_Functions::get_favourites_link( $listing->get_id() ) ); ?>
                                            </li>
					                    <?php } else { ?>
                                            <li class="meta-item meta-favourite">
							                    <?php echo wp_kses_post( Listing_Functions::get_favourites_link( $listing->get_id() ) ); ?>
                                            </li>
					                    <?php } ?>
				                    <?php } if ( rtcl()->has_pro() ) {
					                    if ( ! empty( $instance['rtcl_show_compare'] ) ){
						                    ?>
                                            <li class="meta-compare">
							                    <?php
							                    $compare_ids = ! empty( $_SESSION['rtcl_compare_ids'] ) ? $_SESSION['rtcl_compare_ids'] : []; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
							                    $selected_class = '';
							                    if ( is_array( $compare_ids ) && in_array( $listing->get_id(), $compare_ids ) ) {
								                    $selected_class = ' selected';
							                    }
							                    ?>
                                                <a class="rtcl-compare <?php echo esc_attr( $selected_class ); ?>" href="#" data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
                                                    <i class="icon-compare"></i>
                                                </a>
                                            </li>
					                    <?php }
				                    }
				                    if ( rtcl()->has_pro() ) {
					                    if ( ! empty( $instance['rtcl_show_quick_view'] ) ) :
						                    ?>
                                            <li class="rtin-el-button">
                                                <a class="rtcl-quick-view" href="#" title="<?php esc_attr_e( 'Quick View', 'clplace-core' ); ?>"  data-listing_id="<?php echo absint( $_id ); ?>">
                                                    <i class="icon-eye"></i>
                                                </a>
                                            </li>
					                    <?php
					                    endif;
				                    }
				                    ?>
                                </ul>
                            </div>

                            <!-- All Meta Info Box -->
                            <div class="item-content">
			                    <?php if ( $instance['rtcl_show_category'] ): ?>
                                    <div class="rt-categories">
					                    <?php echo wp_kses_post( $listing->the_categories( false, true )); ?>
                                    </div>
			                    <?php endif; ?>
                                <div class="title-excerpt-box">
				                    <?php if ( $instance['rtcl_show_title'] ) { ?>
                                        <h3 class="listing-title rtcl-listing-title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
				                    <?php } ?>
				                    <?php
				                    if ( $instance['rtcl_show_description'] ) {
					                    $excerpt = get_the_excerpt( $_id );
					                    ?>
                                        <div class="rtcl-short-description"><?php echo wp_kses_post( wpautop( $excerpt ) ); ?></div>
				                    <?php }
				                    ?>
                                </div>

			                    <?php if (!empty($instance['rtcl_show_custom_fields'])) { ?>
                                    <div class="custom-flelds-box">
					                    <?php TemplateHooks::loop_item_listable_fields(); ?>
                                    </div>
			                    <?php } ?>
			                    <?php if ( !empty ( $instance['rtcl_show_user'] || $instance['rtcl_show_location'] || $instance['rtcl_show_views'] || $instance['rtcl_show_category'] )): ?>
                                    <div class="all-meta-info-box">
                                        <ul class="rtcl-listing-meta-data">
						                    <?php if ( $instance['rtcl_show_user'] ) : ?>
                                                <li class="author">
                                                    <i class="icon-author"></i>
								                    <?php esc_html_e( 'by ', 'clplace-core' ); ?>
								                    <?php if ( $listing->can_add_user_link() && ! is_author() ) : ?>
                                                        <a href="<?php echo esc_url( $listing->get_the_author_url() ); ?>"><?php $listing->the_author(); ?></a>
								                    <?php else : ?>
									                    <?php $listing->the_author(); ?>
								                    <?php endif; ?>
								                    <?php do_action( 'rtcl_after_author_meta', $listing->get_owner_id() ); ?>
                                                </li>
						                    <?php endif; ?>
						                    <?php
						                    if ( $instance['rtcl_show_location'] ) :
							                    ?>
                                                <li class="rt-location">
                                                    <i class="icon-location"></i>
								                    <?php $listing->the_locations( true, true ); ?>
                                                </li>
						                    <?php endif; ?>
						                    <?php if ( $instance['rtcl_show_views'] ) : ?>
                                                <li class="rt-views">
                                                    <i class="icon-eye"></i>
								                    <?php
								                    // translators: %s is the number of views.
								                    echo esc_html( sprintf( _n( '%s view', '%s views', $listing->get_view_counts(), 'clplace-core' ), number_format_i18n( $listing->get_view_counts() ) ) ); ?>
                                                </li>
						                    <?php endif; ?>
                                        </ul>
                                    </div>
			                    <?php endif; ?>

                                <div class="listing-footer">
	                                <?php
	                                if ( $instance['rtcl_show_price'] ) {
		                                $price_html = $listing->get_price_html();
		                                $price      = sprintf( '<div class="item-price">%s</div>', $price_html );
		                                echo wp_kses_post( wp_kses_stripslashes( $price ) );
	                                }
	                                ?>
				                    <?php if ( !empty( $phone ) ){ ?>
                                        <a href="tel:<?php echo esc_url( $phone_url ); ?>" class="phone-no">
                                            <i class="icon-phone-call"></i>
						                    <?php echo esc_html( $phone ); ?>
                                        </a>
				                    <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php endwhile; ?>
            </div>
    </section>

<?php endif; wp_reset_postdata(); ?>

<script>jQuery('.portfolio-items').isotope();</script>