// when click on "selectAll" checkbox
$('.checked_all').change(function() {
    tr = $(this).closest('tr');
    var checked_all = $(this).prop('checked');

    tr.find('.check_box').each(function(item) {
        if (checked_all === true) {
            $(this).prop('checked', true)
        } else {
            $(this).prop('checked', false)
        }
    })
})
// ======================================== Checkboxes of "products" table ========================================
// when click on "all checkboxs" , it will checked "all checkboxes"
$('#select_all_ids').click(function() {
    $('.checkbox_ids').prop('checked', $(this).prop('checked'));
});
// +++++++++++++ Delete Row in required_product +++++++++++++
$('.tbody').on('click','.deleteRow',function(){
    $(this).parent().parent().remove();
});
// +++++++++++++++++ Checkboxs and label inside selectbox ++++++++++++++
$("input:checkbox:not(:checked)").each(function() {
    var column = "table ." + $(this).attr("name");
    $(column).hide();
});

$("input:checkbox").click(function(){
    var column = "table ." + $(this).attr("name");
    $(column).toggle();
});
// +++++++++++++++++ Checkboxs and label inside selectbox : showCheckboxes() method ++++++++++++++
var expanded = false;
function showCheckboxes()
{
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}

// ++++++++++++ Calculate "total cost" ++++++++++++++++++++++
            // Add event listeners to quantity and sell price input fields
            $('body').on('input', '.col17 input, .col18 input', function () {
                // Get the row index
                var index = $(this).closest('tr').index();

                // Get the quantity and sell price values
                var quantity = parseFloat($('input[name="products[' + index + '][quantity]"]').val()) || 0;
                var sellPrice = parseFloat($('input[name="products[' + index + '][sell_price]"]').val()) || 0;

                // Calculate the total cost
                var totalCost = quantity * sellPrice;

                // Update the total cost input field
                $('input[name="products[' + index + '][total_cost]"]').val(totalCost.toFixed(2));

                // Recalculate the sum of total costs
                recalculateSumTotalCost();
            });

            // Add event listener to the "select_all_ids" checkbox
            $('#select_all_ids').change(function () {
                // Update all checkbox_ids based on select_all_ids state
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));

                // Recalculate the sum of total costs
                recalculateSumTotalCost();
            });

            // Add event listener to individual checkbox_ids
            $('body').on('change', '.checkbox_ids', function () {
                // Update select_all_ids based on the state of all checkbox_ids
                $('#select_all_ids').prop('checked', $('.checkbox_ids:checked').length === $('.checkbox_ids').length);

                // Recalculate the sum of total costs
                recalculateSumTotalCost();
            });

            // Function to recalculate the sum of total costs
            function recalculateSumTotalCost() {
                var sumTotalCost = 0;

                // Iterate through each row and sum up the total costs
                $('.col19 input').each(function () {
                    sumTotalCost += parseFloat($(this).val()) || 0;
                });

                // Update the sum_total_cost input field
                $('#sum_total_cost').val(sumTotalCost.toFixed(2));
            }
