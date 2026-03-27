<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A = is_array( $attributes ?? null ) ? $attributes : [];

$mainImage    = $A['mainImage'] ?? '';
$badge        = $A['badge'] ?? '';
$title        = $A['title'] ?? '';
$desc         = $A['desc'] ?? '';
$contactItems = $A['contactItems'] ?? [];
$btnText      = $A['btnText'] ?? '';
$btnLink      = $A['btnLink'] ?? '#';

$imagePosition = $A['imagePosition'] ?? 'left'; // 'left' or 'right'
$imageFit      = $A['imageFit'] ?? 'cover'; // 'cover' or 'contain'

// Dynamically resolve image path relative to the active theme/environment
if ( ! empty( $mainImage ) && strpos( $mainImage, '/assets' ) === 0 ) {
    $mainImage = get_stylesheet_directory_uri() . $mainImage;
}

// Dynamically loop and resolve icon arrays
foreach ( $contactItems as &$ci ) {
    if ( ! empty( $ci['icon'] ) && strpos( $ci['icon'], '/assets' ) === 0 ) {
        $ci['icon'] = get_stylesheet_directory_uri() . $ci['icon'];
    }
}
unset( $ci );

// CSS architecture for flipping layout
$layout_class = 'image-text-layout';
if ( $imagePosition === 'right' ) {
    $layout_class .= ' image-text-layout--flip';
}
?>

<section class="section-global image-text-section bg-cream">
    <div class="container-global">
        <div class="<?php echo esc_attr( $layout_class ); ?>">
            
            <!-- Left (or Right reversed): Hero Imagery -->
            <div class="image-text__media" data-animate="fade-left">
                <?php if ( ! empty( $mainImage ) ) : ?>
                    <img src="<?php echo esc_url( $mainImage ); ?>" 
                         alt="<?php echo esc_attr( $title ); ?>" 
                         class="image-text__img <?php echo $imageFit === 'contain' ? 'image-text__img--contain' : ''; ?>" 
                         loading="lazy">
                <?php endif; ?>
            </div>

            <!-- Right (or Left reversed): Semantic Content Column -->
            <div class="image-text__content" data-animate="fade-right">
                <?php if ( ! empty( $badge ) ) : ?>
                    <span class="image-text__badge"><?php echo esc_html( $badge ); ?></span>
                <?php endif; ?>

                <?php if ( ! empty( $title ) ) : ?>
                    <h2 class="image-text__title heading-serif"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>

                <?php if ( ! empty( $desc ) ) : ?>
                    <div class="image-text__desc">
                        <?php echo wp_kses_post( $desc ); ?>
                    </div>
                <?php endif; ?>

                <!-- Dynamic Contact Sub-grid -->
                <?php if ( ! empty( $contactItems ) ) : ?>
                    <div class="image-text__contact-list">
                        <?php foreach ( $contactItems as $ci ) : ?>
                            <div class="image-text__contact-item">
                                <?php if ( ! empty( $ci['icon'] ) ) : ?>
                                    <img src="<?php echo esc_url( $ci['icon'] ); ?>" alt="" class="image-text__contact-icon">
                                <?php endif; ?>
                                
                                <span class="image-text__contact-value">
                                    <?php echo esc_html( $ci['value'] ?? '' ); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Global Action Button -->
                <?php if ( ! empty( $btnText ) ) : ?>
                    <div class="image-text__action">
                        <a href="<?php echo esc_url( $btnLink ); ?>" class="btn-gold"><?php echo esc_html( $btnText ); ?></a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
