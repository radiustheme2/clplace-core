<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Hooks;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\ClplaceCore\Traits\SingletonTraits;

class ActionHooks {
	use SingletonTraits;

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'remove_admin_bar' ], 999 );
		add_action( 'wp_head', [ $this, 'global_js_vairable_assign' ], 1 );
		add_action( 'admin_head', [ $this, 'global_js_vairable_assign' ], 1 );
	}

	//Remove admin bar
	function remove_admin_bar() {
		if ( clplace_option( 'rt_remove_admin_bar' ) && ! current_user_can( 'administrator' ) && ! is_admin() ) {
			show_admin_bar( false );
		}
	}

	function global_js_vairable_assign() {
		$item_id = CLPLACE_ITEM;
		?>
		<script>
            var RDTheme = {
                itemID: "<?php echo esc_attr( $item_id ) ?>",
            }
		</script>
		<?php
	}

}