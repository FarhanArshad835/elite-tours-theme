<?php
defined( 'ABSPATH' ) || exit;

$base    = get_template_directory_uri() . '/assets/images/';
$exp_label   = et_hp( 'exp_label',   'Experiences' );
$exp_heading = et_hp( 'exp_heading', "Every Journey Is Different. Here's Where Yours Might Begin." );

$fallback_images = [
    $base . 'kylemore-abbey.jpg',
    $base . 'irish-pub.jpg',
    $base . 'winding-road.jpg',
    $base . 'golf-coastal.jpg',
    $base . 'castle-hillside.jpg',
    $base . 'gothic-castle.jpg',
];

$exp_defaults = [
    [ 'label' => 'Ancestry & Roots',       'title' => 'Trace Your Irish Heritage',    'desc' => 'Trace your Irish heritage with depth, dignity, and personal connection.',         'url' => home_url( '/bespoke-tours/' ) ],
    [ 'label' => 'Whiskey & Culture',      'title' => "Ireland's Craft Distilleries", 'desc' => "Ireland's craft distilleries and rich cultural story, privately curated.",       'url' => home_url( '/experiences/' ) ],
    [ 'label' => 'Scenic & Coastal Ireland','title' => 'The Wild Atlantic',            'desc' => 'The Wild Atlantic, country roads, cliffs and castles — at your pace.',            'url' => home_url( '/bespoke-tours/' ) ],
    [ 'label' => 'Golf Tours',             'title' => "Ireland's Iconic Links",        'desc' => "Ireland's most iconic links courses, seamlessly handled.",                        'url' => home_url( '/golf-tours/' ) ],
    [ 'label' => 'Family Private Journey', 'title' => 'For Every Generation',         'desc' => 'A meaningful Irish experience for every generation in your family.',              'url' => home_url( '/bespoke-tours/' ) ],
    [ 'label' => 'Heritage & History',     'title' => 'Castles & Estate Stays',       'desc' => 'Castles, estates, and the stories of Ireland told through its landscape.',        'url' => home_url( '/experiences/' ) ],
];

$experiences = [];
for ( $n = 1; $n <= 6; $n++ ) {
    $idx      = $n - 1;
    $img_id   = et_hp_int( 'exp_' . $n . '_image_id', 0 );
    $img_url  = $img_id
        ? wp_get_attachment_image_url( $img_id, 'large' )
        : $fallback_images[ $idx ];

    $experiences[] = [
        'img'   => $img_url,
        'label' => et_hp( 'exp_' . $n . '_label', $exp_defaults[ $idx ]['label'] ),
        'title' => et_hp( 'exp_' . $n . '_title', $exp_defaults[ $idx ]['title'] ),
        'desc'  => et_hp( 'exp_' . $n . '_desc',  $exp_defaults[ $idx ]['desc'] ),
        'url'   => et_hp( 'exp_' . $n . '_url',   $exp_defaults[ $idx ]['url'] ),
    ];
}
?>

<section class="et-experiences" id="et-experiences">
    <div class="et-container">

        <div class="et-experiences__header">
            <span class="et-label"><?php echo esc_html( $exp_label ); ?></span>
            <h2 class="et-experiences__heading"><?php echo wp_kses( $exp_heading, [ 'br' => [] ] ); ?></h2>
        </div>

        <div class="et-experiences__grid">
            <?php foreach ( $experiences as $exp ) : ?>
            <a href="<?php echo esc_url( $exp['url'] ); ?>" class="et-exp-card">
                <div class="et-exp-card__img" style="background-image: url('<?php echo esc_url( $exp['img'] ); ?>')"></div>
                <div class="et-exp-card__overlay"></div>
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

    </div>
</section>
