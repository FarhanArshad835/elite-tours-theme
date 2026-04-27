<?php
/**
 * Template Name: Contact
 */
defined( 'ABSPATH' ) || exit;
get_header();
$phone = et_site( 'phone_us', '+353 86 050 0500' );
$phone_clean = preg_replace( '/[^+0-9]/', '', $phone );
$email = et_site( 'contact_email', 'elitetoursireland@gmail.com' );
?>

<!-- Hero — gradient wrapper kept hardcoded; title/subtitle read from et_page_heroes['contact'] -->
<?php
$contact_heroes = get_option( 'et_page_heroes', [] );
$contact_hero   = is_array( $contact_heroes ) && isset( $contact_heroes['contact'] ) ? $contact_heroes['contact'] : [];
$contact_title  = $contact_hero['title']    ?? 'Start Your Journey Here';
$contact_sub    = $contact_hero['subtitle'] ?? "There are no fixed packages. No automated quote tools. Just a real conversation about who you are and what you'd love to experience in Ireland.";
?>
<section class="et-page-hero">
    <div class="et-page-hero__overlay" style="background:linear-gradient(135deg, var(--et-green) 0%, var(--et-green-dark) 100%);"></div>
    <div class="et-container">
        <div class="et-page-hero__content et-reveal">
            <h1 class="et-page-hero__title"><?php echo wp_kses( $contact_title, [ 'br' => [], 'em' => [], 'strong' => [] ] ); ?></h1>
            <p class="et-page-hero__sub"><?php echo esc_html( $contact_sub ); ?></p>
        </div>
    </div>
</section>

<!-- Form + Contact -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-two-col" style="gap:60px;align-items:start;">

            <!-- Enquiry Form -->
            <div class="et-reveal">
                <div class="et-section__header">
                    <h2 class="et-section__title">Tell Us About Your Journey</h2>
                    <p class="et-section__subtitle">Fill in the form below and we'll be in touch personally, usually within 24 hours.</p>
                </div>
                <form class="et-form" method="post" action="#">
                    <div class="et-form__row">
                        <div class="et-form__field">
                            <label class="et-form__label">First Name</label>
                            <input type="text" name="first_name" class="et-form__input" required>
                        </div>
                        <div class="et-form__field">
                            <label class="et-form__label">Last Name</label>
                            <input type="text" name="last_name" class="et-form__input" required>
                        </div>
                    </div>
                    <div class="et-form__row">
                        <div class="et-form__field">
                            <label class="et-form__label">Email Address</label>
                            <input type="email" name="email" class="et-form__input" required>
                        </div>
                        <div class="et-form__field">
                            <label class="et-form__label">Phone (optional)</label>
                            <input type="tel" name="phone" class="et-form__input">
                        </div>
                    </div>
                    <div class="et-form__row">
                        <div class="et-form__field">
                            <label class="et-form__label">Where are you travelling from?</label>
                            <input type="text" name="location" class="et-form__input" placeholder="Country / State">
                        </div>
                        <div class="et-form__field">
                            <label class="et-form__label">Number of travellers</label>
                            <input type="number" name="travellers" class="et-form__input" min="1" max="50">
                        </div>
                    </div>
                    <div class="et-form__row">
                        <div class="et-form__field et-form__field--full">
                            <label class="et-form__label">Approximate travel dates</label>
                            <input type="text" name="dates" class="et-form__input" placeholder="e.g. June 2026, flexible">
                        </div>
                    </div>
                    <div class="et-form__row">
                        <div class="et-form__field et-form__field--full">
                            <label class="et-form__label">Type of journey</label>
                            <select name="journey_type" class="et-form__select">
                                <option value="">Select...</option>
                                <option value="bespoke">Bespoke Private Tour</option>
                                <option value="golf">Golf Tour</option>
                                <option value="unsure">Not sure yet</option>
                            </select>
                        </div>
                    </div>
                    <div class="et-form__row">
                        <div class="et-form__field et-form__field--full">
                            <label class="et-form__label">Interests (select all that apply)</label>
                            <div class="et-form__checks">
                                <?php
                                $interests = get_option( 'et_contact_interests', [] );
                                if ( ! is_array( $interests ) || empty( $interests ) ) {
                                    $interests = [ 'Ancestry', 'Heritage & History', 'Whiskey & Culture', 'Golf', 'Scenic Ireland', 'Family Journey', 'Something Else' ];
                                }
                                foreach ( $interests as $int ) : ?>
                                <label class="et-form__check">
                                    <input type="checkbox" name="interests[]" value="<?php echo esc_attr( $int ); ?>">
                                    <?php echo esc_html( $int ); ?>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="et-form__row">
                        <div class="et-form__field et-form__field--full">
                            <label class="et-form__label">Tell us more about what you're looking for</label>
                            <textarea name="message" class="et-form__textarea" placeholder="Anything you'd like us to know..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="et-btn et-btn--primary et-btn--lg" style="width:100%;justify-content:center;">Send Your Enquiry</button>
                    <p class="et-form__note">We respond personally to every enquiry. No automated replies. Your details are never shared.</p>
                </form>
            </div>

            <!-- Contact Info Sidebar -->
            <div class="et-reveal">
                <div class="et-contact-grid" style="grid-template-columns:1fr;gap:20px;text-align:left;">
                    <div class="et-contact-card">
                        <div class="et-contact-card__label">Call Us</div>
                        <div class="et-contact-card__value"><a href="tel:<?php echo esc_attr( $phone_clean ); ?>"><?php echo esc_html( $phone ); ?></a></div>
                        <div class="et-contact-card__note">Direct to Ray or the team</div>
                    </div>
                    <div class="et-contact-card">
                        <div class="et-contact-card__label">Email</div>
                        <div class="et-contact-card__value"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></div>
                        <div class="et-contact-card__note">Personal reply guaranteed</div>
                    </div>
                </div>

                <!-- Reassurance -->
                <div style="margin-top:40px;">
                    <div class="et-reassurance" style="grid-template-columns:1fr;gap:16px;text-align:left;">
                        <div class="et-reassurance__item" style="display:flex;align-items:center;gap:12px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;color:var(--et-gold);"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span class="et-reassurance__text">Personal response within 24 hours</span>
                        </div>
                        <div class="et-reassurance__item" style="display:flex;align-items:center;gap:12px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;color:var(--et-gold);"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .91h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                            <span class="et-reassurance__text">No obligation, just a conversation</span>
                        </div>
                        <div class="et-reassurance__item" style="display:flex;align-items:center;gap:12px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;color:var(--et-gold);"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <span class="et-reassurance__text">Your details are kept private, always</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
