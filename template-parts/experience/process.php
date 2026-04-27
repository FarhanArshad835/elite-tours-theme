<?php
/**
 * Experience Funnel — Section 5: Process (Method)
 * Two-column on dark evergreen.
 * Left: bordered card listing 4 process steps (with double-border decoration).
 * Right: large heading + body + 2-image grid + From/Length/Group facts.
 */
defined( 'ABSPATH' ) || exit;

$f = $args['funnel'] ?? [];

$steps = $f['process_steps'] ?? [];
if ( empty( $steps ) ) return;

$label   = $f['process_label']   ?? 'The Process';
$number  = $f['process_number']  ?? '04';

$card_eyebrow  = $f['process_card_eyebrow']  ?? 'The Method';
$card_title    = $f['process_card_title']    ?? 'How a Journey is Built';
$card_subtitle = $f['process_card_subtitle'] ?? '';

$aside_h1 = $f['process_aside_heading_part1'] ?? '';
$aside_h2 = $f['process_aside_heading_part2'] ?? '';
$aside_body = $f['process_aside_body'] ?? '';

$img1_id = (int) ( $f['process_image_1'] ?? 0 );
$img2_id = (int) ( $f['process_image_2'] ?? 0 );
$img1_url = $img1_id ? wp_get_attachment_image_url( $img1_id, 'large' ) : '';
$img2_url = $img2_id ? wp_get_attachment_image_url( $img2_id, 'large' ) : '';

$facts = $f['process_facts'] ?? [];

$texture_url = get_template_directory_uri() . '/assets/images/texture.png';
?>
<section class="et-exp__process">
    <div class="et-exp__process-texture" style="background-image:url('<?php echo esc_url( $texture_url ); ?>');" aria-hidden="true"></div>
    <div class="et-exp__process-inner">
        <div class="et-exp__process-card">
            <div class="et-exp__process-card-head">
                <?php if ( $card_eyebrow ) : ?>
                    <div class="eyebrow gold et-exp__process-card-eyebrow"><?php echo esc_html( $card_eyebrow ); ?></div>
                <?php endif; ?>
                <?php if ( $card_title ) : ?>
                    <div class="et-exp__process-card-title"><?php echo esc_html( $card_title ); ?></div>
                <?php endif; ?>
                <?php if ( $card_subtitle ) : ?>
                    <div class="et-exp__process-card-sub"><?php echo esc_html( $card_subtitle ); ?></div>
                <?php endif; ?>
                <div class="et-exp__process-card-rule"></div>
            </div>

            <?php foreach ( $steps as $s ) :
                $n     = $s['number'] ?? '';
                $title = $s['title']  ?? '';
                $body  = $s['body']   ?? '';
                if ( ! $title && ! $body ) continue;
            ?>
                <div class="et-exp__process-step">
                    <div class="et-exp__process-step-num"><?php echo esc_html( $n ); ?></div>
                    <div>
                        <?php if ( $title ) : ?>
                            <h4 class="et-exp__process-step-title"><?php echo esc_html( $title ); ?></h4>
                        <?php endif; ?>
                        <?php if ( $body ) : ?>
                            <p class="et-exp__process-step-body"><?php echo esc_html( $body ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div>
            <?php if ( $aside_h1 || $aside_h2 ) : ?>
                <h2 class="et-exp__process-aside-heading">
                    <?php if ( $aside_h1 ) : ?>
                        <?php echo esc_html( $aside_h1 ); ?><?php if ( $aside_h2 ) echo '<br>'; ?>
                    <?php endif; ?>
                    <?php if ( $aside_h2 ) : ?>
                        <span class="et-exp__process-aside-heading-em"><?php echo esc_html( $aside_h2 ); ?></span>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>

            <?php if ( $aside_body ) : ?>
                <p class="et-exp__process-aside-body"><?php echo esc_html( $aside_body ); ?></p>
            <?php endif; ?>

            <?php if ( $img1_url || $img2_url ) : ?>
                <div class="et-exp__process-aside-images">
                    <?php if ( $img1_url ) : ?>
                        <img src="<?php echo esc_url( $img1_url ); ?>" alt="">
                    <?php endif; ?>
                    <?php if ( $img2_url ) : ?>
                        <img src="<?php echo esc_url( $img2_url ); ?>" alt="">
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $facts ) ) : ?>
                <div class="et-exp__process-aside-facts">
                    <?php foreach ( $facts as $fact ) :
                        $flabel = $fact['label'] ?? '';
                        $fvalue = $fact['value'] ?? '';
                        if ( ! $flabel && ! $fvalue ) continue;
                    ?>
                        <div>
                            <div class="et-exp__process-aside-fact-label"><?php echo esc_html( $flabel ); ?></div>
                            <div class="et-exp__process-aside-fact-value"><?php echo esc_html( $fvalue ); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
