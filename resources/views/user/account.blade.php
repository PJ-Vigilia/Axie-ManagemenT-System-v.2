@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/account.css') }}">
    <!--modal-->
    <!-- edit -->
    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="editAccountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountLabel">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="put" id="form_edit">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="account_id"  id="account_id">
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
    <!-- edit -->
    <div class="modal fade" id="modal_delete" tabindex="-1" aria-labelledby="editAccountLabel" aria-hidden="true">
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
                    <button type="button" id="btn_delete" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>                        
                </div>
            </div>
        </div>
    </div>
    <!--/modal-->
    <div class="container">
        <div class="row gap-3">
            <div class="col-md div-table py-3 px-4 position-relative bg-white rounded content">
                <!--toast-->
                <div class="position-absolute top-0 end-0 px-4 py-3" id="toast">
                    <div class="bg-white rounded shadow" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>      
                </div>
                <!--/toast--> 
                <h2>Account</h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date added</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbl-account-tbody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4 px-4 div-create py-3 rounded">                    
                <form action="{{ route('account.store') }}" method="post" id="form_add">                     
                    @csrf
                    <h2>Add Account</h2>
                    <div class="form-group">
                        <label for="" class="form-label">Account Name</label>
                        <input type="text" name="account_name" class="form-control" value="{{ old('account_name') }}" required autocomplete="account_name" autofocus>
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
                    <div>
                        <button type="submit" class="w-100 btn btn-add">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/user/account.js') }}" defer></script>
@endsection
