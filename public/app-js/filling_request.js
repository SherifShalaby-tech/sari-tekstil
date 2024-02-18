$(document).on('click','.add_row',function(){
    var index = $('.row_index').val();
    $('.row_index').val(parseInt(index)+1)
    var button = $(this); // Store the reference to the button
        $.ajax({
            type: "get",
            url: "/add-filling-row",
            data:{'index':index},
            dataType: "html",
            success: function (response) {
                $('.fillings').append(response);
                $('.fillings .selectpicker').selectpicker('refresh');
                index++;

                // Update the data-index attribute for future clicks
                button.data('index', index);

                // Update the name attribute for the new <select> element
                $('.fillings').find('select[name^="calibers"]').last().attr('name', 'calibers[' + index + '][]');
            }
        });
    
});
$(document).on('click','.remove_row',function(){
    $(this).closest('.row').remove()
});