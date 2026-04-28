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

    // ── Carousel: prev/next buttons sync with scroll position ─
    // Picks up any element with data-carousel-prev / data-carousel-next
    // pointing at the carousel container's id. Smooth-scrolls one card
    // width per click; updates disabled state at scroll boundaries.
    const wireCarouselButton = ( btn, dir ) => {
        const targetId = btn.getAttribute( dir === -1 ? 'data-carousel-prev' : 'data-carousel-next' );
        const track    = targetId ? document.getElementById( targetId ) : null;
        if ( ! track ) return;

        const cardStep = () => {
            const card = track.querySelector( '.et-exp-card, .et-tile, .et-key-card' );
            if ( ! card ) return track.clientWidth;
            const rect = card.getBoundingClientRect();
            const styles = getComputedStyle( track );
            const gap    = parseFloat( styles.columnGap || styles.gap || '24' ) || 0;
            return rect.width + gap;
        };

        btn.addEventListener( 'click', () => {
            track.scrollBy( { left: dir * cardStep(), behavior: 'smooth' } );
        } );
    };
    document.querySelectorAll( '[data-carousel-prev]' ).forEach( b => wireCarouselButton( b, -1 ) );
    document.querySelectorAll( '[data-carousel-next]' ).forEach( b => wireCarouselButton( b,  1 ) );

    // Update prev/next disabled state as the user scrolls or resizes
    const carouselTracks = new Map(); // track id → { prev, next }
    document.querySelectorAll( '[data-carousel-prev], [data-carousel-next]' ).forEach( btn => {
        const id  = btn.getAttribute( 'data-carousel-prev' ) || btn.getAttribute( 'data-carousel-next' );
        const dir = btn.hasAttribute( 'data-carousel-prev' ) ? 'prev' : 'next';
        if ( ! id ) return;
        const entry = carouselTracks.get( id ) || {};
        entry[ dir ] = btn;
        carouselTracks.set( id, entry );
    } );
    carouselTracks.forEach( ( ctrls, id ) => {
        const track = document.getElementById( id );
        if ( ! track ) return;
        const sync = () => {
            const max = track.scrollWidth - track.clientWidth - 1;
            if ( ctrls.prev ) ctrls.prev.disabled = track.scrollLeft <= 1;
            if ( ctrls.next ) ctrls.next.disabled = track.scrollLeft >= max;
        };
        track.addEventListener( 'scroll', sync, { passive: true } );
        window.addEventListener( 'resize',  sync );
        sync();
    } );

} )();
