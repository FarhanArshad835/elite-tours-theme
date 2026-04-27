<?php
/**
 * Experience Funnel — Section 6: CTA (the conversion)
 * Two-column on white.
 * Left: heading + body + 4-field form + phone/email contact line.
 * Right: founder portrait with overlapping cream quote card.
 *
 * Form posts via AJAX to etm_funnel_submit (same handler as the old funnel).
 */
defined( 'ABSPATH' ) || exit;

$f = $args['funnel'] ?? [];

$label   = $f['cta_label']  ?? 'Tailoring This Journey';
$number  = $f['cta_number'] ?? '05';

$h1 = $f['cta_heading_part1'] ?? 'We are';
$h2 = $f['cta_heading_part2'] ?? 'experience designers,';
$h3 = $f['cta_heading_part3'] ?? 'not tour operators.';

$body  = $f['cta_body']  ?? '';
$phone = $f['cta_phone'] ?? '';
$email = $f['cta_email'] ?? '';

$portrait_id = (int) ( $f['cta_portrait'] ?? 0 );
$portrait_url = $portrait_id ? wp_get_attachment_image_url( $portrait_id, 'large' ) : '';

$quote      = $f['cta_quote']             ?? '';
$quote_attr = $f['cta_quote_attribution'] ?? '';
?>
<section class="et-exp__cta" id="et-exp-cta">
    <div class="et-exp__cta-inner">
        <div>
            <h2 class="et-exp__cta-heading">
                <?php if ( $h1 ) : ?><?php echo esc_html( $h1 ); ?><br><?php endif; ?>
                <?php if ( $h2 ) : ?><span class="et-exp__cta-heading-em"><?php echo esc_html( $h2 ); ?></span><br><?php endif; ?>
                <?php if ( $h3 ) : ?><?php echo esc_html( $h3 ); ?><?php endif; ?>
            </h2>

            <?php if ( $body ) : ?>
                <p class="et-exp__cta-body"><?php echo esc_html( $body ); ?></p>
            <?php endif; ?>

            <form class="et-exp__cta-form et-funnel-form" id="et-funnel-form" novalidate>
                <?php wp_nonce_field( 'etm_funnel', '_wpnonce' ); ?>
                <input type="hidden" name="action"         value="etm_funnel_submit">
                <input type="hidden" name="experience"     value="<?php echo esc_attr( get_the_title() ); ?>">
                <input type="hidden" name="experience_url" value="<?php echo esc_url( get_permalink() ); ?>">
                <div style="position:absolute;left:-9999px;height:0;overflow:hidden;" aria-hidden="true">
                    <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                </div>

                <input type="text"  name="name"           placeholder="Name"               required>
                <input type="email" name="email"          placeholder="Email"              required>
                <input type="text"  name="travelling_from" placeholder="Travelling from">
                <input type="text"  name="dates"          placeholder="Approximate dates">
                <textarea name="message" placeholder="Tell us a little about what you're hoping for…" required></textarea>

                <div class="et-exp__cta-form-actions">
                    <button type="submit" class="et-exp__btn">
                        <span class="et-funnel-form__submit-text">Speak to a Designer</span>
                    </button>
                </div>
                <p class="et-exp__cta-form-feedback" id="et-funnel-feedback" role="status"></p>
            </form>

            <?php if ( $phone || $email ) : ?>
                <div class="et-exp__cta-contact">
                    <?php if ( $phone ) : ?>
                        <span><?php echo esc_html( $phone ); ?></span>
                    <?php endif; ?>
                    <?php if ( $phone && $email ) : ?>
                        <span class="et-exp__cta-contact-sep">·</span>
                    <?php endif; ?>
                    <?php if ( $email ) : ?>
                        <span><?php echo esc_html( $email ); ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ( $portrait_url || $quote ) : ?>
            <div class="et-exp__cta-portrait-wrap">
                <?php if ( $portrait_url ) : ?>
                    <img class="et-exp__cta-portrait" src="<?php echo esc_url( $portrait_url ); ?>" alt="<?php echo esc_attr( $quote_attr ); ?>">
                <?php endif; ?>
                <?php if ( $quote ) : ?>
                    <div class="et-exp__cta-quote">
                        <p class="et-exp__cta-quote-text">&ldquo;<?php echo esc_html( $quote ); ?>&rdquo;</p>
                        <?php if ( $quote_attr ) : ?>
                            <div class="et-exp__cta-quote-attribution">
                                <span class="et-exp__cta-quote-attribution-rule"></span>
                                <span class="eyebrow"><?php echo esc_html( $quote_attr ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
( function () {
    const form = document.getElementById( 'et-funnel-form' );
    if ( ! form ) return;
    const feedback = document.getElementById( 'et-funnel-feedback' );
    const submit   = form.querySelector( 'button[type="submit"]' );
    const txt      = form.querySelector( '.et-funnel-form__submit-text' );
    const ajaxUrl  = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';

    form.addEventListener( 'submit', function ( e ) {
        e.preventDefault();
        if ( ! form.checkValidity() ) { form.reportValidity(); return; }

        feedback.textContent = '';
        feedback.className   = 'et-exp__cta-form-feedback';
        submit.disabled      = true;
        if ( txt ) txt.textContent = 'Sending…';

        fetch( ajaxUrl, {
            method:      'POST',
            credentials: 'same-origin',
            body:        new FormData( form ),
        } )
        .then( r => r.json() )
        .then( res => {
            if ( res.success ) {
                form.reset();
                feedback.textContent = res.data || 'Thanks — we\'ll be in touch shortly.';
                feedback.className   = 'et-exp__cta-form-feedback is-success';
                if ( txt ) txt.textContent = 'Sent';
            } else {
                feedback.textContent = ( res.data && res.data.message ) || res.data || 'Sorry — something went wrong. Please try again.';
                feedback.className   = 'et-exp__cta-form-feedback is-error';
                if ( txt ) txt.textContent = 'Speak to a Designer';
                submit.disabled = false;
            }
        } )
        .catch( () => {
            feedback.textContent = 'Network error. Please try again or email us directly.';
            feedback.className   = 'et-exp__cta-form-feedback is-error';
            if ( txt ) txt.textContent = 'Speak to a Designer';
            submit.disabled = false;
        } );
    } );
} )();
</script>
