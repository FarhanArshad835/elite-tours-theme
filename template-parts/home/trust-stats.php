<?php
defined( 'ABSPATH' ) || exit;

$items = [
    [
        'icon'  => et_hp( 'stats_1_icon',  'star' ),
        'label' => et_hp( 'stats_1_label', 'Since 1973' ),
        'desc'  => et_hp( 'stats_1_desc',  'Over five decades of private touring' ),
    ],
    [
        'icon'  => et_hp( 'stats_2_icon',  'pin' ),
        'label' => et_hp( 'stats_2_label', 'Deep Local Knowledge' ),
        'desc'  => et_hp( 'stats_2_desc',  'Ireland brought to life through storytelling' ),
    ],
    [
        'icon'  => et_hp( 'stats_3_icon',  'shield' ),
        'label' => et_hp( 'stats_3_label', 'Trusted by Premium Travellers' ),
        'desc'  => et_hp( 'stats_3_desc',  'Discretion, professionalism, reliability' ),
    ],
    [
        'icon'  => et_hp( 'stats_4_icon',  'check' ),
        'label' => et_hp( 'stats_4_label', 'Every Detail Handled' ),
        'desc'  => et_hp( 'stats_4_desc',  'Door-to-door, from first conversation to last day' ),
    ],
];
?>

<section class="et-stats" id="et-stats">
    <div class="et-container">
        <div class="et-stats__grid">

            <?php foreach ( $items as $i => $item ) : ?>
            <div class="et-stats__item">
                <div class="et-stats__icon"><?php echo et_get_icon( esc_attr( $item['icon'] ) ); ?></div>
                <div class="et-stats__body">
                    <span class="et-stats__label"><?php echo esc_html( $item['label'] ); ?></span>
                    <span class="et-stats__desc"><?php echo esc_html( $item['desc'] ); ?></span>
                </div>
            </div>
            <?php if ( $i < 3 ) : ?>
            <div class="et-stats__divider"></div>
            <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
</section>
