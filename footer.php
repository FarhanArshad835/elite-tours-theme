<?php
$phone       = et_site( 'phone_us', '+1 888 000 0000' );
$phone_clean = preg_replace( '/[^+0-9]/', '', $phone );
$email       = et_site( 'contact_email', 'info@elitetoursireland.com' );
$ig_url      = et_site( 'social_instagram', '' );
$fb_url      = et_site( 'social_facebook',  '' );
$ta_url      = et_site( 'social_tripadvisor', '' );
$base        = get_template_directory_uri();
?>

<footer class="et-footer" id="et-footer">

    <!-- ── Main footer grid ─────────────────────────────────── -->
    <div class="et-footer__main">
        <div class="et-container">
            <div class="et-footer__grid">

                <!-- Col 1: Brand -->
                <div class="et-footer__col et-footer__col--brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="et-footer__logo-link" aria-label="Elite Tours Ireland">
                        <?php
                        $logo_id  = et_site( 'logo_id' );
                        $logo_url = $logo_id ? wp_get_attachment_image_url( (int) $logo_id, 'full' ) : '';
                        if ( $logo_url ) :
                        ?>
                            <img src="<?php echo esc_url( $logo_url ); ?>" alt="Elite Tours Ireland" class="et-footer__logo" width="120" height="52">
                        <?php else : ?>
                            <span class="et-footer__logo-text">
                                <span>SINCE 1973</span>
                                <strong>ET</strong>
                                <span>ELITE TOURS IRELAND</span>
                            </span>
                        <?php endif; ?>
                    </a>
                    <p class="et-footer__tagline">Ireland, experienced properly.</p>
                    <div class="et-footer__social">
                        <?php if ( $ig_url ) : ?>
                        <a href="<?php echo esc_url( $ig_url ); ?>" class="et-footer__social-link" aria-label="Instagram" rel="noopener noreferrer" target="_blank">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ( $fb_url ) : ?>
                        <a href="<?php echo esc_url( $fb_url ); ?>" class="et-footer__social-link" aria-label="Facebook" rel="noopener noreferrer" target="_blank">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ( $ta_url ) : ?>
                        <a href="<?php echo esc_url( $ta_url ); ?>" class="et-footer__social-link" aria-label="TripAdvisor" rel="noopener noreferrer" target="_blank">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="6" cy="12" r="4"/><circle cx="18" cy="12" r="4"/><path d="M2 7c0 0 4-4 10-4s10 4 10 4"/></svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Col 2: Navigate -->
                <div class="et-footer__col">
                    <h4 class="et-footer__col-title">Navigate</h4>
                    <ul class="et-footer__links">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/bespoke-tours/' ) ); ?>">Bespoke Tours</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/golf-tours/' ) ); ?>">Golf Tours</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/experiences/' ) ); ?>">Experiences</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/accommodation/' ) ); ?>">Accommodation</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">About Us</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
                    </ul>
                </div>

                <!-- Col 3: Experiences -->
                <div class="et-footer__col">
                    <h4 class="et-footer__col-title">Experiences</h4>
                    <ul class="et-footer__links">
                        <li><a href="<?php echo esc_url( home_url( '/bespoke-tours/' ) ); ?>">Ancestry &amp; Roots</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/experiences/' ) ); ?>">Whiskey &amp; Culture</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/golf-tours/' ) ); ?>">Golf Tours</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/experiences/' ) ); ?>">Heritage &amp; History</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/bespoke-tours/' ) ); ?>">Scenic Ireland</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/bespoke-tours/' ) ); ?>">Family Journeys</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact -->
                <div class="et-footer__col">
                    <h4 class="et-footer__col-title">Get in Touch</h4>
                    <ul class="et-footer__contact">
                        <li>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .91h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                            <a href="tel:<?php echo esc_attr( $phone_clean ); ?>"><?php echo esc_html( $phone ); ?></a>
                        </li>
                        <li>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                        </li>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--primary et-footer__cta">
                        Plan Your Journey
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- ── Trust bar ─────────────────────────────────────────── -->
    <div class="et-footer__trust">
        <div class="et-container">
            <div class="et-footer__trust-bar">
                <img src="<?php echo esc_url( $base . '/assets/images/trust/failte-ireland.png' ); ?>"
                     alt="Fáilte Ireland" loading="lazy" class="et-footer__trust-logo">
                <img src="<?php echo esc_url( $base . '/assets/images/trust/asta.png' ); ?>"
                     alt="ASTA" loading="lazy" class="et-footer__trust-logo">
                <img src="<?php echo esc_url( $base . '/assets/images/trust/iagto.jpg' ); ?>"
                     alt="IAGTO" loading="lazy" class="et-footer__trust-logo et-footer__trust-logo--colour">
                <div class="et-footer__trust-ta">
                    <svg viewBox="0 0 120 22" fill="none" xmlns="http://www.w3.org/2000/svg" height="20" aria-label="TripAdvisor">
                        <circle cx="7" cy="11" r="6" fill="#34E0A1"/><circle cx="7" cy="11" r="2.5" fill="white"/>
                        <circle cx="113" cy="11" r="6" fill="#34E0A1"/><circle cx="113" cy="11" r="2.5" fill="white"/>
                        <text x="18" y="15.5" font-size="10" font-family="Arial,sans-serif" font-weight="600" fill="white">TripAdvisor</text>
                    </svg>
                    <span class="et-footer__trust-stars">★★★★★</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Legal bar ─────────────────────────────────────────── -->
    <div class="et-footer__legal">
        <div class="et-container">
            <p class="et-footer__legal-text">
                &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Elite Tours Ireland. All rights reserved.
            </p>
            <ul class="et-footer__legal-links">
                <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a></li>
                <li><a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>">Terms &amp; Conditions</a></li>
            </ul>
        </div>
    </div>

</footer>

<!-- ── Mobile sticky CTA ───────────────────────────────────── -->
<div class="et-sticky-cta" id="et-sticky-cta" aria-hidden="true">
    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-sticky-cta__btn">
        Plan Your Journey
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
