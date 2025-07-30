var staticCacheName = "pwa-v6.1799" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
];

// Cache on install 
self.addEventListener("install", event => {
    this.skipWaiting();
    console.log('11' , '--', staticCacheName)
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

//Clear cache on activate
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
    // self.addEventListener("fetch", event => {
        //     console.log(event);
        //     event.respondWith(
        //         caches.match(event.request)
        //             .then(response => {
        //                 return response || fetch(event.request);
        //             })
        //             .catch(() => {
        //                 return caches.match('offline');
        //             })
        //     )
// });

// Cache then Network
    // self.addEventListener('fetch', function (event) {
        //   event.respondWith(
        //     caches.match(event.request).then(function (response) {
        //       return response || fetch(event.request).then(function(resp){
        //             return caches.open(staticCacheName).then(function(cache){
        //                         return cache.match(event.request).then(function (response) {
        //                             if(response != undefined){
        //                                 //return response;
        //                                 cache.put(event.request, resp.clone());
        //                                 return resp;
        //                             }else{
        //                                 cache.put(event.request, resp.clone());
        //                                 return resp;
        //                             }
        //                         })
        //                     })
        //         });
        //     }),
        //   );
// });

// Network then Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        fetch(event.request)
        .then(function(resp){
            if(event.request.method != 'GET'){
                return resp;
            }
            return caches.open(staticCacheName).then(function(cache){
                        return cache.match(event.request).then(function (response) {
                            if(response != undefined){
                                //return response;
                                cache.put(event.request, resp.clone());
                                return resp;
                            }else{
                                cache.put(event.request, resp.clone());
                                return resp;
                            }
                        })
                    })
        })
        .catch(function(err){
            return caches.match(event.request)
                .then(response => {
                    if(response != undefined){
                        return response;
                    }else{
                        return caches.match('offline').then(resp => {
                            return resp;
                        });
                    }
                })
                .catch((er) => {
                    console.log(er);
                })
        })
    )
});

self.addEventListener('push', (event) => {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }
    if (event.data.json()) {
        var msg = event.data.json();
            console.log(msg, msg.data, 'as');
            event.waitUntil(
                self.registration.pushManager.getSubscription().then(function(subscription) {
                    if(msg.data.for == 'guest'){
                        let current =  msg.data.sub_id.find(element => element.endpoint == subscription.endpoint);

                        if(current && current.subscribable_id == msg.data.id){
                            fetch('/push-user', {
                                method: 'POST',
                                body: JSON.stringify({'id':current.endpoint}),
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                }
                            })
                            .then((res) => {
                                if(res.status == 200){
                                    self.registration.showNotification(msg.title, {
                                    body: msg.body,
                                    icon: msg.icon,
                                    actions: msg.actions
                                    })
                                }
                            })
                            .catch((err) => {
                                console.log(err)
                            });
                        }
                        }
                    if(msg.data.for == 'global'){
                            self.registration.showNotification(msg.title, {
                                        body: msg.body,
                                        icon: msg.icon,
                                        actions: msg.actions
                                        })
                    }
                })
            );
    }
});

self.addEventListener('notificationclick', (event) => {
const clickedNotification = event.notification;
clickedNotification.close()
  // Do something as the result of the notification click
const examplePage = 'https://happywed.in/login';
const promiseChain = clients.openWindow(examplePage);
event.waitUntil(promiseChain);
});



// self.addEventListener("fetch", event => {
//     event.respondWith(
//         fetch(event.request)
//             .then(response => {
//                 // Clone the response to cache it
//                 const clonedResponse = response.clone();

//                 // Open the cache and update it with the new response
//                 return caches.open(staticCacheName).then(cache => {
//                     cache.put(event.request, clonedResponse);
//                     return response;
//                 });
//             })
//             .catch(() => {
//                 // If the network fetch fails, try to respond from cache
//                 return caches.match(event.request)
//                     .then(responseFromCache => {
//                         if (responseFromCache) {
//                             return responseFromCache;
//                         } else {
//                             return caches.match('offline'); // Fallback to offline page
//                         }
//                     })
//                     .catch(error => {
//                         console.error('Error fetching and caching:', error);
//                     });
//             })
//     );
// });