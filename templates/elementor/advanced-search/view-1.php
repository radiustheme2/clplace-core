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
use RT\ClplaceCore\Helper\Fns;
use RT\Clplace\Plugins\Listing_Functions;

$listing_price_range = Listing_Functions::listing_price_range();
?>

<div class="advanced-search-banner">
    <?php
        $data = [
            'title'                         => ! empty( $title ) ? $title : 'inline',
            'orientation'                   => ! empty( $orientation ) ? $orientation : 'inline',
            'layout'                        => ! empty( $layout ) ? $layout : '',
            'icon'                          => ! empty( $icon ) ? $icon : 'icon',
            'can_search_by_keyword'         => ! empty( $search_by_keyword ) ? 1 : 0,
            'can_search_by_listing_types'   => ! empty( $instance['search_by_listing_types'] ) ? 1 : 0,
            'can_search_by_category'        => ! empty( $search_by_category ) ? 1 : 0,
            'category_is_parent'            => ! empty( $category_is_parent ) ? 1 : 0,
            'can_search_by_location'        => ! empty( $search_by_location ) ? 1 : 0,
            'can_search_by_radius_search'   => ! empty( $search_by_radius_search ) ? 1 : 0,
            'can_search_by_radius_distance' => ! empty( $search_by_radius_distance ) ? 1 : 0,
            'can_search_by_price'           => ! empty( $search_by_price ) ? 1 : 0,
            'can_search_by_custom_field'    => ! empty( $search_by_custom_field ) ? 1 : 0,
            'min_price'                     => ! empty( $min_price ) ? $min_price : $listing_price_range['min_price'],
            'max_price'                     => ! empty( $max_price ) ? $max_price : $listing_price_range['max_price'],
        ];
        Fns::get_template( 'listing-search-banner', $data, '', get_template_directory() . '/classified-listing/custom/' );
    ?>
</div>