(function() {

    const app = {
        init() {
          app.registerServiceWorker();
          
          self.addEventListener("fetch", (event) => {
          event.respondWith(
            cacheFirst({
              request: event.request,
              fallbackUrl: "/pics/photo_001.jpg",
            }));
          });
        },
        config: {

        },
        registerServiceWorker: async function() {
          if ("serviceWorker" in navigator) {
            try {
              app.registration = await navigator.serviceWorker.register("sw.js", {
                scope: "/",
              });
              if (app.registration.installing) {
                console.log("Service worker installing");
              } else if (app.registration.waiting) {
                console.log("Service worker installed");
              } else if (app.registration.active) {
                console.log("Service worker active");
              }
            } catch (error) {
              console.error(`Registration failed with ${error}`);
            }
          }
        },

        putInCache: async function(request, response) {
          app.cache = await caches.open("v1");
          await app.cache.put(request, response);
        },
        cacheFirst: async function({ request, fallbackUrl }) {
          // Try the cache first
          const responseFromCache = await caches.match(request);
          if (responseFromCache) {
            return responseFromCache;
          }

          // Next try to get the resource from the network
          try {
            const responseFromNetwork = await fetch(request);
            
            // response cloned because responses can only be read once
            putInCache(request, responseFromNetwork.clone());   
            return responseFromNetwork;
          } catch (error) {
            const fallbackResponse = await caches.match(fallbackUrl);
            if (fallbackResponse) {
              return fallbackResponse;
            }
            // when even the fallback response is not available,
            // there is nothing we can do, but we must always
            // return a Response object. Let's return a nice message
            return new Response("External resource unavailable", {
              status: 408,
              headers: { "Content-Type": "text/plain" },
            });
          }
        };
      }

})();

