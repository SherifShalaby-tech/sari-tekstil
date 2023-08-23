$(document).on('change', '#sku', function(e) {
    e.preventDefault();
    var id=$(this).data(id);
    var sku =$(this).val();
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
            $(this).val('');
            // $.ajax({
            //     type: "get",
            //     url: "/cars/change-sku/"+id.id,
            //     data: {sku:sku},
            //     success: function (response) {
            //         swal("Success", response.msg, "success");
            //     }
            // });
        }
    });
});

$(document).on('change', '#weight_empty', function(e) {
    e.preventDefault();
    var id=$(this).data(id);
    var weight_empty =$(this).val();
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
            $.ajax({
                type: "get",
                url: "/cars/change-weight_empty/"+id.id,
                data: {weight_empty:weight_empty},
                success: function (response) {
                    swal("Success", response.msg, "success");
                }
            });
        }
    });
});

$(document).on('change', '#weight_product', function(e) {
    e.preventDefault();
    var id=$(this).data(id);
    var weight_product =$(this).val();
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
            $.ajax({
                type: "get",
                url: "/cars/change-weight-product/"+id.id,
                data: {weight_product:weight_product},
                success: function (response) {
                    swal("Success", response.msg, "success");
                }
            });
        }
    });
});
var selectedRows = [];
$(document).on('change', '#next_process,#next_employee_id,#caliber_id', function(e) {
    var rowIndex=$(this).data('index');
    var exists = selectedRows.includes(rowIndex);
    if (!exists) {
        selectedRows.push(rowIndex);
    }
    // var next_process=$('#next_process').val();
    // var next_employee_id=$('#next_employee_id').val();
    // var caliber_id=$('#caliber_id').val();
    // if(next_process!==null && next_employee_id!==null && caliber_id!==null ){
        // alert(33)
        // var dataObj = {
        //     id: id,
        //     variation_id : variation_id,
        //     current_stock: current_stock,
        //     actual_stock: actualStock,
        //     shortage: shortage,
        //     shortage_value: shortage_value
        // };
        // selectedData.push(dataObj);
    // }

});
$(document).on('click', '#save', function(e) {
    var table = $('#datatable-buttons').DataTable();
    var dataObj;
    var selectedData=[];
    for(var i=0;i<selectedRows.length;i++){
        var rowData = table.row(selectedRows[i]);
        var id = $('input[name="id"]', rowData.node()).val();
        var weight_product = $('input[name="weight_product"]', rowData.node()).val();
        var next_process = $('#next_process', rowData.node()).val();
        var caliber_id = $('#caliber_id', rowData.node()).val();
        var next_employee_id = $('#next_employee_id', rowData.node()).val();
        if(next_process!=='' && next_employee_id!=='' && caliber_id!=='' ){
            dataObj = {
                id: id,
                weight_product : weight_product,
                next_process: next_process,
                caliber_id: caliber_id,
                next_employee_id: next_employee_id,
                // shortage_value: shortage_value
            };
            selectedData.push(dataObj);
        }
    }
    console.log(selectedData);
    // 
   
});