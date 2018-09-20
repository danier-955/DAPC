
// window._ = require('lodash');

window.Popper = require('popper.js').default;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

/*
 * SweetAlert2
 */
window.swal = require('sweetalert2');

try
{
	/*
	 * jQuery
	 */
    window.$ = window.jQuery = require('jquery');

    /*
     * Bootstrap 4
     */
    require('bootstrap');

    /*
     * Daemonite material
     */
    require('daemonite-material');

    /*
     * Admin Lte
     */
    // require('admin-lte');

    /*
     * Datatables
     */
    require('datatables.net-bs4');
    require('datatables.net-responsive-bs4');

    /*
     * Select2
     */
    require('select2');
    require('select2/dist/js/i18n/es');

    /*
     * FullCalendar
     */
    // require('fullcalendar');

    /*
     * Moment.js
     */
    window.moment = require('moment');

    /*
     * Bootstrap Material Datetimepicker
     */
    require('./bootstrap-material-datetimepicker-bs4daemonite');

    /*
     * Bootstrap Select
     */
    require('bootstrap-select');
    require('bootstrap-select/js/i18n/defaults-es_ES');

} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });