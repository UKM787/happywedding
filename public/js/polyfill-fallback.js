/* Polyfill fallback loader - Immediate detection */
(function() {
    'use strict';

    var polyfillLoaded = false;

    function loadLocalPolyfill() {
        if (polyfillLoaded) return;
        polyfillLoaded = true;

        var script = document.createElement('script');
        script.src = '/js/polyfill.min.js';
        script.async = false;
        script.defer = false;
        document.head.appendChild(script);
        console.log('Loaded local polyfill fallback');
    }

    // Immediately load local polyfill since external one is failing
    loadLocalPolyfill();

})();
