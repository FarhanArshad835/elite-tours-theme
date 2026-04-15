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
        hamburger.addEventListener( 'click', () => {
            const isOpen = nav.classList.toggle( 'is-open' );
            hamburger.setAttribute( 'aria-expanded', String( isOpen ) );
            document.body.style.overflow = isOpen ? 'hidden' : '';
        } );

        // Close nav when a link is clicked
        nav.querySelectorAll( '.et-nav__link' ).forEach( link => {
            link.addEventListener( 'click', () => {
                nav.classList.remove( 'is-open' );
                hamburger.setAttribute( 'aria-expanded', 'false' );
                document.body.style.overflow = '';
            } );
        } );

        // Close on Escape key
        document.addEventListener( 'keydown', e => {
            if ( e.key === 'Escape' && nav.classList.contains( 'is-open' ) ) {
                nav.classList.remove( 'is-open' );
                hamburger.setAttribute( 'aria-expanded', 'false' );
                document.body.style.overflow = '';
                hamburger.focus();
            }
        } );
    }

} )();
