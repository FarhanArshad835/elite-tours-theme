<?php
/**
 * Experience Funnel — Section 7: Similar Experiences
 * 3-card cross-sell on cream. Pulls related experience CPT posts.
 * If the admin has manually selected related posts, those win.
 * Otherwise, the latest 3 other experiences are shown.
 */
defined( 'ABSPATH' ) || exit;

$f = $args['funnel'] ?? [];

$selected = array_values( array_filter( array_map( 'intval', (array) ( $f['similar_ids'] ?? [] ) ) ) );

if ( ! empty( $selected ) ) {
    $query_args = [
        'post_type'      => 'experience',
        'post_status'    => 'publish',
        'post__in'       => $selected,
        'orderby'        => 'post__in',
        'posts_per_page' => count( $selected ),
    ];
} else {
    $query_args = [
        'post_type'      => 'experience',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'post__not_in'   => [ $args['post_id'] ?? get_the_ID() ],
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
}

$similar = get_posts( $query_args );
if ( empty( $similar ) ) return;

$label    = $f['similar_label']    ?? 'You May Also Consider';
$number   = $f['similar_number']   ?? '06';
$heading1 = $f['similar_heading_part1'] ?? 'Other experiences,';
$heading2 = $f['similar_heading_part2'] ?? 'other quiet days.';
$view_all_text = $f['similar_view_all_text'] ?? 'View all experiences →';
$view_all_url  = $f['similar_view_all_url']  ?? get_post_type_archive_link( 'experience' );
if ( ! $view_all_url ) {
    // /experiences/ is a static page, not an archive
    $exp_page = get_page_by_path( 'experiences' );
    $view_all_url = $exp_page ? get_permalink( $exp_page ) : home_url( '/experiences/' );
}
?>
<section class="et-exp__similar">
    <div class="et-exp__similar-inner">
        <div class="et-exp__similar-head">
            <div>
                <h2 class="et-exp__similar-heading">
                    <?php if ( $heading1 ) : ?>
                        <?php echo esc_html( $heading1 ); ?><?php if ( $heading2 ) echo ' '; ?>
                    <?php endif; ?>
                    <?php if ( $heading2 ) : ?>
                        <span class="et-exp__similar-heading-em"><?php echo esc_html( $heading2 ); ?></span>
                    <?php endif; ?>
                </h2>
            </div>
            <?php if ( $view_all_text && $view_all_url ) : ?>
                <a href="<?php echo esc_url( $view_all_url ); ?>" class="eyebrow et-exp__similar-link">
                    <?php echo esc_html( $view_all_text ); ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="et-exp__similar-grid">
            <?php foreach ( $similar as $sim ) :
                $sid     = $sim->ID;
                $thumb   = get_the_post_thumbnail_url( $sid, 'large' );
                $eyebrow_label = (string) get_post_meta( $sid, '_etm_eyebrow', true );
                $sub_meta = (string) get_post_meta( $sid, '_etm_card_meta', true );
                $excerpt = $sim->post_excerpt ?: wp_trim_words( strip_shortcodes( $sim->post_content ), 28, '…' );
            ?>
                <a class="et-exp__similar-card" href="<?php echo esc_url( get_permalink( $sid ) ); ?>">
                    <?php if ( $thumb ) : ?>
                        <div class="et-exp__similar-card-img-wrap">
                            <img class="et-exp__similar-card-img" src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $sim->post_title ); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ( $eyebrow_label ) : ?>
                        <div class="eyebrow gold et-exp__similar-card-label"><?php echo esc_html( $eyebrow_label ); ?></div>
                    <?php endif; ?>
                    <h3 class="et-exp__similar-card-title"><?php echo esc_html( $sim->post_title ); ?></h3>
                    <?php if ( $sub_meta ) : ?>
                        <div class="et-exp__similar-card-meta"><?php echo esc_html( $sub_meta ); ?></div>
                    <?php endif; ?>
                    <?php if ( $excerpt ) : ?>
                        <p class="et-exp__similar-card-body"><?php echo esc_html( $excerpt ); ?></p>
                    <?php endif; ?>
                    <span class="eyebrow et-exp__similar-card-cta">Read more →</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
