<?php
/**
 * Template Name: Experiences
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';

// Pull experiences from admin panel
$admin_experiences = get_option( 'et_experiences', [] );
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

// 1. From admin panel
if ( ! empty( $admin_experiences ) ) {
    foreach ( $admin_experiences as $i => $exp ) {
        $img_id  = absint( $exp['image_id'] ?? 0 );
        $img_url = $img_id
            ? wp_get_attachment_image_url( $img_id, 'large' )
            : ( $fallback_images[ $i % count( $fallback_images ) ] ?? $fallback_images[0] );
        $all_experiences[] = [
            'id'       => 'exp-' . sanitize_title( $exp['title'] ?? $i ),
            'label'    => $exp['label'] ?? '',
            'title'    => $exp['title'] ?? '',
            'desc'     => $exp['desc'] ?? '',
            'img'      => $img_url,
            'url'      => $exp['url'] ? home_url( $exp['url'] ) : home_url( '/contact/' ),
            'type'     => $exp['type'] ?? 'tailormade',
            'duration' => $exp['duration'] ?? 'bespoke',
            'source'   => 'experience',
        ];
    }
}

// 2. Golf courses (always shown)
$golf_courses = [
    [ 'title' => 'Old Head of Kinsale',  'desc' => 'One of the most spectacular settings in world golf.',           'loc' => 'Co. Cork' ],
    [ 'title' => 'Ballybunion Links',    'desc' => 'Championship links on the Wild Atlantic Way.',                   'loc' => 'Co. Kerry' ],
    [ 'title' => 'Lahinch Golf Club',    'desc' => 'Links golf at its finest, overlooking the Atlantic.',            'loc' => 'Co. Clare' ],
    [ 'title' => 'Royal County Down',    'desc' => 'Consistently ranked in the world\'s top 10.',                    'loc' => 'Co. Down' ],
    [ 'title' => 'Waterville Golf Links','desc' => 'Remote, stunning, and unforgettable.',                           'loc' => 'Co. Kerry' ],
];
foreach ( $golf_courses as $j => $gc ) {
    $all_experiences[] = [
        'id'       => 'golf-' . sanitize_title( $gc['title'] ),
        'label'    => $gc['loc'],
        'title'    => $gc['title'],
        'desc'     => $gc['desc'],
        'img'      => $base . 'golf-coastal.jpg',
        'url'      => home_url( '/golf-tours/' ),
        'type'     => 'golf',
        'duration' => '6-10',
        'source'   => 'golf',
    ];
}

// 3. Accommodation properties
$hotels = [
    [ 'title' => 'Dromoland Castle',  'desc' => 'A 16th-century castle set on 450 acres of parkland.',      'loc' => 'Co. Clare' ],
    [ 'title' => 'Adare Manor',       'desc' => 'A neo-Gothic masterpiece with world-class golf.',           'loc' => 'Co. Limerick' ],
    [ 'title' => 'Ashford Castle',    'desc' => 'An 800-year-old castle on the shores of Lough Corrib.',     'loc' => 'Co. Mayo' ],
    [ 'title' => 'Castlemartyr Resort','desc' => 'A restored 18th-century manor house in East Cork.',        'loc' => 'Co. Cork' ],
];
foreach ( $hotels as $h ) {
    $all_experiences[] = [
        'id'       => 'hotel-' . sanitize_title( $h['title'] ),
        'label'    => $h['loc'],
        'title'    => $h['title'],
        'desc'     => $h['desc'],
        'img'      => $base . 'gothic-castle.jpg',
        'url'      => home_url( '/accommodation/' ),
        'type'     => 'accommodation',
        'duration' => 'bespoke',
        'source'   => 'accommodation',
    ];
}

// If no admin experiences, add defaults
if ( empty( $admin_experiences ) ) {
    $defaults = [
        [ 'label' => 'Ancestry & Roots',        'title' => 'Trace Your Irish Heritage',    'desc' => 'Trace your Irish heritage with depth, dignity, and personal connection.',    'type' => 'tailormade', 'duration' => 'bespoke' ],
        [ 'label' => 'Whiskey & Culture',        'title' => "Ireland's Craft Distilleries", 'desc' => "Ireland's craft distilleries and rich cultural story, privately curated.",  'type' => 'culinary',   'duration' => '6-10' ],
        [ 'label' => 'Scenic & Coastal Ireland', 'title' => 'The Wild Atlantic',            'desc' => 'The Wild Atlantic Way, country roads, cliffs and castles, at your pace.',  'type' => 'adventure',  'duration' => '11-15' ],
        [ 'label' => 'Family Private Journey',   'title' => 'For Every Generation',         'desc' => 'A meaningful Irish experience for every generation in your family.',        'type' => 'family',     'duration' => '11-15' ],
        [ 'label' => 'Heritage & History',       'title' => 'Castles & Estate Stays',       'desc' => 'Castles, estates, and the stories of Ireland told through its landscape.',  'type' => 'tailormade', 'duration' => 'bespoke' ],
        [ 'label' => 'Literary Ireland',         'title' => 'Yeats, Wilde & Beckett',       'desc' => 'The country of Yeats, Wilde, Beckett, explored personally.',                'type' => 'culinary',   'duration' => '6-10' ],
        [ 'label' => 'Culinary Ireland',         'title' => 'Farm to Fork',                 'desc' => 'Farm-to-table, artisan producers, traditional Irish food.',                  'type' => 'culinary',   'duration' => '6-10' ],
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

<!-- Hero -->
<section class="et-page-hero">
    <div class="et-page-hero__bg" style="background-image:url('<?php echo esc_url( $base . 'irish-pub.jpg' ); ?>')"></div>
    <div class="et-page-hero__overlay"></div>
    <div class="et-container">
        <div class="et-page-hero__content et-reveal">
            <h1 class="et-page-hero__title">Ireland in Eleven Regions.<br>One Carefully Designed Journey.</h1>
            <p class="et-page-hero__sub">From Dublin's foundations to the Causeway Coast, each region of Ireland brings its own character — its own people, landscapes, and stories. Below is the country we travel.</p>
        </div>
    </div>
</section>

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
            <p class="et-section__subtitle"><?php echo count( $all_experiences ); ?> entries across Ireland — filter by what you\'re drawn to.</p>
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

<!-- CTA -->
<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Don't See What You're Looking For?</h2>
            <p class="et-section__subtitle">We design experiences from scratch. Tell us what interests you and we'll build something entirely around it.</p>
        </div>
        <div style="text-align:center;" class="et-reveal">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Speak to Us</a>
        </div>
    </div>
</section>

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
