
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Vue = require('vue');

/**
 * Vue global components
 */
Vue.component('ipca-calendar', require('./components/calendarios/Index.vue'));
Vue.component('ipca-implement', require('./components/implementos/Index.vue'));

/**
 * Vue instance
 * @type {Vue}
 */
const app = new Vue({
    el: '#app'
});

/*
 * Métodos jQuery Generales
 */
$(window).ready(function()
{
	/**
	 * Loader page
	 */
	$(".loader-page").fadeOut("slow");
});

$(document).ready(function()
{
	/**
	 * Inicializar el tooltip
	 */
	$('[data-toggle="tooltip"]').tooltip();

	/**
	 * Inicializar el popover
	 */
	$('[data-toggle="popover"]').popover();

	/**
	 * Disabled button al enviar el formulario
	 */
	$('form').submit(function()
	{
	    $(this).find('button[type="submit"]').attr('disabled', true);
	});

	/**
	 * Ir al top de la página
	 */
	$(document).on('scroll', function ()
    {
        if ($(window).scrollTop() > 50)
        {
            $('#scroll-top').addClass('visible').fadeIn('2000');
        }
        else
        {
            $('#scroll-top').removeClass('visible').fadeIn('2000');
        }
    });

    $('#scroll-top').on('click', function ()
    {
    	let verticalOffset = typeof(verticalOffset) !== 'undefined' ? verticalOffset : 0;
        let element = $('html');
        let offset = element.offset();
        let offsetTop = offset.top;
        $('html, body').animate({ scrollTop: offsetTop }, 'slow');
    });

});