<?php

/**
 * Enqueue Google Fonts: Playfair Display & Lato
 */
function aura_solis_enqueue_google_fonts() {
    $google_fonts_url = 'https://fonts.googleapis.com/css2?' . http_build_query([
        'family' => 'Playfair+Display:wght@400;700|Lato:wght@400;700',
        'display' => 'swap',
    ]);

    wp_enqueue_style(
        'aura-solis-google-fonts',
        $google_fonts_url,
        [],
        null
    );
}
add_action('wp_enqueue_scripts', 'aura_solis_enqueue_google_fonts');

/**
 * Enqueue Child Theme Styles
 */
function aura_solis_enqueue_child_styles() {
    $parent_style = 'twentytwentyfive-style'; // parent handle
    $theme_dir    = get_stylesheet_directory();
    $theme_uri    = get_stylesheet_directory_uri();
    
    // Child style.css versioning
    $style_path = $theme_dir . '/style.css';
    $ver = file_exists( $style_path ) ? filemtime( $style_path ) : '1.0.0';

    wp_enqueue_style( 
        'child-aura-solis-style', 
        $theme_uri . '/style.css', 
        [ $parent_style ], 
        $ver
    );

    // Enqueue standalone Header CSS component
    $header_style_path = $theme_dir . '/assets/css/header.css';
    $header_ver = file_exists( $header_style_path ) ? filemtime( $header_style_path ) : '1.0.0';
    wp_enqueue_style(
        'aura-solis-header-style',
        $theme_uri . '/assets/css/header.css',
        [],
        $header_ver
    );

    // Enqueue standalone Footer CSS component
    $footer_style_path = $theme_dir . '/assets/css/footer.css';
    $footer_ver = file_exists( $footer_style_path ) ? filemtime( $footer_style_path ) : '1.0.0';
    wp_enqueue_style(
        'aura-solis-footer-style',
        $theme_uri . '/assets/css/footer.css',
        [],
        $footer_ver
    );
}
add_action( 'wp_enqueue_scripts', 'aura_solis_enqueue_child_styles' );

/**
 * Preconnect to Google Fonts for faster loading
 */
function aura_solis_preconnect_google_fonts( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = [
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        ];
        $urls[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'aura_solis_preconnect_google_fonts', 10, 2 );

/**
 * Enqueue Google Fonts in the Block Editor as well
 */
function aura_solis_enqueue_editor_fonts() {
    $google_fonts_url = 'https://fonts.googleapis.com/css2?' . http_build_query([
        'family' => 'Playfair+Display:wght@400;700|Lato:wght@400;700',
        'display' => 'swap',
    ]);

    wp_enqueue_style(
        'aura-solis-google-fonts-editor',
        $google_fonts_url,
        [],
        null
    );
}
add_action( 'enqueue_block_editor_assets', 'aura_solis_enqueue_editor_fonts' );

/**
 * Register custom Gutenberg blocks dynamically from the /blocks/ directory
 */
add_action( 'init', function () {
    $base     = get_stylesheet_directory() . '/blocks';
    $registry = WP_Block_Type_Registry::get_instance();

    // Loop through every block folder that has a block.json
    foreach ( glob( $base . '/*/block.json' ) as $json ) {
        $data = json_decode( file_get_contents( $json ), true );
        if ( ! is_array( $data ) || empty( $data['name'] ) ) {
            continue;
        }

        $name = $data['name'];

        // Skip invalid names with no namespace to avoid WordPress notices
        if ( strpos( $name, '/' ) === false ) {
            continue;
        }

        if ( ! $registry->is_registered( $name ) ) {
            register_block_type( dirname( $json ) );
        }
    }
} );
