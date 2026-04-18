<?php
/**
 * Template Name: About Us
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
            <h1 class="et-page-hero__title">Built on a Belief That People Deserve Better</h1>
            <p class="et-page-hero__sub">Elite Tours was founded on a simple idea: people coming to Ireland deserve to be truly looked after.</p>
        </div>
    </div>
</section>

<!-- Origin Story -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-two-col">
            <div class="et-reveal">
                <div class="et-section__header">
                    <h2 class="et-section__title">How Elite Tours Began</h2>
                </div>
                <div class="et-content">
                    <p>For many visitors, a trip to Ireland is one of the most meaningful journeys of their lives. It might be a connection to ancestry. A lifelong dream. A trip planned for years.</p>
                    <p>Yet so often, that experience falls short. Rushed itineraries. Impersonal service. Volume over meaning.</p>
                    <p>Elite Tours was built to be the alternative.</p>
                    <p>Founded by Raphael Mulally, Elite Tours was built on decades of experience and a deep pride in Ireland, its history, its landscape, its people, and its hospitality. Every journey we create is shaped by a single belief: that clients deserve more than a tour. They deserve to feel completely looked after, understood, and genuinely connected to the country.</p>
                    <p>We are not a big operation. We don't want to be. We are a small, carefully run company that delivers an exceptional level of personal service, because that is the only way we know how to work.</p>
                </div>
            </div>
            <div class="et-reveal">
                <img src="<?php echo esc_url( $base . 'castle-hillside.jpg' ); ?>" alt="Ireland landscape" style="width:100%;height:480px;object-fit:cover;border-radius:6px;">
            </div>
        </div>
    </div>
</section>

<!-- Founder Feature -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-founder-feature et-reveal">
            <img src="<?php echo esc_url( $founder_img ); ?>" alt="Raphael Mulally, Founder" class="et-founder-feature__img">
            <div>
                <div class="et-section__header">
                    <h2 class="et-section__title">Raphael Mulally</h2>
                    <p class="et-section__subtitle">Founder, Elite Tours Ireland</p>
                </div>
                <div class="et-content">
                    <p>Ray has spent decades guiding people through Ireland, not just showing them the country, but helping them feel it.</p>
                    <p>His ability to read people, anticipate needs, and create moments that feel genuinely personal is what defines the Elite Tours experience. Every journey we deliver is shaped by Ray's personal standard of care.</p>
                    <p>Clients are not processed. They are hosted. And the difference is felt from the first conversation to the last goodbye.</p>
                </div>
                <div class="et-founder-feature__quote">
                    "I've spent decades helping people experience Ireland in a truly personal way. That hasn't changed. It never will."
                    <br><small style="color:var(--et-grey);font-style:normal;">Raphael Mulally</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">What We Stand For</h2>
        </div>
        <div class="et-values-grid">
            <?php
            $values = [
                [ 'title' => 'Personal Service Above All', 'desc' => 'Every client is treated as an individual. No two tours are ever the same.' ],
                [ 'title' => 'Warmth & Humanity', 'desc' => 'Service that is never cold or corporate. Warm, real, and human.' ],
                [ 'title' => 'Bespoke Experience', 'desc' => 'Every tour is purpose-built for the people taking it. Always.' ],
                [ 'title' => 'Integrity', 'desc' => 'Respect for where work comes from, honesty in service, doing things the right way.' ],
                [ 'title' => 'Attention to Detail', 'desc' => 'The difference between good and exceptional lies in the details, and nothing is overlooked.' ],
                [ 'title' => 'Pride in Ireland', 'desc' => "A deep respect for Ireland, its history, and its people, shared through every experience." ],
            ];
            foreach ( $values as $v ) : ?>
            <div class="et-value et-reveal">
                <div class="et-value__title"><?php echo esc_html( $v['title'] ); ?></div>
                <div class="et-value__desc"><?php echo esc_html( $v['desc'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Differentiator Table -->
<section class="et-section et-section--offwhite">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">What Makes Us Different</h2>
        </div>
        <div class="et-reveal" style="max-width:720px;margin:0 auto;">
            <table class="et-compare">
                <thead><tr><th>Instead of this</th><th>We offer this</th></tr></thead>
                <tbody>
                    <tr><td>Group tours that move people around</td><td>Private journeys built around the individual</td></tr>
                    <tr><td>Drivers who get you from A to B</td><td>A host who knows the country and how to look after people</td></tr>
                    <tr><td>Cold, corporate luxury</td><td>Warm, personal, genuinely Irish hospitality</td></tr>
                    <tr><td>Fixed itineraries</td><td>Designed from scratch, every time</td></tr>
                    <tr><td>Volume over meaning</td><td>Meaning above everything</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Affiliations -->
<section class="et-section et-section--white">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Trusted & Accredited</h2>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;gap:40px;flex-wrap:wrap;opacity:0.6;" class="et-reveal">
            <img src="<?php echo esc_url( $base . 'trust/tripadvisor.svg' ); ?>" alt="TripAdvisor" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/failte-ireland.png' ); ?>" alt="Failte Ireland" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/asta.png' ); ?>" alt="ASTA" style="height:28px;width:auto;">
            <img src="<?php echo esc_url( $base . 'trust/iagto.jpg' ); ?>" alt="IAGTO" style="height:28px;width:auto;">
        </div>
    </div>
</section>

<!-- CTA -->
<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Talk to Us About Your Journey</h2>
            <p class="et-section__subtitle">There are no fixed packages. Just a real conversation.</p>
        </div>
        <div style="text-align:center;" class="et-reveal">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Plan Your Journey</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
