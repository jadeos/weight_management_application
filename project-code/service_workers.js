/*
Script will be used to register service workers to allow users to work in offline mode
Created by : Jade O'Sullivan 
Date: 15/2/17
Updated 25/3/17: 
*/ 
var version="v2::";
var dataCacheName = 'weightmentordata-v1';
var cacheName = 'offlinecache-2';


self.addEventListener("install", function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(cacheName).then(function(cache) {
        console.log('Opened cache');
        return cache.addAll([
            'css/main.css',
   'css/bootstrap.css',
   'css/bootstrap-theme.min.css',
  'css/bootstrap.min.css',
   'js/jquery-2.2.4.min.js',
  'js/bootstrap.js',
  'js/bootstrap.min.js',
  'js/functions.js',
  'js/notifications.js',
   'js/jquery.canvasjs.min.js',
   'img/logo.png',
  'helpers/functions.php',
  'js/search.js',
  'views/includes/login_register_model.php',
  'classes/logs.php',
  'classes/logout.php',
  'database_functions/notification_messages.php',
  'database_functions/users.php',
  'database_functions/weight_log.php',
  'database_functions/food_log.php',
  'database_functions/exercise_log.php',
  'database_functions/water_log.php',
  'views/profile.php',
  'views/includes/header.php',
  'views/includes/footer.php',
   'views/adminView.php',
   'views/settings.php',
   'views/login.php',
   'views/updateAccount.php',
   'views/resetform.php',
   'views/passwordReset.php',
   'database/database.php',
   'views/home.php'

          ]);
      })
  )
})

self.addEventListener("fetch", function(event) {
event.respondWith(


    caches.match(event.request).then(function(cached) {
        var networked = fetch(event.request).then(fetchedFromNetwork, unableToResolve)
         .catch(unableToResolve);
        return cached || networked;

         function fetchedFromNetwork(response) { 
          var cacheCopy = response.clone();
          caches .open(cacheName) .then(function add(cache) {
              cache.put(event.request, cacheCopy);
            })
            return response ;
        }
         function unableToResolve () {
         
          return new Response('<h1>Error: Please connect to the internet.</h1>', {
            status: 503,
            statusText: 'Service Unavailable',
            headers: new Headers({
              'Content-Type': 'text/html'
            })
          });
        }
})

);

});

self.addEventListener("activate", function(event) {
  event.waitUntil(
    caches.keys().then(function (keys) {
        //We need to update the cache and delete any old versions. 
        Promise.all(
          keys
            .filter(function (key) {
              return !key.startsWith(cacheName);
            })
            .map(function (key) {
              return caches.delete(key);
            })
        );
      })
  );
});