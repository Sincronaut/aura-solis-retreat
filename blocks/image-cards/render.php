<?php
/**
 * Render logic for child/image-cards block
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A      = is_array( $attributes ?? null ) ? $attributes : [];
$images = $A['images'] ?? [];

if ( ! function_exists( 'child_img_cards_url' ) ) {
    function child_img_cards_url( $url ) {
        if ( empty( $url ) ) {
            return '';
        }
        if ( strpos( $url, '/assets' ) === 0 ) {
            return get_stylesheet_directory_uri() . $url;
        }
        return $url;
    }
}
?>

<section class="image-cards-block section-global section-py-lg bg-cream">
    <div class="image-cards-container container-global">
        <!-- Scroll-wrapper strictly protects padding dropshadow logic from breaking edge bounds -->
        <div class="image-cards-wrapper">
            <?php foreach ( $images as $img ) : ?>
                <div class="image-card">
                    <img src="<?php echo esc_url( child_img_cards_url( $img['url'] ?? '' ) ); ?>" 
                         alt="<?php echo esc_attr( $img['alt'] ?? 'Gallery Image' ); ?>" 
                         class="image-card__img">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
