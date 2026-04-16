<?php
defined( 'ABSPATH' ) || exit;

$base_uri = get_template_directory_uri() . '/assets/images/';

// Card 1 — Bespoke
$o1_label    = et_hp( 'offer_1_label',    'Bespoke Private Tours' );
$o1_heading  = et_hp( 'offer_1_heading',  'Ireland,<br>Built Around You.' );
$o1_desc     = et_hp( 'offer_1_desc',     'Deeply personal, privately guided journeys. Ancestry, culture, heritage, whiskey, scenic routes. No fixed itineraries. Everything designed from scratch, around the people taking it.' );
$o1_cta_text = et_hp( 'offer_1_cta_text', 'Explore Bespoke Tours' );
$o1_cta_url  = et_hp( 'offer_1_cta_url',  home_url( '/bespoke-tours/' ) );
$o1_img_id   = et_hp_int( 'offer_1_image_id', 0 );
$o1_img_url  = $o1_img_id
    ? wp_get_attachment_image_url( $o1_img_id, 'large' )
    : $base_uri . 'castle-silhouette.jpg';

// Card 2 — Golf
$o2_label    = et_hp( 'offer_2_label',    'Golf Tours' );
$o2_heading  = et_hp( 'offer_2_heading',  "Play Ireland's Greatest Courses." );
$o2_desc     = et_hp( 'offer_2_desc',     "Fully managed golf journeys across Ireland's most iconic links, with priority access, private chauffeur, and Ray's personal hosting standard throughout." );
$o2_cta_text = et_hp( 'offer_2_cta_text', 'Explore Golf Tours' );
$o2_cta_url  = et_hp( 'offer_2_cta_url',  home_url( '/golf-tours/' ) );
$o2_img_id   = et_hp_int( 'offer_2_image_id', 0 );
$o2_img_url  = $o2_img_id
    ? wp_get_attachment_image_url( $o2_img_id, 'large' )
    : $base_uri . 'golf-coastal.jpg';
?>

<section class="et-offers" id="et-tours">
    <div class="et-offers__grid">

        <!-- Card A — Bespoke Private Tours -->
        <div class="et-offer-card" style="--et-offer-bg: url('<?php echo esc_url( $o1_img_url ); ?>')">
            <div class="et-offer-card__overlay"></div>
            <div class="et-offer-card__content">
                <span class="et-label et-label--light"><?php echo esc_html( $o1_label ); ?></span>
                <h3 class="et-offer-card__heading"><?php echo wp_kses( $o1_heading, [ 'br' => [] ] ); ?></h3>
                <p class="et-offer-card__desc"><?php echo esc_html( $o1_desc ); ?></p>
                <a href="<?php echo esc_url( $o1_cta_url ); ?>" class="et-btn et-btn--outline-light">
                    <?php echo esc_html( $o1_cta_text ); ?>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <!-- Card B — Golf Tours -->
        <div class="et-offer-card" style="--et-offer-bg: url('<?php echo esc_url( $o2_img_url ); ?>')">
            <div class="et-offer-card__overlay"></div>
            <div class="et-offer-card__content">
                <span class="et-label et-label--light"><?php echo esc_html( $o2_label ); ?></span>
                <h3 class="et-offer-card__heading"><?php echo wp_kses( $o2_heading, [ 'br' => [] ] ); ?></h3>
                <p class="et-offer-card__desc"><?php echo esc_html( $o2_desc ); ?></p>
                <a href="<?php echo esc_url( $o2_cta_url ); ?>" class="et-btn et-btn--outline-light">
                    <?php echo esc_html( $o2_cta_text ); ?>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>
