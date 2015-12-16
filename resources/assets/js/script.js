// Ajax request to ensure reload of pages does not loose 
// data during barcode scanning due to pages refresh
document.getElementsByClassName('trackClass')[0].addEventListener('submit', function(e) {
 e.preventDefault();

       var form = $(".trackClass");
    $.ajax({
        url     : form.attr("action"),
        type    : form.attr("method"),
        data    : form.serialize(),
        dataType: "json",
        success : function ( json ) 
        {
            toastr.success( json.message , "Notifications" );
        },
        error   : function ( jqXhr, json, errorThrown ) 
        {
            var errors = jqXhr.responseJSON;
            console.log(errors);
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; 
            });
            toastr.info( errorsHtml , "Error " );
        }
    })

toastr.options = {
  "progressBar": true,
  "positionClass": "toast-bottom-right"
}
 })