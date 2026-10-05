<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="rt-el-text-btn">
	<div class="rtin-item">
		<div class="rtin-left">
			<div class="rtin-left-inner">
				<div class="rtin-content">
					<h3 class="rtin-title"><?php echo esc_html( $title ); ?></h3>
					<div class="rtin-content">
						<?php echo wp_kses_post( $description ); ?>
						<?php echo do_shortcode( $content ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="rtin-right"></div>
	</div>
</div>