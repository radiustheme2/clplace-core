<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RT\Clplace\Helpers\Fns;

$post_count = get_query_var( 'post_count' );
$first_post = $post_count == 1 ? 'first-one' : 'normal-post';

if ( ! empty( $meta_style ) ) {
	$_meta_style = $meta_style;
} else {
	if ( ! is_single() ) {
		$_meta_style = clplace_option( 'rt_blog_meta_style' );
	} else {
		$_meta_style = clplace_option( 'rt_single_meta_style' );
	}
}

$post_classes = Fns::class_list( [ $_meta_style, $first_post ] );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <div class="article-inner-wrapper">
		<?php clplace_post_thumbnail('thumbnail'); ?>
        <div class="entry-wrapper">
            <header class="entry-header">
				<?php
				if ( ! empty( $meta_list ) ) {
					echo wp_kses_post( clplace_post_meta( [
						'with_list'     => true,
						'with_icon'     => true,
						'include'       => $meta_list,
					] ) );
				}
				the_title( sprintf( '<h4 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' );
				?>
            </header>

			<?php
			    if( $content ):
				echo "<div class='entry-content'>";
				echo wp_kses_post( wp_trim_words( get_the_excerpt(), 15 ) );
				echo "</div>";
                endif;
			?>
        </div>
    </div>
</article>