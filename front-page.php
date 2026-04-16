<?php
defined( 'ABSPATH' ) || exit;
get_header();

// Hero is always first — fixed, never hidden or reordered
get_template_part( 'template-parts/home/hero' );

// Dynamic sections — order and visibility driven by admin panel
$default_order = [ 'intro', 'offers', 'process', 'experiences', 'testimonials', 'founder-cta' ];
$stored_order  = et_hp( 'section_order', '' );
$order         = $stored_order ? json_decode( $stored_order, true ) : $default_order;
if ( ! is_array( $order ) ) {
    $order = $default_order;
}

foreach ( $order as $slug ) {
    // Sanitise slug — only allow known sections
    if ( ! in_array( $slug, $default_order, true ) ) {
        continue;
    }
    $visible = et_hp( 'section_' . $slug . '_visible', '1' );
    if ( $visible === '0' ) {
        continue;
    }
    $file = get_template_directory() . '/template-parts/home/' . $slug . '.php';
    if ( file_exists( $file ) ) {
        get_template_part( 'template-parts/home/' . $slug );
    }
}

get_footer();
