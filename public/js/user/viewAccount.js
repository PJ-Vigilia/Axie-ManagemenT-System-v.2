$(document).ready(function(){
    fetchAccountName();
    fetchAccountAxie();
    fetchAccount();

    function fetchAccountName(){
        $.ajax({
            type: 'get',
            url: '/fetchAccountName',
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.accounts);
                $.each(response.accounts, function(key, account){
                    $('#form_edit_axie').find('#edit_account_name').append('\
                        <option value="'+ account.id +'">'+ account.name +'</option>\
                    ');
                });
            }
        })
    }

    function fetchAccount(){
        var account_id = $('#account_id').val();
        $.ajax({
            type: 'get',
            url: '/fetchAccount/'+ account_id,
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.account);
                $('#account').html('');
                $.each(response.account, function(key, item){
                    $('#account').append('\
                        <h2>Account Name: '+ item.name +'</h2>\
                        <p>Account Type: '+ item.type +'</p>\
                        <div class="w-100 d-flex align-items-center gap-2">\
                            <label role="button" class="edit d-flex align-items-center gap-1" onclick="editAccount('+ item.id +')">\
                                <svg role="button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square edt-icon" viewBox="0 0 16 16">\
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>\
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>\
                                </svg>\
                            Edit</label>\
                            <label role="button" class="delete d-flex align-items-center gap-1" onclick="deleteAccount('+ item.id +')">\
                                <svg role="button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill dte-icon" viewBox="0 0 16 16">\
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>\
                                </svg>\
                            Delete</label>\
                        </div>\
                    ');
                });
            }
        })
    }

    //update
    $('#form_edit_account').on('submit', function(e){
        e.preventDefault();
        var account_id = $('#account_id').val();
        var formData ={
            'account_name': $('#form_edit_account').find('#account_name').val(),
            'account_type': $('#form_edit_account').find('#account_type').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'put',
            url: '/updateAccount/' + account_id,
            data: formData,
            //data: new FormData(form_edit),
            dataType: 'json',
            //processData: false,
            //contentType: false,
            success: function(response){
                console.log(response.message);
                if(response.status == 404){
                    $.each(response.errors, function(name, error){
                        $('#form_edit').find('label.'+ name +'_error').text(error[0]);
                    })
                }else{
                    $('#modal_edit_account').modal('hide');
                    $('#toast_account').show().delay(3000).fadeOut();
                    $('#toast_account').find('div.toast-body').text(response.message);
                    $('#form_edit_account').find('label.message-error').text('');
                    $('#form_edit_account').find('input').val('');   
                    $('#form_edit_account').find('#account_type').val('').change();

                    fetchAccount();
                }
            }
        })
    });

    function fetchAccountAxie(){
        var account_id = $('#account_id').val();
        $.ajax({
            type: 'get',
            url: '/fetchAccountAxie/'+ account_id,
            success: function(response){
                //console.log(response.axies);
                
                $('#own_axie').html('');
                $.each(response.axies, function(key, item){
                    $('#own_axie').append('\
                        <div class="col-6 col-md-2">\
                            <div class="w-100 axie-container rounded overflow-hidden position-relative">\
                                <img src="/images/axies/'+ item.axie_picture +'" class="axie-image w-100 h-100" alt="">\
                                <div class="position-absolute top-0 w-100 h-100 img-content">\
                                    <div class="w-100 text-end px-2 position-absolute div-edit-delete">\
                                        <svg onclick="editAxie('+ item.axie_id +')" role="button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square edit-icon" viewBox="0 0 16 16">\
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>\
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>\
                                        </svg>\
                                        <svg onclick="deleteAxie('+ item.axie_id +')" role="button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill delete-icon" viewBox="0 0 16 16">\
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>\
                                        </svg>\
                                    </div>\
                                    <div class="axie-info w-100 px-2 text-center py-1 position-absolute bottom-0">\
                                        '+ item.axie_name +'<br>\
                                        '+ item.axie_type +'<br>\
                                        Account: '+ item.account_name +'\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                })
            }
        })
    }

    //image preview
    axie_picture.onchange = evt => {
        const [file] = axie_picture.files
        if (file) {
            img_add_preview.src = URL.createObjectURL(file)
            $('#img_add_preview').show();
        }
    }

    //add
    $(form_add_axie).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_add_axie).attr('method'),
            url: $(form_add_axie).attr('action'),
            data: new FormData(form_add_axie),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response){
                //console.log(response.message);
                if(response.status == 404){
                    $.each(response.error, function(name, err){
                        $('#form_add_axie').find('label.'+ name +'_error').text(err);
                        $('#form_add_axie').find('label.'+ name +'_error').show();
                    })
                }else{
                    $('#form_add_axie').find('label.message-error').text('');
                    $('#form_add_axie').find('label.message-error').hide();
                    $('#form_add_axie').find('#img_add_preview').hide();
                    $('#form_add_axie').find('input').val('');
                    $('#toast_axie').show().delay(3000).fadeOut();
                    $('#toast_axie').find('div.toast-body').text(response.message);
                    $('#addAxieModal').modal('hide');
                    fetchAccountAxie();
                }
            }
        })
    })
    //update
    $('#form_edit_axie').on('submit', function(e){
        e.preventDefault();

        var id = $('#form_edit_axie').find('#edit_axie_id').val();
        var formData ={
            'axie_name': $('#form_edit_axie').find('#edit_name').val(),
            'axie_type': $('#form_edit_axie').find('#edit_type').val(),
            'account_name': $('#form_edit_axie').find('#edit_account_name').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'put',
            url: '/updateAccountAxie/' + id,
            data: formData,
            dataType: 'json',
            success: function(response){
                if(response.status == 404){
                    $.each(response.error, function(name, err){
                        $('#form_edit_axie').find('label.'+ name +'_error').text(err);
                        $('#form_edit_axie').find('label.'+ name +'_error').show();
                    })
                }else{
                    $('#editAxieModal').modal('hide');
                    $('#form_edit_axie').find('label.message-error').text('');
                    $('#form_edit_axie').find('label.message-error').hide();
                    $('#form_edit_axie').find('input').val('');
                    $('#toast_axie').show().delay(3000).fadeOut();
                    $('#toast_axie').find('div.toast-body').text(response.message);
                    fetchAccountAxie();
                }
            }
        })
    })

    $(document).on('click', '#btn_delete_axie', function(e){
        e.preventDefault();
        var id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'delete',
            url: '/deleteAxie/' + id,
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.message);
                $('#deleteAxieModal').find('#delete_img').attr('src', '');
                $('#deleteAxieModal').find('p').text('');
                $('#deleteAxieModal').find('#btn_delete').val('');

                $('#deleteAxieModal').modal('hide');
                $('#toast_axie').show().delay(3000).fadeOut();
                $('#toast_axie').find('div.toast-body').text(response.message);
                fetchAccountAxie();
            }
        })
    })

    //slp
    fetchAccountSLP();

    function fetchAccountSLP(){
        var account_id = $('#account_id').val();

        $.ajax({
            type: 'get',
            url: '/fetchAccountSLP/'+ account_id,
            contentType: false,
            processData: false,
            success: function(response){
                $('#total_slp').val(response.totalSLP);
                //console.log(response.slp);
                $('#tbl-slp-tbody').html('');
                var i = 1;
                $.each(response.slp, function(key, item){
                    $('#tbl-slp-tbody').append('\
                        <tr>\
                            <th scope="row">'+ i +'</th>\
                            <td>'+ item.quantity +'</td>\
                            <td>'+ item.added_at +'</td>\
                            <td>\
                                <a onclick="editAccountSLP('+ item.id +')" role="button" class="btn-edit px-1">Edit</a>\
                                <a onclick="deleteAccountSLP('+ item.id +')" role="button" class="btn-delete px-1">Delete</a>\
                            </td>\
                        </tr>\
                    ');
                    i++;
                });
                availableSLP();
            }
        })
    }

    //add
    $(form_add_slp).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_add_slp).attr('method'),
            url: $(form_add_slp).attr('action'),
            data: new FormData(form_add_slp),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response){
                //console.log(response.message);
                if(response.status == 404){
                    $.each(response.error, function(name, err){
                        $('#form_add_slp').find('label.'+ name +'_error').text(err);
                        $('#form_add_slp').find('label.'+ name +'_error').show();
                    })
                }else{
                    $('#form_add_slp').find('label.message-error').text('');
                    $('#form_add_slp').find('label.message-error').hide();
                    $('#form_add_slp').find('input').val('');
                    $('#addSLPModal').modal('hide');
                    $('#toast_slp').show().delay(3000).fadeOut();
                    $('#toast_slp').find('div.toast-body').text(response.message);
                    fetchAccountSLP();
                }
            }
        })
    });
    //update
    $(document).on('click', '#btn_update_slp', function(e){
        e.preventDefault();
        var id = $(this).val();
        var data ={
            'quantity': $('#editSLPModal').find('#edit_quantity').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "put",
            url: "/updateAccountSLP/"+ id,
            data: data,
            dataType: 'json',
            success: function(response){
                //console.log(response.message);
                if(response.status == 404){
                    $.each(response.error, function(name, err){
                        $('#editSLPModal').find('label.'+ name +'_error').text(err);
                        $('#editSLPModal').find('label.'+ name +'_error').show();
                    })
                }else{
                    $('#editSLPModal').find('label.message-error').text('');
                    $('#editSLPModal').find('label.message-error').hide();
                    $('#editSLPModal').find('input').val('');
                    $('#editSLPModal').modal('hide');
                    $('#toast_slp').show().delay(3000).fadeOut();
                    $('#toast_slp').find('div.toast-body').text(response.message);
                    fetchAccountSLP();                    
                }
            }
        })
    })

    //delete
    $(document).on('click', '#btn_delete_slp', function(e){
        e.preventDefault();
        var id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'delete',
            url: '/deleteAccountSLP/' + id,
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.message);
                $('#deleteSLPModal').find('#btn_delete_slp').val('');

                $('#deleteSLPModal').modal('hide');
                $('#toast_slp').show().delay(3000).fadeOut();
                $('#toast_slp').find('div.toast-body').text(response.message);
                fetchAccountSLP();
            }
        })
    });

    //transaction
    fetchAccountTransaction();

    function fetchAccountTransaction(){
        var account_id = $('#account_id').val();

        $.ajax({
            type: 'get',
            url: '/fetchAccountTransaction/'+ account_id,
            contentType: false,
            processData: false,
            success: function(response){
                $('#total_transaction').val(response.totalTransaction);
                //console.log(response.totalTransaction);
                $('#tbl-transaction-tbody').html('');
                var i = 1;
                $.each(response.transaction, function(key, item){
                    $('#tbl-transaction-tbody').append('\
                        <tr>\
                            <th scope="row">'+ i +'</th>\
                            <td>'+ item.slp_quantity +'</td>\
                            <td>'+ item.price +'</td>\
                            <td>'+ item.transaction_date +'</td>\
                            <td>\
                                <a onclick="editAccountTransaction('+ item.id +')" role="button" class="btn-edit px-1">Edit</a>\
                                <a onclick="deleteAccountTransaction('+ item.id +')" role="button" class="btn-delete px-1">Delete</a>\
                            </td>\
                        </tr>\
                    ');
                    i++;
                });
                $.each(response.totalTransaction, function(key, data){
                    $('#total_slp_transaction').val(data.totalSLP);
                    $('#total_price_transaction').val(data.totalPrice);
                })
                availableSLP();
            }
        })
    }

    //add
    $(form_add_transaction).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_add_transaction).attr('method'),
            url: $(form_add_transaction).attr('action'),
            data: new FormData(form_add_transaction),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response){
                //console.log(response.message);
                if(response.status == 404){
                    $.each(response.error, function(name, err){
                        $('#form_add_transaction').find('label.'+ name +'_error').text(err);
                        $('#form_add_transaction').find('label.'+ name +'_error').show();
                    });
                    console.log(response.error);
                }else{
                    $('#form_add_transaction').find('label.message-error').text('');
                    $('#form_add_transaction').find('label.message-error').hide();
                    $('#form_add_transaction').find('input').val('');
                    $('#toast_transaction').show().delay(3000).fadeOut();
                    $('#toast_transaction').find('div.toast-body').text(response.message);
                    $('#addTransactionModal').modal('hide');
                    fetchAccountTransaction();
                }
            }
        })
    });

    //update
    $(form_edit_transaction).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_edit_transaction).attr('method'),
            url: $(form_edit_transaction).attr('action'),
            data: new FormData(form_edit_transaction),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                //console.log(response.message);
                if(response.status == 404){
                    $.each(response.error, function(name, err){
                        $('#form_edit_transaction').find('label.'+ name +'_error').text(err);
                        $('#form_edit_transaction').find('label.'+ name +'_error').show();
                    });
                    console.log(response.error);
                }else{
                    $('#form_edit_transaction').find('label.message-error').text('');
                    $('#form_edit_transaction').find('label.message-error').hide();
                    $('#form_edit_transaction').find('input').val('');
                    $('#toast_transaction').show().delay(3000).fadeOut();
                    $('#toast_transaction').find('div.toast-body').text(response.message);
                    $('#editTransactionModal').modal('hide');
                    fetchAccountTransaction();
                }
            }
        })
    });

    //delete
    $(document).on('click', '#btn_delete_transaction', function(e){
        e.preventDefault();
        var id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'delete',
            url: '/deleteAccountTransaction/' + id,
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.message);
                $('#deleteTransactionModal').find('#btn_delete_transaction').val('');

                $('#deleteTransactionModal').modal('hide');
                $('#toast_transaction').show().delay(3000).fadeOut();
                $('#toast_transaction').find('div.toast-body').text(response.message);
                fetchAccountTransaction();
            }
        })
    });

    function availableSLP(){
        var total_slp = $('#total_slp').val();
        var total_slp_transaction =$('#total_slp_transaction').val();
        var available_slp = total_slp - total_slp_transaction;
        $('#available_slp').val(available_slp);
    }

})

var id;

function editAccount(id){
    $('#modal_edit_account').modal('show');
    $('#modal_edit_account').find('input').val('');

    $.ajax({
        type: "get",
        url: "/editAccount/" + id,
        proccessData: false,
        contentType: false,
        success: function(response){
            $.each(response.account, function(key, item){
                $('#modal_edit_account').find('#account_id').val(item.id);
                $('#modal_edit_account').find('#account_name').val(item.name);
                $('#modal_edit_account').find('#account_type').val(item.type).change();
            })
        }
    })
}
function deleteAccount(id){
    $('#modal_delete_account').find('#acc_id').val(id);
    $('#modal_delete_account').modal('show');
}

function editAxie(id){
    $('#editAxieModal').modal('show');

    $.ajax({
        type: 'get',
        url: '/editAxie/'+ id,
        success: function(response){
            $.each(response.axie, function(key, item){
                $('#form_edit_axie').find('#edit_axie_id').val(item.axie_id);
                $('#form_edit_axie').find('#edit_name').val(item.axie_name);
                $('#form_edit_axie').find('#edit_type').val(item.axie_type).change();
                $('#form_edit_axie').find('#edit_account_name').val(item.account_id).change();
            });            
        }
    })
}

function deleteAxie(id){
    $('#deleteAxieModal').modal('show');

    $.ajax({
        type: 'get',
        url: '/editAxie/'+ id,
        success: function(response){
            $.each(response.axie, function(key, item){
                $('#deleteAxieModal').find('#delete_img').attr('src', '/images/axies/'+ item.axie_picture);
                $('#deleteAxieModal').find('p').text('Do you want to delete '+ item.axie_name +'?');
                $('#deleteAxieModal').find('#btn_delete_axie').val(item.axie_id);
            });            
        }
    })
}

function editAccountSLP(id){
    $('#editSLPModal').modal('show');

    $('#btn_update_slp').val(id);
}

function deleteAccountSLP(id){
    $('#deleteSLPModal').modal('show');
    $('#deleteSLPModal').find('#btn_delete_slp').val(id);
}

function editAccountTransaction(id){
    $('#editTransactionModal').modal('show');

    $.ajax({
        type: 'get',
        url: '/editAccountTransaction/'+ id,
        success: function(response){
            //console.log(response.transaction)
            $.each(response.transaction, function(key, item){
                $('#form_edit_transaction').find('#transaction_id').val(item.id);
                $('#form_edit_transaction').find('#slp_quantity').val(item.slp_quantity);
                $('#form_edit_transaction').find('#total_price').val(item.price);
                $('#form_edit_transaction').find('#transaction_date').val(item.transaction_date);
            });            
        }
    })
}

function deleteAccountTransaction(id){
    $('#deleteTransactionModal').modal('show');
    $('#deleteTransactionModal').find('#btn_delete_transaction').val(id);
}