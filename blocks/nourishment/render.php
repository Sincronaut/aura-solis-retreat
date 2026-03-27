<?php
/**
 * Render logic for child/nourishment block
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A           = is_array( $attributes ?? null ) ? $attributes : [];
$title       = $A['title'] ?? '';
$description = $A['description'] ?? '';
$images      = $A['images'] ?? [];

if ( ! function_exists( 'child_nourish_img_url' ) ) {
    function child_nourish_img_url( $url ) {
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

<section class="nourishment-block section-global section-py bg-cream">
    <div class="container-global">
        <header class="nourishment-header section-title-center" data-animate="fade-up">
            <?php if ( ! empty( $title ) ) : ?>
                <h2 class="nourishment-title"><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
            
            <?php if ( ! empty( $description ) ) : ?>
                <p class="nourishment-desc"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </header>

        <div class="nourishment-grid" data-animate-stagger>
            <?php foreach ( $images as $img ) : ?>
                <div class="nourishment-item">
                    <img src="<?php echo esc_url( child_nourish_img_url( $img['url'] ?? '' ) ); ?>" 
                         alt="<?php echo esc_attr( $img['alt'] ?? 'Gourmet Image' ); ?>" 
                         class="nourishment-item__img">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
