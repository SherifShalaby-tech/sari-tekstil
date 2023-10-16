$(document).on('click','.add_row',function(){
        $.ajax({
            type: "get",
            url: "/add-nationality-row",
            dataType: "html",
            success: function (response) {
                $('.nationalities').append(response);
            }
        });
});
$(document).on('click','.remove_row',function(){
    $(this).closest('.row').remove()
});