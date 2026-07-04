<?php
/**
 * Reusable TripAdvisor proof badge.
 *
 * Used in the homepage hero (dark background) and on inner pages such as
 * Contact (light background). Pass args via get_template_part():
 *   'context' => 'light' | 'dark'  (default 'dark' — the hero look)
 *
 * @var array $args
 */
defined( 'ABSPATH' ) || exit;

$proof_text = et_option( 'hero_proof_text', "Ireland's Highest-Rated Tour Provider on TripAdvisor" );
if ( ! $proof_text ) {
	return;
}

$context = isset( $args['context'] ) && $args['context'] === 'light' ? 'light' : 'dark';
?>
<div class="et-proof et-proof--<?php echo esc_attr( $context ); ?>" aria-label="5-star rated">
	<span class="et-proof__stars" aria-hidden="true">★★★★★</span>
	<span class="et-proof__text"><?php echo esc_html( $proof_text ); ?></span>
</div>
