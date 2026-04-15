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
        '1.0.0'
    );

    wp_enqueue_script(
        'elite-tours-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.0',
        true
    );
} );

// ─── Helper: get plugin option ───────────────────────────────────────────────
if ( ! function_exists( 'et_option' ) ) {
    function et_option( string $key, string $fallback = '' ): string {
        $options = get_option( 'et_homepage_settings', [] );
        return ! empty( $options[ $key ] ) ? esc_attr( $options[ $key ] ) : $fallback;
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
