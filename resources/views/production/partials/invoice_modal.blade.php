<!-- Add this modal code after the form -->
<div class="modal fade" id="selectedRowsModal" tabindex="-1" role="dialog" aria-labelledby="selectedRowsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="selectedRowsModalLabel">Selected Rows</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <!-- Move the form outside of tbody -->
                    <form method="post" action="{{ route('production.invoice') }}" id="table_form">
                        @csrf
                        @method('post')
                        <table class="table table-bordered">
                            <thead class="thead">
                                <tr>
                                    <th class="col3">المحتوي الحالي</th>
                                    <th class="col4">نوع التعبئة</th>
                                    <th class="col5">الوزن</th>
                                    <th class="col6">اللون</th>
                                    <th class="col7">سعر البيع</th>
                                    <th class="col8">العدد</th>
                                    <th class="col9">المجموع الفرعي</th>
                                </tr>
                            </thead>
                            <tbody id="invoices_table_body">
                                <!-- Your table rows will be dynamically added here -->
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Add the "Save" button inside the form -->
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
