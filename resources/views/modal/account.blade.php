    <!-- edit -->
    <div class="modal fade" id="modal_edit_account" tabindex="-1" aria-labelledby="editAccountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountLabel">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="put" id="form_edit_account">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="account_id"  id="acc_id">
                        <div class="form-group">
                            <label for="" class="form-label">Account Name</label>
                            <input type="text" id="account_name" name="account_name" class="form-control" value="" required autocomplete="account_name" autofocus>
                            <label for="" class="text-danger message-error account_name_error"></label>
                        </div>
                        <div class="mb-4 form-group">
                            <label for="" class="form-label">Account Type</label>
                            <select name="account_type" id="account_type" class="form-select type">
                                <option  value=""></option>
                                <option value="Personal">Personal</option>
                                <option value="Scholar">Scholar</option>
                            </select>
                            <label for="" class="text-danger message-error account_type_error"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete -->
    <div class="modal fade" id="modal_delete_account" tabindex="-1" aria-labelledby="editAccountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this account?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ url('/deleteThisAccount') }}" method="post">
                        @csrf
                        <input type="hidden" name="account_id" id="acc_id">
                        <button type="submit" id="btn_delete" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>    
                    </form>           
                </div>
            </div>
        </div>
    </div>