/**
 * Number.prototype.format(n, x)
 *
 * @param integer n: length of decimal
 * @param integer x: length of sections
 */
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};


/**
 * Initial Materialize Plugin
 */
$(document).ready(function(){
    $('select.materialize-select').formSelect();
    $('textarea.character-counter, input.character-counter').characterCounter();
    $('.materialize-tooltip').tooltip();
});


/**
 * Script Mobile Menu Sidebar
 */
(function($){
    $(function() {
        $('.sidenav').sidenav();
    });
})(jQuery);


/**
 * Script Form Input Edit Product
 * Preview File Before Upload Images
 */
$(document).on('change', '.input-image', function(e) {
    let files = $(this)[0].files;
    let target = $(this).attr('target');
    let inputImage = $(this).clone();

    if (files && files[0]) {

        for (var i = 0; i < files.length; i++) {

            let reader = new FileReader();
            let copy = $('#'+target).find('.preview-image.master').clone();
            copy.removeClass('hide master');

            reader.onload = function (e) {
                copy.find('img').attr('src', e.target.result);
                inputImage.attr('name', 'images[]');
                inputImage.removeAttr('id class target');
                inputImage.addClass('hide');
                copy.append(inputImage);
                $('#'+target).append(copy);
            }

            reader.readAsDataURL(files[i]);
        }

    }
});

/**
 * Script Form Input Edit Product
 * Remove Preview Image
 */
$(document).on('click', '.preview-image .btn-delete', function(e) {
    $(this).closest('.preview-image').remove();
});


/**
 * Script Add Product to Cart
 */
$(document).on('click', '.product .buy', function(e) {
    e.preventDefault();
    let productId = $(this).data('id');
    let processUrl = $(this).attr('href');

    let postData = {
        'product_id': [productId],
        'qty': [1],
        'method': ['add'],
    };

    $.ajax({
        url: processUrl,
        type: 'POST',
        data: postData,
        success: function(result, status, xhr) {
            console.log(result);
            console.log(status);
            window.location = result['redirect'];
        },
        error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
            console.log(xhr);
        }
    })
})


/**
 * Script Checkout Cart - Ajax Update Cart
 */
$(document).on('click', '.btn-checkout', function(e) {
    e.preventDefault();
    let ids = [];
    let qty = [];
    let methods = [];
    let processUrl = '';

    $('.cart .cart-item').each(function() {
        ids.push($(this).data('id'));
        qty.push($(this).find('input.qty').val());
        methods.push('update');
        processUrl = $(this).data('url');
    })

    let postData = {
        'product_id': ids,
        'qty': qty,
        'method': methods,
    };

    $.ajax({
        url: processUrl,
        type: 'POST',
        data: postData,
        beforeSend: function() {
            $('.checkout-preloader').removeClass('hide');
        },
        success: function(result, status, xhr) {
            // console.log(result);
            // console.log(status);
            $('.checkout-preloader').addClass('hide');
            $('.cart-container').addClass('hide');
            $('.form-checkout').removeClass('hide');
        },
        error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
            console.log(xhr);
            $('.checkout-preloader').removeClass('hide');
        }
    })
})

/**
 * Script Delete Cart Item
 */
$(document).on('click', '.cart .cart-item .delete-item', function(e) {
    e.preventDefault();
    let cartItem = $(this).closest('.cart-item');
    let productId = cartItem.data('id');
    let processUrl = cartItem.data('url');

    let postData = {
        'product_id': [productId],
        // 'qty': [1], // Optional
        'method': ['delete'],
    };

    $.ajax({
        url: processUrl,
        type: 'POST',
        data: postData,
        success: function(result, status, xhr) {
            console.log(result);
            console.log(status);
            cartItem.remove();
            if ($('.cart .cart-item')) {
                location.reload();
            }
        },
        error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
            console.log(xhr);
        }
    })
})

/**
 * Script Cart Change Total Price
 */
$(document).on('change', '.cart-item .qty', function(e) {
    e.preventDefault();
    // Count item total price
    let cartItem = $(this).closest('.cart-item');
    let qty = parseInt($(this).val());
    let price = parseInt($(this).data('price'));
    let total = (qty * price).format();
    cartItem.find('.item-total-price').html('Rp. '+total);
    // Count cart total price
    let totalPrice = 0;
    $('.cart .cart-item').each(function() {
        let qty = parseInt($(this).find('input.qty').val());
        let price = parseInt($(this).find('input.qty').data('price'));
        totalPrice += price * qty;
    });
    $('.cart-total-price').html('Rp. '+totalPrice.format());
});

/**
 * Hide checkout form and back to cart list
 */
$(document).on('click', '.back-to-cart', function(e) {
    e.preventDefault();
    $('.cart-container').removeClass('hide');
    $('.form-checkout').addClass('hide');
})
