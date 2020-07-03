/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

const { ajaxSettings } = require('jquery');

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// require('./components/Example');



$(document).ready(function () {
    "use strict";
    // setup ajax to use csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



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
        var anchor = $(e.currentTarget);
        $('html, body').stop().animate({
            scrollTop: ($(anchor.attr('href')).offset().top)
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

    // switch currency
    $(document).on('click', '#currency-switcher .btn', (e) => {
        e.preventDefault();
        const btn = $(e.currentTarget);
        const currency = btn.attr('data-currency');
        
        $.ajax({
            url: '/settings/currency',
            method: 'POST',
            data: {currency},
            success: (data) => {
                let result = JSON.parse(data);
                if (result.status == 'success') {
                    location.reload();
                }
            },
            error: (error) => {
                console.error("An error occurred.", error);
            }
        });
    });


    // checkout    
    $(document).on('click', '.btn-minus-quantity,.btn-plus-quantity,.btn-erase-item', (e) => {
        e.preventDefault();
        const btn = $(e.currentTarget);
        const id = btn.attr('data-id');
        const quantitySpan = $('span#quantity-' + id);
        const priceSpan = $('span#price-' + id);
        const totalPriceSpan = $('span#price-total-' + id);
        const vatSpan = $('span#vat-cost' );
        const grandTotalSpan = $('span#grand-total');

        let quantity = parseInt(quantitySpan.text());
        const price = parseFloat(priceSpan.text());
        let grandTotal = parseFloat(grandTotalSpan.text());
        
        let totalPrice = parseFloat(totalPriceSpan.text());

        if (btn.hasClass('btn-minus-quantity')) {

            if (quantity > 1) {
                quantity--;
                grandTotal -= price;
                $.ajax({
                    url: '/basket/item',
                    method: 'PATCH',
                    dataType: 'json',            
                    data: {'product-id': id, 'item-quantity': quantity},
                    success: (data) => {                    
                        if (data.status == 'success') {
                            location.reload();
                        }
                    },
                    error: (error) => {
                        console.error('An error occurred.', error);
                    }
                });
            }
        } else if (btn.hasClass('btn-plus-quantity')) {
            if (quantity < 100) {
                quantity++;
                grandTotal += price;
                $.ajax({
                    url: '/basket/item',
                    method: 'PATCH',
                    dataType: 'json',            
                    data: {'product-id': id, 'item-quantity': quantity},
                    success: (data) => {                    
                        if (data.status == 'success') {
                            location.reload();
                        }
                    },
                    error: (error) => {
                        console.error('An error occurred.', error);
                    }
                });
            }

        } else if (btn.hasClass('btn-erase-item')) {
            let canDelete = confirm("Are you sure you want to remove the item from basket?");
            if (canDelete) {
                $.ajax({
                    url: '/basket/item',
                    method: 'DELETE',
                    dataType: 'json',            
                    data: {'product-id': id},
                    success: (data) => {                    
                        if (data.status == 'success') {
                            location.reload();
                        }
                    },
                    error: (error) => {
                        console.error('An error occurred.', error);
                    }
                });
            }

        }


        totalPrice = quantity * price;
        let vat = grandTotal - grandTotal/(1 + settings.vat/100);
        quantitySpan.text(quantity.toString());
        totalPriceSpan.text(totalPrice.toFixed(2));
        vatSpan.text(vat.toFixed(2));
        grandTotalSpan.text(grandTotal.toFixed(2));

        setTimeout(20);
    });

});