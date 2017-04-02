/*
Script will be used to register service workers to allow users to work in offline mode
Created by : Jade O'Sullivan 
Date: 15/2/17
Updated 25/3/17: 
*/ 
console.log("boom");
var dataCacheName = 'weightmentordata-v1';
var cacheName = 'weightmentor-cache-v1';
var filesToCache = [
  '/',
  '/index.php',
   'css/main.css',
   'css/bootstrap.css',
   'css/bootstrap-theme.min.css',
  'css/bootstrap.min.css',
   'js/jquery-2.2.4.min.js',
  'js/bootstrap.js',
  'js/bootstrap.min.js',
  'js/functions.js',
  'js/index.js',
  'js/notifications.js',
  'helpers/charts.php',

  'helpers/functions.php',
 
 
  'js/search.js',
  'views/includes/header.php',
  'views/includes/footer.php',
  'views/includes/login_register_model.php',
  'classes/login.php',
  'classes/logout.php',
  'classes/logs.php',
  'classes/notifications.php',
  'classes/register_process.php',
  'database/db.php',
  'database_functions/notification_messages.php',
  'database_functions/users.php',
  'database_functions/weight_log.php',
  'views/profile.php',
  'views/home.php',
  'views/login.php'

];

self.addEventListener('install', function(e) {

 // console.log('[ServiceWorker] Install');
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
    //  console.log('[ServiceWorker] Caching app shell');
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('activate', function(e) {
 // console.log('[ServiceWorker] Activate');
  e.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
       if (key !== cacheName && key !== dataCacheName) {
        //  console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );
  return self.clients.claim();
});

self.addEventListener('fetch', function(e) {
 // console.log('[Service Worker] Fetch', e.request.url);
  var dataUrl = 'https://query.yahooapis.com/v1/public/yql';
  if (e.request.url.indexOf(dataUrl) > -1) {
    /*
     * When the request URL contains dataUrl, the app is asking for fresh
     * weather data. In this case, the service worker always goes to the
     * network and then caches the response. This is called the "Cache then
     * network" strategy:
     * https://jakearchibald.com/2014/offline-cookbook/#cache-then-network
     */
    e.respondWith(
      caches.open(dataCacheName).then(function(cache) {
        return fetch(e.request).then(function(response){
          cache.put(e.request.url, response.clone());
          return response;
        });
      })
    );
  } else {
    /*
     * The app is asking for app shell files. In this scenario the app uses the
     * "Cache, falling back to the network" offline strategy:
     * https://jakearchibald.com/2014/offline-cookbook/#cache-falling-back-to-network
     */
    e.respondWith(
      caches.match(e.request).then(function(response) {
        return response || fetch(e.request);
      })
    );
  }
});