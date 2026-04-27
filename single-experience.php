<?php
/**
 * Single Experience — Funnel Page Template
 * Layout: Hero header → Highlights → Blurb → Contact form
 * (Modeled on adamsandbutler.com per-experience funnel structure)
 */
defined( 'ABSPATH' ) || exit;
get_header();

if ( ! have_posts() ) {
    echo '<p style="padding:120px 24px;text-align:center;">Experience not found.</p>';
    get_footer();
    return;
}
the_post();

$post_id = get_the_ID();
$funnel  = function_exists( 'etm_get_experience_funnel' ) ? etm_get_experience_funnel( $post_id ) : [];

$hero_id  = get_post_thumbnail_id( $post_id );
$hero_url = $hero_id
    ? wp_get_attachment_image_url( $hero_id, 'full' )
    : get_template_directory_uri() . '/assets/images/hero-default.jpg';

$eyebrow         = $funnel['eyebrow']         ?? '';
$highlights      = $funnel['highlights']      ?? [];
$blurb_cta       = $funnel['blurb_cta']       ?? '';
$blurb_url       = $funnel['blurb_url']       ?? '';
$linked_title    = $funnel['linked_title']    ?? '';
$linked_url      = $funnel['linked_url']      ?? '';
$contact_heading = $funnel['contact_heading'] ?? 'Start Planning Your Journey';
$contact_sub     = $funnel['contact_sub']     ?? 'Tell us a little about who you are and what you\'re hoping to experience.';
?>

<article class="et-exp-funnel">

    <!-- 1. HERO HEADER ─────────────────────────────────────────── -->
    <section class="et-exp-funnel__hero">
        <div class="et-exp-funnel__hero-bg" style="background-image:url('<?php echo esc_url( $hero_url ); ?>');"></div>
        <div class="et-exp-funnel__hero-overlay"></div>
        <div class="et-container et-exp-funnel__hero-inner">
            <?php if ( $eyebrow ) : ?>
                <span class="et-exp-funnel__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>
            <h1 class="et-exp-funnel__title"><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <p class="et-exp-funnel__deck"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- 2. HIGHLIGHTS ──────────────────────────────────────────── -->
    <?php if ( ! empty( $highlights ) ) : ?>
    <section class="et-exp-funnel__highlights">
        <div class="et-container">
            <h2 class="et-exp-funnel__section-title">Highlights</h2>
            <div class="et-exp-funnel__highlights-grid">
                <?php foreach ( $highlights as $h ) : ?>
                    <div class="et-exp-funnel__highlight">
                        <span class="et-exp-funnel__highlight-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </span>
                        <h3 class="et-exp-funnel__highlight-title"><?php echo esc_html( $h['title'] ?? '' ); ?></h3>
                        <?php if ( ! empty( $h['desc'] ) ) : ?>
                            <p class="et-exp-funnel__highlight-desc"><?php echo esc_html( $h['desc'] ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- 3. BLURB ──────────────────────────────────────────────── -->
    <section class="et-exp-funnel__blurb">
        <div class="et-container et-exp-funnel__blurb-inner">
            <div class="et-exp-funnel__blurb-content">
                <?php the_content(); ?>

                <?php if ( $linked_title && $linked_url ) : ?>
                    <p class="et-exp-funnel__linked">
                        <span class="et-exp-funnel__linked-label">Continue to</span>
                        <a href="<?php echo esc_url( $linked_url ); ?>" class="et-exp-funnel__linked-link">
                            <?php echo esc_html( $linked_title ); ?>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </p>
                <?php endif; ?>

                <?php if ( $blurb_cta ) : ?>
                    <a href="<?php echo esc_url( $blurb_url ?: '#et-funnel-contact' ); ?>" class="et-btn et-btn--primary et-exp-funnel__blurb-cta">
                        <?php echo esc_html( $blurb_cta ); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 4. CONTACT FORM ───────────────────────────────────────── -->
    <section class="et-exp-funnel__contact" id="et-funnel-contact">
        <div class="et-container">
            <div class="et-exp-funnel__contact-inner">
                <div class="et-exp-funnel__contact-text">
                    <h2 class="et-exp-funnel__contact-heading"><?php echo esc_html( $contact_heading ); ?></h2>
                    <p class="et-exp-funnel__contact-sub"><?php echo esc_html( $contact_sub ); ?></p>
                </div>

                <form class="et-funnel-form" id="et-funnel-form" novalidate>
                    <?php wp_nonce_field( 'etm_funnel', '_wpnonce' ); ?>
                    <input type="hidden" name="action"          value="etm_funnel_submit">
                    <input type="hidden" name="experience"      value="<?php echo esc_attr( get_the_title() ); ?>">
                    <input type="hidden" name="experience_url"  value="<?php echo esc_url( get_permalink() ); ?>">
                    <!-- honeypot — humans don't fill this -->
                    <div style="position:absolute;left:-9999px;height:0;overflow:hidden;" aria-hidden="true">
                        <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <div class="et-funnel-form__row">
                        <label class="et-funnel-form__field">
                            <span class="et-funnel-form__label">Full name</span>
                            <input type="text" name="name" required>
                        </label>
                        <label class="et-funnel-form__field">
                            <span class="et-funnel-form__label">Email</span>
                            <input type="email" name="email" required>
                        </label>
                    </div>
                    <label class="et-funnel-form__field">
                        <span class="et-funnel-form__label">Phone <span class="et-funnel-form__optional">(optional)</span></span>
                        <input type="tel" name="phone">
                    </label>
                    <label class="et-funnel-form__field">
                        <span class="et-funnel-form__label">Tell us about your trip</span>
                        <textarea name="message" rows="5" required></textarea>
                    </label>

                    <button type="submit" class="et-btn et-btn--primary et-funnel-form__submit">
                        <span class="et-funnel-form__submit-text">Plan Your Journey</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                    <p class="et-funnel-form__feedback" id="et-funnel-feedback" role="status"></p>
                </form>
            </div>
        </div>
    </section>

</article>

<script>
( function () {
    const form = document.getElementById( 'et-funnel-form' );
    if ( ! form ) return;
    const feedback = document.getElementById( 'et-funnel-feedback' );
    const submit   = form.querySelector( '.et-funnel-form__submit' );
    const txt      = form.querySelector( '.et-funnel-form__submit-text' );
    const ajaxUrl  = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';

    form.addEventListener( 'submit', function ( e ) {
        e.preventDefault();
        if ( ! form.checkValidity() ) { form.reportValidity(); return; }

        feedback.textContent = '';
        feedback.className   = 'et-funnel-form__feedback';
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
                feedback.className   = 'et-funnel-form__feedback is-success';
                if ( txt ) txt.textContent = 'Sent';
            } else {
                feedback.textContent = ( res.data && res.data.message ) || res.data || 'Sorry — something went wrong. Please try again.';
                feedback.className   = 'et-funnel-form__feedback is-error';
                if ( txt ) txt.textContent = 'Plan Your Journey';
                submit.disabled = false;
            }
        } )
        .catch( () => {
            feedback.textContent = 'Network error. Please try again or email us directly.';
            feedback.className   = 'et-funnel-form__feedback is-error';
            if ( txt ) txt.textContent = 'Plan Your Journey';
            submit.disabled = false;
        } );
    } );
} )();
</script>

<?php get_footer();
