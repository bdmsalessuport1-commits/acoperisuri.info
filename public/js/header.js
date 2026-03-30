/**
 * Header interactivity - sticky, hamburger, mobile accordion
 */
document.addEventListener('DOMContentLoaded', function () {
    var topBar = document.getElementById('topBar');
    var header = document.getElementById('siteHeader');
    var hamburger = document.getElementById('hamburger');
    var mobileNav = document.getElementById('mobileNav');

    // ===========================
    // Sticky header + hide top bar on scroll
    // ===========================
    var lastScroll = 0;

    function handleScroll() {
        var scrollY = window.scrollY || window.pageYOffset;

        // Sticky shadow
        if (scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        // Hide top bar on scroll (desktop only)
        if (window.innerWidth > 1024) {
            if (scrollY > 100) {
                topBar.classList.add('hidden');
            } else {
                topBar.classList.remove('hidden');
            }
        }

        lastScroll = scrollY;
    }

    window.addEventListener('scroll', handleScroll, { passive: true });

    // ===========================
    // Hamburger menu toggle
    // ===========================
    if (hamburger && mobileNav) {
        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('active');
            mobileNav.classList.toggle('active');
            document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
        });
    }

    // ===========================
    // Mobile accordion
    // ===========================
    var mobileToggleLinks = document.querySelectorAll('.mobile-nav-link[data-toggle]');

    mobileToggleLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var targetId = this.getAttribute('data-toggle');
            var target = document.getElementById(targetId);

            if (target) {
                // Close other subnavs
                document.querySelectorAll('.mobile-subnav.open').forEach(function (el) {
                    if (el.id !== targetId) {
                        el.classList.remove('open');
                        var parentLink = document.querySelector('[data-toggle="' + el.id + '"]');
                        if (parentLink) parentLink.classList.remove('open');
                    }
                });

                // Toggle current
                target.classList.toggle('open');
                this.classList.toggle('open');
            }
        });
    });

    // ===========================
    // Close mobile nav on link click
    // ===========================
    var mobileLinks = mobileNav ? mobileNav.querySelectorAll('a:not([data-toggle])') : [];
    mobileLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            hamburger.classList.remove('active');
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // ===========================
    // Close mobile nav on resize to desktop
    // ===========================
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024 && mobileNav && mobileNav.classList.contains('active')) {
            hamburger.classList.remove('active');
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});
