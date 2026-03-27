<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A           = is_array( $attributes ?? null ) ? $attributes : [];
$title       = $A['title'] ?? '';
$desc        = $A['desc'] ?? '';
$items       = $A['items'] ?? [];
$mapUrl      = $A['mapUrl'] ?? '';
$watermark   = $A['watermarkImg'] ?? '';

// Asset path resolver wrapper
if ( ! function_exists( 'child_info_asset_url' ) ) {
    function child_info_asset_url( $url ) {
        if ( ! empty( $url ) && strpos( $url, '/assets' ) === 0 ) {
            return get_stylesheet_directory_uri() . $url;
        }
        return $url;
    }
}
?>

<section class="section-global section-py information-block bg-cream">
    <!-- Huge Background Watermark Graphic -->
    <?php if ( ! empty( $watermark ) ) : ?>
        <img src="<?php echo esc_url( child_info_asset_url( $watermark ) ); ?>" 
             class="information-watermark" alt="Decorative Watermark" aria-hidden="true" loading="lazy">
    <?php endif; ?>

    <div class="container-global">
        <!-- Centered Header Stack -->
        <header class="information-header section-title-center" data-animate="fade-up">
            <?php if ( ! empty( $title ) ) : ?>
                <h2 class="information-title heading-serif"><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
            
            <?php if ( ! empty( $desc ) ) : ?>
                <p class="information-desc"><?php echo esc_html( $desc ); ?></p>
            <?php endif; ?>
        </header>

        <!-- 3-Card Grid Row -->
        <div class="information-grid" data-animate-stagger>
            <?php foreach ( $items as $index => $item ) : ?>
                <div class="information-card card-variant-<?php echo esc_attr( $index + 1 ); ?>">
                    <div class="information-card__inner">
                        <div class="information-card__icon">
                            <img src="<?php echo esc_url( child_info_asset_url( $item['icon'] ?? '' ) ); ?>" 
                                 alt="<?php echo esc_attr( $item['title'] ?? 'Contact' ); ?>" loading="lazy">
                        </div>
                        <div class="information-card__content">
                            <h3 class="information-card__title"><?php echo esc_html( $item['title'] ) ; ?></h3>
                            <p class="information-card__desc"><?php echo esc_html( $item['desc'] ); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Large Master Map Wrapper -->
        <?php if ( ! empty( $mapUrl ) ) : ?>
            <div class="information-map-wrapper" data-animate="zoom-in" data-animate-delay="200">
                <iframe src="<?php echo esc_url( $mapUrl ); ?>" 
                        loading="lazy" 
                        allowfullscreen 
                        referrerpolicy="no-referrer-when-downgrade" 
                        class="information-map-iframe"></iframe>
            </div>
        <?php endif; ?>
    </div>
</section>
