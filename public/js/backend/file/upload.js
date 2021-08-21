var currentFile = $('.fileUpload');

currentFile.siblings('.fileRemove').on("click", function(){
    $(this).siblings('input').val('');
    $(this).siblings('input').attr('data-path', '');
    $(this).siblings('.filePreview').attr('src', '');
    $(this).siblings('.filePreview').hide();
    $(this).hide();
  });

function upload(selector){
    var id = '#'+selector;
    var fd = new FormData();
    fd.append('file' ,$(id)[0].files[0]);
    var url = $(id).attr('data-url');
    $.ajax( {   
                url:url,
                type:'POST',
                contentType: false,
                processData: false,
                data:fd,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data) {
                    $(id).attr('data-path', data)
                    addData = addData + '&file[' + selector + ']=' + data;
                }
            }
            );
};


