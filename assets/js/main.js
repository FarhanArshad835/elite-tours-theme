( function () {
    'use strict';

    // ── Sticky header on scroll ───────────────────────────────
    const header = document.getElementById( 'et-header' );
    if ( header ) {
        const onScroll = () => {
            header.classList.toggle( 'is-scrolled', window.scrollY > 40 );
        };
        window.addEventListener( 'scroll', onScroll, { passive: true } );
        onScroll(); // run on load
    }

    // ── Mobile nav toggle ─────────────────────────────────────
    const hamburger = document.getElementById( 'et-hamburger' );
    const nav       = document.getElementById( 'et-nav' );

    if ( hamburger && nav ) {
        // iOS-safe body-scroll-lock: position:fixed + restore strategy.
        // overflow:hidden alone doesn't stop iOS Safari rubber-band scroll,
        // and applying it to <html> causes layout jumps. Keeping a saved
        // scrollY lets us restore the user's exact position on close.
        let savedScrollY = 0;

        const lockBodyScroll = () => {
            savedScrollY = window.scrollY || window.pageYOffset || 0;
            document.body.style.position = 'fixed';
            document.body.style.top      = `-${savedScrollY}px`;
            document.body.style.left     = '0';
            document.body.style.right    = '0';
            document.body.style.width    = '100%';
        };
        const unlockBodyScroll = () => {
            document.body.style.position = '';
            document.body.style.top      = '';
            document.body.style.left     = '';
            document.body.style.right    = '';
            document.body.style.width    = '';
            // Restore saved position (avoid 'auto' behaviour that would smooth-scroll).
            window.scrollTo( 0, savedScrollY );
        };

        const closeNav = () => {
            if ( ! nav.classList.contains( 'is-open' ) ) return;
            nav.classList.remove( 'is-open' );
            hamburger.setAttribute( 'aria-expanded', 'false' );
            unlockBodyScroll();
        };
        const openNav = () => {
            nav.classList.add( 'is-open' );
            hamburger.setAttribute( 'aria-expanded', 'true' );
            lockBodyScroll();
        };

        hamburger.addEventListener( 'click', () => {
            if ( nav.classList.contains( 'is-open' ) ) { closeNav(); }
            else                                       { openNav();  }
        } );

        // Close nav when a link is clicked
        nav.querySelectorAll( '.et-nav__link' ).forEach( link => {
            link.addEventListener( 'click', closeNav );
        } );

        // Close on Escape key
        document.addEventListener( 'keydown', e => {
            if ( e.key === 'Escape' && nav.classList.contains( 'is-open' ) ) {
                closeNav();
                hamburger.focus();
            }
        } );

        // Close if viewport widens past the mobile breakpoint while drawer is open
        // (e.g. user rotates device or resizes browser).
        const mql = window.matchMedia( '(min-width: 1025px)' );
        const onMqlChange = ( ev ) => {
            if ( ev.matches && nav.classList.contains( 'is-open' ) ) closeNav();
        };
        if ( mql.addEventListener ) mql.addEventListener( 'change', onMqlChange );
        else if ( mql.addListener ) mql.addListener( onMqlChange ); /* Safari < 14 */
    }

} )();
