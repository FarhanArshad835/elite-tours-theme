<?php
defined( 'ABSPATH' ) || exit;

$f_label    = et_hp( 'founder_label',   '' );
$f_heading  = et_hp( 'founder_heading', 'Start Planning<br>Your Journey' );
$f_body     = et_hp( 'founder_body',    "Every journey is tailored to you, designed with care, local insight, and a deep understanding of Ireland." );
$f_cta_text = et_hp( 'founder_cta_text', 'Plan Your Journey' );
$f_cta_url  = et_hp( 'founder_cta_url',  home_url( '/contact/' ) );
$f_quote    = et_hp( 'founder_quote',    "I've spent decades helping people experience Ireland in a truly personal way." );
$f_cite     = et_hp( 'founder_cite',     'Raphael Mulally, Founder, Elite Tours Ireland' );

$founder_id  = et_hp_int( 'founder_image_id', 0 );
$founder_url = $founder_id
    ? wp_get_attachment_image_url( $founder_id, 'large' )
    : get_template_directory_uri() . '/assets/images/founder-ray-mulally.jpg';
?>

<section class="et-founder" id="et-founder">
    <div class="et-container">
        <div class="et-founder__grid">

            <!-- CTA Text -->
            <div class="et-founder__text">
                <h2 class="et-founder__heading"><?php echo wp_kses( $f_heading, [ 'br' => [] ] ); ?></h2>
                <p class="et-founder__body"><?php echo esc_html( $f_body ); ?></p>

                <!-- Quick enquiry form -->
                <form class="et-founder__form" method="post" action="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                    <input type="text" name="name" placeholder="Name" class="et-founder__input" required>
                    <input type="email" name="email" placeholder="Email" class="et-founder__input" required>
                    <textarea name="message" placeholder="Tell us about your trip..." class="et-founder__textarea" rows="3"></textarea>
                    <button type="submit" class="et-btn et-btn--primary et-btn--lg et-founder__submit">
                        <?php echo esc_html( $f_cta_text ); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </form>

                <div class="et-founder__quote-wrap">
                    <p class="et-founder__quote">"<?php echo esc_html( $f_quote ); ?>"</p>
                    <cite class="et-founder__cite"><?php echo esc_html( $f_cite ); ?></cite>
                </div>
            </div>

            <!-- Founder photo -->
            <div class="et-founder__media">
                <div class="et-founder__img-wrap">
                    <img src="<?php echo esc_url( $founder_url ); ?>"
                         alt="Raphael Mulally, Founder, Elite Tours Ireland"
                         loading="lazy">
                    <div class="et-founder__img-caption">
                        <span>Raphael "Ray" Mulally</span>
                        <span>Founder, Elite Tours Ireland</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
