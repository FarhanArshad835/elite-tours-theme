<?php
defined( 'ABSPATH' ) || exit;

// ─── Theme Setup ────────────────────────────────────────────────────────────
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'elite-tours' ),
    ] );
} );

// ─── Enqueue Assets ─────────────────────────────────────────────────────────
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'elite-tours-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        '1.2.0'
    );
    wp_enqueue_style(
        'elite-tours-sections',
        get_template_directory_uri() . '/assets/css/sections-extra.css',
        [ 'elite-tours-main' ],
        '1.3.0'
    );
    wp_enqueue_style(
        'elite-tours-pages',
        get_template_directory_uri() . '/assets/css/pages.css',
        [ 'elite-tours-main' ],
        '1.3.0'
    );
    wp_enqueue_style(
        'elite-tours-wishlist',
        get_template_directory_uri() . '/assets/css/wishlist.css',
        [ 'elite-tours-main' ],
        '1.3.0'
    );
    wp_enqueue_script(
        'elite-tours-wishlist',
        get_template_directory_uri() . '/assets/js/wishlist.js',
        [],
        '1.3.0',
        true
    );

    wp_enqueue_script(
        'elite-tours-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.0',
        true
    );

    // Funnel page styles — only on single-experience pages
    if ( is_singular( 'experience' ) ) {
        wp_enqueue_style(
            'elite-tours-fonts-funnel',
            'https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;1,400&family=Inter:wght@300;400;500&display=swap',
            [],
            null
        );
        wp_enqueue_style(
            'elite-tours-exp-funnel',
            get_template_directory_uri() . '/assets/css/exp-funnel.css',
            [ 'elite-tours-main', 'elite-tours-fonts-funnel' ],
            '2.0.0'
        );
    }
} );

// ─── Helper: get plugin option ───────────────────────────────────────────────
if ( ! function_exists( 'et_option' ) ) {
    function et_option( string $key, string $fallback = '' ): string {
        $options = get_option( 'et_homepage_settings', [] );
        return ! empty( $options[ $key ] ) ? esc_attr( $options[ $key ] ) : $fallback;
    }
}

// ─── Helper: get homepage setting (raw, unescaped) ───────────────────────────
if ( ! function_exists( 'et_hp' ) ) {
    function et_hp( string $key, string $fallback = '' ): string {
        static $opts = null;
        if ( $opts === null ) $opts = get_option( 'et_homepage_settings', [] );
        return ( isset( $opts[ $key ] ) && $opts[ $key ] !== '' ) ? $opts[ $key ] : $fallback;
    }
}

// ─── Helper: get homepage setting as integer ──────────────────────────────────
if ( ! function_exists( 'et_hp_int' ) ) {
    function et_hp_int( string $key, int $fallback = 0 ): int {
        static $opts = null;
        if ( $opts === null ) $opts = get_option( 'et_homepage_settings', [] );
        return ( isset( $opts[ $key ] ) && $opts[ $key ] !== '' ) ? (int) $opts[ $key ] : $fallback;
    }
}

// ─── Helper: is wishlist feature enabled? ────────────────────────────────────
if ( ! function_exists( 'et_wishlist_enabled' ) ) {
    function et_wishlist_enabled(): bool {
        $opts = get_option( 'et_site_settings', [] );
        // Default ON when the key is missing (preserves pre-toggle behaviour)
        return ! isset( $opts['wishlist_enabled'] ) || $opts['wishlist_enabled'] === '1';
    }
}

// ─── Helper: wishlist heart button ──────────────────────────────────────────
if ( ! function_exists( 'et_heart' ) ) {
    function et_heart( string $id, string $title = '', string $desc = '', string $img = '', string $url = '', string $type = '' ): string {
        if ( ! et_wishlist_enabled() ) return '';
        return '<button type="button" class="et-heart"'
            . ' data-wishlist-id="' . esc_attr( $id ) . '"'
            . ' data-wishlist-title="' . esc_attr( $title ) . '"'
            . ' data-wishlist-desc="' . esc_attr( $desc ) . '"'
            . ' data-wishlist-img="' . esc_attr( $img ) . '"'
            . ' data-wishlist-url="' . esc_attr( $url ) . '"'
            . ' data-wishlist-type="' . esc_attr( $type ) . '"'
            . ' title="Add to wishlist">'
            . '<svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>'
            . '</button>';
    }
}

// ─── Helper: get plugin option (raw — for HTML content) ──────────────────────
if ( ! function_exists( 'et_option_raw' ) ) {
    function et_option_raw( string $key, string $fallback = '' ): string {
        $options = get_option( 'et_homepage_settings', [] );
        return ! empty( $options[ $key ] ) ? $options[ $key ] : $fallback;
    }
}

// ─── Helper: inline SVG icons ────────────────────────────────────────────────
if ( ! function_exists( 'et_get_icon' ) ) {
    function et_get_icon( string $name ): string {
        $icons = [
            'star'   => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
            'pin'    => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>',
            'shield' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
            'check'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>',
            'clock'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        ];
        return $icons[ $name ] ?? '';
    }
}

// ─── Helper: get site settings option ───────────────────────────────────────
if ( ! function_exists( 'et_site' ) ) {
    function et_site( string $key, string $fallback = '' ): string {
        $options = get_option( 'et_site_settings', [] );
        return ! empty( $options[ $key ] ) ? esc_attr( $options[ $key ] ) : $fallback;
    }
}

// ─── Admin: append live deploy timestamp to theme row ───────────────────────
add_filter( 'theme_row_meta', function ( array $meta, string $stylesheet ): array {
    if ( $stylesheet === get_template() ) {
        $ts     = filemtime( get_template_directory() . '/style.css' );
        $meta[] = 'Deployed: <strong>' . gmdate( 'j M Y, H:i', $ts ) . ' UTC</strong>';
    }
    return $meta;
}, 10, 2 );

// ─── Disable maintenance mode during plugin/theme updates ───────────────────
// WP Pusher deploys take 5-10 min — this keeps the site live during updates
add_filter( 'enable_maintenance_mode', '__return_false' );

// ─── Elementor Integration ───────────────────────────────────────────────────

// 1. Declare Elementor support
add_action( 'after_setup_theme', function () {
    add_theme_support( 'elementor' );
} );

// 2. Register brand global colours in Elementor colour picker
add_action( 'elementor/element/after_section_end', function ( $element, $section_id ) {
    // only run once
}, 10, 2 );

add_filter( 'elementor/editor/localize_settings', function ( $settings ) {
    $settings['brandColors'] = [
        [ 'id' => 'et-green',      'title' => 'ET Dark Evergreen', 'value' => '#1A4F31' ],
        [ 'id' => 'et-gold',       'title' => 'ET Gold',           'value' => '#C4A265' ],
        [ 'id' => 'et-off-white',  'title' => 'ET Off White',      'value' => '#F2F7F2' ],
        [ 'id' => 'et-black',      'title' => 'ET Black',          'value' => '#0A0A0A' ],
        [ 'id' => 'et-grey',       'title' => 'ET Grey',           'value' => '#6B6B6B' ],
        [ 'id' => 'et-navy',       'title' => 'ET Deep Navy',      'value' => '#0D1B3E' ],
    ];
    return $settings;
} );

// 3. Push brand colours into Elementor's kit (Global Colours panel)
add_action( 'elementor/kit/register_tabs', function ( $kit ) {
    // colours registered via kit settings below
} );

add_filter( 'elementor_pro/custom_fonts/fonts', function ( $fonts ) {
    $fonts['Old Standard TT'] = 'google';
    $fonts['Arial Nova']      = 'system';
    return $fonts;
} );

// 4. Suppress custom header/footer when Elementor Pro Theme Builder has a template
add_filter( 'et_use_custom_header', function () {
    if ( class_exists( '\ElementorPro\Plugin' ) ) {
        $conditions = \ElementorPro\Plugin::instance()->modules_manager->get_modules( 'theme-builder' );
        if ( $conditions && method_exists( $conditions, 'get_conditions_manager' ) ) {
            $location = $conditions->get_conditions_manager()->get_documents_for_location( 'header' );
            if ( ! empty( $location ) ) {
                return false; // Elementor Pro has a header — skip custom header
            }
        }
    }
    return true;
} );

// 5. Add Elementor canvas + full-width page templates
add_filter( 'theme_page_templates', function ( $templates ) {
    $templates['elementor_canvas']     = __( 'Elementor Canvas', 'elite-tours' );
    $templates['elementor_header_footer'] = __( 'Elementor Full Width', 'elite-tours' );
    return $templates;
} );
