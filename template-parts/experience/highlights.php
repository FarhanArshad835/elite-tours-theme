<?php
/**
 * Experience Funnel — Section 2: Highlights (V2 — image cards, 4-col)
 * Header row: section heading on left, intro paragraph on right.
 * Below: 4 cards each with an image, top-border + number + "No. NN", title, body.
 */
defined( 'ABSPATH' ) || exit;

$f = $args['funnel'] ?? [];

$items = $f['highlights'] ?? [];
if ( empty( $items ) ) return;

$label   = $f['highlights_label']   ?? 'The Experience at a Glance';
$heading = $f['highlights_heading'] ?? 'Highlights.';
$intro   = $f['highlights_intro']   ?? '';
?>
<section class="et-exp__highlights">
    <div class="et-exp__highlights-inner">
        <div class="et-exp__highlights-head">
            <div>
                <h2 class="et-exp__highlights-heading"><?php echo esc_html( $heading ); ?></h2>
            </div>
            <?php if ( $intro ) : ?>
                <p class="et-exp__highlights-intro"><?php echo esc_html( $intro ); ?></p>
            <?php endif; ?>
        </div>

        <div class="et-exp__highlights-grid">
            <?php foreach ( $items as $i => $h ) :
                $title_h = $h['title'] ?? '';
                $desc_h  = $h['desc']  ?? '';
                if ( ! $title_h && ! $desc_h ) continue;

                $img_id  = (int) ( $h['image_id'] ?? 0 );
                $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
            ?>
                <article class="et-exp__highlight">
                    <?php if ( $img_url ) : ?>
                        <div class="et-exp__highlight-img-wrap">
                            <img class="et-exp__highlight-img"
                                 src="<?php echo esc_url( $img_url ); ?>"
                                 alt="<?php echo esc_attr( $title_h ); ?>">
                        </div>
                    <?php endif; ?>
                    <h3 class="et-exp__highlight-title"><?php echo esc_html( $title_h ); ?></h3>
                    <?php if ( $desc_h ) : ?>
                        <p class="et-exp__highlight-desc"><?php echo esc_html( $desc_h ); ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
