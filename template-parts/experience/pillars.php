<?php
/**
 * Experience Funnel — Section 4: Pillars (Three Threads)
 * 3-column grid. Each pillar: image + Roman numeral + eyebrow + title + body.
 */
defined( 'ABSPATH' ) || exit;

$f = $args['funnel'] ?? [];

$pillars = $f['pillars'] ?? [];
if ( empty( $pillars ) ) return;

$label    = $f['pillars_label']    ?? 'The Three Threads';
$number   = $f['pillars_number']   ?? '03';
$heading1 = $f['pillars_heading_part1'] ?? '';
$heading2 = $f['pillars_heading_part2'] ?? '';
$sub      = $f['pillars_subheading'] ?? '';
$intro    = $f['pillars_intro']    ?? '';

$romans = [ 'I', 'II', 'III', 'IV', 'V' ];
?>
<section class="et-exp__pillars">
    <div class="et-exp__pillars-inner">
        <div class="et-exp__pillars-head">
            <div>
                <?php if ( $heading1 || $heading2 ) : ?>
                    <h2 class="et-exp__pillars-heading">
                        <?php if ( $heading1 ) : ?>
                            <?php echo esc_html( $heading1 ); ?><?php if ( $heading2 ) echo '<br>'; ?>
                        <?php endif; ?>
                        <?php if ( $heading2 ) : ?>
                            <span class="et-exp__pillars-heading-em"><?php echo esc_html( $heading2 ); ?></span>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>
                <?php if ( $sub ) : ?>
                    <div class="et-exp__pillars-subheading"><?php echo esc_html( $sub ); ?></div>
                <?php endif; ?>
            </div>
            <?php if ( $intro ) : ?>
                <p class="et-exp__pillars-intro"><?php echo esc_html( $intro ); ?></p>
            <?php endif; ?>
        </div>

        <div class="et-exp__pillars-grid">
            <?php foreach ( $pillars as $i => $p ) :
                $name  = $p['pillar'] ?? '';
                $title = $p['title']  ?? '';
                $body  = $p['body']   ?? '';
                $img_id = (int) ( $p['image_id'] ?? 0 );
                $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
                if ( ! $name && ! $title ) continue;
                $r = $romans[ $i ] ?? (string) ( $i + 1 );
            ?>
                <div>
                    <?php if ( $img_url ) : ?>
                        <img class="et-exp__pillar-img" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $name ); ?>">
                    <?php endif; ?>
                    <div class="et-exp__pillar-meta">
                        <span class="et-exp__pillar-num"><?php echo esc_html( $r ); ?></span>
                        <?php if ( $name ) : ?>
                            <span class="eyebrow"><?php echo esc_html( $name ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ( $title ) : ?>
                        <h3 class="et-exp__pillar-title"><?php echo esc_html( $title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $body ) : ?>
                        <p class="et-exp__pillar-body"><?php echo esc_html( $body ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
