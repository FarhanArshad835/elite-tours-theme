<?php
/**
 * Homepage section — Bespoke Journeys (the 2 client-defined Bespoke product
 * variants from the PDFs: Signature 11–15 days, Essence 6–10 days).
 *
 * Per the ET Website Brief 2026 — Section 7 "Journey Types / Breakdown" —
 * the homepage should surface the duration-based Bespoke choices as a
 * primary navigation step into the funnel. Cards are derived from the
 * Experience CPT (Sample Itineraries) via et_get_bespoke_variants() so
 * editing a CPT post updates the homepage card automatically.
 */
defined( 'ABSPATH' ) || exit;

$base     = get_template_directory_uri() . '/assets/images/';
$variants = function_exists( 'et_get_bespoke_variants' ) ? et_get_bespoke_variants() : [];
if ( empty( $variants ) ) return;

$heading  = et_hp( 'bespoke_journeys_heading',  'Two Ways to Travel.' );
$subhead  = et_hp( 'bespoke_journeys_subhead',  'Same level of care, same private hosting, same end-to-end design — across either eleven to fifteen days, or six to ten. Choose your length and we build the rest around you.' );
$eyebrow  = et_hp( 'bespoke_journeys_eyebrow',  'Bespoke Journeys' );
?>

<section class="et-section et-section--white" id="et-bespoke-journeys">
    <div class="et-container">

        <div class="et-section__header et-section__header--center et-reveal">
            <?php if ( $eyebrow ) : ?>
            <p class="et-section__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
            <?php endif; ?>
            <h2 class="et-section__title"><?php echo wp_kses( $heading, [ 'br' => [], 'em' => [] ] ); ?></h2>
            <?php if ( $subhead ) : ?>
            <p class="et-section__subtitle"><?php echo esc_html( $subhead ); ?></p>
            <?php endif; ?>
        </div>

        <div class="et-tile-grid">
            <?php foreach ( $variants as $v ) :
                $img_id      = absint( $v['image_id'] ?? 0 );
                $img_url     = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'large' )
                    : ( $base . 'winding-road.jpg' );
                $title_clean = preg_replace( '/\.$/u', '', $v['title'] ?? '' );
            ?>
            <a href="<?php echo esc_url( $v['url'] ); ?>" class="et-tile et-tile--lg et-reveal" style="height:480px;">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $img_url ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( 'bespoke-variant-home-' . sanitize_title( $v['slug'] ?? 'variant' ), $title_clean, $v['desc'] ?? '', $img_url, $v['url'], 'Bespoke' ); ?>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $v['label'] ?? '' ); ?></span>
                    <h3 class="et-tile__title" style="font-size:32px;line-height:1.15;"><?php echo esc_html( $title_clean ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $v['desc'] ?? '' ); ?></p>
                    <span class="et-tile__cta">Read the journey &rsaquo;</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div style="text-align:center;margin-top:32px;">
            <a href="<?php echo esc_url( home_url( '/bespoke-tours/' ) ); ?>" class="et-link-arrow">
                Explore Bespoke Tours
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
</section>
