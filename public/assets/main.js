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
 * Script Cart Send Ajax - Add Product to Cart
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
 * Script Cart Send Ajax - Delete Cart Item
 */
$(document).on('click', '.cart .cart-item .delete-item', function(e) {
    e.preventDefault();
    let cartItem = $(this).closest('.cart-item');
    let productId = $(this).data('id');
    let processUrl = $(this).attr('href');
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
        },
        error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
            console.log(xhr);
        }
    })
})
