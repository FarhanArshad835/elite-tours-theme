<?php
/**
 * Template Name: Experiences
 *
 * Page structure:
 *   1. Hero — CMS-driven via et_page_heroes['experiences']
 *   2. Regions of Ireland — 11 region tiles from et_regions (admin: Regions)
 *   3. Bottom CTA — CMS-driven via et_page_ctas['experiences']
 *
 * The previous "Browse Everything" mixed grid (tour products + golf + hotels)
 * was removed — those are already on their own dedicated pages
 * (/bespoke-tours/, /golf-tours/, /accommodation/), and showing them here
 * mixed with placeholder fallback images was visually noisy.
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';

$regions = get_option( 'et_regions', [] );
?>

<!-- Hero (CMS-driven via et_page_heroes['experiences']) -->
<?php etm_render_page_hero( 'experiences', [
    'title'          => 'Ireland in Eleven Regions.<br>One Carefully Designed Journey.',
    'subtitle'       => "From Dublin's foundations to the Causeway Coast, each region of Ireland brings its own character — its own people, landscapes, and stories. Below is the country we travel.",
    'image_filename' => 'irish-pub.jpg',
], $base ); ?>

<?php if ( ! empty( $regions ) && is_array( $regions ) ) : ?>
<!-- Regions of Ireland (admin: Elite Tours → Regions) -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <p class="et-section__eyebrow">Regions of Ireland</p>
            <h2 class="et-section__title">The country, in eleven movements.</h2>
            <p class="et-section__subtitle">Each Bespoke Journey is built from a careful selection of these. Some travellers spend a full week in one region; others move through five or six. We help you choose.</p>
        </div>
        <div class="et-tile-grid">
            <?php foreach ( $regions as $region ) :
                $r_img_id  = absint( $region['image_id'] ?? 0 );
                $r_img_url = $r_img_id
                    ? wp_get_attachment_image_url( $r_img_id, 'large' )
                    : ( ! empty( $region['image_filename'] ) ? $base . $region['image_filename'] : $base . 'kylemore-abbey.jpg' );
                $r_url = ! empty( $region['tour_link_url'] ) ? home_url( $region['tour_link_url'] ) : home_url( '/contact/' );
                $highlights = is_array( $region['highlights'] ?? null ) ? array_filter( $region['highlights'] ) : [];
            ?>
            <a href="<?php echo esc_url( $r_url ); ?>" class="et-tile et-reveal" data-type="region" id="region-<?php echo esc_attr( $region['slug'] ?? '' ); ?>">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $r_img_url ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $region['eyebrow'] ?? '' ); ?></span>
                    <h3 class="et-tile__title"><?php echo esc_html( $region['title'] ?? '' ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $region['blurb'] ?? '' ); ?></p>
                    <?php if ( ! empty( $highlights ) ) : ?>
                    <ul style="list-style:none;padding:0;margin:14px 0 12px 0;font-size:13px;line-height:1.5;color:rgba(255,255,255,0.85);">
                        <?php foreach ( array_slice( $highlights, 0, 3 ) as $h ) : ?>
                        <li style="position:relative;padding-left:14px;margin-bottom:4px;">
                            <span style="position:absolute;left:0;top:0;color:rgba(255,255,255,0.5);">·</span>
                            <?php echo esc_html( $h ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <span class="et-tile__cta"><?php echo esc_html( $region['tour_link_text'] ?? 'Explore' ); ?> &rsaquo;</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Bottom CTA (CMS-driven via et_page_ctas['experiences']) -->
<?php etm_render_page_cta( 'experiences', [
    'title'    => "Don't See What You're Looking For?",
    'subtitle' => "We design experiences from scratch. Tell us what interests you and we'll build something entirely around it.",
    'cta_text' => 'Speak to Us',
    'cta_url'  => '/contact/',
] ); ?>

<?php get_footer(); ?>
