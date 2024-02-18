$(document).on('click','.add_row',function(){
    var index = $('.row_index').val();
    $('.row_index').val(parseInt(index)+1)
    var button = $(this); 
        $.ajax({
            type: "get",
            url: "/add-pressing-row",
            data:{'index':index},
            dataType: "html",
            success: function (response) {
                $('.fillings').append(response);
                $('.fillings .selectpicker').selectpicker('refresh');
                index++;
                
                button.data('index', index);

                $('.fillings').find('select[name^="calibers"]').last().attr('name', 'calibers[' + index + '][]');
            }
        });
    
});
$(document).on('click','.remove_row',function(){
    $(this).closest('.row').remove()
});