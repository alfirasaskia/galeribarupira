/* ============================================
   BERANDA PERFORMANCE OPTIMIZATION
   Hanya optimasi performa, TIDAK mengubah tampilan
   ============================================ */

(function() {
    'use strict';

    // ============================================
    // LAZY LOADING IMAGES
    // ============================================
    
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px'
            });

            lazyImages.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback untuk browser lama
            lazyImages.forEach(img => {
                img.src = img.dataset.src;
                img.classList.add('loaded');
            });
        }
    }

    // ============================================
    // OPTIMIZED SCROLL HANDLING
    // ============================================
    
    function initOptimizedScroll() {
        const navbar = document.querySelector('.navbar');
        if (!navbar) return;

        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    
                    if (scrollTop > 100) {
                        if (!navbar.classList.contains('scrolled')) {
                            navbar.classList.add('scrolled');
                        }
                    } else {
                        if (navbar.classList.contains('scrolled')) {
                            navbar.classList.remove('scrolled');
                        }
                    }
                    
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    // ============================================
    // SMOOTH SCROLL LINKS
    // ============================================
    
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    }

    // ============================================
    // DEBOUNCE UTILITY
    // ============================================
    
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // ============================================
    // RESIZE HANDLER
    // ============================================
    
    function initResizeHandler() {
        const handleResize = debounce(() => {
            // Handle resize events here
        }, 250);

        window.addEventListener('resize', handleResize, { passive: true });
    }

    // ============================================
    // INITIALIZATION
    // ============================================
    
    document.addEventListener('DOMContentLoaded', function() {
        initLazyLoading();
        initOptimizedScroll();
        initSmoothScroll();
        initResizeHandler();
    });

    // ============================================
    // SERVICE WORKER REGISTRATION
    // ============================================
    
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => {
                    console.log('ServiceWorker registration successful');
                })
                .catch(err => {
                    console.log('ServiceWorker registration failed:', err);
                });
        });
    }

})();
