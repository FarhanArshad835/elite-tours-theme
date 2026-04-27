<?php
defined( 'ABSPATH' ) || exit;

$base        = get_template_directory_uri() . '/assets/images/';
$exp_heading = et_hp( 'exp_heading', "Every Journey Is Different. Here's Where Yours Might Begin." );

// Single source of truth: et_get_experiences() — derives cards directly from
// Experience CPT posts so editing a post in the WP admin updates this grid
// AND the /experiences/ page in lockstep. Legacy et_experiences option is
// only used as a fallback when no CPT posts are published yet.
$stored_experiences = et_get_experiences();

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

    // URL: cards from CPT already carry a permalink. Legacy fallback entries
    // ship a relative path like '/bespoke-tours/' that needs home_url().
    $url = $exp['url'] ?? '#';
    if ( $url && strpos( $url, 'http' ) !== 0 ) {
        $url = home_url( $url );
    }

    $experiences[] = [
        'img'      => $img_url,
        'label'    => $exp['label'] ?? '',
        'title'    => $exp['title'] ?? '',
        'desc'     => $exp['desc'] ?? '',
        'url'      => $url,
        'type'     => $exp['type'] ?? 'bespoke',
        'duration' => $exp['duration'] ?? 'bespoke',
    ];
}

// Filter categories — read from saved taxonomies or use defaults
$taxonomies = get_option( 'et_experience_taxonomies', [] );

$type_filters = [ 'all' => 'All Experiences' ];
$saved_types  = ! empty( $taxonomies['types'] ) ? $taxonomies['types']
    : [ 'bespoke' => 'Bespoke', 'golf' => 'Golf', 'culinary' => 'Culinary', 'adventure' => 'Adventure', 'family' => 'Family' ];
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
