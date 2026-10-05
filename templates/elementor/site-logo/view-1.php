<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $logo_has_used;
$logo_h1    = ! is_singular( [ 'post' ] );
$site_title = $logo_title ?? '';
if ( isset( $logo_has_used ) && $logo_has_used ) {
	$logo_h1 = '';
}
?>
    <div class="site-branding <?php echo esc_attr($logo_mode); ?> pr-15">
		<?php echo wp_kses_post( clplace_site_logo( $logo_h1, $site_title ) ); ?>
    </div>
<?php
$logo_has_used = true;
