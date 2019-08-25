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
});

// $(document).ready(function (e){
//     $("#uploadForm").on('submit',(function(e){
//         e.preventDefault();
//         $.ajax({
//         url: "upload.php",
//         type: "POST",
//         data:  new FormData(this),
//         contentType: false,
//         cache: false,
//         processData:false,
//         success: function(data){
//         $("#targetLayer").html(data);
//         },
//         error: function(){}
//         });
//     }));
// });