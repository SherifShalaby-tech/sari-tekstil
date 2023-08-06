$(document).on("click", ".add_phone", function () {
let row_id = parseInt($("#raw_phone_index").val());
$("#raw_phone_index").val(parseInt(row_id) + 1);
$('.phones').append("<div class='d-flex justify-content-center phone_row'><input type='text' name='phones[]' class='form-control mt-2' placeholder='"+LANG.phone+" "+$("#raw_phone_index").val()+"'/><button type='button' class='btn btn-xs btn-danger remove_phone'><i class='fa fa-times'></i></button></div>");
});
$(document).on("click", ".remove_phone", function () {
    $(this).closest(".phone_row").remove();
});

$(document).on("click", ".add_email", function () {
let row_id = parseInt($("#raw_email_index").val());
$("#raw_email_index").val(parseInt(row_id) + 1);
$('.emails').append("<div class='d-flex justify-content-center email_row'><input type='email' name='emails[]' class='form-control mt-2' placeholder='"+LANG.email+" "+$("#raw_email_index").val()+"' /><button type='button' class='btn btn-xs btn-danger remove_email'><i class='fa fa-times'></i></button></div>");
});
$(document).on("click", ".remove_email", function () {
    $(this).closest(".email_row").remove();
});