/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// require('./components/Example');

$(document).ready(function() {
    "use strict";

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.navbar').on('mousewheel DOMMouseScroll wheel', (e) => {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', () => {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', (e) => {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 500);
        e.preventDefault();
    });

    // Product section
    $(document).on('click', '#btn-quantity-down,#btn-quantity-up', (e) => {
        e.preventDefault();
        let quantity = parseInt($('input#item-quantity').val());
        const price = parseFloat($('input#product-price').val());
        const id = e.currentTarget.id;        
        if (id == 'btn-quantity-down') {
            quantity--;
            if (quantity < 1) quantity = 1;
        } else if (id == 'btn-quantity-up') {
            quantity++;
            if (quantity > 100) quantity = 100;
        }                
        const totalPrice = price * quantity;
        $('input#item-quantity').val(quantity);
        $('span#item-price').text(totalPrice);        
        setTimeout(20);
    });

    $(document).on('click', 'a#btn-add-to-basket', (e) => {
        $('form#basket-form').submit();
        e.preventDefault();
    });
    

});