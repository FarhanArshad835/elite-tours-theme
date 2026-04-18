/**
 * Elite Tours — Wishlist (localStorage based, no login required)
 */
(function () {
    var STORAGE_KEY = 'et_wishlist';

    // ── Core functions ──────────────────────────────────────────
    function getWishlist() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; }
        catch (e) { return []; }
    }

    function saveWishlist(list) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(list));
        updateCounter();
        window.dispatchEvent(new CustomEvent('et-wishlist-change', { detail: list }));
    }

    function isWishlisted(id) {
        return getWishlist().some(function (item) { return item.id === id; });
    }

    function addToWishlist(data) {
        var list = getWishlist();
        if (list.some(function (item) { return item.id === data.id; })) return;
        list.push(data);
        saveWishlist(list);
    }

    function removeFromWishlist(id) {
        var list = getWishlist().filter(function (item) { return item.id !== id; });
        saveWishlist(list);
    }

    function toggleWishlist(data) {
        if (isWishlisted(data.id)) {
            removeFromWishlist(data.id);
            return false;
        } else {
            addToWishlist(data);
            return true;
        }
    }

    // ── Nav counter ─────────────────────────────────────────────
    function updateCounter() {
        var count = getWishlist().length;
        document.querySelectorAll('.et-wishlist-count').forEach(function (el) {
            el.textContent = count > 0 ? count : '';
            el.setAttribute('data-count', count);
        });
    }

    // ── Heart buttons ───────────────────────────────────────────
    function initHearts() {
        document.querySelectorAll('[data-wishlist-id]').forEach(function (btn) {
            var id = btn.dataset.wishlistId;
            if (isWishlisted(id)) btn.classList.add('is-wishlisted');

            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var data = {
                    id: btn.dataset.wishlistId,
                    title: btn.dataset.wishlistTitle || '',
                    desc: btn.dataset.wishlistDesc || '',
                    img: btn.dataset.wishlistImg || '',
                    url: btn.dataset.wishlistUrl || '',
                    type: btn.dataset.wishlistType || '',
                };

                var added = toggleWishlist(data);
                btn.classList.toggle('is-wishlisted', added);

                // Animate
                btn.classList.add('et-heart-pop');
                setTimeout(function () { btn.classList.remove('et-heart-pop'); }, 400);
            });
        });
    }

    // ── Wishlist page rendering ──────────────────────────────────
    function renderWishlistPage() {
        var container = document.getElementById('et-wishlist-items');
        if (!container) return;

        var list = getWishlist();
        var empty = document.getElementById('et-wishlist-empty');

        if (list.length === 0) {
            container.innerHTML = '';
            if (empty) empty.style.display = '';
            return;
        }

        if (empty) empty.style.display = 'none';

        container.innerHTML = list.map(function (item) {
            return '<div class="et-wishlist-card" data-id="' + item.id + '">' +
                (item.img ? '<div class="et-wishlist-card__img" style="background-image:url(\'' + item.img + '\')"></div>' : '') +
                '<div class="et-wishlist-card__body">' +
                    '<h3 class="et-wishlist-card__title">' + (item.title || 'Untitled') + '</h3>' +
                    (item.type ? '<span class="et-wishlist-card__type">' + item.type + '</span>' : '') +
                    (item.desc ? '<p class="et-wishlist-card__desc">' + item.desc + '</p>' : '') +
                '</div>' +
                '<div class="et-wishlist-card__actions">' +
                    (item.url ? '<a href="' + item.url + '" class="et-btn et-btn--primary" style="font-size:12px;padding:8px 16px;">View</a>' : '') +
                    '<button type="button" class="et-wishlist-card__remove" data-remove="' + item.id + '" title="Remove">&times;</button>' +
                '</div>' +
            '</div>';
        }).join('');

        // Remove buttons
        container.querySelectorAll('[data-remove]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                removeFromWishlist(btn.dataset.remove);
                renderWishlistPage();
                // Update any heart buttons on the page
                document.querySelectorAll('[data-wishlist-id="' + btn.dataset.remove + '"]').forEach(function (h) {
                    h.classList.remove('is-wishlisted');
                });
            });
        });
    }

    // ── Init ────────────────────────────────────────────────────
    function init() {
        updateCounter();
        initHearts();
        renderWishlistPage();
    }

    // Handle both cases: script loaded before or after DOMContentLoaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Expose for dynamic content
    window.etWishlist = {
        get: getWishlist,
        add: addToWishlist,
        remove: removeFromWishlist,
        toggle: toggleWishlist,
        isWishlisted: isWishlisted,
        initHearts: initHearts,
        renderPage: renderWishlistPage,
    };
})();
