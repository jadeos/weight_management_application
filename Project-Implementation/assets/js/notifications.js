	

//window.onload = createNotification("test");
function createNotification(message){


    // window.addEventListener('load', function() { 
      
         // navigator.serviceWorker.register('../service_workers.js').then(function(reg)
         //  {


            
         //   if(reg.installing) {
         //     console.log('Service worker installing');
         //   } else if(reg.waiting) {
         //     console.log('Service worker installed');
         //   } else if(reg.active) {
         //     console.log('Service worker active');
         //   }

           
          // if (!("Notification" in window)) {
          //    alert("This browser does not support desktop notifications");
          //  } 
          //  else if (Notification.permission === "granted") {

          //  // If it's okay let's create a notification
          //     Notification.requestPermission(function(result) {
          //      navigator.serviceWorker.ready.then(function(registration) {
                
          //      registration.showNotification(message) ;
          //       });//service worker ready
          //      });//notification request permission
          //     }//if
          //  else if(Notification.permission !== "denied"){
          //   Notification.requestPermission(function(result) {
          //     if (result === 'granted') {
          //      navigator.serviceWorker.ready.then(function(registration) {
          //      registration.showNotification(message) ;
          //       });//service worker ready
          //     }else{
          //       navigator.serviceWorker.ready.then(function(registration) {
          //        registration.showNotification(message) ;
          //      });//service worker ready
          //    }
          //  });//notification request permission  
   //  }
   // }); //navigator
// navigator.serviceWorker.register('../service_workers.js');
// Notification.requestPermission(function(result) {
//   if (result === 'granted') {
//     navigator.serviceWorker.ready.then(function(registration) {
//       registration.showNotification('Notification with ServiceWorker');
//     });
//   }
// });

   if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
    console.log('permission granted');
    // If it's okay let's create a notification
    var notification = new Notification(message);
   // notification.showNotification(message);
   // ServiceWorkerRegistration.showNotification(message);
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== "denied") {
     console.log('permission not granted');
    Notification.requestPermission(function (permission) {
       console.log('permission not even granted');
      // If the user accepts, let's create a notification
      if (permission === "granted") {
       var notification = new Notification(message);
       // ServiceWorkerRegistration.showNotification(message);
      }
    });
  }   //});  //window event listener
}

// function initialiseState() {  
//   // Are Notifications supported in the service worker?  
//   if (!('showNotification' in ServiceWorkerRegistration.prototype)) {  
//     console.warn('Notifications aren\'t supported.');  
//     return;  
//   }

//   // Check the current Notification permission.  
//   // If its denied, it's a permanent block until the  
//   // user changes the permission  
//   if (Notification.permission === 'denied') {  
//     console.warn('The user has blocked notifications.');  
//     return;  
//   }

//   // Check if push messaging is supported  
//   if (!('PushManager' in window)) {  
//     console.warn('Push messaging isn\'t supported.');  
//     return;  
//   }

//   // We need the service worker registration to check for a subscription  
//   navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {  
//     // Do we already have a push message subscription?  
//     serviceWorkerRegistration.pushManager.getSubscription()  
//       .then(function(subscription) {  
//         // Enable any UI which subscribes / unsubscribes from  
//         // push messages.  
//         var pushButton = document.querySelector('.js-push-button');  
//         pushButton.disabled = false;

//         if (!subscription) {  
//           // We aren't subscribed to push, so set UI  
//           // to allow the user to enable push  
//           return;  
//         }

//         // Keep your server in sync with the latest subscriptionId
//       // sendSubscriptionToServer(subscription);

//         // Set your UI to show they have subscribed for  
//         // push messages  
//         pushButton.textContent = 'Disable Push Messages';  
//         isPushEnabled = true;  
//       })  
//       .catch(function(err) {  
//         console.warn('Error during getSubscription()', err);  
//       });  
//   });  
// }
// function subscribe() {  
//   // Disable the button so it can't be changed while  
//   // we process the permission request  
//   var pushButton = document.querySelector('.js-push-button');  
//   pushButton.disabled = true;

//   navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {  
//     serviceWorkerRegistration.pushManager.subscribe()  
//       .then(function(subscription) {  
//         // The subscription was successful  
//         isPushEnabled = true;  
//         pushButton.textContent = 'Disable Push Messages';  
//         pushButton.disabled = false;

//         // TODO: Send the subscription.endpoint to your server  
//         // and save it to send a push message at a later date
//         return;
//       })  
//       .catch(function(e) {  
//         if (Notification.permission === 'denied') {  
//           // The user denied the notification permission which  
//           // means we failed to subscribe and the user will need  
//           // to manually change the notification permission to  
//           // subscribe to push messages  
//           console.warn('Permission for Notifications was denied');  
//           pushButton.disabled = true;  
//         } else {  
//           // A problem occurred with the subscription; common reasons  
//           // include network errors, and lacking gcm_sender_id and/or  
//           // gcm_user_visible_only in the manifest.  
//           console.error('Unable to subscribe to push.', e);  
//           pushButton.disabled = false;  
//           pushButton.textContent = 'Enable Push Messages';  
//         }  
//       });  
//   });  
// }

// self.addEventListener('push', function(event) {  
//   console.log('Received a push message', event);

//   var title = 'Yay a message.';  
//   var body = 'We have received a push message.';  
//   var icon = '/images/icon-192x192.png';  
//   var tag = 'simple-push-demo-notification-tag';

//   event.waitUntil(  
//     self.registration.showNotification(title, {  
//       body: body,  
//       icon: icon,  
//       tag: tag  
//     })  
//   );  
// });
