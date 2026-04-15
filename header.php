<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="et-header" id="et-header">
    <div class="et-header__inner">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="et-header__logo" aria-label="Elite Tours Ireland">
            <?php
            $logo_id  = et_site( 'logo_id' );
            $logo_url = $logo_id ? wp_get_attachment_image_url( (int) $logo_id, 'full' ) : '';
            if ( $logo_url ) :
            ?>
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="Elite Tours Ireland" width="140" height="60">
            <?php else : ?>
                <span class="et-header__logo-text">
                    <span class="et-header__logo-since">SINCE 1973</span>
                    <span class="et-header__logo-et">ET</span>
                    <span class="et-header__logo-name">ELITE TOURS IRELAND</span>
                </span>
            <?php endif; ?>
        </a>

        <!-- Primary Navigation -->
        <nav class="et-nav" id="et-nav" aria-label="Primary navigation">
            <ul class="et-nav__list">
                <?php
                $nav_items = [
                    [ 'label' => 'Bespoke Tours', 'url' => home_url( '/bespoke-tours/' ) ],
                    [ 'label' => 'Golf Tours',    'url' => home_url( '/golf-tours/' ) ],
                    [ 'label' => 'Experiences',   'url' => home_url( '/experiences/' ) ],
                    [ 'label' => 'Accommodation', 'url' => home_url( '/accommodation/' ) ],
                    [ 'label' => 'About Us',      'url' => home_url( '/about-us/' ) ],
                    [ 'label' => 'Blog',          'url' => home_url( '/blog/' ) ],
                    [ 'label' => 'Contact',       'url' => home_url( '/contact/' ) ],
                ];
                foreach ( $nav_items as $item ) :
                    $is_active = ( trailingslashit( get_permalink() ) === trailingslashit( $item['url'] ) );
                ?>
                    <li class="et-nav__item">
                        <a href="<?php echo esc_url( $item['url'] ); ?>"
                           class="et-nav__link<?php echo $is_active ? ' et-nav__link--active' : ''; ?><?php echo ( $item['label'] === 'Bespoke Tours' ) ? ' et-nav__link--bespoke' : ''; ?>">
                            <?php echo esc_html( $item['label'] ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <!-- Right Side: Phone + CTA -->
        <div class="et-header__actions">
            <?php
            $phone       = et_site( 'phone_us', '+1 888 000 0000' );
            $phone_clean = preg_replace( '/[^+0-9]/', '', $phone );
            ?>
            <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="et-header__phone">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .91h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                </svg>
                <?php echo esc_html( $phone ); ?>
            </a>

            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="et-btn et-btn--primary">
                <?php echo esc_html( et_site( 'nav_cta_text', 'Plan Your Journey' ) ); ?>
            </a>
        </div>

        <!-- Mobile Hamburger -->
        <button class="et-hamburger" id="et-hamburger" aria-label="Toggle navigation" aria-expanded="false" aria-controls="et-nav">
            <span class="et-hamburger__bar"></span>
            <span class="et-hamburger__bar"></span>
            <span class="et-hamburger__bar"></span>
        </button>

    </div>
</header>
