<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A = is_array( $attributes ?? null ) ? $attributes : [];

// Automatically point all generic paths to the Theme's Asset Directory
$img_keys = [ 'img1', 'img2', 'watermarkImg', 'feature1_icon', 'feature2_icon', 'feature3_icon' ];
foreach ( $img_keys as $key ) {
    if ( ! empty( $A[ $key ] ) && strpos( $A[ $key ], '/assets' ) === 0 ) {
        $A[ $key ] = get_stylesheet_directory_uri() . $A[ $key ];
    }
}
?>

<section class="section-global ethos-section">
    <!-- Huge Background Watermark Graphic -->
    <?php if ( ! empty( $A['watermarkImg'] ) ) : ?>
        <img src="<?php echo esc_url( $A['watermarkImg'] ); ?>" class="ethos-watermark" alt="Watermark Graphic" aria-hidden="true" loading="lazy">
    <?php endif; ?>

    <div class="container-global">
        <!-- 2-Column Split: Image Stagger and Text Box -->
        <div class="ethos-split">
            
            <!-- Left Grid: Dual Staggered Images -->
            <div class="ethos-media">
                <div class="ethos-media__col left-img">
                   <?php if ( ! empty( $A['img1'] ) ) : ?>
                       <img src="<?php echo esc_url( $A['img1'] ); ?>" alt="Aura Solis Interior 1" loading="lazy">
                   <?php endif; ?>
                </div>
                <div class="ethos-media__col right-img">
                   <?php if ( ! empty( $A['img2'] ) ) : ?>
                       <img src="<?php echo esc_url( $A['img2'] ); ?>" alt="Aura Solis Interior 2" loading="lazy">
                   <?php endif; ?>
                </div>
            </div>

            <!-- Right Flex: Text Content -->
            <div class="ethos-content">
                <?php if ( ! empty( $A['badgeText'] ) ) : ?>
                    <span class="ethos-badge"><?php echo esc_html( $A['badgeText'] ); ?></span>
                <?php endif; ?>
                
                <?php if ( ! empty( $A['title'] ) ) : ?>
                    <h2 class="ethos-title heading-serif"><?php echo esc_html( $A['title'] ); ?></h2>
                <?php endif; ?>
                
                <?php if ( ! empty( $A['desc1'] ) ) : ?>
                    <p class="ethos-desc"><?php echo esc_html( $A['desc1'] ); ?></p>
                <?php endif; ?>

                <?php if ( ! empty( $A['desc2'] ) ) : ?>
                    <p class="ethos-desc"><?php echo esc_html( $A['desc2'] ); ?></p>
                <?php endif; ?>

                <?php if ( ! empty( $A['buttonText'] ) ) : ?>
                    <div class="ethos-btn-wrapper">
                        <a href="<?php echo esc_url( $A['buttonLink'] ?? '#' ); ?>" class="btn-gold"><?php echo esc_html( $A['buttonText'] ); ?></a>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Trust Features (Bottom 3 Columns) -->
        <div class="ethos-features">
            <?php for ( $i = 1; $i <= 3; $i++ ) : 
                $f_icon  = $A['feature'.$i.'_icon'] ?? '';
                $f_title = $A['feature'.$i.'_title'] ?? '';
                $f_desc  = $A['feature'.$i.'_desc'] ?? '';
                
                // Skip if this slot has no assigned content 
                if ( empty( $f_icon ) && empty( $f_title ) ) continue;
            ?>
                <div class="ethos-feature-item">
                    <?php if ( ! empty( $f_icon ) ) : ?>
                        <div class="ethos-feature-item__icon">
                            <img src="<?php echo esc_url( $f_icon ); ?>" alt="<?php echo esc_attr( $f_title ); ?>" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <div class="ethos-feature-item__text">
                        <h3 class="ethos-feature-title"><?php echo esc_html( $f_title ); ?></h3>
                        <p class="ethos-feature-desc"><?php echo esc_html( $f_desc ); ?></p>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

    </div>
</section>
