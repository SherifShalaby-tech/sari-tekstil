<!-- Modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit">@lang('lang.edit')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => route('customers.pay_due'), 'method' => 'post']) !!}
            <div class="modal-body">
                <div class="row">
                    {{-- ++++++++++++++ production_transaction_id ++++++++++++++ --}}
                    <input type="hidden" class="form-control production_transaction_id" name="production_transaction_id" value="">
                    {{-- ++++++++++++++ customer_id ++++++++++++++ --}}
                    <input type="hidden" class="form-control customer_id" name="customer_id" value="">
                    {{-- ++++++++++++++ due : المتاخر ++++++++++++++ --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="job_title">متاخرات</label>
                            <input type="text" class="form-control dueAmount" name="dueAmount" value="" readonly>
                        </div>
                    </div>
                    {{-- ++++++++++++++ customer_paid : المبلغ المستلم مسبقا من العميل ++++++++++++++ --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="job_title">دفع مسبقاً</label>
                            <input type="text" class="form-control last_customer_paid" name="last_customer_paid" value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- ///////// المبلغ المٌستلم ///////// --}}
                    <div class="col-md-4" >
                        <label for="">المبلغ المٌستلم</label> <br/>
                        <input type="number" class="form-control" name="customer_paid" id="customer_paid" value="0" />
                    </div>
                    {{-- ///////// المبلغ المتبقي ///////// --}}
                    <div class="col-md-4" id="rest_paid_cont_id" style="display: none;">
                        <label for="" class="text-danger">المبلغ المتبقي</label> <br/>
                        <input type="number" class="form-control" id="rest_paid_id" name="rest_paid" readonly value="" />
                    </div>
                    {{-- ///////// اضافة لرصيد العميل ///////// --}}
                    <div class="col-md-4" id="balance_container" style="display:none;">
                        {{-- المبلغ اللي هيتم اضافته في رصيد العميل --}}
                        <input type="hidden" class="col-md-6 form-control" name="balance" id="balance_input"  />
                        {{-- زرار اضافة لرصيد العميل --}}
                        <div class="col-md-12" style="margin-top:33px !important;">
                            <button class="btn btn-info" id="submit_balance">اضافة لرصيد العميل</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // +++++++++++++++++ Calculate rest +++++++++++++++++
        $("#customer_paid").on('keyup', function ()
        {
            // Get the entered customer_paid value
            var customerPaid = parseFloat($(this).val()) || 0;
            // Get the initial amount
            var dueAmount = parseFloat($(".dueAmount").val()) || 0;
            // Calculate the remaining amount
            var remainingAmount = customerPaid - dueAmount;
            console.log("Remaining Amount = " + remainingAmount);
            // Update the rest_paid input
            $("#rest_paid_id").val(remainingAmount.toFixed(2));
            // +++++++++ Appear Customer Balance +++++++++
            // Appear Customer Balance and set balance_input value
            if (remainingAmount > 0)
            {
                $("#rest_paid_cont_id").show();
                $("#balance_container").show();
            }
            else
            {
                $("#balance_container").hide();
                $("#rest_paid_cont_id").hide();
            }
        });
        // +++++++++++++++++ Submit Balance +++++++++++++++++
        $("#submit_balance").on("click", function(e){
            e.preventDefault();
            // Set the absolute value of rest to balance_input
            $rest_value = $("#rest_paid_id").val();
            $("#balance_input").val($rest_value);
        });
    });
</script>

