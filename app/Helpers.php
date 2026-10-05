<?php
/**
 * Helpers methods
 * List all your static functions you wish to use globally on your theme
 *
 * @package clplace-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'clplace_about_social' ) ) {
	/**
	 * Get about social icon list
	 * @return void
	 */
	function clplace_about_social( $instance ) {
		$icon_style = clplace_option( 'rt_social_icon_style' ) ?? '';
		?>
		<ul class="footer-social">
			<?php if ( ! empty( $instance['facebook'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'facebook' . $icon_style ) ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['twitter'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'twitter' . $icon_style ) ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['linkedin'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'linkedin' . $icon_style ) ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['pinterest'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'pinterest' . $icon_style ) ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['instagram'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'instagram' . $icon_style ) ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['youtube'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'youtube' . $icon_style ) ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['rss'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['rss'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'rss' . $icon_style ) ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['zalo'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['zalo'] ); ?>" target="_blank">
                    <span class="rticon-zalo">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="black" xmlns="http://www.w3.org/2000/svg">
                        <path
	                        d="M3.60001 1.60001C2.5002 1.60001 1.60001 2.5002 1.60001 3.60001V16.4C1.60001 17.4998 2.5002 18.4 3.60001 18.4H16.4C17.4998 18.4 18.4 17.4998 18.4 16.4V3.60001C18.4 2.5002 17.4998 1.60001 16.4 1.60001H3.60001ZM3.60001 2.40001H6.23047C4.84722 3.83925 4.00001 5.72946 4.00001 7.80001C4.00001 9.94455 4.90726 11.8994 6.37969 13.3555C6.32617 13.3045 6.39546 13.3932 6.40235 13.55C6.40946 13.7119 6.38508 13.9344 6.31954 14.1547C6.18845 14.5953 5.91427 15.0015 5.47344 15.1484C5.38972 15.1763 5.31757 15.2312 5.26823 15.3043C5.21889 15.3775 5.19514 15.4649 5.20067 15.553C5.20619 15.6411 5.24069 15.7249 5.29879 15.7913C5.35689 15.8577 5.43532 15.9031 5.52188 15.9203C6.62576 16.1411 7.40659 15.8087 7.98204 15.5445C8.55748 15.2803 8.86842 15.1026 9.45001 15.3375C9.45156 15.338 9.45313 15.3386 9.45469 15.3391C10.5436 15.7647 11.7425 16 13 16C14.6789 16 16.2525 15.5805 17.6 14.8492V16.4C17.6 17.0674 17.0674 17.6 16.4 17.6H3.60001C2.93261 17.6 2.40001 17.0674 2.40001 16.4V3.60001C2.40001 2.93261 2.93261 2.40001 3.60001 2.40001ZM7.39844 2.40001H16.4C17.0674 2.40001 17.6 2.93261 17.6 3.60001V13.9219C16.2908 14.7251 14.7099 15.2 13 15.2C11.8441 15.2 10.7455 14.9838 9.75001 14.5953C8.90479 14.2539 8.2163 14.5565 7.64844 14.8172C7.34091 14.9584 7.03749 15.0758 6.69454 15.1406C6.86421 14.8987 7.00934 14.6403 7.08594 14.3828C7.17645 14.0786 7.21324 13.7807 7.20157 13.5148C7.18993 13.2499 7.16678 13.0073 6.94297 12.7875L6.94219 12.7867C5.60678 11.4661 4.80001 9.7195 4.80001 7.80001C4.80001 5.67097 5.79448 3.75506 7.39844 2.40001ZM13.1938 5.99454C13.0878 5.99619 12.9868 6.03982 12.913 6.11583C12.8392 6.19185 12.7986 6.29405 12.8 6.40001V10C12.7993 10.053 12.809 10.1056 12.8288 10.1548C12.8486 10.204 12.8779 10.2488 12.9151 10.2865C12.9524 10.3243 12.9967 10.3542 13.0456 10.3747C13.0945 10.3952 13.147 10.4057 13.2 10.4057C13.253 10.4057 13.3055 10.3952 13.3544 10.3747C13.4033 10.3542 13.4477 10.3243 13.4849 10.2865C13.5221 10.2488 13.5514 10.204 13.5712 10.1548C13.591 10.1056 13.6008 10.053 13.6 10V6.40001C13.6007 6.34649 13.5907 6.29337 13.5706 6.2438C13.5504 6.19422 13.5205 6.14919 13.4826 6.11139C13.4447 6.07358 13.3996 6.04375 13.35 6.02368C13.3004 6.00361 13.2473 5.9937 13.1938 5.99454ZM7.20001 6.40001C7.147 6.39926 7.09438 6.40905 7.04519 6.42881C6.996 6.44858 6.95123 6.47792 6.91348 6.51514C6.87574 6.55236 6.84576 6.59671 6.8253 6.64561C6.80484 6.69451 6.79431 6.747 6.79431 6.80001C6.79431 6.85302 6.80484 6.9055 6.8253 6.9544C6.84576 7.0033 6.87574 7.04765 6.91348 7.08487C6.95123 7.12209 6.996 7.15143 7.04519 7.1712C7.09438 7.19096 7.147 7.20076 7.20001 7.20001H8.47891L6.86094 9.78829C6.82319 9.84882 6.80232 9.91835 6.80048 9.98967C6.79865 10.061 6.81592 10.1315 6.8505 10.1939C6.88509 10.2563 6.93573 10.3083 6.99718 10.3446C7.05864 10.3808 7.12866 10.3999 7.20001 10.4H9.20001C9.25301 10.4008 9.30564 10.391 9.35482 10.3712C9.40401 10.3514 9.44878 10.3221 9.48653 10.2849C9.52427 10.2477 9.55425 10.2033 9.57471 10.1544C9.59517 10.1055 9.6057 10.053 9.6057 10C9.6057 9.947 9.59517 9.89451 9.57471 9.84561C9.55425 9.79671 9.52427 9.75236 9.48653 9.71514C9.44878 9.67792 9.40401 9.64858 9.35482 9.62881C9.30564 9.60905 9.25301 9.59926 9.20001 9.60001H7.9211L9.53907 7.01172C9.57682 6.95119 9.59769 6.88166 9.59953 6.81034C9.60136 6.73902 9.58409 6.66851 9.54951 6.60611C9.51492 6.54371 9.46428 6.4917 9.40283 6.45546C9.34137 6.41922 9.27135 6.40007 9.20001 6.40001H7.20001ZM11.9938 7.59454C11.9281 7.59569 11.8638 7.61298 11.8065 7.64486C11.7491 7.67674 11.7005 7.72224 11.6648 7.77735C11.4658 7.66806 11.2414 7.60001 11 7.60001C10.2315 7.60001 9.60001 8.23154 9.60001 9.00001C9.60001 9.76847 10.2315 10.4 11 10.4C11.2411 10.4 11.4652 10.3318 11.6641 10.2227C11.7112 10.2956 11.7808 10.3511 11.8623 10.381C11.9438 10.4109 12.0328 10.4135 12.1158 10.3884C12.1989 10.3632 12.2716 10.3117 12.3228 10.2417C12.3741 10.1716 12.4012 10.0868 12.4 10V9.00001V8.00001C12.4007 7.94649 12.3907 7.89337 12.3706 7.8438C12.3504 7.79422 12.3205 7.74919 12.2826 7.71138C12.2447 7.67358 12.1996 7.64375 12.15 7.62368C12.1004 7.60361 12.0473 7.5937 11.9938 7.59454ZM15.4 7.60001C14.6315 7.60001 14 8.23154 14 9.00001C14 9.76847 14.6315 10.4 15.4 10.4C16.1685 10.4 16.8 9.76847 16.8 9.00001C16.8 8.23154 16.1685 7.60001 15.4 7.60001ZM11 8.40001C11.3361 8.40001 11.6 8.6639 11.6 9.00001C11.6 9.33611 11.3361 9.60001 11 9.60001C10.6639 9.60001 10.4 9.33611 10.4 9.00001C10.4 8.6639 10.6639 8.40001 11 8.40001ZM15.4 8.40001C15.7361 8.40001 16 8.6639 16 9.00001C16 9.33611 15.7361 9.60001 15.4 9.60001C15.0639 9.60001 14.8 9.33611 14.8 9.00001C14.8 8.6639 15.0639 8.40001 15.4 8.40001Z"/>
                    </svg>
                        </span>
				</a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['telegram'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['telegram'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'telegram' . $icon_style ) ) ?></a>
			<?php endif; ?>

		</ul>
		<?php
	}
}

if ( ! function_exists( 'clplace_about_apps' ) ) {
	/**
	 * Get about social icon list
	 * @return void
	 */
	function clplace_about_apps( $instance ) {
		?>
        <div class="app-download-area">
			<?php if ( ! empty( $instance['app_store_link'] ) ) : ?>
                <a href="<?php echo esc_url( $instance['app_store_link'] ); ?>" target="_blank"><?php echo wp_kses_post( clplace_get_svg( 'app-store' ) ); ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['play_store_link'] ) ) : ?>
                <a href="<?php echo esc_url( $instance['play_store_link'] ); ?>" target="_blank">
	                <?php echo wp_kses_post( clplace_get_svg( 'play-store' ) ); ?>
                </a>
			<?php endif; ?>
        </div>
		<?php
	}
}


if ( ! function_exists( 'clplace_contact_render' ) ) {
	function clplace_contact_render( $data ) {
		ob_start();
		?>
		<div class="contact-info-widget">
			<ul>
				<?php if ( ! empty( $data['address'] ) ) : ?>
					<li>
                        <i class="icon-tag-1"></i>
						<p><?php echo esc_html( $data['address'] ); ?></p>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $data['mail'] ) ) : ?>
					<li>
                        <i class="icon-mi_email"></i>
						<p><a target="_blank" href="mailto:<?php echo esc_html( $data['mail'] ); ?>"><?php echo esc_html( $data['mail'] ); ?></a></p>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $data['phone'] ) ) : ?>
					<li>
                        <i class="icon-phone-call"></i>
						<p><a target="_blank" href="tel:<?php echo esc_attr( $data['phone'] ); ?>"><?php echo esc_html( $data['phone'] ); ?></a></p>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $data['website'] ) ) : ?>
					<li>
                        <i class="icon-location-two"></i>
						<p><a target="_blank" href="<?php echo esc_url( $data['website'] ); ?>"><?php echo esc_html( $data['website'] ); ?></a></p>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $data['shortcode'] || $data['shortcode_title'] ) ) : ?>
                    <li class="newsletter-form-1">
			            <?php if ( ! empty( $data['shortcode_title'] ) ) : ?>
                        <h4><?php echo esc_html( $data['shortcode_title'] ); ?></h4>
				        <?php endif; if ( ! empty( $data['shortcode'] ) ) : ?>
                        <div class="shortcode-wrap">
                            <?php echo do_shortcode($data['shortcode']) ?>
                        </div>
					    <?php endif; ?>
                    </li>
				<?php endif; ?>
			</ul>
		</div>
		<?php
		return ob_get_clean();
	}
}


function clplace_flaticon_icons(){
	return [
		" icon-right-open",
		" icon-left-open-big",
		" icon-right-open-big",
		" icon-author",
		" icon-twiter",
		" icon-location-1",
		" icon-heart-1",
		" icon-arrow-right-1",
		" icon-reply",
		" icon-star",
		" icon-eye-light",
		" icon-tag-2",
		" icon-tag",
		" icon-attention",
		" icon-location",
		" icon-plus",
		" icon-ok",
		" icon-calander",
		" icon-down-open",
		" icon-ok-1",
		" icon-arrow-3",
		" icon-massage",
		" icon-facebook",
		" icon-search-1",
		" icon-linkdin",
		" icon-insta",
		" icon-right-arow",
		" icon-location-2",
		" icon-heart-3",
		" icon-arrow-2",
		" icon-cancel",
		" icon-star-4",
		" icon-location-3",
		" icon-heart-empty",
		" icon-talk-bubbles-line",
		" icon-massage-1",
		" icon-heart-2",
		" icon-center-arow",
		" icon-printer",
		" icon-go-to-top",
		" icon-info-outline",
		" icon-star-2",
		" icon-minus",
		" icon-phone-call",
		" icon-heart-empty-1",
		" icon-go-right",
		" icon-data-analysis",
		" icon-location-4",
		" icon-massage-3",
		" icon-star-1",
		" icon-play-btn",
		" icon-phon-call-2",
		" icon-eye",
		" icon-gps",
		" icon-satting",
		" icon-search",
		" icon-buliding",
		" icon-cap",
		" icon-location-5",
		" icon-buliding-2",
		" icon-routing",
		" icon-courthouse",
		" icon-railway-station",
		" icon-airport",
		" icon-play",
		" icon-check",
		" icon-quotation",
		" icon-cloock",
		" icon-check-1",
		" icon-close-1",
		" icon-quotion-2",
		" icon-web",
		" icon-arrow-bottom",
		" icon-flug",
		" icon-plus-squared",
		" icon-plus-2",
		" icon-angle-up",
		" icon-angle-down",
	];
}


//post category list
function rt_category_list() {
	$categories = get_categories( [ 'hide_empty' => false ] );
	$lists      = [];
	foreach ( $categories as $category ) {
		$lists[ $category->cat_ID ] = $category->name;
	}

	return $lists;
}


// post tags lists
function rt_tag_list() {
	$tags     = get_tags( [ 'hide_empty' => false ] );
	$tag_list = [];
	foreach ( $tags as $tag ) {
		$tag_list[ $tag->slug ] = $tag->name;
	}

	return $tag_list;
}

//Get all thumbnail size
function rt_get_all_image_sizes() {
	global $_wp_additional_image_sizes;
	$image_sizes = [ '0' => __( 'Default Image Size', 'clplace-core' ) ];
	foreach ( $_wp_additional_image_sizes as $index => $item ) {
		$image_sizes[ $index ] = ucwords( $index . ' - ' . $item['width'] . 'x' . $item['height'] );
	}
	$image_sizes['full'] = __( "Full Size", 'clplace-core' );

	return $image_sizes;
}