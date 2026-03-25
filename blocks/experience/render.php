<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A = is_array( $attributes ?? null ) ? $attributes : [];

$badge = $A['badge'] ?? 'REFINED LIVING';
$title = $A['title'] ?? 'Elevated Guest Experiences';
$items = $A['items'] ?? [];

// Resolve paths for icons dynamically so they work in all environments without breaking
foreach ( $items as &$item ) {
    if ( ! empty( $item['icon'] ) && strpos( $item['icon'], '/assets' ) === 0 ) {
        $item['icon'] = get_stylesheet_directory_uri() . $item['icon'];
    }
}
unset( $item );
?>

<section class="section-global experience-section">
    <div class="container-global">
        
        <!-- Header Stack: Badge & Title -->
        <div class="experience-header">
            <?php if ( ! empty( $badge ) ) : ?>
                <span class="experience-badge"><?php echo esc_html( $badge ); ?></span>
            <?php endif; ?>
            
            <?php if ( ! empty( $title ) ) : ?>
                <h2 class="experience-title heading-serif"><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
        </div>

        <!-- Dynamic Loop over Features Array -->
        <?php if ( ! empty( $items ) ) : ?>
            <div class="experience-grid">
                <?php foreach ( $items as $item ) : ?>
                    <div class="experience-item">
                        <!-- Feature Icon Base -->
                        <?php if ( ! empty( $item['icon'] ) ) : ?>
                            <div class="experience-item__icon-wrap">
                                <img src="<?php echo esc_url( $item['icon'] ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $item['title'] ?? 'Feature Icon' ) ); ?>" class="experience-item__icon" loading="lazy">
                            </div>
                        <?php endif; ?>
                        
                        <!-- Feature Text Hierarchy -->
                        <div class="experience-item__content">
                            <?php if ( ! empty( $item['title'] ) ) : ?>
                                <h3 class="experience-item__title"><?php echo esc_html( $item['title'] ); ?></h3>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $item['desc'] ) ) : ?>
                                <p class="experience-item__desc"><?php echo esc_html( $item['desc'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
