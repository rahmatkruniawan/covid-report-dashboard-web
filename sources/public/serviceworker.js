var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/e-dms/sources/public/',
    '/e-dms/sources/public/apps/',
    '/e-dms/sources/public/crm/',
    '/e-dms/sources/public/crm/lead/',
    '/e-dms/sources/public/master/material/',
    '/e-dms/sources/public/master/sales-activity/',
    '/e-dms/sources/public/master/sales-activity/',
    '/e-dms/sources/public/master/sales-activity/opportunity/',
    '/e-dms/sources/public/master/sales-activity/spk/',
    //'/e-dms/sources/public/manifest.json',
    '/e-dms/sources/public/css/app.css',
    '/e-dms/sources/public/js/app.js',
    '/e-dms/sources/public/images/icons/icon-72x72.png',
    '/e-dms/sources/public/images/icons/icon-96x96.png',
    '/e-dms/sources/public/images/icons/icon-128x128.png',
    '/e-dms/sources/public/images/icons/icon-144x144.png',
    '/e-dms/sources/public/images/icons/icon-152x152.png',
    '/e-dms/sources/public/images/icons/icon-192x192.png',
    '/e-dms/sources/public/images/icons/icon-384x384.png',
    '/e-dms/sources/public/images/icons/icon-512x512.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});