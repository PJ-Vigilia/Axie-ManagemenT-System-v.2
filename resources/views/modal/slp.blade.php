        <!-- add -->
        <div class="modal fade" id="addSLPModal" tabindex="-1" aria-labelledby="addSLPModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSLPModalLabel">Add SLP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/storeAccountSLP') }}" method="post" id="form_add_slp" class="h-100 w-100">
                        @csrf
                        <input type="hidden" name="account_id" value="{{ $account_id }}">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="text" name="quantity" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                class="form-control" value="" required>
                                <label for="" class="text-danger message-error quantity_error"></label>
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
        <div class="modal fade" id="editSLPModal" tabindex="-1" aria-labelledby="editSLPModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSLPModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="text" name="quantity" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                class="form-control" value="" id="edit_quantity" required>
                                <label for="" class="text-danger message-error quantity_error"></label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="btn_update_slp" class="btn btn-primary px-4">Update</button>
                        </div>
                </div>
            </div>
        </div>

        <!--delete-->
        <div class="modal fade" id="deleteSLPModal" tabindex="-1" aria-labelledby="deleteSLPModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delteSLPModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>
                            Do you want to delete this SLP?
                        </p>
                    </div>
                    <div class="modal-footer text-center d-flex justify-content-center gap-2">
                        <button type="button" id="btn_delete_slp" class="btn btn-danger btn-sm px-4">Yes</button>
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">No</button>                    
                    </div>
                </div>
            </div>
        </div>