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

?>
<div class="section-title-wrapper">
	<!--Background Title-->
	<?php if ( $bg_title ): ?>
		<div class="bg-title-wrap">
            <span class="background-title <?php echo esc_attr( $bg_title_style ) ?>">
                <?php echo esc_html( $bg_title ); ?>
            </span>
		</div>
	<?php endif; ?>

	<div class="title-inner-wrapper">
		<!--Top Sub Title-->
		<?php if ( $top_sub_title ): ?>
			<div class="top-sub-title-wrap">
                <span class="top-sub-title">
                    <?php echo esc_html( $top_sub_title ); ?>
                </span>
			</div>
		<?php endif; ?>

		<!--Main Title-->
		<?php if ( $title ): ?>
            <<?php echo esc_attr( $main_title_tag ) ?> class="main-title"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $main_title_tag ) ?>>
        <?php endif; ?>

        <!--Description-->
        <?php if ( $description ): ?>
            <div class="description"><?php echo wp_kses_post( $description ); ?></div>
        <?php endif; ?>
    </div>
</div>