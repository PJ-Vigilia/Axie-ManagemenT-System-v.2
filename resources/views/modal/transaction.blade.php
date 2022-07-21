        <!-- add -->
        <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTransactionModalLabel">Add Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/storeAccountTransaction') }}" method="post" id="form_add_transaction" class="h-100 w-100">
                        @csrf
                        <input type="hidden" name="account_id" value="{{ $account_id }}">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">SLP Quantity</label>
                                <input type="text" name="slp_quantity" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                class="form-control" value="" required>
                                <label for="" class="text-danger message-error slp_quantity_error"></label>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">SLP Total Price</label>
                                <input type="number" name="total_price" class="form-control" value="" required>
                                <label for="" class="text-danger message-error total_price_error"></label>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Transaction Date</label>
                                <input type="date" name="transaction_date" class="form-control" value="" required>
                                <label for="" class="text-danger message-error transaction_date_error"></label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- edit -->
        <div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTransactionModalLabel">Edit Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/updateAccountTransaction') }}" method="post" id="form_edit_transaction" class="h-100 w-100">
                        @csrf
                        <input type="hidden" name="transaction_id" id="transaction_id" value="">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">SLP Quantity</label>
                                <input type="text" name="slp_quantity" id="slp_quantity" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                class="form-control" value="" required>
                                <label for="" class="text-danger message-error slp_quantity_error"></label>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">SLP Total Price</label>
                                <input type="number" name="total_price" id="total_price" class="form-control" value="" required>
                                <label for="" class="text-danger message-error total_price_error"></label>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Transaction Date</label>
                                <input type="date" name="transaction_date" id="transaction_date" class="form-control" value="" required>
                                <label for="" class="text-danger message-error transaction_date_error"></label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--delete-->
        <div class="modal fade" id="deleteTransactionModal" tabindex="-1" aria-labelledby="deleteTransactionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delteTransactionModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>
                            Do you want to delete this Transaction?
                        </p>
                    </div>
                    <div class="modal-footer text-center d-flex justify-content-center gap-2">
                        <button type="button" id="btn_delete_transaction" class="btn btn-danger btn-sm px-4">Yes</button>
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">No</button>                    
                    </div>
                </div>
            </div>
        </div>