<?php
/**
 * Template Name: About Us
 *
 * Rebuilt 2026-04-27 around the brand DNA brief from the client:
 *   - Hero & headline lean into "Ireland, through Ray." as the central angle.
 *   - Replaced the old Core Values list with The DNA of Elite Tours (five
 *     pillars from the brief: Hosted / Insider / Emotion-led / Ray-is-the-product
 *     / Controlled Luxury).
 *   - Added a Signature Moments section — six moment categories with
 *     specific named locations, the marketing-gold from the brief.
 *   - Differentiator table tightened with the "done properly" anti-tourism
 *     positioning.
 */
defined( 'ABSPATH' ) || exit;
get_header();
$base = get_template_directory_uri() . '/assets/images/';
$founder_img = $base . 'founder-ray-mulally.jpg';
?>

<!-- Hero -->
<section class="et-page-hero">
    <div class="et-page-hero__bg" style="background-image:url('<?php echo esc_url( $base . 'kylemore-abbey.jpg' ); ?>')"></div>
    <div class="et-page-hero__overlay"></div>
    <div class="et-container">
        <div class="et-page-hero__content et-reveal">
            <h1 class="et-page-hero__title">Ireland, through Ray.</h1>
            <p class="et-page-hero__sub">Elite Tours is not a tour company. It is a privately hosted experience of Ireland — built on more than fifty years of relationships across the country, and led personally by Ray himself.</p>
        </div>
    </div>
</section>

<!-- Origin Story / The Anti-Tourism Angle -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-two-col">
            <div class="et-reveal">
                <div class="et-section__header">
                    <h2 class="et-section__title">Most people visit Ireland.<br>Very few experience it properly.</h2>
                </div>
                <div class="et-content">
                    <p>For many visitors, a trip to Ireland is one of the most meaningful journeys of their lives — a connection to ancestry, a long-held dream, a trip planned for years. Yet so often, the experience falls short. Rushed itineraries. Group buses. The Guinness Storehouse. Volume over meaning.</p>
                    <p>Elite Tours was built to be the alternative. Founded by Raphael Mulally — Ray — on decades of experience and a deep pride in the country, every journey is shaped by a single belief: clients deserve more than a tour. They deserve to feel completely looked after, understood, and genuinely connected to Ireland itself.</p>
                    <p>We are not a big operation. We don't want to be. We are a small, carefully run company that delivers an exceptional level of personal service, because that is the only way we know how to work — and the only way Ireland is properly understood.</p>
                    <p><em>The Ireland most people never see. Done properly.</em></p>
                </div>
            </div>
            <div class="et-reveal">
                <img src="<?php echo esc_url( $base . 'castle-hillside.jpg' ); ?>" alt="Ireland landscape" style="width:100%;height:480px;object-fit:cover;border-radius:6px;">
            </div>
        </div>
    </div>
</section>

<!-- Founder Feature — Ray IS the Product -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-founder-feature et-reveal">
            <img src="<?php echo esc_url( $founder_img ); ?>" alt="Raphael Mulally, Founder" class="et-founder-feature__img">
            <div>
                <div class="et-section__header">
                    <h2 class="et-section__title">Raphael Mulally</h2>
                    <p class="et-section__subtitle">Founder, host &amp; the Irish connection</p>
                </div>
                <div class="et-content">
                    <p>The product is not the route, the hotels, or the itinerary. It is Ray's perspective, his relationships, his storytelling, and his instinct — built across more than fifty years on these roads.</p>
                    <p>Ray knows everyone. Shop owners, local guides, the publican who'll open for a private after-hours visit, the cousin still on the family land. He is — to use his own word — a chameleon: equally at home pouring whiskey in a Donegal bar and seating clients at a long Dublin lunch. Clients are not processed; they are personally hosted, from the first conversation to the last goodbye.</p>
                    <p>Every Bespoke is designed by Ray himself. He still drives. He still tells the stories. He still sings, when the moment calls for it. <strong>No Ray, no Elite Tours.</strong> That has been the deal from the beginning, and it is what makes this company impossible to copy.</p>
                </div>
                <div class="et-founder-feature__quote">
                    "I've spent decades helping people experience Ireland in a truly personal way. The most memorable moments are usually the ones you never see coming."
                    <br><small style="color:var(--et-grey);font-style:normal;">Raphael Mulally · Founder, Elite Tours Ireland</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- The DNA of Elite Tours — five pillars from the brief -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <p class="et-section__eyebrow">The DNA</p>
            <h2 class="et-section__title">What separates Elite Tours from every other "Ireland tour".</h2>
        </div>
        <div class="et-values-grid">
            <?php
            $dna = [
                [ 'title' => 'Hosted Ireland, not guided',
                  'desc'  => 'You aren\'t guided through Ireland — you are personally hosted. Ray is not a driver; he is the Irish connection. The trip is not scheduled — it is felt and adapted in real time.' ],
                [ 'title' => 'Insider Ireland, not tourist Ireland',
                  'desc'  => 'No Guinness Storehouse. No gift-shop stops. The right entrance, the right pub, the right person — every time. Where the buses don\'t go. Who the tourists don\'t meet.' ],
                [ 'title' => 'Emotion-led, not location-led',
                  'desc'  => 'Most tours sell Cliffs of Moher and Ring of Kerry. Ray delivers the silence moment that follows them — goosebumps, pride in heritage, a feeling that you\'ve gone from observer to participant.' ],
                [ 'title' => 'Ray <em>is</em> the product',
                  'desc'  => 'Fifty-plus years on these roads, an unmatched book of relationships, an ear for what each guest actually wants to feel. The unfair advantage. No Ray — no Elite Tours.' ],
                [ 'title' => 'Controlled luxury — not sterilised',
                  'desc'  => 'Five-star castles paired with the right village pub at the end of the day. Premium without losing soul. Authentic without losing comfort. The sweet spot most luxury operators miss.' ],
            ];
            foreach ( $dna as $v ) : ?>
            <div class="et-value et-reveal">
                <div class="et-value__title"><?php echo wp_kses( $v['title'], [ 'em' => [] ] ); ?></div>
                <div class="et-value__desc"><?php echo esc_html( $v['desc'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Signature Moments — the marketing gold -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <p class="et-section__eyebrow">Signature Moments</p>
            <h2 class="et-section__title">The moments most people miss.</h2>
            <p class="et-section__subtitle">Some moments will never appear on an itinerary. They are not listed, not planned in advance, and not shared publicly — these are the ones we live for.</p>
        </div>
        <div class="et-values-grid">
            <?php
            $moments = [
                [ 'title' => 'The First Conversation',
                  'desc'  => 'Sitting down with Ray at the start of the journey — setting expectations, understanding dreams, finding the personal connection. This is not logistics. This is emotional anchoring. <em>Your journey begins with a conversation, not a schedule.</em>' ],
                [ 'title' => 'Silence Moments',
                  'desc'  => 'The cliffs from the right angle (the Doolin ferry under them, not the bus-tour viewing platform). The Dingle Peninsula viewpoint before Inch Beach. O\'Connor\'s Pass overlooking Tralee Bay. Donegal coastline. The kind of moments you remember for the rest of your life.' ],
                [ 'title' => 'Local Immersion',
                  'desc'  => 'Sean\'s Bar in Athlone — the oldest pub in Ireland — for whiskey storytelling. Kane\'s Bar with a 12-year and the view. Foxy John\'s in Dingle. The Ivy Bar in Doolin for chowder. The kind of stops where you stop feeling like a tourist.' ],
                [ 'title' => 'Story-Driven History',
                  'desc'  => 'EPIC Centre for the real Irish emigration story (not the Guinness version). The Derry walking tour with Bloody Sunday context. The Cobh Titanic & Lusitania truth. Clonmacnoise — the High Kings\' burial ground. The visits where you finally understand Ireland.' ],
                [ 'title' => 'Ray Knows Everyone',
                  'desc'  => 'Private walking tours with Michael Martin in Cobh and Brian Kelly in Dublin. Shop owners, locals, characters introduced by name. Access most travellers will never get on their own. Status, but the kind built on relationships, not bookings.' ],
                [ 'title' => 'Done Properly',
                  'desc'  => 'Entering the Cliffs of Moher the right way. Avoiding the tourist-bus timing. Macroom backroads. The Kerry coastline that isn\'t on the postcards. The expert authority that comes from doing this for fifty-plus years on the same roads.' ],
            ];
            foreach ( $moments as $m ) : ?>
            <div class="et-value et-reveal">
                <div class="et-value__title"><?php echo esc_html( $m['title'] ); ?></div>
                <div class="et-value__desc"><?php echo wp_kses( $m['desc'], [ 'em' => [] ] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Differentiator Table — the "instead of this / we offer this" punch -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">What makes us different.</h2>
            <p class="et-section__subtitle">Most people do Ireland wrong. We take you the right way.</p>
        </div>
        <div class="et-reveal" style="max-width:760px;margin:0 auto;">
            <table class="et-compare">
                <thead><tr><th>Instead of this</th><th>We offer this</th></tr></thead>
                <tbody>
                    <tr><td>Group tours that move people around in coaches</td><td>A privately hosted journey, end-to-end, designed around you</td></tr>
                    <tr><td>Drivers who get you from A to B</td><td>An Irish host who tells the stories, opens the doors, and stays with you the whole way</td></tr>
                    <tr><td>The Guinness Storehouse and the gift-shop circuit</td><td>EPIC Museum, Sean's Bar, the after-hours visits — the Ireland most travellers never see</td></tr>
                    <tr><td>Cold, corporate luxury — five-star and sterilised</td><td>Five-star where it counts, paired with the right village pub at the end of the day</td></tr>
                    <tr><td>Fixed itineraries, set in stone</td><td>Built from a conversation, designed from scratch every time, adaptable in real time</td></tr>
                    <tr><td>Volume over meaning</td><td>Meaning above everything</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Affiliations -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Trusted &amp; accredited.</h2>
            <p class="et-section__subtitle">Decades of partnerships with the bodies that vouch for Irish hospitality.</p>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;gap:40px;flex-wrap:wrap;opacity:0.7;" class="et-reveal">
            <img src="<?php echo esc_url( $base . 'trust/tripadvisor.svg' ); ?>" alt="TripAdvisor" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/failte-ireland.png' ); ?>" alt="Failte Ireland" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/asta.png' ); ?>" alt="ASTA" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/iagto.jpg' ); ?>" alt="IAGTO" style="height:28px;width:auto;background:#fff;padding:3px 6px;border-radius:4px;">
        </div>
    </div>
</section>

<!-- CTA -->
<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Every journey begins with a conversation.</h2>
            <p class="et-section__subtitle">Tell us a name, a region, a curiosity, a feeling — we'll write back within a working day.</p>
        </div>
        <div style="text-align:center;" class="et-reveal">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Begin Your First Conversation</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
