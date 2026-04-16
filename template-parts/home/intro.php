<?php
defined( 'ABSPATH' ) || exit;

$label       = et_hp( 'intro_label',   'Who We Are' );
$heading     = et_hp( 'intro_heading', 'More Than a Tour.<br>A Deeper Connection to Ireland.' );
$body        = et_hp( 'intro_body',    '<p>For many people, a journey to Ireland is not just a holiday. It is a return to something — ancestry, identity, a sense of belonging. Yet too often, that experience is rushed, impersonal, and built for volume rather than meaning.</p><p>Elite Tours was built to change that.</p><p>Every journey we create is built entirely around you — your interests, your family, your pace. We don\'t move people from place to place. We welcome them into Ireland properly. Every detail is considered. Every experience is shaped to feel effortless, personal, and worth remembering.</p><p>This is not a tour. This is how Ireland should be experienced.</p>' );
$cta_text    = et_hp( 'intro_cta_text', 'Meet Our Story' );
$cta_url     = et_hp( 'intro_cta_url',  home_url( '/about-us/' ) );
$badge_num   = et_hp( 'intro_badge_num',  '50+' );
$badge_text  = et_hp( 'intro_badge_text', 'Years of<br>Experience' );

$image_id  = et_hp_int( 'intro_image_id', 0 );
$image_url = $image_id
    ? wp_get_attachment_image_url( $image_id, 'large' )
    : get_template_directory_uri() . '/assets/images/castle-hillside.jpg';
?>

<section class="et-intro" id="et-intro">
    <div class="et-container">
        <div class="et-intro__grid">

            <!-- Text -->
            <div class="et-intro__text">
                <span class="et-label"><?php echo esc_html( $label ); ?></span>
                <h2 class="et-intro__heading">
                    <?php echo wp_kses( $heading, [ 'br' => [] ] ); ?>
                </h2>
                <div class="et-intro__body">
                    <?php echo wp_kses_post( $body ); ?>
                </div>
                <a href="<?php echo esc_url( $cta_url ); ?>" class="et-link-arrow">
                    <?php echo esc_html( $cta_text ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Image -->
            <div class="et-intro__media">
                <div class="et-intro__img-wrap">
                    <img src="<?php echo esc_url( $image_url ); ?>"
                         alt="Ireland — Elite Tours"
                         loading="lazy">
                    <div class="et-intro__badge">
                        <span class="et-intro__badge-num"><?php echo esc_html( $badge_num ); ?></span>
                        <span class="et-intro__badge-text"><?php echo wp_kses( $badge_text, [ 'br' => [] ] ); ?></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
