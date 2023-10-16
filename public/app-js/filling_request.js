$(document).on('click','.add_row',function(){
        $.ajax({
            type: "get",
            url: "/add-filling-row",
            dataType: "html",
            success: function (response) {
                $('.fillings').append(response);
                $('.fillings .selectpicker').selectpicker('refresh');
            }
        });
});
$(document).on('click','.remove_row',function(){
    $(this).closest('.row').remove()
});