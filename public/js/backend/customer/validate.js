
    $(".password_icon").click(function() {
        var input = $(this).prev();
        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).children('i').attr('class',"fas fa-eye-slash");
        } else {
            input.attr("type", "password");
            $(this).children('i').attr('class',"fas fa-eye");
        }
    });
    
    $('#formBO').validate({ // initialize the plugin
        rules: {
            'formBO[email]': {
                email: true,
             },
            'formBO[password]': {
                minlength: 8,
             },
            'formBO[confirm_password]': {
                equalTo: "#formBO_password"
             },
            'formBO[mobile]': {
                number: true
             },
             'formBO[profile_photo_path]': {
                accept:"image/*"
             },
        },
        messages: {
                'formBO[email]': {
                        required:"Please type valid email",
                 },
                'formBO[password]': {
                      minlength: "Password minimum of 8 characters" ,
                 },
                'formBO[confirm_password]': {
                    equalTo:"Password mismatch",
                },
                'formBO[mobile]': {
                    number:"Number Invalid",
                },
                'formBO[profile_photo_path]': {
                    accept: "Invalid image"
                 },
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "formBO[password]" || element.attr("name") == "formBO[confirm_password]") {
                var sError = element.parent('div').siblings('span');
                if(sError.html().length){
                    sError.html('');
                }
                error.insertAfter(element.parent('div'));
            } 
            else if (element.attr("name") == "formBO[profile_photo_path]") {
                var sError = element.siblings('span');
                if(sError.html().length){
                    sError.html('');
                }
                error.insertAfter(element.siblings('div'));
            }else {
                var sError = element.siblings('span');
                if(sError.html().length){
                    sError.html('');
                }
                error.insertAfter(element);
            }
        }
    });