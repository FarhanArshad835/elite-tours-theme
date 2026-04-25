<?php
/**
 * Template Name: Bespoke Tours
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';
?>

<!-- Hero -->
<section class="et-page-hero">
    <div class="et-page-hero__bg" style="background-image:url('<?php echo esc_url( $base . 'winding-road.jpg' ); ?>')"></div>
    <div class="et-page-hero__overlay"></div>
    <div class="et-container">
        <div class="et-page-hero__content et-reveal">
            <h1 class="et-page-hero__title">Your Ireland.<br>Built Around You.</h1>
            <p class="et-page-hero__sub">No fixed routes. No templates. Every journey designed from scratch, for you.</p>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--primary et-btn--lg et-page-hero__cta">Start Planning Your Journey</a>
        </div>
    </div>
</section>

<!-- Philosophy -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-two-col">
            <div class="et-reveal">
                <div class="et-section__header">
                    <h2 class="et-section__title">This Is Not a Tour Package</h2>
                </div>
                <div class="et-content">
                    <p>Most companies offer you a list of itineraries and ask you to choose. We don't.</p>
                    <p>Every Elite Tours journey begins with a conversation about who you are, what brought you to Ireland, and what you want to feel when you leave. Then we build it entirely around you.</p>
                    <p>No two tours are the same. That is not a marketing line. It is simply how we work.</p>
                    <p>From ancestry searches in County Mayo to whiskey tastings on the Dingle Peninsula, every experience is chosen, sequenced, and delivered for the specific people taking it.</p>
                </div>
            </div>
            <div class="et-reveal">
                <img src="<?php echo esc_url( $base . 'castle-hillside.jpg' ); ?>" alt="Ireland countryside" style="width:100%;height:480px;object-fit:cover;border-radius:6px;">
            </div>
        </div>
    </div>
</section>

<!-- Journey Types Grid -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Where Would You Like to Begin?</h2>
        </div>
        <div class="et-tile-grid">
            <?php
            $tiles = [
                [ 'label' => 'Ancestry & Roots',   'title' => 'Find Where You Came From',          'desc' => 'Trace your Irish heritage. Walk the land your family walked. Discover records, townlands, and living connections to your past.', 'img' => $base . 'kylemore-abbey.jpg' ],
                [ 'label' => 'Whiskey & Culture',   'title' => "Ireland's Story, Poured Into a Glass", 'desc' => "Private visits to Ireland's finest craft distilleries, paired with rich cultural storytelling.", 'img' => $base . 'irish-pub.jpg' ],
                [ 'label' => 'Scenic & Coastal',    'title' => 'The Roads Less Taken',               'desc' => 'The Wild Atlantic Way, the Ring of Kerry, country roads and landscapes that stop you in your tracks.', 'img' => $base . 'winding-road.jpg' ],
                [ 'label' => 'Heritage & History',   'title' => "Ireland's History, Brought to Life", 'desc' => 'Castles, monastic ruins, Georgian estates, and the stories behind them.', 'img' => $base . 'gothic-castle.jpg' ],
                [ 'label' => 'Family Journeys',     'title' => 'Memorable for Every Generation',     'desc' => 'A meaningful, multi-generational Irish experience paced for every age in your group.', 'img' => $base . 'castle-hillside.jpg' ],
                [ 'label' => 'Your Own Journey',     'title' => 'Something Completely Your Own',      'desc' => 'Have something specific in mind? Tell us. We will build it entirely from scratch, around you.', 'img' => $base . 'golf-coastal.jpg' ],
            ];
            foreach ( $tiles as $t ) : ?>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-tile et-reveal">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $t['img'] ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( 'bespoke-' . sanitize_title( $t['title'] ), $t['title'], $t['desc'], $t['img'], home_url( '/contact/' ), 'Bespoke' ); ?>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $t['label'] ); ?></span>
                    <h3 class="et-tile__title"><?php echo esc_html( $t['title'] ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $t['desc'] ); ?></p>
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
        <div class="et-info-grid" style="grid-template-columns: repeat(3,1fr);">
            <?php
            $durations = [
                [ 'num' => '6-10', 'title' => 'Days', 'desc' => 'A focused, deeply personal Ireland experience. Two to three regions, unhurried pace, time to truly settle in.' ],
                [ 'num' => '11-15', 'title' => 'Days', 'desc' => 'A comprehensive journey, west coast to east coast, with time to breathe in every region.' ],
                [ 'num' => '?', 'title' => 'Bespoke', 'desc' => "We'll design whatever length works best for your group. Tell us your dates and we'll build around them." ],
            ];
            foreach ( $durations as $d ) : ?>
            <div class="et-info-card et-reveal">
                <div class="et-info-card__num"><?php echo esc_html( $d['num'] ); ?></div>
                <div class="et-info-card__title"><?php echo esc_html( $d['title'] ); ?></div>
                <div class="et-info-card__desc"><?php echo esc_html( $d['desc'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Sample Itineraries -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-reveal">
            <h2 class="et-section__title">Here Is Where Other Journeys Have Begun</h2>
            <p class="et-section__subtitle" style="font-style:italic;">These are examples only. Every journey we design is unique.</p>
        </div>
        <?php
        // Pull bespoke itineraries from admin (filter by type = bespoke)
        $all_itineraries = get_option( 'et_itineraries', [] );
        $itineraries = array_filter( $all_itineraries, function( $it ) {
            return ( $it['type'] ?? 'bespoke' ) === 'bespoke';
        } );

        // Fallback defaults if no admin itineraries
        if ( empty( $itineraries ) ) {
            $itineraries = [
                [ 'name' => 'The Ancestral Journey', 'meta' => '8 Days', 'route' => 'Dublin → County Clare → County Mayo → Connemara → Galway → Departure', 'highlights' => [ 'Ancestry records visit with local expert', 'Private family townland tour', 'Cliffs of Moher (private morning)', 'Ashford Castle area', 'Traditional Irish evening with live music', 'Connemara lakeside drive' ] ],
                [ 'name' => 'The Grand Tour of Ireland', 'meta' => '12 Days', 'route' => 'Dublin → Wicklow → Kilkenny → Cork → Kerry → Clare → Galway → Connemara → Departure', 'highlights' => [ 'Powerscourt Estate', 'Rock of Cashel', 'Kilkenny Castle', 'Midleton Distillery', 'Ring of Kerry', 'Dingle Peninsula', 'Cliffs of Moher', 'Aran Islands' ] ],
                [ 'name' => 'Whiskey & The West', 'meta' => '7 Days', 'route' => 'Shannon → Midleton → Cork City → Kerry → Dingle → Connemara → Departure', 'highlights' => [ 'Jameson Distillery Midleton (private)', 'Dingle Distillery', 'Skellig Coast', 'Dingle Peninsula drive', 'Artisan food and pub experiences', 'Connemara' ] ],
            ];
        }
        foreach ( $itineraries as $it ) : ?>
        <div class="et-itinerary et-reveal">
            <div class="et-itinerary__header" onclick="this.closest('.et-itinerary').classList.toggle('is-open')">
                <div>
                    <div class="et-itinerary__name"><?php echo esc_html( $it['name'] ); ?></div>
                    <div class="et-itinerary__meta"><?php echo esc_html( $it['meta'] ); ?></div>
                </div>
                <span class="et-itinerary__arrow">&#9662;</span>
            </div>
            <div class="et-itinerary__body">
                <p class="et-itinerary__route"><?php echo wp_kses_post( $it['route'] ); ?></p>
                <ul class="et-itinerary__highlights">
                    <?php foreach ( $it['highlights'] as $h ) : ?>
                    <li><?php echo esc_html( $h ); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
        <p style="margin-top:24px;font-style:italic;color:var(--et-grey);font-size:14px;">These are starting points. Your journey will be designed around you.</p>
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
            $included = [
                [ 'num' => '01', 'title' => 'Private Chauffeur', 'desc' => 'Door-to-door throughout your journey. Premium vehicles. No shared transfers.' ],
                [ 'num' => '02', 'title' => 'Custom Itinerary', 'desc' => 'Designed from scratch after your consultation. Built for you, nobody else.' ],
                [ 'num' => '03', 'title' => 'All Logistics', 'desc' => 'Accommodation, reservations, access, timing. All managed. You think about nothing.' ],
                [ 'num' => '04', 'title' => "Ray's Personal Standard", 'desc' => 'Every journey is shaped and overseen by Ray Mulally personally.' ],
            ];
            foreach ( $included as $inc ) : ?>
            <div class="et-info-card et-reveal">
                <div class="et-info-card__num"><?php echo esc_html( $inc['num'] ); ?></div>
                <div class="et-info-card__title"><?php echo esc_html( $inc['title'] ); ?></div>
                <div class="et-info-card__desc"><?php echo esc_html( $inc['desc'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Ready to Begin?</h2>
            <p class="et-section__subtitle">Tell us who you are and what you're looking for. We'll come back to you personally, usually within 24 hours, with the start of your journey.</p>
        </div>
        <div style="text-align:center;" class="et-reveal">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Plan Your Journey</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
