<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A            = is_array( $attributes ?? null ) ? $attributes : [];
$isCarousel   = $A['isCarousel'] ?? true;
$sectionTitle = $A['sectionTitle'] ?? '';
$items        = $A['items'] ?? [];

// Resolve relative image paths and handle groups
foreach ( $items as &$item ) {
    if ( ! empty( $item['img'] ) && strpos( $item['img'], '/assets' ) === 0 ) {
        $item['img'] = get_stylesheet_directory_uri() . $item['img'];
    }
}
unset($item);

// If carousel mode is on, we group them into sets of 3 manually or by the track
$wrapper_class = $isCarousel ? 'cards-carousel-wrapper is-carousel' : 'cards-carousel-wrapper is-static';
?>

<section class="section-global cards-section">
    <div class="container-global">
        <?php if ( ! empty( $sectionTitle ) ) : ?>
            <h2 class="cards-section__main-title section-title-center" data-animate="fade-up"><?php echo esc_html( $sectionTitle ); ?></h2>
        <?php endif; ?>

        <div class="<?php echo esc_attr( $wrapper_class ); ?>" id="cards-carousel-root">
            <div class="cards-track" id="cards-track" data-animate-stagger>
                <?php foreach ( $items as $item ) : ?>
                    <div class="card-item">
                        <div class="card-item__media">
                            <div class="card-item__img-wrapper">
                                <?php if ( ! empty( $item['img'] ) ) : ?>
                                    <img src="<?php echo esc_url( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="card-item__img" loading="lazy">
                                <?php else : ?>
                                    <div class="card-item__img-placeholder"></div>
                                <?php endif; ?>
                            </div>
                            
                            <a href="<?php echo esc_url( $item['link'] ?? '#' ); ?>" class="card-item__float-btn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 19V5M5 12l7-7 7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="card-item__content">
                            <h3 class="card-item__title"><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
                            <p class="card-item__desc"><?php echo esc_html( $item['desc'] ?? '' ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ( $isCarousel ) : ?>
                <button class="carousel-nav prev" id="carousel-prev" aria-label="Previous Slide">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button class="carousel-nav next" id="carousel-next" aria-label="Next Slide">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            <?php endif; ?>

            <!-- Dots are rendered regardless of desktop static mode for mobile carousel support -->
            <div class="carousel-dots" id="carousel-dots" data-is-carousel="<?php echo $isCarousel ? 'true' : 'false'; ?>">
                <?php foreach ( $items as $i => $item ) : ?>
                    <button class="dot <?php echo $i===0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
