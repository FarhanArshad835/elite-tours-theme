<?php
/**
 * Template Name: Privacy Policy
 *
 * Phase 8 — pre-launch placeholder. Client must have a solicitor review and
 * adjust before going public. Fields marked [REVIEW] need confirmation.
 */
defined( 'ABSPATH' ) || exit;
get_header();

$site_email = (function () {
    $opts = get_option( 'et_site_settings', [] );
    return ! empty( $opts['contact_email'] ) ? $opts['contact_email'] : 'concierge@elitetours.ie';
})();
$site_address = (function () {
    $opts = get_option( 'et_site_settings', [] );
    return ! empty( $opts['address'] ) ? $opts['address'] : '[REVIEW] Elite Tours Ireland, Co. Mayo, Ireland';
})();
?>

<section class="et-page-hero et-page-hero--compact" style="min-height:340px;">
    <div class="et-page-hero__bg" style="background:linear-gradient(135deg,#1a4f31 0%,#0d2818 100%);"></div>
    <div class="et-container">
        <div class="et-page-hero__content et-reveal">
            <h1 class="et-page-hero__title">Privacy Policy</h1>
            <p class="et-page-hero__sub">How we collect, use, and protect your personal data.</p>
        </div>
    </div>
</section>

<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-content et-reveal" style="max-width:780px;margin:0 auto;">

            <p><strong>Last updated:</strong> <?php echo esc_html( gmdate( 'F Y' ) ); ?></p>

            <p>Elite Tours Ireland ("we", "us", "our") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, store, and protect any personal data you share with us when you contact us, browse this website, or travel with us. By using this site or our services, you agree to the practices described in this policy.</p>

            <h2>1. Who we are</h2>
            <p>Elite Tours Ireland is a privately operated tour company based in Ireland.</p>
            <ul>
                <li>Postal address: <?php echo esc_html( $site_address ); ?></li>
                <li>Contact email: <a href="mailto:<?php echo esc_attr( $site_email ); ?>"><?php echo esc_html( $site_email ); ?></a></li>
                <li>Data Controller: Elite Tours Ireland</li>
            </ul>

            <h2>2. What personal data we collect</h2>
            <p>Depending on how you interact with us, we may collect the following:</p>
            <ul>
                <li><strong>Contact details:</strong> name, email address, phone number, postal address.</li>
                <li><strong>Travel details:</strong> party size, travel dates, accommodation preferences, dietary requirements, mobility needs, ancestry information you choose to share for heritage research.</li>
                <li><strong>Payment details:</strong> billing address and payment information, processed by our regulated payment provider — we do not store full card numbers on our own systems.</li>
                <li><strong>Website usage:</strong> IP address, browser type, pages visited, and similar standard analytics, collected via cookies and server logs.</li>
            </ul>

            <h2>3. How we use your data</h2>
            <ul>
                <li>To respond to enquiries and design your bespoke itinerary.</li>
                <li>To make bookings on your behalf with hotels, restaurants, golf courses, guides, and other suppliers.</li>
                <li>To process payments and issue invoices.</li>
                <li>To send service updates relating to your trip.</li>
                <li>To improve this website and our services.</li>
                <li>To send marketing communications, only with your explicit opt-in. You can unsubscribe at any time.</li>
            </ul>

            <h2>4. Legal basis for processing</h2>
            <p>We process your personal data on the following legal bases under the General Data Protection Regulation (GDPR):</p>
            <ul>
                <li><strong>Performance of a contract</strong> — to deliver the tour or service you have booked.</li>
                <li><strong>Legitimate interest</strong> — to operate and improve our business.</li>
                <li><strong>Consent</strong> — for any marketing communications you have specifically opted into.</li>
                <li><strong>Legal obligation</strong> — for tax, financial, and other regulatory record-keeping.</li>
            </ul>

            <h2>5. Who we share your data with</h2>
            <p>We share only what is necessary to deliver your trip:</p>
            <ul>
                <li>Hotels, restaurants, golf clubs, transport providers, and other suppliers we book on your behalf.</li>
                <li>Professional genealogists where you have engaged us for heritage research.</li>
                <li>Our payment processor for billing.</li>
                <li>Our IT and email service providers, under appropriate data-processing agreements.</li>
                <li>Where required by law (e.g. tax authorities, regulators).</li>
            </ul>
            <p>We do <strong>not</strong> sell your personal data to third parties.</p>

            <h2>6. International transfers</h2>
            <p>Some of our service providers may be based outside the European Economic Area. Where this is the case, we ensure appropriate safeguards are in place (such as Standard Contractual Clauses approved by the European Commission).</p>

            <h2>7. How long we keep your data</h2>
            <p>We keep your data only for as long as necessary:</p>
            <ul>
                <li>Booking and travel records: up to 7 years (for accounting and tax).</li>
                <li>Marketing list: until you unsubscribe.</li>
                <li>Website analytics: typically up to 26 months.</li>
            </ul>

            <h2>8. Your rights</h2>
            <p>Under GDPR, you have the right to:</p>
            <ul>
                <li>Access the personal data we hold about you.</li>
                <li>Request correction of any inaccurate data.</li>
                <li>Request deletion of your data (where we are not legally required to keep it).</li>
                <li>Object to processing or request that we restrict it.</li>
                <li>Request a copy of your data in a portable format.</li>
                <li>Withdraw consent for marketing at any time.</li>
                <li>Lodge a complaint with the Irish Data Protection Commission (<a href="https://www.dataprotection.ie/" rel="noopener noreferrer" target="_blank">dataprotection.ie</a>).</li>
            </ul>
            <p>To exercise any of these rights, contact us at <a href="mailto:<?php echo esc_attr( $site_email ); ?>"><?php echo esc_html( $site_email ); ?></a>.</p>

            <h2>9. Cookies</h2>
            <p>This site uses essential cookies for navigation and analytics cookies to understand how visitors use the site. You can disable cookies in your browser settings, although some features may not work as expected.</p>

            <h2>10. Changes to this policy</h2>
            <p>We may update this policy from time to time. The latest version will always be available on this page, with the "Last updated" date adjusted accordingly.</p>

            <h2>11. Contact</h2>
            <p>For any questions about this policy or how we handle your data, please contact us at <a href="mailto:<?php echo esc_attr( $site_email ); ?>"><?php echo esc_html( $site_email ); ?></a>.</p>

            <hr>
            <p style="font-size:13px;color:var(--et-grey);font-style:italic;">This policy is provided as a working draft. Elite Tours Ireland recommends a final review by a qualified Irish data-protection solicitor before publication, and confirmation of the company's exact legal name and registered address.</p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
