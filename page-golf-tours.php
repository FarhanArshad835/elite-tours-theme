<?php
/**
 * Template Name: Golf Tours
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';
?>

<!-- Hero -->
<section class="et-page-hero">
    <div class="et-page-hero__bg" style="background-image:url('<?php echo esc_url( $base . 'golf-coastal.jpg' ); ?>')"></div>
    <div class="et-page-hero__overlay"></div>
    <div class="et-container">
        <div class="et-page-hero__content et-reveal">
            <h1 class="et-page-hero__title">The Best Golf Trip of Your Life.<br>Without Having to Think About Anything.</h1>
            <p class="et-page-hero__sub">Fully tailored golf journeys across Ireland's greatest courses, seamlessly handled, privately hosted, expertly curated.</p>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--primary et-btn--lg et-page-hero__cta">Plan Your Golf Journey</a>
        </div>
    </div>
</section>

<!-- Positioning -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-two-col">
            <div class="et-reveal">
                <div class="et-section__header">
                    <h2 class="et-section__title">This Is Not a Golf Package</h2>
                </div>
                <div class="et-content">
                    <p>We don't hand you a list of courses and ask you to pick three.</p>
                    <p>We design a golf experience around the golfer. Your handicap, your bucket list courses, your pace, your group dynamic. Every tee time, every transfer, every detail is managed. You simply show up and play.</p>
                    <p>This is what separates Elite Tours from every other golf operator in Ireland.</p>
                    <blockquote>The best golf trip of your life, without having to think about anything.</blockquote>
                </div>
            </div>
            <div class="et-reveal">
                <img src="<?php echo esc_url( $base . 'golf-coastal.jpg' ); ?>" alt="Irish golf links" style="width:100%;height:480px;object-fit:cover;border-radius:6px;">
            </div>
        </div>
    </div>
</section>

<!-- 5 Pillars -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">What Every Elite Golf Journey Includes</h2>
        </div>
        <?php
        $pillars = [
            [ 'num' => '01', 'title' => 'Golf-Led Personalisation', 'desc' => 'Built around you, not a pre-set route. Playing level, bucket list courses vs hidden gems, preferred pace, group dynamic. All considered before a single tee time is booked.' ],
            [ 'num' => '02', 'title' => "Ray's Personal Hosting", 'desc' => 'Every golf journey is personally overseen by Ray. Someone who knows the game, knows the country, and knows how to host properly. Present without intruding.' ],
            [ 'num' => '03', 'title' => 'Seamless Logistics', 'desc' => 'Tee time scheduling, private chauffeur between courses, club transport and handling, pre/post round timing. You never think about where to be or when to leave.' ],
            [ 'num' => '04', 'title' => 'Priority Course Access', 'desc' => "Ireland's top courses are seasonal and highly booked. We know when and how to secure the rounds that matter, through established relationships and strategic booking windows." ],
            [ 'num' => '05', 'title' => 'Curation Beyond Golf', 'desc' => 'Handpicked luxury accommodation near courses. Whiskey tastings. Coastal drives. Private dining. Post-round pub evenings. The full Ireland experience, built around the game.' ],
        ];
        ?>
        <div class="et-info-grid" style="grid-template-columns: repeat(5, 1fr);">
            <?php foreach ( $pillars as $p ) : ?>
            <div class="et-info-card et-reveal">
                <div class="et-info-card__num"><?php echo esc_html( $p['num'] ); ?></div>
                <div class="et-info-card__title"><?php echo esc_html( $p['title'] ); ?></div>
                <div class="et-info-card__desc"><?php echo esc_html( $p['desc'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Courses -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Ireland's Greatest Courses</h2>
        </div>
        <div class="et-tile-grid">
            <?php
            $courses = [
                [ 'name' => 'Old Head of Kinsale', 'loc' => 'Co. Cork', 'desc' => 'One of the most spectacular settings in world golf, a peninsula jutting into the Atlantic.', 'img' => $base . 'golf-coastal.jpg' ],
                [ 'name' => 'Ballybunion Links', 'loc' => 'Co. Kerry', 'desc' => 'A bucket-list course for every serious golfer. Championship links on the Wild Atlantic Way.', 'img' => $base . 'winding-road.jpg' ],
                [ 'name' => 'Lahinch Golf Club', 'loc' => 'Co. Clare', 'desc' => 'Links golf at its finest, overlooking the Atlantic. One of Ireland\'s most beloved courses.', 'img' => $base . 'castle-hillside.jpg' ],
                [ 'name' => 'Royal County Down', 'loc' => 'Co. Down', 'desc' => 'Consistently ranked in the world\'s top 10. A links masterpiece beneath the Mourne Mountains.', 'img' => $base . 'gothic-castle.jpg' ],
                [ 'name' => 'Portmarnock Golf Club', 'loc' => 'Co. Dublin', 'desc' => 'A legendary championship links course north of Dublin.', 'img' => $base . 'kylemore-abbey.jpg' ],
                [ 'name' => 'Waterville Golf Links', 'loc' => 'Co. Kerry', 'desc' => 'Remote, stunning, and unforgettable. A bucket-list course on the Ring of Kerry.', 'img' => $base . 'irish-pub.jpg' ],
            ];
            foreach ( $courses as $c ) : ?>
            <div class="et-tile et-reveal">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $c['img'] ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( 'golf-' . sanitize_title( $c['name'] ), $c['name'], $c['desc'], $c['img'], home_url( '/golf-tours/' ), 'Golf' ); ?>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $c['loc'] ); ?></span>
                    <h3 class="et-tile__title"><?php echo esc_html( $c['name'] ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $c['desc'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <p style="margin-top:32px;text-align:center;font-style:italic;color:var(--et-grey);font-size:14px;">Availability at Ireland's top courses is limited, especially in peak season. We secure access through established relationships. Speak to us early.</p>
    </div>
</section>

<!-- Sample Golf Journeys -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-reveal">
            <h2 class="et-section__title">Where Other Golf Journeys Have Begun</h2>
        </div>
        <?php
        $journeys = [
            [ 'name' => 'The Classic Links', 'meta' => '7 Days / 5 Rounds', 'route' => 'Shannon &rarr; Lahinch &rarr; Ballybunion &rarr; Waterville &rarr; Old Head &rarr; Shannon', 'highlights' => [ '5-star accommodation', 'Private chauffeur throughout', 'Whiskey experience included', '5 championship rounds' ] ],
            [ 'name' => 'The Ultimate Golf Journey', 'meta' => '10 Days / 7 Rounds', 'route' => 'Dublin &rarr; Royal County Down &rarr; Portmarnock &rarr; Lahinch &rarr; Ballybunion &rarr; Waterville &rarr; Old Head &rarr; Shannon', 'highlights' => [ 'Full curation, 7 rounds', 'Luxury accommodation', 'Cultural experiences between rounds', 'Private dining' ] ],
            [ 'name' => 'Father & Son Ireland', 'meta' => '7 Days', 'route' => 'Custom route built around shared bucket-list courses', 'highlights' => [ 'Courses selected together', 'Relaxed pace', 'Shared memories', 'Post-round pub evenings' ] ],
        ];
        foreach ( $journeys as $j ) : ?>
        <div class="et-itinerary et-reveal">
            <div class="et-itinerary__header" onclick="this.closest('.et-itinerary').classList.toggle('is-open')">
                <div>
                    <div class="et-itinerary__name"><?php echo esc_html( $j['name'] ); ?></div>
                    <div class="et-itinerary__meta"><?php echo esc_html( $j['meta'] ); ?></div>
                </div>
                <span class="et-itinerary__arrow">&#9662;</span>
            </div>
            <div class="et-itinerary__body">
                <p class="et-itinerary__route"><?php echo wp_kses_post( $j['route'] ); ?></p>
                <ul class="et-itinerary__highlights">
                    <?php foreach ( $j['highlights'] as $h ) : ?>
                    <li><?php echo esc_html( $h ); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
        <p style="margin-top:24px;font-style:italic;color:var(--et-grey);font-size:14px;">All itineraries designed around the group. These are starting points only.</p>
    </div>
</section>

<!-- CTA -->
<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Let's Plan Your Golf Journey</h2>
            <p class="et-section__subtitle">Ireland's top courses book out early, especially in peak season. The earlier you speak to us, the better we can secure the rounds that matter most.</p>
        </div>
        <div style="text-align:center;" class="et-reveal">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Enquire About Golf Tours</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
