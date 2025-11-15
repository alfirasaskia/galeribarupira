/* ============================================
   BERANDA MOBILE OPTIMIZATION
   - Kurangi animasi berat
   - Optimasi untuk mobile
   - TIDAK mengubah tampilan
   ============================================ */

(function() {
    'use strict';

    // Detect if device is mobile
    const isMobile = () => {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
               window.innerWidth <= 768;
    };

    // ============================================
    // DISABLE AOS ANIMATIONS ON MOBILE
    // ============================================
    
    function optimizeAOS() {
        if (isMobile() && window.AOS) {
            // Disable AOS on mobile untuk performa lebih baik
            window.AOS.init({
                disable: 'mobile', // Disable on mobile
                duration: 300,
                easing: 'ease-in-out',
                once: true
            });
        }
    }

    // ============================================
    // OPTIMIZE SWIPER ON MOBILE
    // ============================================
    
    function optimizeSwiper() {
        if (isMobile()) {
            // Reduce animation duration on mobile
            const swipers = document.querySelectorAll('.swiper');
            swipers.forEach(swiper => {
                if (swiper.swiper) {
                    swiper.swiper.params.speed = 300; // Reduce from default
                }
            });
        }
    }

    // ============================================
    // OPTIMIZE SCROLL PERFORMANCE
    // ============================================
    
    function optimizeScroll() {
        let ticking = false;
        const navbar = document.querySelector('.navbar');

        if (!navbar) return;

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
    // LAZY LOAD IMAGES
    // ============================================
    
    function lazyLoadImages() {
        const images = document.querySelectorAll('img[data-src]');
        
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

            images.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback
            images.forEach(img => {
                img.src = img.dataset.src;
                img.classList.add('loaded');
            });
        }
    }

    // ============================================
    // REDUCE ANIMATION COMPLEXITY ON MOBILE
    // ============================================
    
    function reduceAnimations() {
        if (isMobile()) {
            // Disable complex animations
            const style = document.createElement('style');
            style.textContent = `
                @media (max-width: 768px) {
                    * {
                        animation-duration: 0.1s !important;
                        transition-duration: 150ms !important;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }

    // ============================================
    // OPTIMIZE TOUCH INTERACTIONS
    // ============================================
    
    function optimizeTouchInteractions() {
        if (isMobile()) {
            // Disable hover effects on touch devices
            const style = document.createElement('style');
            style.textContent = `
                @media (hover: none) {
                    .card:hover,
                    .news-card:hover,
                    .gallery-card:hover,
                    .btn:hover,
                    a:hover {
                        transform: none !important;
                        box-shadow: none !important;
                    }
                }
            `;
            document.head.appendChild(style);
        }
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
    // HANDLE RESIZE
    // ============================================
    
    function handleResize() {
        const resizeHandler = debounce(() => {
            // Re-optimize on resize
            if (isMobile()) {
                optimizeSwiper();
            }
        }, 250);

        window.addEventListener('resize', resizeHandler, { passive: true });
    }

    // ============================================
    // INITIALIZATION
    // ============================================
    
    document.addEventListener('DOMContentLoaded', function() {
        // Run optimizations
        reduceAnimations();
        optimizeTouchInteractions();
        optimizeAOS();
        optimizeSwiper();
        optimizeScroll();
        lazyLoadImages();
        handleResize();

        console.log('Beranda mobile optimization loaded');
    });

    // ============================================
    // SMOOTH SCROLL
    // ============================================
    
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

})();
