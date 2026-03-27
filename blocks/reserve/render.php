<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A = is_array( $attributes ?? null ) ? $attributes : [];

$sectionTitle = $A['sectionTitle'] ?? '';
$roomTitle    = $A['roomTitle'] ?? '';
$roomDesc     = $A['roomDesc'] ?? '';
$mainImage    = $A['mainImage'] ?? '';
$priceAmount  = $A['priceAmount'] ?? '450';
$priceUnit    = $A['priceUnit'] ?? '/ NIGHT';
$badgeText    = $A['badgeText'] ?? 'CURATED COMFORT';

// Resolve image path
if ( ! empty( $mainImage ) && strpos( $mainImage, '/assets' ) === 0 ) {
    $mainImage = get_stylesheet_directory_uri() . $mainImage;
}

$amenities = $A['amenities'] ?? [];
// Resolve amenity icons
foreach ( $amenities as &$am ) {
    if ( ! empty( $am['icon'] ) && strpos( $am['icon'], '/assets' ) === 0 ) {
        $am['icon'] = get_stylesheet_directory_uri() . $am['icon'];
    }
}
unset($am);

$reserveBtnText = $A['reserveBtnText'] ?? 'RESERVE NOW';
$reserveBtnLink = $A['reserveBtnLink'] ?? '#';
$detailsBtnText = $A['detailsBtnText'] ?? 'EXPLORE DETAILS';
$detailsBtnLink = $A['detailsBtnLink'] ?? '#';
?>

<section class="section-global reserve-section">
    <div class="container-global">
        <!-- Top Badge & Section Title -->
        <div class="reserve-header" data-animate="fade-up">
            <?php if ( ! empty( $badgeText ) ) : ?>
                <span class="reserve-badge-top"><?php echo esc_html( $badgeText ); ?></span>
            <?php endif; ?>
            <?php if ( ! empty( $sectionTitle ) ) : ?>
                <h2 class="reserve-section-title"><?php echo esc_html( $sectionTitle ); ?></h2>
            <?php endif; ?>
        </div>

        <!-- Main Card Container -->
        <div class="reserve-card">
            <!-- Left Side: Information -->
            <div class="reserve-card__info" data-animate="fade-left">
                <h3 class="reserve-room-title"><?php echo esc_html( $roomTitle ); ?></h3>
                <p class="reserve-room-desc"><?php echo esc_html( $roomDesc ); ?></p>

                <!-- Amenities Grid -->
                <div class="reserve-amenities">
                    <?php foreach ( $amenities as $am ) : ?>
                        <div class="reserve-amenity-item">
                            <?php if ( ! empty( $am['icon'] ) ) : ?>
                                <img src="<?php echo esc_url( $am['icon'] ); ?>" alt="" class="reserve-amenity-icon">
                            <?php endif; ?>
                            <span class="reserve-amenity-text"><?php echo esc_html( $am['label'] ?? '' ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Action Buttons -->
                <div class="reserve-actions">
                    <a href="<?php echo esc_url( $reserveBtnLink ); ?>" class="btn-gold"><?php echo esc_html( $reserveBtnText ); ?></a>
                    <a href="<?php echo esc_url( $detailsBtnLink ); ?>" class="btn-outline"><?php echo esc_html( $detailsBtnText ); ?></a>
                </div>
            </div>

            <!-- Right Side: Image with CSS Badge -->
            <div class="reserve-card__media" data-animate="fade-right">
                <?php if ( ! empty( $mainImage ) ) : ?>
                    <img src="<?php echo esc_url( $mainImage ); ?>" alt="<?php echo esc_attr( $roomTitle ); ?>" class="reserve-main-img" loading="lazy">
                <?php endif; ?>
            </div>

            <!-- Scalloped Price Badge moved OUTSIDE media to prevent overflow clipping -->
            <div class="reserve-price-badge">
               <!-- Structural layers for the 8-lobe CSS shape -->
               <div class="reserve-price-badge-inner-bg"></div>
               
               <div class="reserve-price-badge__content">
                    <span class="reserve-price-starting">Starting at</span>
                    <span class="reserve-price-val">$<?php echo esc_html( $priceAmount ); ?></span>
                    <span class="reserve-price-unit"><?php echo esc_html( $priceUnit ); ?></span>
               </div>
            </div>

        </div>
    </div>
</section>
