<?php
/**
 * Template Name: Accommodation
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';
?>

<!-- Hero -->
<section class="et-page-hero">
    <div class="et-page-hero__bg" style="background-image:url('<?php echo esc_url( $base . 'gothic-castle.jpg' ); ?>')"></div>
    <div class="et-page-hero__overlay"></div>
    <div class="et-container">
        <div class="et-page-hero__content et-reveal">
            <h1 class="et-page-hero__title">Where You Rest Matters as Much as Where You Go</h1>
            <p class="et-page-hero__sub">Every property we recommend has been personally vetted by Ray. Handpicked for character, location, and the standard of welcome you deserve.</p>
        </div>
    </div>
</section>

<!-- Three Categories -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-tile-grid">
            <?php
            $categories = [
                [ 'label' => 'Castle & Estate Hotels', 'title' => 'Sleep Inside History', 'desc' => "Ireland's castle hotels offer a level of grandeur and warmth that is entirely unique to this country.", 'img' => $base . 'gothic-castle.jpg' ],
                [ 'label' => 'Boutique & Country House', 'title' => 'Intimacy Over Grandeur', 'desc' => 'Handpicked country houses where the welcome is as warm as the fire.', 'img' => $base . 'castle-hillside.jpg' ],
                [ 'label' => 'Luxury Coastal & Scenic', 'title' => 'Wake Up to the Atlantic', 'desc' => 'Properties that stay with you. Fall asleep to silence, wake up to the ocean.', 'img' => $base . 'winding-road.jpg' ],
            ];
            foreach ( $categories as $cat ) : ?>
            <div class="et-tile et-reveal" style="height:400px;">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $cat['img'] ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $cat['label'] ); ?></span>
                    <h3 class="et-tile__title"><?php echo esc_html( $cat['title'] ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $cat['desc'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Properties -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Properties We Work With</h2>
        </div>
        <div class="et-tile-grid">
            <?php
            $properties = [
                [ 'name' => 'Dromoland Castle',  'loc' => 'Co. Clare',    'desc' => 'A 16th-century castle set on 450 acres of parkland. One of Ireland\'s finest.' ],
                [ 'name' => 'Adare Manor',       'loc' => 'Co. Limerick', 'desc' => 'A neo-Gothic masterpiece. Home to world-class golf and unmatched luxury.' ],
                [ 'name' => 'Ashford Castle',    'loc' => 'Co. Mayo',     'desc' => 'An 800-year-old castle on the shores of Lough Corrib. Truly iconic.' ],
                [ 'name' => 'Castlemartyr Resort','loc' => 'Co. Cork',    'desc' => 'A restored 18th-century manor house in the heart of East Cork.' ],
            ];
            foreach ( $properties as $p ) : ?>
            <div class="et-tile et-reveal" style="height:280px;">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $base . 'gothic-castle.jpg' ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( 'hotel-' . sanitize_title( $p['name'] ), $p['name'], $p['desc'], $base . 'gothic-castle.jpg', home_url( '/accommodation/' ), 'Accommodation' ); ?>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $p['loc'] ); ?></span>
                    <h3 class="et-tile__title"><?php echo esc_html( $p['name'] ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $p['desc'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Access Note -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-content et-reveal" style="margin:0 auto;text-align:center;max-width:640px;">
            <blockquote>We have built relationships with Ireland's finest hotels over many years. This means preferred rooms, priority availability, and a personal welcome, not just a reservation.</blockquote>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Want Us to Handle Accommodation Too?</h2>
            <p class="et-section__subtitle">All accommodation is included in your bespoke journey. We handle everything.</p>
        </div>
        <div style="text-align:center;" class="et-reveal">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Plan Your Journey</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
