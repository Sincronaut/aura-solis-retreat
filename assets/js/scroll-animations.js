/**
 * Aura Solis — Scroll Animation Observer
 * Watches for [data-animate] and [data-animate-stagger] elements
 * and adds .is-visible when they enter the viewport.
 *
 * Supports optional overrides via data attributes:
 *   data-animate-delay="200"    → CSS transition-delay in ms
 *   data-animate-duration="600" → CSS transition-duration in ms
 */
(function () {
    'use strict';

    // Bail immediately if the browser doesn't support IntersectionObserver
    if (!('IntersectionObserver' in window)) {
        // Graceful fallback: make everything visible immediately
        document.querySelectorAll('[data-animate], [data-animate-stagger]').forEach(function (el) {
            el.classList.add('is-visible');
        });
        return;
    }

    /**
     * Apply optional inline overrides for delay / duration
     * defined as data attributes on the element itself.
     */
    function applyDataOverrides(el) {
        var delay    = el.getAttribute('data-animate-delay');
        var duration = el.getAttribute('data-animate-duration');
        if (delay)    el.style.transitionDelay    = delay + 'ms';
        if (duration) el.style.transitionDuration = duration + 'ms';
    }

    /* ── Observer 1: Individual elements [data-animate] ─────────── */
    var elementObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                elementObserver.unobserve(entry.target); // Fires once, no repeat
            }
        });
    }, {
        threshold: 0.12,          // Trigger when 12% of element is visible
        rootMargin: '0px 0px -40px 0px' // Slightly below the fold for a natural feel
    });

    /* ── Observer 2: Stagger containers [data-animate-stagger] ──── */
    var staggerObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                staggerObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.08,
        rootMargin: '0px 0px -20px 0px'
    });

    /* ── Initialize on DOM ready ─────────────────────────────────── */
    function init() {
        // Individual animated elements
        document.querySelectorAll('[data-animate]').forEach(function (el) {
            applyDataOverrides(el);
            elementObserver.observe(el);
        });

        // Stagger container elements
        document.querySelectorAll('[data-animate-stagger]').forEach(function (el) {
            staggerObserver.observe(el);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
