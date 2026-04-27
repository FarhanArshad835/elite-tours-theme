<?php
/**
 * Template Name: About Us
 *
 * Rebuilt 2026-04-27 around the brand DNA brief from the client:
 *   - Hero & headline lean into "Ireland, through Ray." as the central angle.
 *   - Replaced the old Core Values list with The DNA of Elite Tours (five
 *     pillars from the brief: Hosted / Insider / Emotion-led / Ray-is-the-product
 *     / Controlled Luxury).
 *   - Added a Signature Moments section — six moment categories with
 *     specific named locations, the marketing-gold from the brief.
 *   - Differentiator table tightened with the "done properly" anti-tourism
 *     positioning.
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';
$founder_img = $base . 'founder-ray-mulally.jpg';

// CMS-driven editorial content (admin: Page Content)
$strings = get_option( 'et_page_strings', [] );
if ( ! is_array( $strings ) ) $strings = [];
?>

<!-- Hero (CMS-driven via et_page_heroes['about-us']) -->
<?php etm_render_page_hero( 'about-us', [
    'title'          => 'Ireland, through Ray.',
    'subtitle'       => 'Elite Tours is not a tour company. It is a privately hosted experience of Ireland — built on more than fifty years of relationships across the country, and led personally by Ray himself.',
    'image_filename' => 'kylemore-abbey.jpg',
], $base ); ?>

<!-- Origin Story / The Anti-Tourism Angle -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-two-col">
            <div class="et-reveal">
                <div class="et-section__header">
                    <h2 class="et-section__title">Most people visit Ireland.<br>Very few experience it properly.</h2>
                </div>
                <div class="et-content">
                    <?php
                    // Origin story — paragraphs split by blank line. Convert *…* to <em> for the closing line.
                    $origin = trim( (string) ( $strings['about_origin_story'] ?? '' ) );
                    if ( $origin === '' ) {
                        $origin = "For many visitors, a trip to Ireland is one of the most meaningful journeys of their lives — a connection to ancestry, a long-held dream, a trip planned for years. Yet so often, the experience falls short. Rushed itineraries. Group buses. The Guinness Storehouse. Volume over meaning.\n\nElite Tours was built to be the alternative. Founded by Raphael Mulally — Ray — on decades of experience and a deep pride in the country, every journey is shaped by a single belief: clients deserve more than a tour. They deserve to feel completely looked after, understood, and genuinely connected to Ireland itself.\n\nWe are not a big operation. We don't want to be. We are a small, carefully run company that delivers an exceptional level of personal service, because that is the only way we know how to work — and the only way Ireland is properly understood.\n\n*The Ireland most people never see. Done properly.*";
                    }
                    $paragraphs = preg_split( '/\n\s*\n/', $origin );
                    foreach ( $paragraphs as $p ) {
                        $p = trim( $p );
                        if ( $p === '' ) continue;
                        // Split on *…* tokens, escape every piece, wrap captured em pieces.
                        $parts = preg_split( '/\*([^*]+)\*/', $p, -1, PREG_SPLIT_DELIM_CAPTURE );
                        $out = '';
                        foreach ( $parts as $i => $part ) {
                            $out .= ( $i % 2 === 0 )
                                ? esc_html( $part )
                                : '<em>' . esc_html( $part ) . '</em>';
                        }
                        echo '<p>' . $out . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="et-reveal">
                <img src="<?php echo esc_url( $base . 'castle-hillside.jpg' ); ?>" alt="Ireland landscape" style="width:100%;height:480px;object-fit:cover;border-radius:6px;">
            </div>
        </div>
    </div>
</section>

<!-- Founder Feature — Ray IS the Product (CMS-driven via et_page_strings.about_founder_*) -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-founder-feature et-reveal">
            <img src="<?php echo esc_url( $founder_img ); ?>" alt="Raphael Mulally, Founder" class="et-founder-feature__img">
            <div>
                <div class="et-section__header">
                    <h2 class="et-section__title"><?php echo esc_html( $strings['about_founder_title'] ?? 'Raphael Mulally' ); ?></h2>
                    <p class="et-section__subtitle"><?php echo esc_html( $strings['about_founder_subtitle'] ?? 'Founder, host & the Irish connection' ); ?></p>
                </div>
                <div class="et-content">
                    <?php etm_render_paragraphs( $strings['about_founder_body'] ?? "The product is not the route, the hotels, or the itinerary. It is Ray's perspective, his relationships, his storytelling, and his instinct — built across more than fifty years on these roads.\n\nRay knows everyone. Shop owners, local guides, the publican who'll open for a private after-hours visit, the cousin still on the family land. He is — to use his own word — a chameleon: equally at home pouring whiskey in a Donegal bar and seating clients at a long Dublin lunch. Clients are not processed; they are personally hosted, from the first conversation to the last goodbye.\n\nEvery Bespoke is designed by Ray himself. He still drives. He still tells the stories. He still sings, when the moment calls for it. **No Ray, no Elite Tours.** That has been the deal from the beginning, and it is what makes this company impossible to copy." ); ?>
                </div>
                <?php $founder_quote = $strings['about_founder_quote'] ?? "I've spent decades helping people experience Ireland in a truly personal way. The most memorable moments are usually the ones you never see coming."; ?>
                <?php $founder_attr = $strings['about_founder_quote_attribution'] ?? 'Raphael Mulally · Founder, Elite Tours Ireland'; ?>
                <?php if ( $founder_quote ) : ?>
                <div class="et-founder-feature__quote">
                    "<?php echo esc_html( $founder_quote ); ?>"
                    <?php if ( $founder_attr ) : ?>
                    <br><small style="color:var(--et-grey);font-style:normal;"><?php echo esc_html( $founder_attr ); ?></small>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- The DNA of Elite Tours — five pillars from the brief -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <p class="et-section__eyebrow">The DNA</p>
            <h2 class="et-section__title">What separates Elite Tours from every other "Ireland tour".</h2>
        </div>
        <div class="et-values-grid">
            <?php
            $dna = get_option( 'et_about_dna', [] );
            if ( ! is_array( $dna ) ) $dna = [];
            foreach ( $dna as $v ) : ?>
            <div class="et-value et-reveal">
                <div class="et-value__title"><?php echo wp_kses( $v['title'] ?? '', [ 'em' => [], 'strong' => [] ] ); ?></div>
                <div class="et-value__desc"><?php echo esc_html( $v['desc'] ?? '' ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Signature Moments — the marketing gold -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <p class="et-section__eyebrow">Signature Moments</p>
            <h2 class="et-section__title">The moments most people miss.</h2>
            <p class="et-section__subtitle">Some moments will never appear on an itinerary. They are not listed, not planned in advance, and not shared publicly — these are the ones we live for.</p>
        </div>
        <div class="et-values-grid">
            <?php
            $moments = get_option( 'et_about_signature_moments', [] );
            if ( ! is_array( $moments ) ) $moments = [];
            foreach ( $moments as $m ) : ?>
            <div class="et-value et-reveal">
                <div class="et-value__title"><?php echo esc_html( $m['title'] ?? '' ); ?></div>
                <div class="et-value__desc"><?php echo wp_kses( $m['desc'] ?? '', [ 'em' => [], 'strong' => [] ] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Differentiator Table — the "instead of this / we offer this" punch -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">What makes us different.</h2>
            <p class="et-section__subtitle">Most people do Ireland wrong. We take you the right way.</p>
        </div>
        <div class="et-reveal" style="max-width:760px;margin:0 auto;">
            <?php
            $compare_rows = get_option( 'et_about_compare', [] );
            if ( ! is_array( $compare_rows ) ) $compare_rows = [];
            ?>
            <table class="et-compare">
                <thead><tr><th>Instead of this</th><th>We offer this</th></tr></thead>
                <tbody>
                    <?php foreach ( $compare_rows as $row ) : ?>
                    <tr><td><?php echo esc_html( $row['left'] ?? '' ); ?></td><td><?php echo esc_html( $row['right'] ?? '' ); ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Affiliations -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Trusted &amp; accredited.</h2>
            <p class="et-section__subtitle">Decades of partnerships with the bodies that vouch for Irish hospitality.</p>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;gap:40px;flex-wrap:wrap;opacity:0.7;" class="et-reveal">
            <img src="<?php echo esc_url( $base . 'trust/tripadvisor.svg' ); ?>" alt="TripAdvisor" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/failte-ireland.png' ); ?>" alt="Failte Ireland" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/asta.png' ); ?>" alt="ASTA" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/iagto.jpg' ); ?>" alt="IAGTO" style="height:28px;width:auto;background:#fff;padding:3px 6px;border-radius:4px;">
        </div>
    </div>
</section>

<!-- Bottom CTA (CMS-driven via et_page_ctas['about-us']) -->
<?php etm_render_page_cta( 'about-us', [
    'title'    => 'Every journey begins with a conversation.',
    'subtitle' => "Tell us a name, a region, a curiosity, a feeling — we'll write back within a working day.",
    'cta_text' => 'Begin Your First Conversation',
    'cta_url'  => '/contact/',
] ); ?>

<?php get_footer(); ?>
