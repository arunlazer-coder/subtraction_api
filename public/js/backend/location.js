
$(document).ready(function() {
    $('.js-data-example-ajax').select2({
        ajax: {
            url: 'https://api.github.com/search/repositories?q=a',
            dataType: 'json'
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        }
    });
});
function getList(id, route, routeName){
    
    var selectId = "#formBO_"+route+"_id"
    var data = 'id='+ id
    $(selectId).empty()
    $.ajax({   
                    url:routeName,
                    type:'GET',
                    data:data,
                    dataType: 'json',
                    success:function(data) {
                        
                        if(data.length > 0){
                            var option = "<option value=''>Select</option>";
                            $(selectId).prepend(option);
                            $.each(data, function(i, item) {
                                var id = item.id;
                                var name = item.name;
                                
                                var option = "<option value='"+id+"'>"+name+"</option>"; 
                                $(selectId).append(option); 
                            });
                        }
                    }
                });
}