<?php
/**
 * Reusable trust-logo strip (TripAdvisor, Fáilte Ireland, ASTA, IAGTO, Since 1973).
 *
 * Used in the homepage hero and on inner pages such as Contact. Pass args via
 * get_template_part():
 *   'context' => 'light' | 'dark'  (default 'dark' — the hero look)
 *
 * All sub-labels and logos are editable from Elite Tours Manager → settings,
 * mirroring the values the hero already reads.
 *
 * @var array $args
 */
defined( 'ABSPATH' ) || exit;

$context = isset( $args['context'] ) && $args['context'] === 'light' ? 'light' : 'dark';

// Editable sub-labels + logo IDs from plugin settings.
$trust_failte_sub  = et_option( 'trust_failte_sub',  'Approved Partner' );
$trust_failte_logo = et_option( 'trust_failte_logo_id', '' );
$trust_asta_sub    = et_option( 'trust_asta_sub',    'Member' );
$trust_asta_logo   = et_option( 'trust_asta_logo_id', '' );
$trust_iagto_sub   = et_option( 'trust_iagto_sub',   'Golf Tourism' );
$trust_iagto_logo  = et_option( 'trust_iagto_logo_id', '' );
$trust_since_label = et_option( 'trust_since_label', 'Since 1973' );
$trust_since_sub   = et_option( 'trust_since_sub',   '50+ years experience' );
$trust_ta_sub      = et_option( 'trust_ta_sub',      '5.0 · 90 Reviews' );

// Resolve logo URLs (fall back to bundled assets).
$failte_url = $trust_failte_logo
	? wp_get_attachment_image_url( (int) $trust_failte_logo, 'full' )
	: get_template_directory_uri() . '/assets/images/trust/failte-ireland.png';
$asta_url   = $trust_asta_logo
	? wp_get_attachment_image_url( (int) $trust_asta_logo, 'full' )
	: get_template_directory_uri() . '/assets/images/trust/asta.png';
$iagto_url  = $trust_iagto_logo
	? wp_get_attachment_image_url( (int) $trust_iagto_logo, 'full' )
	: get_template_directory_uri() . '/assets/images/trust/iagto.jpg';
?>
<div class="et-trust-wrap et-trust-wrap--<?php echo esc_attr( $context ); ?>">
	<button type="button" class="et-trust-arrow et-trust-arrow--left" aria-label="Scroll left">
		<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
	</button>
	<div class="et-trust-bar">
		<div class="et-trust-bar__item">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/trust/tripadvisor.svg' ); ?>"
			     alt="TripAdvisor" class="et-trust-bar__logo et-trust-bar__logo--ta" loading="lazy">
			<div class="et-trust-bar__stars" aria-label="5 stars">★★★★★</div>
			<span class="et-trust-bar__sub"><?php echo esc_html( $trust_ta_sub ); ?></span>
		</div>
		<div class="et-trust-bar__item">
			<img src="<?php echo esc_url( $failte_url ); ?>" alt="Fáilte Ireland" class="et-trust-bar__logo" loading="lazy">
			<span class="et-trust-bar__sub"><?php echo esc_html( $trust_failte_sub ); ?></span>
		</div>
		<div class="et-trust-bar__item">
			<img src="<?php echo esc_url( $asta_url ); ?>" alt="ASTA" class="et-trust-bar__logo" loading="lazy">
			<span class="et-trust-bar__sub"><?php echo esc_html( $trust_asta_sub ); ?></span>
		</div>
		<div class="et-trust-bar__item">
			<img src="<?php echo esc_url( $iagto_url ); ?>" alt="IAGTO" class="et-trust-bar__logo et-trust-bar__logo--iagto" loading="lazy">
			<span class="et-trust-bar__sub"><?php echo esc_html( $trust_iagto_sub ); ?></span>
		</div>
		<div class="et-trust-bar__item">
			<span class="et-trust-bar__badge et-trust-bar__badge--gold"><?php echo esc_html( $trust_since_label ); ?></span>
			<span class="et-trust-bar__sub"><?php echo esc_html( $trust_since_sub ); ?></span>
		</div>
	</div>
	<button type="button" class="et-trust-arrow et-trust-arrow--right" aria-label="Scroll right">
		<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
	</button>
</div>
