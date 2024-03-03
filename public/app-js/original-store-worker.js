// $("input[name='recive_stock']").click(function(){
//     $(this).closest('.recieve').find('input[name="check_recive_stock"]').val($(this)[0].checked);
// });
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
$(document).on('change','.sku',function () {
    $.ajax({
        type: "get",
        url: "/get-cart-weight",
        data: {'car_id':$(this).val()},
        success: function (response) {
            console.log(response)
            $('.car_weight').val(response);
        }
    });
});
$(document).on('change','.nationality_id',function () {
    $.ajax({
        type: "get",
        url: "/get-nationality-weight",
        data: {'nationality_id':$(this).val()},
        success: function (response) {
            console.log(response)
            $('.weight').val(response);
            $('.percent').val(100);
            $('.actual_weight').val(response);
            // $(this).closest('.row_weight').find('.weight').val(response);
        }
    });
});
$(document).on('change','.percent',function () {
    var actual_weight=($('.weight').val()*$(this).val())/100;
    $('.actual_weight').val(actual_weight);
    // $(this).closest('.row_weight').find('.actual_weight').val(actual_weight);
});
$(document).on('change','.actual_weight',function () {
    var percent=(100*$(this).val())/$('.weight').val();
    $('.percent').val(percent);
    // $(this).closest('.row_weight').find('.actual_weight').val(actual_weight);
});
