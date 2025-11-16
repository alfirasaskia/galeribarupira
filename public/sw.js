/* ============================================
   SERVICE WORKER - SMKN 4 BOGOR
   ============================================ */

const CACHE_NAME = 'smkn4bogor-v2';
const RUNTIME_CACHE = 'smkn4bogor-runtime-v2';
const ASSETS_TO_CACHE = [
    '/',
    '/images/logo.png',
    '/favicon.ico'
];

// ============================================
// INSTALL EVENT
// ============================================

self.addEventListener('install', event => {
    console.log('Service Worker installing...');
    
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Caching app shell');
                return cache.addAll(ASSETS_TO_CACHE);
            })
            .then(() => self.skipWaiting())
    );
});

// ============================================
// ACTIVATE EVENT
// ============================================

self.addEventListener('activate', event => {
    console.log('Service Worker activating...');
    
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME && cacheName !== RUNTIME_CACHE) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// ============================================
// FETCH EVENT
// ============================================

self.addEventListener('fetch', event => {
    const { request } = event;
    const url = new URL(request.url);

    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }

    // Skip cross-origin requests
    if (url.origin !== location.origin) {
        return;
    }

    // Handle API requests
    if (url.pathname.startsWith('/api/')) {
        event.respondWith(networkFirst(request));
        return;
    }

    // Handle image requests
    if (request.destination === 'image') {
        event.respondWith(cacheImages(request));
        return;
    }

    // Handle CSS and JS
    if (request.destination === 'style' || request.destination === 'script') {
        event.respondWith(cacheFirst(request));
        return;
    }

    // Default strategy
    event.respondWith(cacheFirst(request));
});

// ============================================
// CACHE STRATEGIES
// ============================================

// Cache First Strategy
function cacheFirst(request) {
    return caches.match(request)
        .then(response => {
            if (response) {
                return response;
            }

            return fetch(request).then(response => {
                // Don't cache non-successful responses
                if (!response || response.status !== 200 || response.type === 'error') {
                    return response;
                }

                // Clone the response
                const responseToCache = response.clone();

                caches.open(RUNTIME_CACHE)
                    .then(cache => {
                        cache.put(request, responseToCache);
                    });

                return response;
            });
        })
        .catch(() => {
            // Return offline page or cached response
            return caches.match(request);
        });
}

// Network First Strategy
function networkFirst(request) {
    return fetch(request)
        .then(response => {
            if (!response || response.status !== 200 || response.type === 'error') {
                return response;
            }

            const responseToCache = response.clone();

            caches.open(RUNTIME_CACHE)
                .then(cache => {
                    cache.put(request, responseToCache);
                });

            return response;
        })
        .catch(() => {
            return caches.match(request);
        });
}

// Cache Images Strategy
function cacheImages(request) {
    return caches.open(RUNTIME_CACHE)
        .then(cache => {
            return cache.match(request)
                .then(response => {
                    if (response) {
                        return response;
                    }

                    return fetch(request)
                        .then(response => {
                            if (!response || response.status !== 200) {
                                return response;
                            }

                            cache.put(request, response.clone());
                            return response;
                        })
                        .catch(() => {
                            // Return placeholder image or cached response
                            return cache.match(request);
                        });
                });
        });
}

// ============================================
// MESSAGE HANDLING
// ============================================

self.addEventListener('message', event => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }

    if (event.data && event.data.type === 'CLEAR_CACHE') {
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => caches.delete(cacheName))
            );
        });
    }
});

console.log('Service Worker loaded');
