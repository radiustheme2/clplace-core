<?php

namespace RT\ClplaceCore\Helper;

class Fns {

	public static function doing_it_wrong( $function, $message, $version ) {
		// @codingStandardsIgnoreStart
		$message .= ' Backtrace: ' . wp_debug_backtrace_summary();
		_doing_it_wrong( $function, $message, $version );
	}

	/**
	 * @param        $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed|void
	 */
	public static function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		$template_name = $template_name . ".php";
		if ( ! $template_path ) {
			$template_path = 'clplace-core/';
		}

		if ( ! $default_path ) {
			$default_path = untrailingslashit( CLPLACE_CORE_BASE_DIR ) . '/templates/';
		}

		$template_files = trailingslashit( $template_path ) . $template_name;

		$template = locate_template( apply_filters( 'rtcl_locate_template_files', $template_files, $template_name, $template_path, $default_path ) );

		// Get default template/.
		if ( ! $template ) {
			$template = trailingslashit( $default_path ) . $template_name;
		}

		return apply_filters( 'rtcl_locate_template', $template, $template_name );
	}

	/**
	 * Template Content
	 *
	 * @param string $template_name Template name.
	 * @param array $args Arguments. (default: array).
	 * @param string $template_path Template path. (default: '').
	 * @param string $default_path Default path. (default: '').
	 */
	public static function get_template( $template_name, $args = null, $template_path = '', $default_path = '' ) {

		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args ); // @codingStandardsIgnoreLine
		}

		$located = self::locate_template( $template_name, $template_path, $default_path );


		if ( ! file_exists( $located ) ) {
			// translators: %s template
			self::doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'clplace-core' ), '<code>' . $located . '</code>' ), '1.0' );

			return;
		}

		// Allow 3rd party plugin filter template file from their plugin.
		$located = apply_filters( 'rtcl_get_template', $located, $template_name, $args );

		do_action( 'rtcl_before_template_part', $template_name, $located, $args );

		include $located;

		do_action( 'rtcl_after_template_part', $template_name, $located, $args );
	}

	/**
	 * Get Asset URL
	 * @return string
	 */
	public static function get_assets_url( $path = null ) {
		return CLPLACE_CORE_BASE_URL . 'assets/' . $path;
	}

	/**
	 * Get all Post Type
	 * @return array
	 */
	public static function get_post_types( $exc = '' ) {
		$post_types = get_post_types(
			[
				'public' => true,
			],
			'objects'
		);
		$post_types = wp_list_pluck( $post_types, 'label', 'name' );

		$exclude = [ 'attachment', 'revision', 'nav_menu_item', 'elementor_library', 'tpg_builder', 'e-landing-page', 'elementor-clplace' ];
		if ( $exc ) {
			$exclude = array_merge( $exclude, $exc );
		}

		foreach ( $exclude as $ex ) {
			unset( $post_types[ $ex ] );
		}

		return $post_types;
	}


	/**
	 * Get Nav menu list
	 * @return array
	 */
	public static function nav_menu_list() {
		$nav_menus     = wp_get_nav_menus();
		$nav_list      = [];
		$nav_list['0'] = __( 'Select A Menu', 'clplace-core' );
		foreach ( (array) $nav_menus as $_nav_menu ) {
			$nav_list[ $_nav_menu->term_id ] = $_nav_menu->name;
		}

		return $nav_list;
	}

	/**
	 * @param $title
	 *
	 * @return void
	 */
	public static function rt_page_title( $title, $post_type = 'page' ) {
		$page = get_posts( array(
			'post_type'   => $post_type,
			'name'        => sanitize_title( $title ),
			'post_status' => 'publish',
			'numberposts' => 1
		) );

		if ( $page ) {
			$page = $page[0];
            return $page->ID;
		} else {
			return null;
		}
	}

	public static function get_user_social_info( $social_icons ){ ?>
		<div class="rt-team-social">
			<?php foreach ( $social_icons as $social_icons ):
				$attr = '';
				if ( !empty( $social_icons['social_link'] ) ) {
					$attr  = 'href="' . $social_icons['social_link'] . '"';
					$attr .= !empty( $social_icons['social_link']['is_external'] ) ? ' target="_blank"' : '';
					$attr .= !empty( $social_icons['social_link']['nofollow'] ) ? ' rel="nofollow"' : '';
				}
				$iconClass = '';
                $icon_value = $social_icons['social_icon'];
				$string = $icon_value['value'];
				$class = explode(' ', $string);
				if(isset($class[1])) {
					$mainClass = explode('-', $class[1]);
					if(isset($mainClass[1])) {
						$iconClass = $mainClass[1];
					}
				}
				?>
				<a class="elementor-repeater-item-<?php echo esc_attr( $social_icons['_id'].' '.$iconClass ); ?>" <?php echo $attr; ?> ><?php \Elementor\Icons_Manager::render_icon( $social_icons['social_icon'] ) ; ?></a>
			<?php endforeach; ?>
		</div>
		<?php
	}

}