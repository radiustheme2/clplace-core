<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\ClplaceCore\Helper\Fns;

 $template_style = 'style-'.$style;
 $cols = 'col-lg-'.$grid_column_desktop.' col-md-'.$grid_column_tab.' col-sm-'.$grid_column_mobile;
?>

<div class="rt-el-testimonial grid-layout testimonial-<?php echo esc_attr(  $template_style ); ?>-wrapper">
    <div class="row align-stretch">
        <?php foreach ( $items as $item ): ?>
            <div class="<?php echo esc_attr( $cols ); ?> text-<?php echo esc_attr( $align ); ?>">
               <?php Fns::get_template( "elementor/testimonial/style-" . $style, $item ); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

