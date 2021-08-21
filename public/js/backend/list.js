$(function () {

    $('.statusButton').change(function(){
        model   = $(this).attr('data-model');
        id      = $(this).attr('data-id');
        url     = $(this).attr('data-url');

        $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            url: url,
            data: { id: id, url:url, model:model },
            beforeSend: function () {
                $("#load").show();
            },
            error: function(){
                alert('server error found');
                $( "#load" ).hide();
            }
        })
        .done(function () { 
            $( "#load" ).hide();
        })
    })
    
    $(".selectAll").click(function () {
        if($('.selectAll').is(':checked')){
            $('.check').each(function(){
                if(!$(this).hasClass('selected') ){
                    $(this).children('.tdCheckBox').click();
                }
            }); 
        }
        else {
            $('.check').each(function(){
                if($(this).hasClass('selected') ){
                    $(this).children('.tdCheckBox').click();
                }
            }); 
        }
    })


    let deleteButtonTrans = 'delete'    
    let deleteButton = {
        text: deleteButtonTrans,
        url: massDestroyUrl,
        className: 'btn-danger',
        action: function (e, dt, node, config) {
        var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
            return $(entry).data('entry-id')
        });

        if (ids.length === 0) {
            alert('No Rows Selected')
            return
        }

        if (confirm('Are you sure ?')) {
            $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            url: config.url,
            data: { ids: ids, _method: 'DELETE' }})
            .done(function () { location.reload() })
        }
        }
    }
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    if (canDelete) {
        dtButtons.push(deleteButton)
    }   
    

    $('.datatable:not(.ajaxTable)').DataTable({
                                                 buttons: dtButtons ,
                                                 pageLength:10,
                                                //  "columns": column
                                              })

})