<?php
defined( 'ABSPATH' ) || exit;

$base        = get_template_directory_uri() . '/assets/images/';
$exp_heading = et_hp( 'exp_heading', "Every Journey Is Different. Here's Where Yours Might Begin." );

// Now driven by et_key_experiences (the 22 client-named experiences) rather
// than the Experience CPT posts. After Signature + Essence moved to the
// Bespoke Tours hub (their natural home), the only thematic CPT posts left
// were zero, leaving this grid empty. Key experiences are the right unit
// at this teaser level: specific named moments people can immediately
// picture, with the County tag acting as the eyebrow.
$key_experiences = get_option( 'et_key_experiences', [] );
if ( ! is_array( $key_experiences ) ) $key_experiences = [];

$fallback_images = [
    $base . 'kylemore-abbey.jpg', $base . 'irish-pub.jpg', $base . 'winding-road.jpg',
    $base . 'golf-coastal.jpg', $base . 'castle-hillside.jpg', $base . 'gothic-castle.jpg',
];

$experiences = [];
foreach ( $key_experiences as $i => $ke ) {
    $img_id  = absint( $ke['image_id'] ?? 0 );
    $img_url = $img_id
        ? wp_get_attachment_image_url( $img_id, 'large' )
        : ( ! empty( $ke['image_filename'] ) ? $base . $ke['image_filename'] : ( $fallback_images[ $i % count( $fallback_images ) ] ?? $fallback_images[0] ) );

    // URL: optional on key experiences. If empty, link to /experiences/
    // (the destination where all 22 are browseable in full).
    $url = $ke['url'] ?? '';
    if ( $url === '' ) {
        $url = home_url( '/experiences/' );
    } elseif ( strpos( $url, 'http' ) !== 0 ) {
        $url = home_url( $url );
    }

    $experiences[] = [
        'img'   => $img_url,
        'label' => $ke['region'] ?? '',
        'title' => $ke['name']   ?? '',
        'desc'  => $ke['desc']   ?? '',
        'url'   => $url,
    ];
}

?>

<section class="et-experiences" id="et-experiences">
    <div class="et-container">

        <div class="et-experiences__header et-experiences__header--with-controls">
            <h2 class="et-experiences__heading"><?php echo wp_kses( $exp_heading, [ 'br' => [] ] ); ?></h2>

            <?php if ( count( $experiences ) > 1 ) : ?>
            <div class="et-carousel-controls" aria-label="Carousel navigation">
                <button type="button" class="et-carousel-btn et-carousel-btn--prev" data-carousel-prev="et-exp-grid" aria-label="Previous experience" disabled>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" class="et-carousel-btn et-carousel-btn--next" data-carousel-next="et-exp-grid" aria-label="Next experience">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
            <?php endif; ?>
        </div>

        <div class="et-experiences__grid et-experiences__grid--carousel" id="et-exp-grid"
             role="region" aria-label="Featured experiences carousel" tabindex="0">
            <?php foreach ( $experiences as $exp ) : ?>
            <a href="<?php echo esc_url( $exp['url'] ); ?>" class="et-exp-card">
                <div class="et-exp-card__img" style="background-image: url('<?php echo esc_url( $exp['img'] ); ?>')"></div>
                <div class="et-exp-card__overlay"></div>
                <?php echo et_heart( 'exp-' . sanitize_title( $exp['title'] ), $exp['title'], $exp['desc'], $exp['img'], $exp['url'], 'experience' ); ?>
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

        <div class="et-experiences__cta">
            <a href="<?php echo esc_url( home_url( '/experiences/' ) ); ?>" class="et-link-arrow">
                View All Experiences
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
</section>

