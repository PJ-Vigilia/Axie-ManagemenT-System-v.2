@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/axie.css') }}">
    <div class="container-fluid body-container px-5">
        <!-- Modal -->
        <!-- edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Axie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="put" enctype="multipart/form-data" id="form_edit">                     
                        @csrf
                        <input type="hidden" id="edit_axie_id">
                        <div class="mb-2">
                            <label for="" class="form-label">Axie Name</label>
                            <input type="text" name="axie_name" id="edit_name" class="form-control" value="" required>
                            <label for="" class="text-danger message-error axie_name_error"></label>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Axie Type</label>
                            <select name="axie_type"  id="edit_type" class="form-select type" required>
                                <option value=""></option>
                                <option value="Aqua">Aqua</option>
                                <option value="Beast">Beast</option>
                                <option value="Bird">Bird</option>
                                <option value="Bug">Bug</option>
                                <option value="Dusk">Dusk</option>
                                <option value="Mech">Mech</option>
                                <option value="Plant">Plant</option>
                                <option value="Reptile">Reptile</option>
                            </select>
                            <label for="" class="text-danger message-error axie_type_error"></label>
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Account Name</label>
                            <select name="account_name"  id="edit_account_name" class="form-select type">
                                
                            </select>
                            <label for="" class="text-danger message-error account_name_error"></label>
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
        <!--delete-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delteModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="w-100 d-flex justify-content-center mb-2">
                            <div class="img-container" style="border:none;">
                                <img src="" alt="axie picture"  class="w-100 h-100" id="delete_img">
                            </div>
                        </div>
                        <p></p>
                    </div>
                    <div class="modal-footer text-center d-flex justify-content-center gap-2">
                        <button type="button" id="btn_delete" class="btn btn-danger px-4">Yes</button>
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">No</button>                    
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal -->
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
                    <h2>Axie</h2>
                    <a href="#div_form_add" class="link-add-axie btn btn-success btn-sm" role="button">Add Axie</a>
                </div>
                <div class="w-100">
                    <div class="row g-3" id="own_axie">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4 px-4 div-create py-3 rounded shadow bg-white" id="div_form_add">                    
                <form action="{{ route('axie.store') }}" method="post" enctype="multipart/form-data" id="form_add">                     
                    @csrf
                    <h2>Add Axie</h2>
                    <div class="w-100 d-flex justify-content-center mb-2">
                        <div class="img-container">
                            <img src="" alt="axie picture"  class="w-100 h-100 img-add" id="img_add_preview">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Axie Picture</label>
                        <input type="file" accept="image/*" class="form-control" name="axie_picture" id="axie_picture" required>
                        <label for="" class="text-danger message-error axie_picture_error"></label>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Axie Name</label>
                        <input type="text" name="axie_name" class="form-control" value="" required>
                        <label for="" class="text-danger message-error axie_name_error"></label>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Axie Type</label>
                        <select name="axie_type" id="axie_type" class="form-select type" required>
                            <option value=""></option>
                            <option value="Aqua">Aqua</option>
                            <option value="Beast">Beast</option>
                            <option value="Bird">Bird</option>
                            <option value="Bug">Bug</option>
                            <option value="Dusk">Dusk</option>
                            <option value="Mech">Mech</option>
                            <option value="Plant">Plant</option>
                            <option value="Reptile">Reptile</option>
                        </select>
                        <label for="" class="text-danger message-error axie_type_error"></label>
                    </div>
                    <div class="mb-4">
                        <label for="" class="form-label">Account Name</label>
                        <select name="account_name" id="account_name" class="form-select type">
                            
                        </select>
                        <label for="" class="text-danger message-error account_name_error"></label>
                    </div>
                    <div>
                        <button type="submit" class="w-100 btn btn-add">Add</button>
                    </div>
                </form>
                <div class="mt-3 text-secondary">
                    If account name is blank, create <a href="{{ route('account.index') }}" class="account-link">axie account</a> first.
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/user/axie.js') }}" defer></script>
@endsection