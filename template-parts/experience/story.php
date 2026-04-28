<?php
/**
 * Experience Funnel — Section 3: Story
 * Image stack on left (with rotated "Plate" caption), narrative on right.
 * Ends with two "your people" cards.
 */
defined( 'ABSPATH' ) || exit;

$f = $args['funnel'] ?? [];

$image_main_id   = (int) ( $f['story_image_main']   ?? 0 );
$image_accent_id = (int) ( $f['story_image_accent'] ?? 0 );
$image_main_url  = $image_main_id   ? wp_get_attachment_image_url( $image_main_id,   'large' ) : '';
$image_accent_url= $image_accent_id ? wp_get_attachment_image_url( $image_accent_id, 'large' ) : '';

// At minimum we need the lede paragraph for this section to render.
$lede = $f['story_lede'] ?? '';
if ( ! $lede && ! $image_main_url ) return;

$label    = $f['story_label']    ?? 'The Story';
$number   = $f['story_number']   ?? '02';
$heading1 = $f['story_heading_part1'] ?? '';
$heading2 = $f['story_heading_part2'] ?? '';
$plate    = $f['story_plate']    ?? '';
$para1    = $f['story_para1']    ?? '';
$para2    = $f['story_para2']    ?? '';
$people   = $f['story_people']   ?? [];
$people_label = $f['story_people_label'] ?? 'Your People for the Journey';
?>
<section class="et-exp__story">
    <div class="et-exp__story-inner">
        <div class="et-exp__story-images">
            <?php if ( $image_main_url ) : ?>
                <img class="et-exp__story-img-main"
                     src="<?php echo esc_url( $image_main_url ); ?>"
                     alt="<?php echo esc_attr( get_the_title() ); ?>">
            <?php endif; ?>
            <?php if ( $image_accent_url ) : ?>
                <img class="et-exp__story-img-accent"
                     src="<?php echo esc_url( $image_accent_url ); ?>" alt="">
            <?php endif; ?>
            <?php if ( $plate ) : ?>
                <div class="et-exp__story-plate"><?php echo esc_html( $plate ); ?></div>
            <?php endif; ?>
        </div>

        <div class="et-exp__story-narrative">
            <?php if ( $heading1 || $heading2 ) : ?>
                <h2 class="et-exp__story-heading">
                    <?php if ( $heading1 ) : ?>
                        <?php echo esc_html( $heading1 ); ?><?php if ( $heading2 ) echo '<br>'; ?>
                    <?php endif; ?>
                    <?php if ( $heading2 ) : ?>
                        <span class="et-exp__story-heading-em"><?php echo esc_html( $heading2 ); ?></span>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>

            <?php if ( $lede ) : ?>
                <p class="et-exp__story-lede"><?php echo esc_html( $lede ); ?></p>
            <?php endif; ?>

            <?php if ( $para1 ) : ?>
                <p class="et-exp__story-para"><?php echo esc_html( $para1 ); ?></p>
            <?php endif; ?>
            <?php if ( $para2 ) : ?>
                <p class="et-exp__story-para"><?php echo esc_html( $para2 ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $people ) ) : ?>
                <div class="et-exp__story-rule"></div>
                <div class="eyebrow et-exp__story-people-label"><?php echo esc_html( $people_label ); ?></div>
                <div class="et-exp__story-people">
                    <?php foreach ( $people as $p ) :
                        $name = $p['name'] ?? '';
                        $role = $p['role'] ?? '';
                        $note = $p['note'] ?? '';
                        $alt  = $p['alt']  ?? '';
                        if ( ! $name ) continue;
                    ?>
                        <div class="et-exp__person">
                            <div class="et-exp__person-name"><?php echo esc_html( $name ); ?></div>
                            <?php if ( $alt ) : ?>
                                <div class="et-exp__person-alt"><?php echo esc_html( $alt ); ?></div>
                            <?php endif; ?>
                            <?php if ( $role ) : ?>
                                <div class="eyebrow et-exp__person-role"><?php echo esc_html( $role ); ?></div>
                            <?php endif; ?>
                            <?php if ( $note ) : ?>
                                <p class="et-exp__person-note"><?php echo esc_html( $note ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
