<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$A = is_array( $attributes ?? null ) ? $attributes : [];

$formTitle       = $A['formTitle'] ?? '';
$formDesc        = $A['formDesc'] ?? '';
$newsletterTitle = $A['newsletterTitle'] ?? '';
$newsletterDesc  = $A['newsletterDesc'] ?? '';
$newsletterBg    = $A['newsletterBg'] ?? '';

// Automatically point generic path to the Theme's Asset Directory
if ( ! empty( $newsletterBg ) && strpos( $newsletterBg, '/assets' ) === 0 ) {
    $newsletterBg = get_stylesheet_directory_uri() . $newsletterBg;
}
?>

<section class="section-global section-py contact-section bg-cream">
    <div class="container-global">
        <div class="contact-split">
            
            <!-- Left: Inquiry Form -->
            <div class="contact-inquiry" data-animate="fade-left">
                <?php if ( ! empty( $formTitle ) ) : ?>
                    <h2 class="contact-title"><?php echo esc_html( $formTitle ); ?></h2>
                <?php endif; ?>
                
                <?php if ( ! empty( $formDesc ) ) : ?>
                    <p class="contact-desc"><?php echo esc_html( $formDesc ); ?></p>
                <?php endif; ?>

                <form class="aura-form" action="#" method="POST" onsubmit="event.preventDefault();">
                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="Your first name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Your last name" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email" placeholder="Your email address" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Your message</label>
                        <textarea id="message" name="message" rows="4" placeholder="How can we help curate your experience?" required></textarea>
                    </div>

                    <button type="submit" class="btn-gold form-submit-btn">SUBMIT</button>
                </form>
            </div>

            <!-- Right: Newsletter Box -->
            <div class="contact-newsletter" data-animate="fade-right" style="background-image: url('<?php echo esc_url( $newsletterBg ); ?>');">
                <div class="newsletter-overlay"></div>
                <div class="newsletter-content">
                    <?php if ( ! empty( $newsletterTitle ) ) : ?>
                        <h2 class="newsletter-title"><?php echo esc_html( $newsletterTitle ); ?></h2>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $newsletterDesc ) ) : ?>
                        <p class="newsletter-desc"><?php echo esc_html( $newsletterDesc ); ?></p>
                    <?php endif; ?>

                    <form class="newsletter-form" action="#" method="POST" onsubmit="event.preventDefault();">
                        <div class="form-group">
                            <input type="email" name="newsletter_email" placeholder="TYPE YOUR EMAIL HERE..." aria-label="Newsletter Email" required>
                        </div>
                        <button type="submit" class="btn-gold newsletter-submit-btn">SUBSCRIBE</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
