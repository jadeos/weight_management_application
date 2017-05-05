
function createTestNotification(type, message){
  window.addEventListener('load', function(){
         navigator.serviceWorker.register('../service_workers.js').then(function(reg){
               if(reg.installing) {
                 console.log('Service worker installing');
               } else if(reg.waiting) {
                 console.log('Service worker installed');
               } else if(reg.active) {
                 console.log('Service worker active');

               }

              if (!("Notification" in window)) {
                 console.log("Notification not supported");
                 alert("This browser does not support desktop notifications");
               } else if (Notification.permission === "granted") {
              
                   // If it's okay let's create a notification
                   Notification.requestPermission(function(result) {
                   //  console.log("Notifications");
                   //  navigator.serviceWorker.ready.then(function(registration) {
                     // console.log("Notificationssss");

                    testExp = new RegExp('Android|webOS|iPhone|iPad|' +
                      'BlackBerry|Windows Phone|'  +
                      'Opera Mini|IEMobile|Mobile' ,
                     'i');

                      if (testExp.test(navigator.userAgent)){
                        // alert(  "Your device is a Mobile Device");
                          navigator.serviceWorker.ready.then(function(registration) {
                                  registration.showNotification(type,{
                                body: message,
                                icon: '../logo3.png',
                                 badge: '../logo3.png'
                               }) ;
                               });//serv

                       }else{
                          // alert("Your device is NOT a Mobile Device");
                           var notification = new Notification(type,{
                                      body: message,
                                      icon: '../logo3.png',
                                      badge: '../logo3.png'
                                     }) ;
                       }
                    });//service worker ready
    
               // });//notification request permission
                }else if(Notification.permission !== "denied"){
                    console.log("Notification denied");
                    Notification.requestPermission(function(result) {
                      if (result === 'granted') {
                        console.log("Notification granted");
                                   testExp = new RegExp('Android|webOS|iPhone|iPad|' +
                        'BlackBerry|Windows Phone|'  +
                        'Opera Mini|IEMobile|Mobile' ,
                       'i');

                        if (testExp.test(navigator.userAgent)){
                          // alert(  "Your device is a Mobile Device");
                            navigator.serviceWorker.ready.then(function(registration) {
                                    registration.showNotification(type,{
                                  body: message,
                                  icon: '../logo3.png',
                                   badge: '../logo3.png'
                                 }) ;
                                 });//serv

                        }else{
                        // alert("Your device is NOT a Mobile Device");
                         var notification = new Notification(type,{
                                    body: message,
                                    icon: '../logo3.png',
                                    badge: '../logo3.png'
                                   }) ;
                       }
                    }else{
                      console.log("Notification");
                                 testExp = new RegExp('Android|webOS|iPhone|iPad|' +
                      'BlackBerry|Windows Phone|'  +
                      'Opera Mini|IEMobile|Mobile' ,
                     'i');

                        if (testExp.test(navigator.userAgent)){
                          // alert(  "Your device is a Mobile Device");
                            navigator.serviceWorker.ready.then(function(registration) {
                                    registration.showNotification(type,{
                                  body: message,
                                  icon: '../logo3.png',
                                   badge: '../logo3.png'
                                 }) ;
                                 });//serv

                        }else{
                        // alert("Your device is NOT a Mobile Device");
                         var notification = new Notification(type,{
                                    body: message,
                                    icon: '../logo3.png',
                                    badge: '../logo3.png'
                                   }) ;
                           }
                      }
                  });//notification request permission  
              } //if permission ==denied

            }); //navigator

  });
}

//window.onload = createNotification("test");
function createNotification(type, message,todays_time,sent_time){   
         window.addEventListener('load', function() { 
         setInterval(function(){

          var d = new Date();
            var n = d.getHours();
            
            var m = d.getMinutes();
            var s = d.getSeconds();
            var sec = 0;
            if(m<10){

              sec="0"+m;
            }else{
              sec = m;
            }

            var min = 0;
            if(n<10){

              min="0"+n;
            }else{
              min = n;
            }

            var ttime = min+":"+sec;
          console.log(ttime+":"+sec);

        if(ttime===sent_time){
          // console.log(sent_time + todays_time);
           console.log(message);
        
           navigator.serviceWorker.register('../service_workers.js').then(function(reg){
               if(reg.installing) {
                 console.log('Service worker installing');
               } else if(reg.waiting) {
                 console.log('Service worker installed');
               } else if(reg.active) {
                 console.log('Service worker active');

               }

              if (!("Notification" in window)) {
                 console.log("Notification not supported");
                 alert("This browser does not support desktop notifications");
               } else if (Notification.permission === "granted") {
              
                   // If it's okay let's create a notification
                   Notification.requestPermission(function(result) {
                   //  console.log("Notifications");
                   //  navigator.serviceWorker.ready.then(function(registration) {
                     // console.log("Notificationssss");

                    testExp = new RegExp('Android|webOS|iPhone|iPad|' +
                      'BlackBerry|Windows Phone|'  +
                      'Opera Mini|IEMobile|Mobile' ,
                     'i');

                      if (testExp.test(navigator.userAgent)){
                        // alert(  "Your device is a Mobile Device");
                          navigator.serviceWorker.ready.then(function(registration) {
                                  registration.showNotification(type,{
                                body: message,
                                icon: '../logo3.png',
                                 badge: '../logo3.png'
                               }) ;
                               });//serv

                       }else{
                          // alert("Your device is NOT a Mobile Device");
                           var notification = new Notification(type,{
                                      body: message,
                                      icon: '../logo3.png',
                                      badge: '../logo3.png'
                                     }) ;
                       }
                    });//service worker ready
    
               // });//notification request permission
                }else if(Notification.permission !== "denied"){
                    console.log("Notification denied");
                    Notification.requestPermission(function(result) {
                      if (result === 'granted') {
                        console.log("Notification granted");
                                   testExp = new RegExp('Android|webOS|iPhone|iPad|' +
                        'BlackBerry|Windows Phone|'  +
                        'Opera Mini|IEMobile|Mobile' ,
                       'i');

                        if (testExp.test(navigator.userAgent)){
                          // alert(  "Your device is a Mobile Device");
                            navigator.serviceWorker.ready.then(function(registration) {
                                    registration.showNotification(type,{
                                  body: message,
                                  icon: '../logo3.png',
                                   badge: '../logo3.png'
                                 }) ;
                                 });//serv

                        }else{
                        // alert("Your device is NOT a Mobile Device");
                         var notification = new Notification(type,{
                                    body: message,
                                    icon: '../logo3.png',
                                    badge: '../logo3.png'
                                   }) ;
                       }
                    }else{
                      console.log("Notification");
                                 testExp = new RegExp('Android|webOS|iPhone|iPad|' +
                      'BlackBerry|Windows Phone|'  +
                      'Opera Mini|IEMobile|Mobile' ,
                     'i');

                        if (testExp.test(navigator.userAgent)){
                          // alert(  "Your device is a Mobile Device");
                            navigator.serviceWorker.ready.then(function(registration) {
                                    registration.showNotification(type,{
                                  body: message,
                                  icon: '../logo3.png',
                                   badge: '../logo3.png'
                                 }) ;
                                 });//serv

                        }else{
                        // alert("Your device is NOT a Mobile Device");
                         var notification = new Notification(type,{
                                    body: message,
                                    icon: '../logo3.png',
                                    badge: '../logo3.png'
                                   }) ;
                           }
                      }
                  });//notification request permission  
              } //if permission ==denied

            }); //navigator

            }
        
       }, 40000);


      });//window event listener

  }



