window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

window.fmSetLink = function($url){
    window.objInputFileManager.val($url.replace(process.env.MIX_APP_URL+'/storage', '')).change();

    // Create native event
    const event = new Event('input', { bubbles: true });

    // Dispatch the event on "native" element
    window.objInputFileManager.get(0).dispatchEvent(event);
}

window.setCharAt = function(str,index,chr){
    if(index > str.length-1) return str;
    return str.substr(0,index) + chr + str.substr(index+1);
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
