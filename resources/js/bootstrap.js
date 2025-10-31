import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import * as Popper from '@popperjs/core'
window.Popper = Popper
import axios from 'axios';
import 'bootstrap';
window.axios = axios;

import jQuery from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;



window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.params = {
//     param1: 'value1',
//     param2: 'value2'
//   };

navigator.geolocation.getCurrentPosition(
    position => {
        let lat = position.coords.latitude
        let lng = position.coords.longitude
        window.axios.defaults.params = {
            latitude:lat,
            longitude: lng
        };
    },
    error => {
        // console.log(error.message);

    },
)

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */



// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

// We have dybamic pusher in a mixin "PusherMixin"

