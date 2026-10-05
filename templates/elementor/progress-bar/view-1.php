<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$progress_percentage = is_numeric( $percent['size'] ) ? $percent['size'] : '0';
if ( 100 < $progress_percentage ) {
    $progress_percentage = 100;
}

?>
<div class="rt-progress-bar <?php echo esc_attr($layout) ?>">
    <h4 class="progress-title"><?php echo esc_html( $title ); ?></h4>
    <div 
        class="elementor-progress-wrapper <?php echo esc_attr($progress_type) ?>"
        role = "progressbar"
        aria-valuemin = "0"
        aria-valuemax = "100"
        aria-valuenow = "<?php echo esc_attr( $progress_percentage ) ?>"
        aria-valuetext = "<?php echo esc_attr( $inner_text ) ?>"
    >
        <div 
            class="elementor-progress-bar <?php echo esc_attr($progress_animation) ?>"
            data-max="<?php echo esc_attr( $progress_percentage) ?>"
        >
            <span class="elementor-progress-text"><?php echo esc_html( $inner_text ); ?></span>
            <?php if ( 'hide' !== $display_percentage ) { ?>
                <span class="elementor-progress-percentage">
                    <?php echo esc_html( $progress_percentage ); ?>%
                </span>
            <?php } ?>
        </div>
    </div>
</div>