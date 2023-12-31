
$(document).on('click','.add_row',function(){
    // var latestRow = $(".row_weight:last");
    var actual_weight =0;
    $(".row_weight").each(function() {
        actual_weight += parseFloat($(this).find(".actual_weight").val());
    });
    var net_weight=parseFloat($('.net_weight').val());
    if(actual_weight<net_weight || actual_weight==0){
        $.ajax({
            type: "get",
            url: "/original-store-worker/add-nationality-row",
            data:{'car_id':$('.sku').val()},
            dataType: "html",
            success: function (response) {
                $('.nationalities').append(response);
                $('.selectpicker').selectpicker();
            }
        });
    }
});
$(document).on('click','.remove_row',function(){
    $(this).closest('.row').remove()
});

$(document).on('change','.percent',function () { 
    var actual_weight=($('.net_weight').val()*$(this).val())/100;
    $(this).closest('.row_weight').find('.actual_weight').val(actual_weight);
});