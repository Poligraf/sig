// Ajax request to ensure reload of pages does not loose 
// data during barcode scanning due to pages refresh
 $( '.trackClass' ).on( 'submit', function(e) {


    var form = $(".trackClass");
    $.ajax({
        url     : form.attr("action"),
        type    : "POST",
        data    : form.serialize(),
        dataType : 'json',
        success : function () 
        {
            $('.trackClass')[0].reset();
            toastr.success('Legit.', '', {timeOut: 1000})
        },
        error   : function ( jqXhr, json, errorThrown ) 
        {
            var errors = jqXhr.responseJSON;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<p>' + value + '</p>'; 
            });
            toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
        }
    })
    .done(function(response)
    {
        //
    })
    .fail(function( jqXHR, json ) 
    {
        //
    });
    toastr.options = {
                        
                       "positionClass": "toast-bottom-center"
                    }

    return false;
});