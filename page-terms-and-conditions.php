<?php
/**
 * Template Name: Terms & Conditions
 *
 * Phase 8 — pre-launch placeholder. Client must have a solicitor review and
 * adjust before going public, particularly the booking, cancellation,
 * liability, and force-majeure clauses which are travel-specific.
 */
defined( 'ABSPATH' ) || exit;
get_header();

$site_email = (function () {
    $opts = get_option( 'et_site_settings', [] );
    return ! empty( $opts['contact_email'] ) ? $opts['contact_email'] : 'concierge@elitetours.ie';
})();
$base = get_template_directory_uri() . '/assets/images/';
?>

<?php etm_render_page_hero( 'terms-and-conditions', [
    'title'          => 'Terms &amp; Conditions',
    'subtitle'       => 'The terms governing your booking with Elite Tours Ireland.',
    'image_filename' => 'cloud-sea-figure.jpg',
], $base, 'et-page-hero--compact' ); ?>

<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-content et-reveal" style="max-width:780px;margin:0 auto;">

            <p><strong>Last updated:</strong> <?php echo esc_html( gmdate( 'F Y' ) ); ?></p>

            <p>These Terms &amp; Conditions ("Terms") govern your booking and use of services provided by Elite Tours Ireland ("we", "us", "our"). By booking a tour, retaining our services, or using this website, you confirm that you have read, understood, and agreed to these Terms.</p>

            <h2>1. About us</h2>
            <p>Elite Tours Ireland is a privately operated tour company providing bespoke private tours, golf tours, and curated travel experiences across Ireland and Northern Ireland.</p>

            <h2>2. Booking &amp; confirmation</h2>
            <p>An enquiry through this website or by email does not constitute a confirmed booking. A booking is confirmed only when:</p>
            <ul>
                <li>We have issued a written itinerary and pricing.</li>
                <li>You have agreed in writing to the proposed itinerary.</li>
                <li>The required deposit has been received and cleared (see Payment below).</li>
            </ul>

            <h2>3. Payment</h2>
            <ul>
                <li>A non-refundable deposit (typically 25% of the total tour price, exact amount stated on your written itinerary) is due to confirm the booking.</li>
                <li>The balance is due no later than 60 days before the tour start date, unless otherwise agreed in writing.</li>
                <li>Bookings made within 60 days of the tour start date require payment in full at the time of confirmation.</li>
                <li>Payment is accepted by bank transfer or by major credit card via our regulated payment provider. Card payments may incur a transaction fee, which will be disclosed at the time of payment.</li>
            </ul>

            <h2>4. Cancellation by you</h2>
            <p>If you need to cancel, the following charges apply, calculated against the total tour price:</p>
            <ul>
                <li>More than 90 days before tour start: deposit only.</li>
                <li>60–90 days before: 50% of total tour price.</li>
                <li>30–60 days before: 75% of total tour price.</li>
                <li>Less than 30 days before: 100% of total tour price.</li>
            </ul>
            <p>Some third-party bookings (hotels, golf courses, special-access experiences) may be subject to stricter cancellation conditions which we will disclose at the time of booking. We strongly recommend comprehensive travel insurance.</p>

            <h2>5. Cancellation by us</h2>
            <p>In the unlikely event we need to cancel a confirmed tour for reasons within our control, we will offer either a full refund or a comparable alternative date.</p>

            <h2>6. Force majeure</h2>
            <p>We are not liable for cancellations, delays, or changes caused by events beyond our reasonable control, including but not limited to: extreme weather, natural disasters, pandemics, government actions, transport strikes, civil disturbance, or acts of terrorism. In such cases we will use reasonable endeavours to provide alternatives but cannot guarantee refunds for third-party services already incurred.</p>

            <h2>7. Travel insurance</h2>
            <p>Comprehensive travel insurance is strongly recommended and is your responsibility to arrange. Your insurance should cover trip cancellation, medical emergencies, baggage, and any specific activities planned (e.g. golf, equestrian, hiking).</p>

            <h2>8. Passports, visas, and health</h2>
            <p>It is your responsibility to ensure that you have a valid passport, the necessary visas, and any required health documentation for travel to and within Ireland and Northern Ireland.</p>

            <h2>9. Behaviour &amp; conduct</h2>
            <p>We reserve the right to refuse to continue any service where a guest's behaviour endangers the safety, comfort, or enjoyment of other guests, our staff, or the public, or where it damages property. Costs incurred from such refusal are non-refundable.</p>

            <h2>10. Liability</h2>
            <ul>
                <li>We act as an agent in arranging accommodation, transport, and experiences with independent third-party suppliers. We are not liable for the acts or omissions of those suppliers.</li>
                <li>Our liability for any direct loss is limited to the total tour price paid.</li>
                <li>We accept no liability for indirect or consequential losses.</li>
                <li>Nothing in these Terms limits liability for personal injury or death caused by our negligence, or for any other liability that cannot be limited under Irish law.</li>
            </ul>

            <h2>11. Intellectual property</h2>
            <p>All content on this website — text, photography, design, and trademarks — is the property of Elite Tours Ireland or used with permission. Personal, non-commercial use is permitted; reuse of any material in any form requires our prior written consent.</p>

            <h2>12. Privacy</h2>
            <p>Our handling of your personal data is governed by our <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>.</p>

            <h2>13. Governing law</h2>
            <p>These Terms are governed by the laws of Ireland. Any disputes will be subject to the exclusive jurisdiction of the Irish courts.</p>

            <h2>14. Changes to these Terms</h2>
            <p>We may update these Terms from time to time. The version published on this page at the time you make your booking will apply to that booking.</p>

            <h2>15. Contact</h2>
            <p>For any questions about these Terms or your booking, please contact us at <a href="mailto:<?php echo esc_attr( $site_email ); ?>"><?php echo esc_html( $site_email ); ?></a>.</p>

            <hr>
            <p style="font-size:13px;color:var(--et-grey);font-style:italic;">These Terms are provided as a working draft. Elite Tours Ireland recommends a final review by a qualified Irish travel-law solicitor before publication, particularly the cancellation, liability, and force-majeure clauses, which should be tuned to current Irish travel-law and consumer-protection requirements.</p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
