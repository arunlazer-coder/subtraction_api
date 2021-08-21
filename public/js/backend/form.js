$('select').addClass("select2");

$(document).ready(function() {

    
    $("#btn-submit").click(function(e){
        e.preventDefault();
        initFile();
        var data = $('form').serialize();
        if(typeof addData !== 'undefined'){
            data = data + addData
        }
        var route = $('form').attr('action');
        var method = $('form').attr('method');
        var btn = $(this);
        $(this).buttonLoader('start');
        $.ajax({
            url: route,
            type: method,
            dataType: 'json',
            beforeSend: function(){
            // Show image container
                $("#formBO :input").prop("disabled", true);
            },
            data: data,
            success: function(data) {
                $('.error').empty()
                if (data.redirect) {
                    // data.redirect contains the string URL to redirect to
                    window.location.href = data.redirect;
                }
                if(data.errors){
                    printErrorMsg(data.errors)
                }
            },
            error: function(){
                alert("Some server error found...");
            },
            complete:function(data){
                // Hide image container
                $("#formBO :input").prop("disabled", false);
                $(btn).buttonLoader('stop');  
              }
        });
    }); 
    function printErrorMsg (msg) {
        $.each( msg, function( key, value ) {
            var idName = '#formBO_'+key+'_error';
            $(idName).html(value);    
        });
    };

        

});

function initFile () {
    if(typeof file !== 'undefined'){
        $.each(file, function(index, item){
            selector = '#'+item;
            addData = addData + '&' + 'file['+$(selector).attr('id')+ ']=' +$(selector).attr('data-path')
        })
    }
}