const cacheName = 'cache-v1';
const precacheResources = [
	'/',
	'home',
	'assets/images/logo/logo.png',
	'assets/images/portrait/small/avatar-s-11.jpg',
	'assets/vendors/css/vendors.min.css',
	'assets/css/bootstrap.css',
	'assets/css/bootstrap-extended.css',
	'assets/css/colors.css',
	'assets/css/components.css',
	'assets/css/core/menu/menu-types/horizontal-menu.css',
	'assets/css/pages/dashboard-analytics.css',
	'assets/css/style.css',
	'assets/vendors/css/tables/datatable/datatables.min.css',
	'assets/vendors/css/extensions/sweetalert2.min.css'
];

self.addEventListener('install', event => {
  console.log('Service worker install event!');
  event.waitUntil(
    caches.open(cacheName)
      .then(cache => {
        return cache.addAll(precacheResources);
      })
  );
});

self.addEventListener('activate', event => {
  console.log('Service worker activate event!');
});

self.addEventListener('fetch', event => {
  console.log('Fetch intercepted for:', event.request.url);
  event.respondWith(caches.match(event.request)
    .then(cachedResponse => {
        if (cachedResponse) {
          return cachedResponse;
        }
        return fetch(event.request);
      })
    );
});