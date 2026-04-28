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

$regions          = get_option( 'et_regions', [] );
$key_experiences  = get_option( 'et_key_experiences', [] );
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

<?php if ( ! empty( $key_experiences ) && is_array( $key_experiences ) ) : ?>
<!-- Featured Experiences — the 22 client-named "key experiences to build into the
     website" from Full list of experiences.txt. Renders as a small-card grid
     beneath the regions. Each card: image + name + region tag + short blurb.
     Edit via Elite Tours → Key Experiences. -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <p class="et-section__eyebrow">Featured experiences</p>
            <h2 class="et-section__title">The named moments.</h2>
            <p class="et-section__subtitle">Specific stops and signature moments inside those eleven regions — the ones we tell people about by name. None are a fixed inclusion; each is offered if it fits the journey we are designing for you.</p>
        </div>
        <div class="et-key-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:18px;">
            <?php foreach ( $key_experiences as $ke ) :
                $ke_img_id  = absint( $ke['image_id'] ?? 0 );
                $ke_img_url = $ke_img_id
                    ? wp_get_attachment_image_url( $ke_img_id, 'medium_large' )
                    : ( ! empty( $ke['image_filename'] ) ? $base . $ke['image_filename'] : $base . 'kylemore-abbey.jpg' );
                $ke_url = ! empty( $ke['url'] ) ? ( strpos( $ke['url'], 'http' ) === 0 ? $ke['url'] : home_url( $ke['url'] ) ) : '';
                $card_tag = $ke_url ? 'a' : 'div';
            ?>
            <<?php echo $card_tag; ?>
                <?php if ( $ke_url ) : ?>href="<?php echo esc_url( $ke_url ); ?>"<?php endif; ?>
                class="et-key-card et-reveal"
                style="display:block;position:relative;overflow:hidden;border-radius:6px;text-decoration:none;color:#fff;background:#1a4f31;aspect-ratio:4/5;">
                <div class="et-key-card__img" style="position:absolute;inset:0;background-image:url('<?php echo esc_url( $ke_img_url ); ?>');background-size:cover;background-position:center;transition:transform 0.4s ease;"></div>
                <div class="et-key-card__overlay" style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.78) 0%,rgba(0,0,0,0.32) 50%,rgba(0,0,0,0.05) 100%);"></div>
                <div class="et-key-card__content" style="position:absolute;inset:auto 0 0 0;padding:18px 20px;">
                    <span style="display:inline-block;font-size:11px;letter-spacing:1.4px;text-transform:uppercase;color:#cdb989;font-family:var(--et-font-body);margin-bottom:6px;"><?php echo esc_html( $ke['region'] ?? '' ); ?></span>
                    <h3 style="font-family:var(--et-font-heading);font-size:20px;line-height:1.2;font-weight:400;margin:0 0 6px 0;color:#fff;"><?php echo esc_html( $ke['name'] ?? '' ); ?></h3>
                    <?php if ( ! empty( $ke['desc'] ) ) : ?>
                    <p style="font-size:13px;line-height:1.5;color:rgba(255,255,255,0.85);margin:0;font-family:var(--et-font-body);"><?php echo esc_html( $ke['desc'] ); ?></p>
                    <?php endif; ?>
                </div>
            </<?php echo $card_tag; ?>>
            <?php endforeach; ?>
        </div>
        <style>.et-key-card:hover .et-key-card__img { transform: scale(1.04); }</style>
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
