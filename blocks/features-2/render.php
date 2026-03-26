<?php
/**
 * Render logic for child/features-2 block
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A = is_array( $attributes ?? null ) ? $attributes : [];

// Helper function to resolve dynamic image paths internally
if ( ! function_exists( 'child_features_2_image_path' ) ) {
    function child_features_2_image_path( $url ) {
        if ( empty( $url ) ) {
            return '';
        }
        if ( strpos( $url, '/assets' ) === 0 ) {
            return get_stylesheet_directory_uri() . $url;
        }
        return $url;
    }
}

$mainTitle = $A['mainTitle'] ?? 'Luxury in Every Breath';

$f1_t = $A['feature1_title'] ?? 'Infinite Privacy';
$f1_d = $A['feature1_desc'] ?? 'With 50 acres of untouched shoreline at your doorstep, your personal space is measured in horizons, not square footage.';
$f1_i = $A['feature1_icon'] ?? '/assets/images/features-2/mountain.webp';

$f2_t = $A['feature2_title'] ?? 'Bespoke Artistry';
$f2_d = $A['feature2_desc'] ?? 'From forest-to-table dining to meditative shoreline rituals, we craft moments that resonate long after the sun sets behind the peaks.';
$f2_i = $A['feature2_icon'] ?? '/assets/images/features-2/star.webp';

$f3_t = $A['feature3_title'] ?? 'Guaranteed Serenity';
$f3_d = $A['feature3_desc'] ?? 'Eliminate the noise of third-party bookings. Direct guests enjoy our most flexible cancellation policies and a dedicated concierge from moment one.';
$f3_i = $A['feature3_icon'] ?? '/assets/images/features-2/shield.webp';
?>

<section class="features-2-block section-global bg-cream">
    <div class="container-global">
        <div class="features-2-grid">
            
            <!-- Left Side Title Column -->
            <div class="f2-left">
                <h2 class="wp-block-heading heading-serif"><?php echo esc_html( $mainTitle ); ?></h2>
            </div>
            
            <!-- Right Side Features Display matrix -->
            <div class="f2-right">
                
                <!-- Top Row (Contains icons side-by-side with text) -->
                <div class="f2-row f2-row--top">
                    <!-- Feature 1 -->
                    <div class="f2-item">
                        <div class="f2-item-header">
                            <img src="<?php echo esc_url( child_features_2_image_path( $f1_i ) ); ?>" alt="Feature Icon" class="f2-icon">
                            <h3 class="wp-block-heading heading-serif f2-item-title"><?php echo esc_html( $f1_t ); ?></h3>
                        </div>
                        <p class="wp-block-paragraph f2-item-desc"><?php echo esc_html( $f1_d ); ?></p>
                    </div>

                    <!-- Visual Separator between top columns -->
                    <div class="f2-divider f2-divider--vertical"></div>

                    <!-- Feature 2 -->
                    <div class="f2-item">
                        <div class="f2-item-header">
                            <img src="<?php echo esc_url( child_features_2_image_path( $f2_i ) ); ?>" alt="Feature Icon" class="f2-icon">
                            <h3 class="wp-block-heading heading-serif f2-item-title"><?php echo esc_html( $f2_t ); ?></h3>
                        </div>
                        <p class="wp-block-paragraph f2-item-desc"><?php echo esc_html( $f2_d ); ?></p>
                    </div>
                </div>

                <!-- Visual Separator cutting across the bottom -->
                <div class="f2-divider f2-divider--horizontal"></div>

                <!-- Bottom Row (Centered shield logic) -->
                <div class="f2-row f2-row--bottom">
                    <div class="f2-item f2-item--centered">
                        <div class="f2-item-header f2-item-header--centered">
                            <img src="<?php echo esc_url( child_features_2_image_path( $f3_i ) ); ?>" alt="Feature Icon" class="f2-icon">
                            <h3 class="wp-block-heading heading-serif f2-item-title"><?php echo esc_html( $f3_t ); ?></h3>
                        </div>
                        <p class="wp-block-paragraph f2-item-desc"><?php echo esc_html( $f3_d ); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
