<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A           = is_array( $attributes ?? null ) ? $attributes : [];
$title       = $A['title'] ?? '';
$description = $A['description'] ?? '';
$buttonText  = $A['buttonText'] ?? '';
$buttonLink  = $A['buttonLink'] ?? '#';
$imageUrl    = $A['imageUrl'] ?? '';
$is_inner    = $A['isInner'] ?? false;

// Allowed HTML for the title so 'em', 'i', or 'span' tags survive.
$allowed_html = array(
    'em'     => array('class' => true),
    'i'      => array('class' => true),
    'span'   => array('class' => true),
    'br'     => array(),
    'strong' => array(),
    'b'      => array(),
);

// CSS Background variable map
$bg_style = '';
if ( ! empty( $imageUrl ) ) {
    // If the image URL is a relative path starting with /assets, point it to the child theme folder
    if ( strpos( $imageUrl, '/assets' ) === 0 ) {
        $imageUrl = get_stylesheet_directory_uri() . $imageUrl;
    }
    $bg_style = 'background-image: url(' . esc_url( $imageUrl ) . ');';
} else {
    // Generic fallback color if the user hasn't added the URL in attributes yet
    $bg_style = 'background-color: #1a1a1a;'; 
}

$section_classes = 'banner-block';
if ( $is_inner ) {
    $section_classes .= ' banner-block--inner';
}
?>

<section class="<?php echo esc_attr( $section_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="banner-block__overlay"></div>

    <div class="banner-block__content">
        <?php if ( ! empty( $title ) ) : ?>
            <h1 class="wp-block-heading has-h-1-font-size banner-block__title">
                <?php echo wp_kses( $title, $allowed_html ); ?>
            </h1>
        <?php endif; ?>
        
        <?php if ( ! empty( $description ) ) : ?>
            <p class="banner-block__description">
                <?php echo wp_kses_post( $description ); ?>
            </p>
        <?php endif; ?>

        <?php if ( ! empty( $buttonText ) ) : ?>
            <a href="<?php echo esc_url( $buttonLink ); ?>" class="btn-gold">
                <?php echo esc_html( $buttonText ); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
