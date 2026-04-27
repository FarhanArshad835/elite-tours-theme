<?php
/**
 * Template Name: Experiences
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';

// Single source of truth: et_get_experiences() derives cards from Experience
// CPT posts (with legacy et_experiences as fallback). Keeps the homepage grid
// and this page in lockstep — editing a post in the admin updates both.
$admin_experiences = et_get_experiences();
$regions           = get_option( 'et_regions', [] );
$taxonomies        = get_option( 'et_experience_taxonomies', [] );
$type_options = ! empty( $taxonomies['types'] ) ? $taxonomies['types']
    : [ 'tailormade' => 'Tailormade', 'golf' => 'Golf', 'culinary' => 'Culinary', 'adventure' => 'Adventure', 'family' => 'Family' ];
$duration_options = ! empty( $taxonomies['durations'] ) ? $taxonomies['durations']
    : [ '6-10' => '6-10 Days', '11-15' => '11-15 Days', 'bespoke' => 'Bespoke' ];

$fallback_images = [
    $base . 'kylemore-abbey.jpg', $base . 'irish-pub.jpg', $base . 'winding-road.jpg',
    $base . 'golf-coastal.jpg', $base . 'castle-hillside.jpg', $base . 'gothic-castle.jpg',
];

// Build all experiences array (from admin + hardcoded extras)
$all_experiences = [];

// 1. From single source of truth (CPT-derived, falls back to et_experiences)
if ( ! empty( $admin_experiences ) ) {
    foreach ( $admin_experiences as $i => $exp ) {
        $img_id  = absint( $exp['image_id'] ?? 0 );
        $img_url = $img_id
            ? wp_get_attachment_image_url( $img_id, 'large' )
            : ( $fallback_images[ $i % count( $fallback_images ) ] ?? $fallback_images[0] );

        // CPT-derived cards already carry an absolute permalink; legacy
        // option entries ship a relative path. Don't double-wrap absolute URLs.
        $url = $exp['url'] ?? '';
        if ( $url === '' ) {
            $url = home_url( '/contact/' );
        } elseif ( strpos( $url, 'http' ) !== 0 ) {
            $url = home_url( $url );
        }

        $all_experiences[] = [
            'id'       => 'exp-' . sanitize_title( $exp['title'] ?? $i ),
            'label'    => $exp['label'] ?? '',
            'title'    => $exp['title'] ?? '',
            'desc'     => $exp['desc'] ?? '',
            'img'      => $img_url,
            'url'      => $url,
            'type'     => $exp['type'] ?? 'tailormade',
            'duration' => $exp['duration'] ?? 'bespoke',
            'source'   => 'experience',
        ];
    }
}

// 2. Golf courses — pulled from et_golf_courses (single source of truth, shared with /golf-tours/)
$golf_courses = get_option( 'et_golf_courses', [] );
if ( ! is_array( $golf_courses ) ) $golf_courses = [];
foreach ( $golf_courses as $j => $gc ) {
    $gc_img_id  = absint( $gc['image_id'] ?? 0 );
    $gc_img_url = $gc_img_id
        ? wp_get_attachment_image_url( $gc_img_id, 'large' )
        : ( $base . 'golf-coastal.jpg' );
    $all_experiences[] = [
        'id'       => 'golf-' . sanitize_title( $gc['name'] ?? $j ),
        'label'    => $gc['location'] ?? '',
        'title'    => $gc['name'] ?? '',
        'desc'     => $gc['desc'] ?? '',
        'img'      => $gc_img_url,
        'url'      => ! empty( $gc['url'] ) ? esc_url( $gc['url'] ) : home_url( '/golf-tours/' ),
        'type'     => 'golf',
        'duration' => '6-10',
        'source'   => 'golf',
    ];
}

// 3. Accommodation — pulled from et_hotels (single source of truth, shared with /accommodation/)
$hotels = get_option( 'et_hotels', [] );
if ( ! is_array( $hotels ) ) $hotels = [];
foreach ( $hotels as $h ) {
    $h_img_id  = absint( $h['image_id'] ?? 0 );
    $h_img_url = $h_img_id
        ? wp_get_attachment_image_url( $h_img_id, 'large' )
        : ( $base . 'gothic-castle.jpg' );
    $all_experiences[] = [
        'id'       => 'hotel-' . sanitize_title( $h['name'] ?? '' ),
        'label'    => $h['location'] ?? '',
        'title'    => $h['name'] ?? '',
        'desc'     => $h['desc'] ?? '',
        'img'      => $h_img_url,
        'url'      => ! empty( $h['url'] ) ? esc_url( $h['url'] ) : home_url( '/accommodation/' ),
        'type'     => 'accommodation',
        'duration' => 'bespoke',
        'source'   => 'accommodation',
    ];
}

// If no admin experiences, add defaults
if ( empty( $admin_experiences ) ) {
    $defaults = [
        [ 'label' => '11–15 Days · Fully Bespoke', 'title' => 'The Signature Ireland Journey',     'desc' => 'A privately curated journey through Ireland — Dublin & Ancient Ireland, the Atlantic Edge, and the Quiet North. Fully bespoke, hosted by Ray.', 'type' => 'bespoke',   'duration' => '11-15' ],
        [ 'label' => '6–10 Days · Fully Bespoke',  'title' => 'The Essence of Ireland Experience', 'desc' => "A refined version of the full experience for those with less time. Ireland's very best, without unnecessary movement.",                          'type' => 'bespoke',   'duration' => '6-10' ],
    ];
    foreach ( $defaults as $k => $d ) {
        array_unshift( $all_experiences, [
            'id'       => 'exp-' . sanitize_title( $d['title'] ),
            'label'    => $d['label'],
            'title'    => $d['title'],
            'desc'     => $d['desc'],
            'img'      => $fallback_images[ $k % count( $fallback_images ) ],
            'url'      => home_url( '/contact/' ),
            'type'     => $d['type'],
            'duration' => $d['duration'],
            'source'   => 'experience',
        ] );
    }
}

// Build filter tabs from all experiences + custom taxonomies
$type_filters = [ 'all' => 'All' ];
foreach ( $type_options as $k => $v ) { $type_filters[ $k ] = $v; }
$type_filters['golf'] = 'Golf';
$type_filters['accommodation'] = 'Accommodation';
?>

<!-- Hero (CMS-driven via et_page_heroes['experiences']) -->
<?php etm_render_page_hero( 'experiences', [
    'title'          => 'Ireland in Eleven Regions.<br>One Carefully Designed Journey.',
    'subtitle'       => "From Dublin's foundations to the Causeway Coast, each region of Ireland brings its own character — its own people, landscapes, and stories. Below is the country we travel.",
    'image_filename' => 'irish-pub.jpg',
], $base ); ?>

<?php if ( ! empty( $regions ) && is_array( $regions ) ) : ?>
<!-- Regions of Ireland — Phase 5 -->
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
                    : ( $base . 'kylemore-abbey.jpg' );
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

<!-- All Experiences Grid with Filters -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <p class="et-section__eyebrow">Browse Everything</p>
            <h2 class="et-section__title">Tour products, golf, accommodation.</h2>
            <p class="et-section__subtitle"><?php echo count( $all_experiences ); ?> entries across Ireland — filter by what you&rsquo;re drawn to.</p>
        </div>

        <!-- Filters -->
        <div class="et-experiences__filters" style="justify-content:center;margin-bottom:40px;">
            <div class="et-filter-tabs" id="et-page-filter">
                <?php foreach ( $type_filters as $val => $text ) : ?>
                <button type="button"
                        class="et-filter-tab<?php echo $val === 'all' ? ' is-active' : ''; ?>"
                        data-filter="type"
                        data-value="<?php echo esc_attr( $val ); ?>">
                    <?php echo esc_html( $text ); ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="et-tile-grid" id="et-all-exp-grid">
            <?php foreach ( $all_experiences as $exp ) : ?>
            <a href="<?php echo esc_url( $exp['url'] ); ?>"
               class="et-tile et-reveal"
               data-type="<?php echo esc_attr( $exp['type'] ); ?>">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $exp['img'] ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( $exp['id'], $exp['title'], $exp['desc'], $exp['img'], $exp['url'], ucfirst( $exp['type'] ) ); ?>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $exp['label'] ); ?></span>
                    <h3 class="et-tile__title"><?php echo esc_html( $exp['title'] ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $exp['desc'] ); ?></p>
                    <span class="et-tile__cta">Explore &rsaquo;</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <p class="et-experiences__empty" id="et-page-exp-empty" style="display:none;">No experiences match this filter.</p>
    </div>
</section>

<!-- Bottom CTA (CMS-driven via et_page_ctas['experiences']) -->
<?php etm_render_page_cta( 'experiences', [
    'title'    => "Don't See What You're Looking For?",
    'subtitle' => "We design experiences from scratch. Tell us what interests you and we'll build something entirely around it.",
    'cta_text' => 'Speak to Us',
    'cta_url'  => '/contact/',
] ); ?>

<script>
(function () {
    var grid  = document.getElementById('et-all-exp-grid');
    var empty = document.getElementById('et-page-exp-empty');
    var cards = grid ? Array.from(grid.querySelectorAll('.et-tile')) : [];
    var activeType = 'all';

    document.querySelectorAll('#et-page-filter .et-filter-tab').forEach(function (btn) {
        btn.addEventListener('click', function () {
            activeType = btn.dataset.value;
            btn.closest('.et-filter-tabs').querySelectorAll('.et-filter-tab').forEach(function (t) { t.classList.remove('is-active'); });
            btn.classList.add('is-active');

            var visible = 0;
            cards.forEach(function (card) {
                var show = activeType === 'all' || card.dataset.type === activeType;
                card.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            if (empty) empty.style.display = visible === 0 ? '' : 'none';
        });
    });
})();
</script>

<?php get_footer(); ?>
