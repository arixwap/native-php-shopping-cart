(function($){

    $(function(){

        $('.sidenav').sidenav();

    }); // end of document ready

})(jQuery); // end of jQuery name space


/**
 * Initial Materialize Plugin
 */
$(document).ready(function(){
    $('select.materialize-select').formSelect();
    $('textarea.character-counter, input.character-counter').characterCounter();
    $('.materialize-tootlip').tooltip();
});


/**
 * JQuery Preview File Before Upload Images
 */
$(document).on('change', '.input-image', function(e){
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
 * Remove Preview Image
 */
$(document).on('click', '.preview-image .btn-delete', function(e) {
    $(this).closest('.preview-image').remove();
});