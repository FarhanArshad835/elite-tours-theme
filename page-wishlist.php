<?php
/**
 * Template Name: Wishlist
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>

<section class="et-page-hero" style="padding:140px 0 60px;">
    <div class="et-page-hero__overlay" style="background:linear-gradient(135deg, var(--et-green) 0%, var(--et-green-dark) 100%);"></div>
    <div class="et-container">
        <div class="et-page-hero__content">
            <h1 class="et-page-hero__title">Your Wishlist</h1>
            <p class="et-page-hero__sub">Experiences and journeys you've saved. Share this with us when you're ready to plan.</p>
        </div>
    </div>
</section>

<section class="et-section et-section--white">
    <div class="et-container">

        <div id="et-wishlist-empty" class="et-wishlist-empty">
            <div class="et-wishlist-empty__icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </div>
            <p class="et-wishlist-empty__text">Your wishlist is empty. Browse our experiences and tap the heart icon to save them here.</p>
            <a href="<?php echo esc_url( home_url( '/experiences/' ) ); ?>" class="et-btn et-btn--primary">Browse Experiences</a>
        </div>

        <div id="et-wishlist-items" class="et-wishlist-grid"></div>

    </div>
</section>

<section class="et-section et-section--green">
    <div class="et-container">
        <div class="et-section__header et-section__header--center">
            <h2 class="et-section__title">Ready to Turn This Into a Journey?</h2>
            <p class="et-section__subtitle">Share your wishlist with us and we'll design something around it.</p>
        </div>
        <div style="text-align:center;">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--pill et-btn--pill-light et-btn--lg">Plan Your Journey</a>
        </div>
    </div>
</section>

<script>
// Force render wishlist on this page (fallback if global init missed it)
(function() {
    function tryRender() {
        if (window.etWishlist) {
            window.etWishlist.renderPage();
            window.etWishlist.initHearts();
        } else {
            setTimeout(tryRender, 100);
        }
    }
    tryRender();
})();
</script>

<?php get_footer(); ?>
