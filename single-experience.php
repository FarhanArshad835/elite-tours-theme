<?php
/**
 * Single Experience — V2 Funnel Page
 * Editorial layout modeled on adamsandbutler.com, adapted to Elite Tours.
 *
 * Sections (top → bottom):
 *   1. Hero          — full-bleed cinematic, breadcrumb + meta + asymmetric grid
 *   2. Highlights    — Roman numeral 2x2 grid
 *   3. Story         — image stack + narrative + person cards
 *   4. Pillars       — three threads (3-card grid)
 *   5. Process       — method card on dark evergreen
 *   6. CTA           — founder portrait + contact form + quote card
 *   7. Similar       — 3-card cross-sell
 *
 * Each section is a partial under template-parts/experience/. All data flows
 * through $funnel (returned by etm_get_experience_funnel) so partials are
 * pure presentation.
 */
defined( 'ABSPATH' ) || exit;

get_header();

if ( ! have_posts() ) {
    echo '<p style="padding:120px 24px;text-align:center;">Experience not found.</p>';
    get_footer();
    return;
}
the_post();

$post_id = get_the_ID();
$funnel  = function_exists( 'etm_get_experience_funnel' ) ? etm_get_experience_funnel( $post_id ) : [];
?>

<article class="et-exp">
    <?php
    $sections = [ 'hero', 'highlights', 'story', 'pillars', 'process', 'cta', 'similar' ];
    foreach ( $sections as $section ) {
        get_template_part( 'template-parts/experience/' . $section, null, [
            'funnel'  => $funnel,
            'post_id' => $post_id,
        ] );
    }
    ?>
</article>

<?php get_footer();
