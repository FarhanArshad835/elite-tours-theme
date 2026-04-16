<?php
defined( 'ABSPATH' ) || exit;

$t_label   = et_hp( 'testimonials_label',   'Client Stories' );
$t_heading = et_hp( 'testimonials_heading', 'What Our Clients Say' );
$t_sub     = et_hp( 'testimonials_sub',     'These are not reviews. These are stories.' );

$ta_url = esc_url( 'https://www.tripadvisor.com/Attraction_Review-g186621-d19840247-Reviews-Elite_Tours_Ireland-Limerick_County_Limerick.html' );

$testimonials = [
    [
        'quote'  => et_hp( 't_1_quote',  "Ray went above and beyond and completely transformed our trip from good to simply amazing. He took time to know us and customize a really special tour that was perfectly suited to our family. I cannot imagine trying to explore Ireland without him." ),
        'name'   => et_hp( 't_1_name',   'Beth G.' ),
        'origin' => et_hp( 't_1_origin', 'TripAdvisor' ),
    ],
    [
        'quote'  => et_hp( 't_2_quote',  "Ray is more than a driver. He\'s a storyteller, a guide, and now, a dear friend. Whether we were at the Cliffs of Moher, winding through the Gap of Dunloe, or soaking in the charm of Cobh, Ray brought each place to life in a way only someone deeply connected to Ireland could." ),
        'name'   => et_hp( 't_2_name',   'Margaret B.' ),
        'origin' => et_hp( 't_2_origin', 'TripAdvisor' ),
    ],
    [
        'quote'  => et_hp( 't_3_quote',  "By the end of the trip, it felt like we were saying goodbye to a friend rather than a driver. Ray\'s insider tips led us away from the typical tourist crowds and gave us a more authentic experience. He is truly a gem, and we can\'t recommend him highly enough." ),
        'name'   => et_hp( 't_3_name',   'Ellie M.' ),
        'origin' => et_hp( 't_3_origin', 'Boston' ),
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
        <a href="<?php echo $ta_url; ?>" class="et-testimonials__trust" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/trust/tripadvisor.svg' ); ?>"
                 alt="TripAdvisor" class="et-testimonials__ta-logo" onerror="this.style.display='none'">
            <div class="et-testimonials__ta-stars" aria-label="5 stars">★★★★★</div>
            <span class="et-testimonials__ta-label">5.0 Rating &middot; 90 Reviews &middot; #1 in Limerick</span>
        </a>

    </div>
</section>
