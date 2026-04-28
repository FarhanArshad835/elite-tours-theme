<?php
/**
 * Template Name: Blog
 */
defined( 'ABSPATH' ) || exit;
get_header();

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$blog_query = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'paged'          => $paged,
] );
$base = get_template_directory_uri() . '/assets/images/';
?>

<?php etm_render_page_hero( 'blog', [
    'title'          => 'Insights from Ireland',
    'subtitle'       => 'Stories, guides, and insider knowledge from our journeys across the country.',
    'image_filename' => 'notebook-desk.jpg',
], $base ); ?>

<!-- Blog Grid -->
<section class="et-section et-section--white">
    <div class="et-container">
        <?php if ( $blog_query->have_posts() ) : ?>
        <div class="et-blog-grid">
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="et-blog-card et-reveal">
                <?php if ( has_post_thumbnail() ) : ?>
                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ); ?>" alt="<?php the_title_attribute(); ?>" class="et-blog-card__img">
                <?php else : ?>
                    <div class="et-blog-card__img" style="background:var(--et-off-white);display:flex;align-items:center;justify-content:center;color:var(--et-grey);font-size:13px;">No image</div>
                <?php endif; ?>
                <div class="et-blog-card__body">
                    <?php
                    $cats = get_the_category();
                    if ( ! empty( $cats ) ) :
                    ?>
                    <span class="et-blog-card__cat"><?php echo esc_html( $cats[0]->name ); ?></span>
                    <?php endif; ?>
                    <h3 class="et-blog-card__title"><?php the_title(); ?></h3>
                    <span class="et-blog-card__date"><?php echo get_the_date( 'F j, Y' ); ?></span>
                </div>
            </a>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <?php if ( $blog_query->max_num_pages > 1 ) : ?>
        <div style="text-align:center;margin-top:48px;">
            <?php
            echo paginate_links( [
                'total'   => $blog_query->max_num_pages,
                'current' => $paged,
                'prev_text' => '&laquo; Prev',
                'next_text' => 'Next &raquo;',
            ] );
            ?>
        </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
        <?php else : ?>
        <div style="text-align:center;padding:60px 0;">
            <h2 class="et-section__title">Coming Soon</h2>
            <p class="et-section__subtitle">We're working on stories, guides, and insider knowledge from our journeys across Ireland. Check back soon.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA -->
<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center et-reveal">
            <h2 class="et-section__title">Ready to Experience Ireland Personally?</h2>
        </div>
        <div style="text-align:center;" class="et-reveal">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Plan Your Journey</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
