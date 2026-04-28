<?php
/**
 * Template Name: Bespoke Tours
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';

$et_strings = get_option( 'et_page_strings', [] );
if ( ! is_array( $et_strings ) ) $et_strings = [];
?>

<!-- Hero (CMS-driven via et_page_heroes['bespoke-tours']) -->
<?php etm_render_page_hero( 'bespoke-tours', [
    'title'          => 'Your Ireland.<br>Built Around You.',
    'subtitle'       => 'No fixed routes. No templates. Every journey designed from scratch, for you.',
    'cta_text'       => 'Begin Your First Conversation',
    'cta_url'        => '/contact/',
    'image_filename' => 'winding-road.jpg',
], $base ); ?>

<!-- Philosophy (CMS-driven via et_page_strings.bespoke_philosophy_*) -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-two-col">
            <div class="et-reveal">
                <div class="et-section__header">
                    <h2 class="et-section__title"><?php echo esc_html( $et_strings['bespoke_philosophy_title'] ?? 'This Is Not a Tour Package' ); ?></h2>
                </div>
                <div class="et-content">
                    <?php etm_render_paragraphs( $et_strings['bespoke_philosophy_body'] ?? "Most companies offer you a list of itineraries and ask you to choose. We don't.\n\nEvery Elite Tours journey begins with a conversation about who you are, what brought you to Ireland, and what you want to feel when you leave. Then we build it entirely around you.\n\nNo two tours are the same. That is not a marketing line. It is simply how we work.\n\nFrom ancestry searches in County Mayo to whiskey tastings on the Dingle Peninsula, every experience is chosen, sequenced, and delivered for the specific people taking it." ); ?>
                </div>
            </div>
            <div class="et-reveal">
                <img src="<?php echo esc_url( $base . 'castle-hillside.jpg' ); ?>" alt="Ireland countryside" style="width:100%;height:480px;object-fit:cover;border-radius:6px;">
            </div>
        </div>
    </div>
</section>

<!-- Two Ways to Travel — Signature + Essence (the two Bespoke duration variants
     from the client PDFs). Each card links to its full detail page. -->
<?php
$bespoke_variants = function_exists( 'et_get_bespoke_variants' ) ? et_get_bespoke_variants() : [];
if ( count( $bespoke_variants ) >= 1 ) :
?>
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <p class="et-section__eyebrow">Two ways to travel</p>
            <h2 class="et-section__title">Choose your length.</h2>
            <p class="et-section__subtitle">Same level of care, same private hosting, same end-to-end design — across either eleven to fifteen days, or six to ten. We help you pick the shape that fits the time you have.</p>
        </div>
        <div class="et-tile-grid">
            <?php foreach ( $bespoke_variants as $v ) :
                $img_id  = absint( $v['image_id'] ?? 0 );
                $img_url = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'large' )
                    : ( $base . 'winding-road.jpg' );
                $title_clean = preg_replace( '/\.$/u', '', $v['title'] ?? '' ); // drop trailing period for card display
            ?>
            <a href="<?php echo esc_url( $v['url'] ); ?>" class="et-tile et-tile--lg et-reveal" style="height:480px;">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $img_url ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( 'bespoke-variant-' . sanitize_title( $v['slug'] ?? 'variant' ), $title_clean, $v['desc'] ?? '', $img_url, $v['url'], 'Bespoke' ); ?>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $v['label'] ?? '' ); ?></span>
                    <h3 class="et-tile__title" style="font-size:32px;line-height:1.15;"><?php echo esc_html( $title_clean ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $v['desc'] ?? '' ); ?></p>
                    <span class="et-tile__cta">Read the journey &rsaquo;</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Journey Types Grid -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Where Would You Like to Begin?</h2>
        </div>
        <div class="et-tile-grid">
            <?php
            $tiles = get_option( 'et_bespoke_journey_types', [] );
            if ( ! is_array( $tiles ) ) $tiles = [];
            $tile_fallback_imgs = [
                $base . 'kylemore-abbey.jpg', $base . 'irish-pub.jpg', $base . 'winding-road.jpg',
                $base . 'gothic-castle.jpg', $base . 'castle-hillside.jpg', $base . 'golf-coastal.jpg',
            ];
            foreach ( $tiles as $i => $t ) :
                $img_id  = absint( $t['image_id'] ?? 0 );
                $img_url = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'large' )
                    : $tile_fallback_imgs[ $i % count( $tile_fallback_imgs ) ];
                $href = ! empty( $t['url'] ) ? esc_url( $t['url'] ) : esc_url( home_url( '/contact/' ) );
            ?>
            <a href="<?php echo esc_url( $href ); ?>" class="et-tile et-reveal">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $img_url ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( 'bespoke-' . sanitize_title( $t['title'] ?? 'tile' ), $t['title'] ?? '', $t['desc'] ?? '', $img_url, $href, 'Bespoke' ); ?>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $t['label'] ?? '' ); ?></span>
                    <h3 class="et-tile__title"><?php echo esc_html( $t['title'] ?? '' ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $t['desc'] ?? '' ); ?></p>
                    <span class="et-tile__cta">Learn More &rsaquo;</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Duration Breakdown -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">How Long Would You Like?</h2>
        </div>
        <?php
        $durations = get_option( 'et_bespoke_durations', [] );
        if ( ! is_array( $durations ) ) $durations = [];
        $dur_count = max( 1, count( $durations ) );
        ?>
        <div class="et-info-grid" style="grid-template-columns: repeat(<?php echo (int) min( 4, $dur_count ); ?>,1fr);">
            <?php foreach ( $durations as $d ) : ?>
            <div class="et-info-card et-reveal">
                <div class="et-info-card__num"><?php echo esc_html( $d['num'] ?? '' ); ?></div>
                <div class="et-info-card__title"><?php echo esc_html( $d['title'] ?? '' ); ?></div>
                <div class="et-info-card__desc"><?php echo esc_html( $d['desc'] ?? '' ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- What's Included -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">What Every Journey Includes</h2>
        </div>
        <div class="et-info-grid">
            <?php
            $included = get_option( 'et_bespoke_includes', [] );
            if ( ! is_array( $included ) ) $included = [];
            foreach ( $included as $inc ) : ?>
            <div class="et-info-card et-reveal">
                <div class="et-info-card__num"><?php echo esc_html( $inc['num'] ?? '' ); ?></div>
                <div class="et-info-card__title"><?php echo esc_html( $inc['title'] ?? '' ); ?></div>
                <div class="et-info-card__desc"><?php echo esc_html( $inc['desc'] ?? '' ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Bottom CTA (CMS-driven via et_page_ctas['bespoke-tours']) -->
<?php etm_render_page_cta( 'bespoke-tours', [
    'title'    => 'Ready to Begin?',
    'subtitle' => "Tell us who you are and what you're looking for. We'll come back to you personally, usually within 24 hours, with the start of your journey.",
    'cta_text' => 'Begin Your First Conversation',
    'cta_url'  => '/contact/',
] ); ?>

<?php get_footer(); ?>
