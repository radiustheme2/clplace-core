<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$target   = $link['is_external'] ? ' target="_blank"' : '';
$nofollow = $link['nofollow'] ? ' rel="nofollow"' : '';
?>

<div class="rt-pricing-box-wrapper <?php echo esc_attr($is_featured.' '.$is_active) ?>">

    <?php if($is_featured == 'is-featured') : ?>
        <div class="is-featured">
            <span><?php echo esc_html($featured_text) ?></span>
        </div>
    <?php endif; ?>
    <header>
	    <?php  if('icon' == $icon_type || 'image' == $icon_type) : ?>
            <div class="icon-holder">
			    <?php
			    if('icon' == $icon_type) {
				    \Elementor\Icons_Manager::render_icon( $price_icon, [ 'aria-hidden' => 'true' ] );
			    } elseif ('image' == $icon_type) {
				    echo wp_get_attachment_image( $image['id'], 'full' );
			    }
			    ?>
            </div>
	    <?php endif; ?>
        <div class="title-price-holder">

	        <?php if (!empty( $title )) { ?>
                <div class="plan-name-wrap">
                    <h3 class="plan-name"><?php echo esc_html($title) ?></h3>
                </div>
            <?php } ?>

            <div class="price-wrap">
                <span class="price"><?php echo esc_html( $price ) ?></span>
                <span class="seperator">/</span>
                <span class="period"><?php echo esc_html( $period ) ?></span>
            </div>

            <?php if (!empty( $subtitle )){ ?>
            <div class="subtitle">
		        <?php echo esc_html( $subtitle ); ?>
            </div>
            <?php } ?>

        </div>
    </header>
    <div class="feature-lists">
	    <?php if (!empty( $feature_list_title )) { ?>
            <p class="feature-list-title">
	            <?php echo esc_html( $feature_list_title ); ?>
            </p>
	    <?php } ?>
        <ul>
            <?php foreach($list as $item) {  ?>
                <li class="elementor-repeater-item-<?php echo esc_attr($item['_id']) ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <span class="list-item"><?php echo esc_html($item['faature_title']) ?></span>
                </li>
            <?php }  ?>
        </ul>
    </div>

    <footer>
        <?php printf( "<a class='btn btn-primary button-el rt-animation-btn' href='%s' %s %s >%s</a>", esc_url( $link['url'] ), esc_attr( $target ), esc_attr( $nofollow ), esc_html( $btn_text ) ); ?>
    </footer>
</div>
