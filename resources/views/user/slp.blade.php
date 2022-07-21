@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/slp.css') }}">
    <div class="container-fluid body-container px-5">
        <!-- Modal -->
        <!--delete-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delteModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p></p>
                    </div>
                    <div class="modal-footer text-center d-flex justify-content-center gap-2">
                        <button type="button" id="btn_delete" class="btn btn-danger px-4">Yes</button>
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">No</button>                    
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal -->
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
                <div class="mb-3">
                    <h2>Smooth Love Potion</h2>
                    <a href="#div_form_add" class="link-add-axie btn btn-success btn-sm" role="button">Add SLP</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Account Name</th>
                                <th scope="col">Account Type</th>
                                <th scope="col">Total SLP</th>
                                <th scope="col">Last added</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbl-slp-tbody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4 px-4 div-create py-3 rounded shadow bg-white position-relative" id="div_form_add">                    
                <form action="{{ route('slp.store') }}" method="post" enctype="multipart/form-data" id="form_add" class="position-relative h-100 w-100">                     
                    @csrf
                    <h2>Add SLP</h2>
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input type="text" name="quantity" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                         class="form-control" value="" required>
                        <label for="" class="text-danger message-error quantity_error"></label>
                    </div>
                    <div class="mb-4">
                        <label for="" class="form-label">Account Name</label>
                        <select name="account_name" id="account_name" class="form-select type">
                            
                        </select>
                        <label for="" class="text-danger message-error account_name_error"></label>
                    </div>
                    <div class="position-absolute bottom-0 w-100 mb-2">
                        <button type="submit" class="w-100 btn btn-add">Add</button>
                        <div class="mt-3 text-secondary text-center">
                            If account name is blank, create <a href="{{ route('account.index') }}" class="account-link">axie account</a> first.
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/user/slp.js') }}" defer></script>
@endsection
