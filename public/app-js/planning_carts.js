$(document).on('change', '.sku,.weight_empty,.weight_product', function(e) {
    e.preventDefault();
    var val=$(this).attr('data-val');
    swal({
        title: LANG.are_you_sure,
        text: LANG.continue,
        icon: "warning",
        buttons: true,
        dangerMode: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
    })
    .then((isConfirm) => {
        if (!isConfirm) {
            $(this).val(val);
        }else{
            $(this).attr('data-val', $(this).val());
        }
    });
});
////////////////////////////////
var selectedRows = [];
$(document).on('change', '.next_process,.next_employee_id,.caliber_id', function(e) {
    var rowIndex=$(this).data('index');
    console.log(rowIndex)
    if(rowIndex!== undefined){
        var exists = selectedRows.includes(rowIndex);
        if (!exists) {
            selectedRows.push(rowIndex);
        }
    }
});
$(document).on('click', '#save,#save-print', function(e) {
    var print=$(this).data('print');
    console.log(selectedRows)
    if(selectedRows.length>=1){
        swal({
            title: LANG.are_you_sure,
            text: LANG.continue,
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
        })
        .then((isConfirmed) => {
            if (isConfirmed) {
                console.log(selectedRows.length)
                var table = $('#datatable-buttons').DataTable();
                var dataObj;
                var selectedData=[];
                for(var i=0;i<selectedRows.length;i++){
                    var rowData = table.row(selectedRows[i]);
                    var id = $('input[name="id"]', rowData.node()).val();
                    var sku = $('input[name="sku"]', rowData.node()).val();
                    var weight_empty = $('input[name="weight_empty"]', rowData.node()).val();
                    var weight_product = $('input[name="weight_product"]', rowData.node()).val();
                    var recent_place = $('select[name="recent_place"]', rowData.node()).val();
                    var process = $('select[name="process"]', rowData.node()).val();
                    var next_process = $('select[name="next_process"]', rowData.node()).val();
                    var next_place = $('select[name="next_place"]', rowData.node()).val();
                    var caliber_id = $('.caliber_id option:selected', rowData.node()).map(function() {
                        return $(this).val();
                    }).get();
                    var employee_id = $('.employee_id option:selected', rowData.node()).map(function() {
                        return $(this).val();
                    }).get();
                    var next_employee_id = $('.next_employee_id option:selected', rowData.node()).map(function() {
                        return $(this).val();
                    }).get();
                    // var recent_car_content = $('.recent_car_content', rowData.node()).val();
                    // if(next_process!=='' && next_employee_id!=='' && caliber_id!==''){
                        
                        dataObj = {
                            id: id,
                            sku: sku,
                            weight_empty : weight_empty,
                            weight_product : weight_product,
                            employee_id : employee_id,
                            recent_place : recent_place,
                            next_process: next_process,
                            next_place: next_place,
                            caliber_id: caliber_id,
                            next_employee_id: next_employee_id,
                            process : process,
                            // recent_car_content : recent_car_content
                        };
                        selectedData.push(dataObj);
                    // }
                }
                saveCarPlanning(selectedData,print);
            }else{
                selectedRows=[];
            }
        });
    }else{
        swal(LANG.no_cart_changed, '', "error");
    }
});
function saveCarPlanning(selectedData,print) {
    if(selectedData.length>=1){
        $.ajax({
            method: "post",
            url: "/planning-carts",
            data: {selectedData:selectedData,
                print:print
            },
            success: function (response) {
                new PNotify( {title: response.msg, text: response.msg,type: "success"});
                if(response.html_content!=='' && print==1){
                pos_print(response.html_content);
                }
                selectedRows=[];
            }
        });
    }else{
        swal(LANG.no_cart_changed, '', "error");
    }
}
function pos_print(receipt) {
    $("#receipt_section").html(receipt);
    const sectionToPrint = document.getElementById('receipt_section');
    __print_receipt(sectionToPrint);
}
function __print_receipt(section= null) {
    setTimeout(function () {
        section.style.display = 'block';
        window.print();
        section.style.display = 'none';
    
    }, 1000);
}

$(document).on('change','.next_process',function (e) { 
    var next_process=$(this).val();
    $.ajax({
        type: "get",
        url: "/cars/get-places/"+next_process,
        contactType: "html",
        success: function (response) {
            console.log(response)
            $('.selectpicker').selectpicker();

            $(".next_place").empty().append(response);
        }
    });
});

////
$(document).on('click','.add-barcode',function(e){
    e.preventDefault();
    $.ajax({
        type: "get",
        url: "/cars/get-barcode/"+$(this).data('car'),
        success: function (response) {
           console.log(response);
           pos_print(response.html_content);
        }
    });
});
/////
$(document).on('click','.change_plan',function(e){
    var table = $('#datatable-buttons').DataTable();
    var index=$(this).data('id');
    var cartData = [];
    var rowData = table.row(index);
    var id = $('input[name="id"]', rowData.node()).val();
    var sku = $('input[name="sku"]', rowData.node()).val();
    var weight_empty = $('input[name="weight_empty"]', rowData.node()).val();
    var weight_product = $('input[name="weight_product"]', rowData.node()).val();
    var recent_place = $('select[name="recent_place"]', rowData.node()).val();
    var process = $('select[name="process"]', rowData.node()).val();
    var next_process = $('select[name="next_process"]', rowData.node()).val();
    var next_place = $('select[name="next_place"]', rowData.node()).val();
    var caliber_id = $('.caliber_id option:selected', rowData.node()).map(function() {
        return $(this).val();
    }).get();
    var employee_id = $('.employee_id option:selected', rowData.node()).map(function() {
        return $(this).val();
    }).get();
    var next_employee_id = $('.next_employee_id option:selected', rowData.node()).map(function() {
        return $(this).val();
    }).get();
    // var recent_car_content = $('.recent_car_content', rowData.node()).val();
    // if(next_process!=='' && next_employee_id!=='' && caliber_id!==''){
        dataObj = {
            id: id,
            sku: sku,
            weight_empty : weight_empty,
            weight_product : weight_product,
            employee_id : employee_id,
            recent_place : recent_place,
            next_process: next_process,
            next_place: next_place,
            caliber_id: caliber_id,
            next_employee_id: next_employee_id,
            process : process,
            // recent_car_content : recent_car_content
        };
        console.log(dataObj);
        cartData.push(dataObj);
        $.ajax({
            method: "post",
            url: "/change-cart-plan",
            data: {cartData:cartData,},
            success: function (response) {
                new PNotify( {title: response.msg, text: response.msg,type: "success"});
                cartData=[];
            }
        });             
});