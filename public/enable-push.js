
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {

            navigator.serviceWorker.register('/serviceworker.js', {
                scope: '/'
            }).then(function (registration) {
                // Registration was successful
                // console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
                initPush();

            }, function (err) {
                // registration failed :(
                // console.log('Laravel PWA: ServiceWorker registration failed: ', err);
            });
        });
    }
// // Get the version from the query parameter
// const queryParams = new URLSearchParams(self.location.search);
// const version = queryParams.get('version');

// // Now you can use the version in your cache names or other parts of the service worker
// const cacheName = `my-cache-${version}`;

function initPush() {
    if (!navigator.serviceWorker.ready) {
        return;
    }
    new Promise(function (resolve, reject) {
        const permissionResult = Notification.requestPermission(function (result) {
            resolve(result);
        });

        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    })
        .then((permissionResult) => {
            if (permissionResult !== 'granted') {
                console.log('Notification permission was not granted.');
                return; // Just return instead of throwing error
            }
            subscribeUser();
        })
        .catch(err => {
            console.log('Error requesting notification permission:', err);
        });
}

function subscribeUser() {
    navigator.serviceWorker.ready
        .then((registration) => {
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(
                    'BDXu64y0IT7ocNMtEaJTZOIIOdyF0MPMkgNwoL79cvqPiwfVQ0fJiE8UxuHt1Y4sBosriAsb6nVQK2sz2R-nOQk' 
                )
            };

            return registration.pushManager.subscribe(subscribeOptions);
        })
        .then((pushSubscription) => {
            // console.log('Received PushSubscription: ', JSON.stringify(pushSubscription), pushSubscription);
            storePushSubscription(pushSubscription);
        });
}

function urlBase64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}
function storePushSubscription(pushSubscription) {
    const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');
    fetch('/push', {
        method: 'POST',
        body: JSON.stringify(pushSubscription),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-Token': token
        }
    })
        .then((res) => {
            return res.json();
        })
        .then((res) => {
            // console.log(res)
        })
        .catch((err) => {
            // console.log(err)
        });
}

