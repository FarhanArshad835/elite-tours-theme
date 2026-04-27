<?php
/**
 * Template Name: Golf Tours
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';

$et_strings = get_option( 'et_page_strings', [] );
if ( ! is_array( $et_strings ) ) $et_strings = [];
?>

<!-- Hero (CMS-driven via et_page_heroes['golf-tours']) -->
<?php etm_render_page_hero( 'golf-tours', [
    'title'          => "Play Ireland's<br>greatest courses.",
    'subtitle'       => "Old Head, Lahinch, Doonbeg, Royal County Down, Adare Manor — fully managed, privately hosted, with Ray's standard of care across every round, transfer, and evening.",
    'cta_text'       => 'Begin Your First Conversation',
    'cta_url'        => '/contact/',
    'image_filename' => 'golf-coastal.jpg',
], $base ); ?>

<!-- Positioning (CMS-driven via et_page_strings.golf_philosophy_*) -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-two-col">
            <div class="et-reveal">
                <div class="et-section__header">
                    <h2 class="et-section__title"><?php echo esc_html( $et_strings['golf_philosophy_title'] ?? 'This Is Not a Golf Package' ); ?></h2>
                </div>
                <div class="et-content">
                    <?php etm_render_paragraphs( $et_strings['golf_philosophy_body'] ?? "We don't hand you a list of courses and ask you to pick three.\n\nWe design a golf experience around the golfer. Your handicap, your bucket list courses, your pace, your group dynamic. Every tee time, every transfer, every detail is managed. You simply show up and play.\n\nThis is what separates Elite Tours from every other golf operator in Ireland." ); ?>
                    <?php $golf_quote = $et_strings['golf_philosophy_blockquote'] ?? 'The best golf trip of your life, without having to think about anything.'; ?>
                    <?php if ( $golf_quote ) : ?>
                    <blockquote><?php echo esc_html( $golf_quote ); ?></blockquote>
                    <?php endif; ?>
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
        $pillars = get_option( 'et_golf_pillars', [] );
        if ( ! is_array( $pillars ) ) $pillars = [];
        $pillar_count = max( 1, count( $pillars ) );
        ?>
        <div class="et-info-grid" style="grid-template-columns: repeat(<?php echo (int) min( 5, $pillar_count ); ?>, 1fr);">
            <?php foreach ( $pillars as $p ) : ?>
            <div class="et-info-card et-reveal">
                <div class="et-info-card__num"><?php echo esc_html( $p['num'] ?? '' ); ?></div>
                <div class="et-info-card__title"><?php echo esc_html( $p['title'] ?? '' ); ?></div>
                <div class="et-info-card__desc"><?php echo esc_html( $p['desc'] ?? '' ); ?></div>
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
            $courses = get_option( 'et_golf_courses', [] );
            if ( ! is_array( $courses ) ) $courses = [];
            $course_fallback_imgs = [
                $base . 'golf-coastal.jpg', $base . 'castle-hillside.jpg', $base . 'winding-road.jpg',
                $base . 'gothic-castle.jpg', $base . 'kylemore-abbey.jpg', $base . 'irish-pub.jpg',
            ];
            foreach ( $courses as $i => $c ) :
                $img_id  = absint( $c['image_id'] ?? 0 );
                $img_url = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'large' )
                    : $course_fallback_imgs[ $i % count( $course_fallback_imgs ) ];
                $href = ! empty( $c['url'] ) ? esc_url( $c['url'] ) : esc_url( home_url( '/golf-tours/' ) );
            ?>
            <div class="et-tile et-reveal">
                <div class="et-tile__img" style="background-image:url('<?php echo esc_url( $img_url ); ?>')"></div>
                <div class="et-tile__overlay"></div>
                <?php echo et_heart( 'golf-' . sanitize_title( $c['name'] ?? 'course' ), $c['name'] ?? '', $c['desc'] ?? '', $img_url, $href, 'Golf' ); ?>
                <div class="et-tile__content">
                    <span class="et-tile__label"><?php echo esc_html( $c['location'] ?? '' ); ?></span>
                    <h3 class="et-tile__title"><?php echo esc_html( $c['name'] ?? '' ); ?></h3>
                    <p class="et-tile__desc"><?php echo esc_html( $c['desc'] ?? '' ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php $golf_avail_note = $et_strings['golf_availability_note'] ?? "Availability at Ireland's top courses is limited, especially in peak season. We secure access through established relationships. Speak to us early."; ?>
        <?php if ( $golf_avail_note ) : ?>
        <p style="margin-top:32px;text-align:center;font-style:italic;color:var(--et-grey);font-size:14px;"><?php echo esc_html( $golf_avail_note ); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Sample Golf Journeys -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-reveal">
            <h2 class="et-section__title">Where Other Golf Journeys Have Begun</h2>
        </div>
        <?php
        // Pull golf itineraries from admin (filter by type = golf)
        $all_itineraries = get_option( 'et_itineraries', [] );
        $journeys = array_filter( $all_itineraries, function( $it ) {
            return ( $it['type'] ?? '' ) === 'golf';
        } );

        // Fallback defaults if no admin golf itineraries
        if ( empty( $journeys ) ) {
            $journeys = [
                [ 'name' => 'The Classic Links', 'meta' => '7 Days / 5 Rounds', 'route' => 'Shannon → Lahinch → Ballybunion → Waterville → Old Head → Shannon', 'highlights' => [ '5-star accommodation', 'Private chauffeur throughout', 'Whiskey experience included', '5 championship rounds' ] ],
                [ 'name' => 'The Ultimate Golf Journey', 'meta' => '10 Days / 7 Rounds', 'route' => 'Dublin → Royal County Down → Portmarnock → Lahinch → Ballybunion → Waterville → Old Head → Shannon', 'highlights' => [ 'Full curation, 7 rounds', 'Luxury accommodation', 'Cultural experiences between rounds', 'Private dining' ] ],
                [ 'name' => 'Father & Son Ireland', 'meta' => '7 Days', 'route' => 'Custom route built around shared bucket-list courses', 'highlights' => [ 'Courses selected together', 'Relaxed pace', 'Shared memories', 'Post-round pub evenings' ] ],
            ];
        }
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
        <?php $golf_disclaimer = $et_strings['golf_itinerary_disclaimer'] ?? 'All itineraries designed around the group. These are starting points only.'; ?>
        <?php if ( $golf_disclaimer ) : ?>
        <p style="margin-top:24px;font-style:italic;color:var(--et-grey);font-size:14px;"><?php echo esc_html( $golf_disclaimer ); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Bottom CTA (CMS-driven via et_page_ctas['golf-tours']) -->
<?php etm_render_page_cta( 'golf-tours', [
    'title'    => "Let's plan your golf journey.",
    'subtitle' => "Ireland's top courses book out early, especially in peak season — and Ryder Cup-host venues like Adare Manor and Royal County Down even earlier. The earlier you speak to us, the better we can secure the rounds that matter most.",
    'cta_text' => 'Begin Your First Conversation',
    'cta_url'  => '/contact/',
] ); ?>

<?php get_footer(); ?>
