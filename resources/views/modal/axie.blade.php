        <!-- add -->
        <div class="modal fade" id="addAxieModal" tabindex="-1" aria-labelledby="addAxieModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAxieModalLabel">Add Axie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/storeAccountAxie') }}" method="post" enctype="multipart/form-data" id="form_add_axie">                     
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="form_account_id" value="{{ $account_id }}" id="form_account_id">
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
        <div class="modal fade" id="editAxieModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Axie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="put" enctype="multipart/form-data" id="form_edit_axie">                     
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
        <div class="modal fade" id="deleteAxieModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                        <button type="button" id="btn_delete_axie" class="btn btn-danger px-4">Yes</button>
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">No</button>                    
                    </div>
                </div>
            </div>
        </div>