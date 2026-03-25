<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A               = is_array( $attributes ?? null ) ? $attributes : [];
$backgroundColor = $A['backgroundColor'] ?? '#FBFAF3';

// Array for simple looping
$items = [
    [
        'icon'  => $A['feature1_icon']  ?? '',
        'title' => $A['feature1_title'] ?? '',
        'desc'  => $A['feature1_desc']  ?? '',
    ],
    [
        'icon'  => $A['feature2_icon']  ?? '',
        'title' => $A['feature2_title'] ?? '',
        'desc'  => $A['feature2_desc']  ?? '',
    ],
    [
        'icon'  => $A['feature3_icon']  ?? '',
        'title' => $A['feature3_title'] ?? '',
        'desc'  => $A['feature3_desc']  ?? '',
    ],
];

// Ensure absolute URLs for assets
foreach ( $items as &$item ) {
    if ( ! empty( $item['icon'] ) && strpos( $item['icon'], '/assets' ) === 0 ) {
        $item['icon'] = get_stylesheet_directory_uri() . $item['icon'];
    }
}
unset($item);
?>

<section class="section-global features-block" style="background-color: <?php echo esc_attr( $backgroundColor ); ?>;">
    <div class="container-global">
        <div class="features-grid">
            <?php foreach ( $items as $index => $item ) : ?>
                <div class="feature-item">
                    <div class="feature-item__inner">
                        <div class="feature-item__header">
                            <div class="feature-item__icon-wrapper">
                                <?php if ( ! empty( $item['icon'] ) ) : ?>
                                    <img src="<?php echo esc_url( $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="feature-item__icon">
                                <?php endif; ?>
                            </div>
                            <h3 class="feature-item__title"><?php echo esc_html( $item['title'] ); ?></h3>
                        </div>
                        <p class="feature-item__desc"><?php echo esc_html( $item['desc'] ); ?></p>
                    </div>
                </div>
                
                <?php if ( $index < 2 ) : ?>
                    <div class="features-v-divider"></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <div class="features-h-divider"></div>
    </div>
</section>
