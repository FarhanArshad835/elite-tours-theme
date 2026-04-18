<?php
defined( 'ABSPATH' ) || exit;

$base        = get_template_directory_uri() . '/assets/images/';
$exp_heading = et_hp( 'exp_heading', "Every Journey Is Different. Here's Where Yours Might Begin." );

// Read experiences from the Experiences admin panel (et_experiences option)
$stored_experiences = get_option( 'et_experiences', [] );

// Fallback to hardcoded defaults if no experiences saved yet
if ( empty( $stored_experiences ) ) {
    $fallback_images = [
        $base . 'kylemore-abbey.jpg', $base . 'irish-pub.jpg', $base . 'winding-road.jpg',
        $base . 'golf-coastal.jpg', $base . 'castle-hillside.jpg', $base . 'gothic-castle.jpg',
    ];
    $stored_experiences = [
        [ 'label' => 'Ancestry & Roots',        'title' => 'Trace Your Irish Heritage',    'desc' => 'Trace your Irish heritage with depth, dignity, and personal connection.',    'url' => '/bespoke-tours/', 'type' => 'tailormade',  'duration' => 'bespoke', 'image_id' => 0 ],
        [ 'label' => 'Whiskey & Culture',        'title' => "Ireland's Craft Distilleries", 'desc' => "Ireland's craft distilleries and rich cultural story, privately curated.",  'url' => '/experiences/',    'type' => 'culinary',    'duration' => '6-10',    'image_id' => 0 ],
        [ 'label' => 'Scenic & Coastal Ireland', 'title' => 'The Wild Atlantic',            'desc' => 'The Wild Atlantic, country roads, cliffs and castles, at your pace.',      'url' => '/bespoke-tours/', 'type' => 'adventure',   'duration' => '11-15',   'image_id' => 0 ],
        [ 'label' => 'Golf Tours',               'title' => "Ireland's Iconic Links",       'desc' => "Ireland's most iconic links courses, seamlessly handled.",                  'url' => '/golf-tours/',    'type' => 'golf',        'duration' => '6-10',    'image_id' => 0 ],
        [ 'label' => 'Family Private Journey',   'title' => 'For Every Generation',         'desc' => 'A meaningful Irish experience for every generation in your family.',        'url' => '/bespoke-tours/', 'type' => 'family',      'duration' => '11-15',   'image_id' => 0 ],
        [ 'label' => 'Heritage & History',       'title' => 'Castles & Estate Stays',       'desc' => 'Castles, estates, and the stories of Ireland told through its landscape.',  'url' => '/experiences/',    'type' => 'tailormade',  'duration' => 'bespoke', 'image_id' => 0 ],
    ];
}

$fallback_images = [
    $base . 'kylemore-abbey.jpg', $base . 'irish-pub.jpg', $base . 'winding-road.jpg',
    $base . 'golf-coastal.jpg', $base . 'castle-hillside.jpg', $base . 'gothic-castle.jpg',
];

$experiences = [];
foreach ( $stored_experiences as $i => $exp ) {
    $img_id  = absint( $exp['image_id'] ?? 0 );
    $img_url = $img_id
        ? wp_get_attachment_image_url( $img_id, 'large' )
        : ( $fallback_images[ $i % count( $fallback_images ) ] ?? $fallback_images[0] );

    $experiences[] = [
        'img'      => $img_url,
        'label'    => $exp['label'] ?? '',
        'title'    => $exp['title'] ?? '',
        'desc'     => $exp['desc'] ?? '',
        'url'      => $exp['url'] ? home_url( $exp['url'] ) : '#',
        'type'     => $exp['type'] ?? 'tailormade',
        'duration' => $exp['duration'] ?? 'bespoke',
    ];
}

// Filter categories — read from saved taxonomies or use defaults
$taxonomies = get_option( 'et_experience_taxonomies', [] );

$type_filters = [ 'all' => 'All Experiences' ];
$saved_types  = ! empty( $taxonomies['types'] ) ? $taxonomies['types']
    : [ 'tailormade' => 'Tailormade', 'golf' => 'Golf', 'culinary' => 'Culinary', 'adventure' => 'Adventure', 'family' => 'Family' ];
foreach ( $saved_types as $k => $v ) { $type_filters[ $k ] = $v; }

$duration_filters = [ 'all' => 'All' ];
$saved_durations  = ! empty( $taxonomies['durations'] ) ? $taxonomies['durations']
    : [ '6-10' => '6-10 Days', '11-15' => '11-15 Days', 'bespoke' => 'Bespoke' ];
foreach ( $saved_durations as $k => $v ) { $duration_filters[ $k ] = $v; }
?>

<section class="et-experiences" id="et-experiences">
    <div class="et-container">

        <div class="et-experiences__header">
            <h2 class="et-experiences__heading"><?php echo wp_kses( $exp_heading, [ 'br' => [] ] ); ?></h2>
        </div>

        <!-- Filter tabs -->
        <div class="et-experiences__filters">
            <div class="et-filter-group">
                <span class="et-filter-group__label">Experience Type</span>
                <div class="et-filter-tabs" id="et-filter-type">
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
            <div class="et-filter-group">
                <span class="et-filter-group__label">Duration</span>
                <div class="et-filter-tabs" id="et-filter-duration">
                    <?php foreach ( $duration_filters as $val => $text ) : ?>
                    <button type="button"
                            class="et-filter-tab<?php echo $val === 'all' ? ' is-active' : ''; ?>"
                            data-filter="duration"
                            data-value="<?php echo esc_attr( $val ); ?>">
                        <?php echo esc_html( $text ); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="et-experiences__grid" id="et-exp-grid">
            <?php foreach ( $experiences as $exp ) : ?>
            <a href="<?php echo esc_url( $exp['url'] ); ?>"
               class="et-exp-card"
               data-type="<?php echo esc_attr( $exp['type'] ); ?>"
               data-duration="<?php echo esc_attr( $exp['duration'] ); ?>">
                <div class="et-exp-card__img" style="background-image: url('<?php echo esc_url( $exp['img'] ); ?>')"></div>
                <div class="et-exp-card__overlay"></div>
                <?php echo et_heart( 'exp-' . sanitize_title( $exp['title'] ), $exp['title'], $exp['desc'], $exp['img'], $exp['url'], $exp['type'] ); ?>
                <div class="et-exp-card__content">
                    <span class="et-exp-card__label"><?php echo esc_html( $exp['label'] ); ?></span>
                    <h3 class="et-exp-card__title"><?php echo esc_html( $exp['title'] ); ?></h3>
                    <p class="et-exp-card__desc"><?php echo esc_html( $exp['desc'] ); ?></p>
                    <span class="et-exp-card__cta">
                        Learn More
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- No results message -->
        <p class="et-experiences__empty" id="et-exp-empty" style="display:none;">No experiences match your filters. Try a different combination.</p>

        <div class="et-experiences__cta">
            <a href="<?php echo esc_url( home_url( '/experiences/' ) ); ?>" class="et-link-arrow">
                View All Experiences
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
</section>

<script>
(function () {
    var grid    = document.getElementById( 'et-exp-grid' );
    var empty   = document.getElementById( 'et-exp-empty' );
    var cards   = grid ? Array.from( grid.querySelectorAll( '.et-exp-card' ) ) : [];
    var filters = { type: 'all', duration: 'all' };

    function applyFilters() {
        var visible = 0;
        cards.forEach( function ( card ) {
            var showType     = filters.type === 'all' || card.dataset.type === filters.type;
            var showDuration = filters.duration === 'all' || card.dataset.duration === filters.duration;
            var show         = showType && showDuration;
            card.style.display = show ? '' : 'none';
            if ( show ) visible++;
        } );
        if ( empty ) empty.style.display = visible === 0 ? '' : 'none';
    }

    document.querySelectorAll( '.et-filter-tab' ).forEach( function ( btn ) {
        btn.addEventListener( 'click', function () {
            var group = btn.dataset.filter;
            filters[ group ] = btn.dataset.value;

            // Update active state within this group
            btn.closest( '.et-filter-tabs' ).querySelectorAll( '.et-filter-tab' ).forEach( function ( t ) {
                t.classList.remove( 'is-active' );
            } );
            btn.classList.add( 'is-active' );

            applyFilters();
        } );
    } );
})();
</script>
