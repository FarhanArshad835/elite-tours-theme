<?php
defined( 'ABSPATH' ) || exit;

$proc_label   = et_hp( 'process_label',   'The Process' );
$proc_heading = et_hp( 'process_heading', 'Your Journey, From First Conversation to Final Day.' );
$proc_cta_text = et_hp( 'process_cta_text', 'Start Planning Your Journey' );
$proc_cta_url  = et_hp( 'process_cta_url',  home_url( '/contact/' ) );

$steps = [
    [
        'num'   => et_hp( 'step_1_num',   '01' ),
        'title' => et_hp( 'step_1_title', 'We Listen' ),
        'desc'  => et_hp( 'step_1_desc',  "Tell us who you are, what matters to you, and what you're hoping to feel. No forms. A real conversation." ),
    ],
    [
        'num'   => et_hp( 'step_2_num',   '02' ),
        'title' => et_hp( 'step_2_title', 'We Design' ),
        'desc'  => et_hp( 'step_2_desc',  'We create a bespoke itinerary built entirely around you. Your interests, your family, your pace.' ),
    ],
    [
        'num'   => et_hp( 'step_3_num',   '03' ),
        'title' => et_hp( 'step_3_title', 'We Handle Everything' ),
        'desc'  => et_hp( 'step_3_desc',  "From accommodation to access, transfers to timing, every detail is managed, so you don't have to think about a thing." ),
    ],
    [
        'num'   => et_hp( 'step_4_num',   '04' ),
        'title' => et_hp( 'step_4_title', 'You Experience Ireland Properly' ),
        'desc'  => et_hp( 'step_4_desc',  'Arrive as a visitor. Leave with a deeper connection to Ireland, and often, a lifelong friend.' ),
    ],
];
?>

<section class="et-process" id="et-process">
    <div class="et-container">

        <div class="et-process__header">
            <span class="et-label"><?php echo esc_html( $proc_label ); ?></span>
            <h2 class="et-process__heading"><?php echo wp_kses( $proc_heading, [ 'br' => [] ] ); ?></h2>
        </div>

        <div class="et-process__steps">
            <?php foreach ( $steps as $i => $step ) : ?>
            <div class="et-process__step">
                <span class="et-process__num"><?php echo esc_html( $step['num'] ); ?></span>
                <h3 class="et-process__title"><?php echo esc_html( $step['title'] ); ?></h3>
                <p class="et-process__desc"><?php echo esc_html( $step['desc'] ); ?></p>
                <?php if ( $i < count( $steps ) - 1 ) : ?>
                    <div class="et-process__connector" aria-hidden="true"></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="et-process__cta">
            <a href="<?php echo esc_url( $proc_cta_url ); ?>" class="et-btn et-btn--primary et-btn--lg">
                <?php echo esc_html( $proc_cta_text ); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
</section>
