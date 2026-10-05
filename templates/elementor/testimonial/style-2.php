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
?>

<div class="testimonial-box testimonial-style-2">
    <div class="user-image">
	    <?php
            if ( $image['id'] ) {
                echo "<div class='author-img'>";
                echo wp_get_attachment_image( $image['id'], 'full' );
                echo "</div>";
            }
	    ?>
    </div>
    <div class="testimonial-content-wrapper">
        <div class="quote-icon">
            <?php
            if (!empty( $icon['value'] )) {
                Icons_Manager::render_icon( $icon,[ 'aria-hidden' => 'true' ] );
            } else {
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.5652 11.395C14.1527 17.44 8.924 24.475 7.87775 32.5037C6.249 45 17.424 51.1162 23.0865 45.6212C28.749 40.125 25.3552 33.15 21.2552 31.2425C17.1552 29.3362 14.6477 30 15.0852 27.4512C15.5227 24.9037 21.3552 17.8387 26.4802 14.5487C26.6619 14.3943 26.7777 14.1764 26.8042 13.9395C26.8307 13.7025 26.7658 13.4644 26.6227 13.2737L25.3552 11.625C24.8052 10.91 24.2777 10.9375 23.5652 11.3937V11.395ZM48.3477 11.395C38.9352 17.44 33.7052 24.4762 32.6602 32.5037C31.0315 45 42.2065 51.1162 47.869 45.6212C53.5315 40.125 50.1377 33.15 46.0365 31.2425C41.9365 29.3362 39.429 30 39.8665 27.4512C40.304 24.9037 46.1377 17.8387 51.2627 14.5487C51.4441 14.3941 51.5598 14.1761 51.586 13.9392C51.6123 13.7023 51.5472 13.4643 51.404 13.2737L50.1365 11.625C49.5865 10.91 49.059 10.9375 48.3477 11.3937V11.395Z" fill="#FF1D58"></path>
                </svg>
            <?php } ?>
        </div>
        <?php if ($title) { ?>
            <h3 class="title"><?php echo esc_html( $title ); ?></h3>
        <?php } if ( $rating ) : ?>
            <ul class="rating ul-ol">
                <?php for ( $i=0; $i <=4 ; $i++ ) {
                    if ( $i < $rating ) {
                        $full = 'active';
                    } else {
                        $full = 'deactive';
                    }
                    echo '<li class="has-rating"><i class="fa-solid fa-star ' . esc_attr( $full ) . '"></i></li>';
                } ?>
            </ul>
        <?php endif; ?>

        <?php if ($content) { ?>
            <p class="testimonial-content">
                <?php echo esc_html( $content ); ?>
            </p>
        <?php } ?>
        <div class="testimonial-user-info">
            <div class="content-info">
                <h3 class="author-name"><?php echo esc_html( $name ); ?></h3>
                <?php if ( $designation ): ?>
                    <span class="author-designation"><?php echo esc_html( $designation ); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

