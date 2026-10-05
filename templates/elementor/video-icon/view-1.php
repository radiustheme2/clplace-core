<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Icons_Manager;

$image_uploaded = $video_image['id'] ? 'image-ebable' : 'image-disable';

?>
<div class="rt-video-icon-wrapper <?php echo esc_attr( $layout.' '.$image_uploaded ); ?>">
	<?php echo wp_get_attachment_image( $video_image['id'], 'full' ); ?>
	<div class="video-icon-inner">
		<div class="icon-left">
			<div class="icon-box">
				<a class="popup-youtube video-popup-icon" href="<?php echo esc_url( $video_url ) ?>">
					<?php Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
				</a>
			</div>
		</div>
		<?php if ( $button_text ) : ?>
			<div class="icon-right">
				<a class="popup-youtube button-text" href="<?php echo esc_url( $video_url ) ?>">
					<?php echo esc_html( $button_text ) ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>

