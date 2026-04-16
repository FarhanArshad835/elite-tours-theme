<?php
defined( 'ABSPATH' ) || exit;

$t_label   = et_hp( 'testimonials_label',   'Client Stories' );
$t_heading = et_hp( 'testimonials_heading', 'What Our Clients Say' );
$t_sub     = et_hp( 'testimonials_sub',     'These are not reviews. These are stories.' );

$testimonials = [
    [
        'quote'  => et_hp( 't_1_quote',  "We arrived not knowing what to expect. We left feeling like Ireland was part of us. Ray thought of everything — things we didn't even know we needed. It was the most personal trip we've ever taken." ),
        'name'   => et_hp( 't_1_name',   'Patricia &amp; Tom M.' ),
        'origin' => et_hp( 't_1_origin', 'Boston' ),
    ],
    [
        'quote'  => et_hp( 't_2_quote',  "The golf was extraordinary. Old Head was a moment I'll never forget. But it was the way everything was handled — every tee time, every detail — that made it truly special." ),
        'name'   => et_hp( 't_2_name',   'James K.' ),
        'origin' => et_hp( 't_2_origin', 'New York' ),
    ],
    [
        'quote'  => et_hp( 't_3_quote',  "We came to find our family's roots in County Cork. What we found was far more than we expected. This wasn't tourism — it was a homecoming." ),
        'name'   => et_hp( 't_3_name',   'The McCarthy Family' ),
        'origin' => et_hp( 't_3_origin', 'Chicago' ),
    ],
];
?>

<section class="et-testimonials" id="et-testimonials">
    <div class="et-container">

        <div class="et-testimonials__header">
            <span class="et-label"><?php echo esc_html( $t_label ); ?></span>
            <h2 class="et-testimonials__heading"><?php echo esc_html( $t_heading ); ?></h2>
            <p class="et-testimonials__sub"><?php echo esc_html( $t_sub ); ?></p>
        </div>

        <div class="et-testimonials__grid">
            <?php foreach ( $testimonials as $t ) : ?>
            <div class="et-testimonial">
                <div class="et-testimonial__quote-mark">"</div>
                <blockquote class="et-testimonial__body">
                    <?php echo esc_html( $t['quote'] ); ?>
                </blockquote>
                <footer class="et-testimonial__footer">
                    <span class="et-testimonial__name"><?php echo wp_kses( $t['name'], [] ); ?></span>
                    <span class="et-testimonial__origin"><?php echo esc_html( $t['origin'] ); ?></span>
                </footer>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- TripAdvisor trust signal -->
        <div class="et-testimonials__trust">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/trust/tripadvisor.svg' ); ?>"
                 alt="TripAdvisor" class="et-testimonials__ta-logo" onerror="this.style.display='none'">
            <div class="et-testimonials__ta-stars" aria-label="5 stars">★★★★★</div>
            <span class="et-testimonials__ta-label">5-Star Rated on TripAdvisor</span>
        </div>

    </div>
</section>
