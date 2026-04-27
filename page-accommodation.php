<?php
/**
 * Template Name: Accommodation
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';

// Pull hotels from admin panel
$admin_hotels = get_option( 'et_hotels', [] );

// Fallback defaults if no admin hotels exist
if ( empty( $admin_hotels ) ) {
    $admin_hotels = [
        [ 'name' => 'Dromoland Castle',   'location' => 'Co. Clare',    'desc' => 'A 16th-century castle set on 450 acres of parkland. One of Ireland\'s finest.', 'category' => 'castle',   'image_id' => 0, 'url' => '' ],
        [ 'name' => 'Adare Manor',        'location' => 'Co. Limerick', 'desc' => 'A neo-Gothic masterpiece. Home to world-class golf and unmatched luxury.',      'category' => 'castle',   'image_id' => 0, 'url' => '' ],
        [ 'name' => 'Ashford Castle',     'location' => 'Co. Mayo',     'desc' => 'An 800-year-old castle on the shores of Lough Corrib. Truly iconic.',           'category' => 'castle',   'image_id' => 0, 'url' => '' ],
        [ 'name' => 'Castlemartyr Resort','location' => 'Co. Cork',     'desc' => 'A restored 18th-century manor house in the heart of East Cork.',               'category' => 'castle',   'image_id' => 0, 'url' => '' ],
    ];
}

$category_labels = [
    'castle'   => 'Castle & Estate',
    'boutique' => 'Boutique & Country House',
    'coastal'  => 'Luxury Coastal & Scenic',
];

// Group by category
$grouped = [ 'castle' => [], 'boutique' => [], 'coastal' => [] ];
foreach ( $admin_hotels as $h ) {
    $cat = $h['category'] ?? 'castle';
    if ( isset( $grouped[ $cat ] ) ) $grouped[ $cat ][] = $h;
}

function et_hotel_img_url( $hotel, $fallback ) {
    $id = absint( $hotel['image_id'] ?? 0 );
    return $id ? wp_get_attachment_image_url( $id, 'large' ) : $fallback;
}
?>

<!-- Hero -->
<section class="et-page-hero">
    <div class="et-page-hero__bg" style="background-image:url('<?php echo esc_url( $base . 'gothic-castle.jpg' ); ?>')"></div>
    <div class="et-page-hero__overlay"></div>
    <div class="et-container">
        <div class="et-page-hero__content et-reveal">
            <h1 class="et-page-hero__title">Where you stay,<br>chosen for how it feels.</h1>
            <p class="et-page-hero__sub">Accommodation throughout your journey is carefully selected to reflect both the standard of experience and the character of Ireland itself. From Ashford Castle to handpicked Kinsale stays, each location is chosen for how it contributes to the journey — not just for its star rating.</p>
        </div>
    </div>
</section>

<!-- Three Category Intros -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-tile-grid">
            <?php
            $category_intros = [
                [ 'key' => 'castle',   'label' => 'Castle & Estate Hotels',   'title' => 'Sleep inside history.',      'desc' => 'Ashford, Dromoland, Ballynahinch, Lough Eske, Glenlo Abbey, Abbeyglen — and Private Estates by request. The flagship 5-star tier that anchors every premium itinerary.', 'img' => $base . 'gothic-castle.jpg' ],
                [ 'key' => 'boutique', 'label' => 'Boutique & Country House', 'title' => 'Where authenticity balances luxury.',  'desc' => 'Handpicked iconic city stays (Shelbourne, Merrion, Merchant) and high-end character hotels (Hayfield Manor, Bushmills Inn, Harvey\'s Point) where the welcome is as warm as the fire.', 'img' => $base . 'castle-hillside.jpg' ],
                [ 'key' => 'coastal',  'label' => 'Luxury Coastal & Scenic',  'title' => 'Wake up to the Atlantic.',   'desc' => 'Sheen Falls Lodge, Aghadoe Heights, Kinsale curated stays, Fishing Lodges — properties chosen for their setting as much as their service.',  'img' => $base . 'winding-road.jpg' ],
            ];
            foreach ( $category_intros as $cat ) : ?>
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

<!-- Featured Properties by Category -->
<?php foreach ( $grouped as $cat_key => $cat_hotels ) : ?>
    <?php if ( empty( $cat_hotels ) ) continue; ?>
<section class="et-section <?php echo $cat_key === 'boutique' ? 'et-section--white' : 'et-section--offwhite'; ?>">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title"><?php echo esc_html( $category_labels[ $cat_key ] ); ?></h2>
        </div>
        <div class="et-tile-grid">
            <?php foreach ( $cat_hotels as $h ) :
                $img_url = et_hotel_img_url( $h, $base . 'gothic-castle.jpg' );
            ?>
            <div class="et-tile et-reveal" style="height:280px;">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $img_url ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( 'hotel-' . sanitize_title( $h['name'] ), $h['name'], $h['desc'], $img_url, home_url( '/accommodation/' ), 'Accommodation' ); ?>
                <div class="et-tile__content">
                    <?php if ( ! empty( $h['location'] ) ) : ?>
                    <span class="et-tile__label"><?php echo esc_html( $h['location'] ); ?></span>
                    <?php endif; ?>
                    <h3 class="et-tile__title"><?php echo esc_html( $h['name'] ); ?></h3>
                    <?php if ( ! empty( $h['desc'] ) ) : ?>
                    <p class="et-tile__desc"><?php echo esc_html( $h['desc'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

<!-- Access Note -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-content et-reveal" style="margin:0 auto;text-align:center;max-width:680px;">
            <blockquote>We have built relationships with Ireland's finest hotels over many years. This means preferred rooms, priority availability, and a personal welcome — not just a reservation. Many of the places we use are not widely known, and some are not publicly marketed in the traditional way.</blockquote>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">All accommodation handled for you.</h2>
            <p class="et-section__subtitle">Every stay across your Bespoke journey is selected, booked, and looked after by us — paired carefully so the rhythm of the trip flows from one to the next.</p>
        </div>
        <div style="text-align:center;" class="et-reveal">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Begin Your First Conversation</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
