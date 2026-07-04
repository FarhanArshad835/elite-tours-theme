<?php
defined( 'ABSPATH' ) || exit;

$label         = et_option( 'hero_label',        'ELITE TOURS IRELAND · SINCE 1973' );
$headline      = et_option_raw( 'hero_headline',  'Ireland,<br>Experienced Properly.' );
$subheading    = et_option( 'hero_subheading',    'Bespoke private journeys, tailored to you, delivered with genuine Irish care.' );
$cta_primary   = et_option( 'hero_cta_primary',   'Plan Your Journey' );
$cta_secondary = et_option( 'hero_cta_secondary', 'Explore Our Tours' );
$video_url     = et_option( 'hero_video_url',     '' );
$image_id      = et_option( 'hero_image_id',      '' );
$image_url     = $image_id
    ? wp_get_attachment_image_url( (int) $image_id, 'full' )
    : get_template_directory_uri() . '/assets/images/hero-default.jpg';
// Proof badge + trust bar are rendered via reusable template parts below.
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
                 alt="Ireland - Elite Tours" loading="eager" fetchpriority="high">
        <?php else : ?>
            <div class="et-hero__placeholder"></div>
        <?php endif; ?>

        <!-- Gradient overlay -->
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

                <?php // TripAdvisor proof badge, above CTAs for conversion lift ?>
                <div class="et-hero__proof-slot">
                    <?php get_template_part( 'template-parts/proof-badge', null, [ 'context' => 'dark' ] ); ?>
                </div>

                <!-- CTAs -->
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
    <div class="et-hero__trust">
        <?php get_template_part( 'template-parts/trust-bar', null, [ 'context' => 'dark' ] ); ?>
    </div>

</section>
