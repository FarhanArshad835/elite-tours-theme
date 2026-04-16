<?php
defined( 'ABSPATH' ) || exit;

$label         = et_option( 'hero_label',        'ELITE TOURS IRELAND — SINCE 1973' );
$headline      = et_option_raw( 'hero_headline',  'Ireland,<br>Experienced Properly.' );
$subheading    = et_option( 'hero_subheading',    'Bespoke private journeys — tailored to you, delivered with genuine Irish care.' );
$cta_primary   = et_option( 'hero_cta_primary',   'Visit the Emerald Isle' );
$cta_secondary = et_option( 'hero_cta_secondary', 'Explore Our Tours' );
$video_url     = et_option( 'hero_video_url',     '' );
$image_id      = et_option( 'hero_image_id',      '' );
$image_url     = $image_id
    ? wp_get_attachment_image_url( (int) $image_id, 'full' )
    : get_template_directory_uri() . '/assets/images/hero-default.jpg';

// Trust bar — pull editable sub-labels and logo IDs from plugin settings
$trust_failte_sub  = et_option( 'trust_failte_sub',  'Approved Partner' );
$trust_failte_logo = et_option( 'trust_failte_logo_id', '' );
$trust_asta_sub    = et_option( 'trust_asta_sub',    'Member' );
$trust_asta_logo   = et_option( 'trust_asta_logo_id', '' );
$trust_iagto_sub   = et_option( 'trust_iagto_sub',   'Golf Tourism' );
$trust_iagto_logo  = et_option( 'trust_iagto_logo_id', '' );
$trust_since_label = et_option( 'trust_since_label', 'Since 1973' );
$trust_since_sub   = et_option( 'trust_since_sub',   '50+ years experience' );
$trust_ta_sub      = et_option( 'trust_ta_sub',       '5-Star Rated' );

// Resolve logo URLs (fall back to bundled assets)
$failte_url = $trust_failte_logo
    ? wp_get_attachment_image_url( (int) $trust_failte_logo, 'full' )
    : get_template_directory_uri() . '/assets/images/trust/failte-ireland.png';
$asta_url   = $trust_asta_logo
    ? wp_get_attachment_image_url( (int) $trust_asta_logo, 'full' )
    : get_template_directory_uri() . '/assets/images/trust/asta.png';
$iagto_url  = $trust_iagto_logo
    ? wp_get_attachment_image_url( (int) $trust_iagto_logo, 'full' )
    : get_template_directory_uri() . '/assets/images/trust/iagto.jpg';
?>

<section class="et-hero" id="et-hero">

    <!-- ── Background ───────────────────────────────────────── -->
    <div class="et-hero__bg">
        <?php if ( $video_url ) : ?>
            <video class="et-hero__video" autoplay muted loop playsinline preload="none"
                   <?php if ( $image_url ) : ?>poster="<?php echo esc_url( $image_url ); ?>"<?php endif; ?>>
                <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
            </video>
        <?php elseif ( $image_url ) : ?>
            <img class="et-hero__image" src="<?php echo esc_url( $image_url ); ?>"
                 alt="Ireland — Elite Tours" loading="eager" fetchpriority="high">
        <?php else : ?>
            <div class="et-hero__placeholder"></div>
        <?php endif; ?>

        <!-- Gradient overlay — darker at bottom like Adams & Butler -->
        <div class="et-hero__overlay"></div>
    </div>

    <!-- ── Main Content (bottom-left like Adams & Butler) ───── -->
    <div class="et-hero__content">
        <div class="et-container">

            <div class="et-hero__inner">

                <!-- Label -->
                <span class="et-hero__label"><?php echo esc_html( $label ); ?></span>

                <!-- Headline -->
                <h1 class="et-hero__headline">
                    <?php echo wp_kses( $headline, [ 'br' => [] ] ); ?>
                </h1>

                <!-- Subheading -->
                <p class="et-hero__subheading">
                    <?php echo esc_html( $subheading ); ?>
                </p>

                <!-- CTAs — pill style like Adams & Butler -->
                <div class="et-hero__ctas">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                       class="et-btn et-btn--pill et-btn--pill-light">
                        <?php echo esc_html( $cta_primary ); ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="#et-tours"
                       class="et-btn et-btn--pill et-btn--pill-outline">
                        <?php echo esc_html( $cta_secondary ); ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- ── Trust Bar (above fold, bottom of hero) ────────────── -->
    <!-- Reference: executivetoursireland.com footer badge row   -->
    <div class="et-hero__trust">
        <div class="et-container">
            <div class="et-trust-bar">

                <!-- TripAdvisor -->
                <div class="et-trust-bar__item">
                    <svg class="et-trust-bar__svg" viewBox="0 0 124 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="TripAdvisor">
                        <circle cx="8"  cy="12" r="7" fill="#34E0A1"/>
                        <circle cx="8"  cy="12" r="3" fill="white"/>
                        <circle cx="116" cy="12" r="7" fill="#34E0A1"/>
                        <circle cx="116" cy="12" r="3" fill="white"/>
                        <text x="20" y="17" font-size="11" font-family="Arial,sans-serif" font-weight="600" fill="white">TripAdvisor</text>
                    </svg>
                    <div class="et-trust-bar__stars" aria-label="5 stars">★★★★★</div>
                    <span class="et-trust-bar__sub"><?php echo esc_html( $trust_ta_sub ); ?></span>
                </div>

                <div class="et-trust-bar__divider"></div>

                <!-- Fáilte Ireland -->
                <div class="et-trust-bar__item">
                    <img src="<?php echo esc_url( $failte_url ); ?>"
                         alt="Fáilte Ireland"
                         class="et-trust-bar__logo"
                         loading="lazy">
                    <span class="et-trust-bar__sub"><?php echo esc_html( $trust_failte_sub ); ?></span>
                </div>

                <div class="et-trust-bar__divider"></div>

                <!-- ASTA -->
                <div class="et-trust-bar__item">
                    <img src="<?php echo esc_url( $asta_url ); ?>"
                         alt="ASTA"
                         class="et-trust-bar__logo"
                         loading="lazy">
                    <span class="et-trust-bar__sub"><?php echo esc_html( $trust_asta_sub ); ?></span>
                </div>

                <div class="et-trust-bar__divider"></div>

                <!-- IAGTO -->
                <div class="et-trust-bar__item">
                    <img src="<?php echo esc_url( $iagto_url ); ?>"
                         alt="IAGTO"
                         class="et-trust-bar__logo et-trust-bar__logo--iagto"
                         loading="lazy">
                    <span class="et-trust-bar__sub"><?php echo esc_html( $trust_iagto_sub ); ?></span>
                </div>

                <div class="et-trust-bar__divider"></div>

                <!-- Since -->
                <div class="et-trust-bar__item">
                    <span class="et-trust-bar__badge et-trust-bar__badge--gold"><?php echo esc_html( $trust_since_label ); ?></span>
                    <span class="et-trust-bar__sub"><?php echo esc_html( $trust_since_sub ); ?></span>
                </div>

            </div>
        </div>
    </div>

</section>
