$(document).on('change', '.sku,.weight_empty,.weight_product', function(e) {
    e.preventDefault();
    var val=$(this).attr('data-val');
    alert(val)
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
    var exists = selectedRows.includes(rowIndex);
    if (!exists) {
        selectedRows.push(rowIndex);
    }
});
$(document).on('click', '#save,#save-print', function(e) {
    var print=$(this).data('print');
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
        .then((isConfirm) => {
            if (isConfirm) {
                var table = $('#datatable-buttons').DataTable();
                var dataObj;
                var selectedData=[];
                for(var i=0;i<selectedRows.length;i++){
                    var rowData = table.row(selectedRows[i]);
                    var id = $('input[name="id"]', rowData.node()).val();
                    var sku = $('input[name="sku"]', rowData.node()).val();
                    var weight_empty = $('input[name="weight_empty"]', rowData.node()).val();
                    var weight_product = $('input[name="weight_product"]', rowData.node()).val();
                    var recent_place = $('input[name="recent_place"]', rowData.node()).val();
                    var process = $('.process', rowData.node()).val();
                    var next_process = $('.next_process', rowData.node()).val();
                    var caliber_id = $('.caliber_id', rowData.node()).val();
                    var employee_id = $('.employee_id', rowData.node()).val();
                    var next_employee_id = $('.next_employee_id', rowData.node()).val();
                    var recent_car_content = $('.recent_car_content', rowData.node()).val();
                    alert(next_employee_id);
                    if(next_process!=='' && next_employee_id!=='' && caliber_id!=='' ){
                        dataObj = {
                            id: id,
                            sku: sku,
                            weight_empty : weight_empty,
                            weight_product : weight_product,
                            employee_id : employee_id,
                            recent_place : recent_place,
                            next_process: next_process,
                            caliber_id: caliber_id,
                            next_employee_id: next_employee_id,
                            process : process,
                            recent_car_content : recent_car_content
                        };
                        selectedData.push(dataObj);
                    }
                }
                console.log(selectedData);
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
                console.log(response)
            }
        });
    }else{
        swal(LANG.no_cart_changed, '', "error");
    }
}