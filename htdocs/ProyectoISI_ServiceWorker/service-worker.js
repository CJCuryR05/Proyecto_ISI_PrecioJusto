const CACHE_NAME = 'mi-app-cache-v1';
const urlsToCache = [
    '/',
    '/index.html',
    '/login.html',
    '/quejas.html',
    '/sesion.html',
    '/CategoriaCrepes.php',
    '/CategoriaPerrosCalientes.php',
    '/CategoriaCafe.php',
    '/CategoriaEnsaladas.php',
    '/CategoriaSandwiches.php',
    '/CategoriaWaffles.php',
    '/css/styles.css',
    '/js/scripts.js',
    '/images/icon-192x192.png',
    '/images/icon-512x512.png'
];

// Instalaci�n del Service Worker y cacheo de recursos
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Abriendo cach�');
                return cache.addAll(urlsToCache);
            })
    );
});

// Activaci�n del Service Worker y limpieza de cach�s antiguas
self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        console.log('Eliminando cach� antigua:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Interceptaci�n de solicitudes de red y respuesta desde la cach�
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) {
                    console.log('Respuesta desde la cach�:', event.request.url);
                    return response;
                }
                console.log('Obteniendo de la red:', event.request.url);
                return fetch(event.request).then(
                    response => {
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }
                        const responseToCache = response.clone();
                        caches.open(CACHE_NAME)
                            .then(cache => {
                                cache.put(event.request, responseToCache);
                            });
                        return response;
                    }
                );
            })
    );
});

