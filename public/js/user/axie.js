$(document).ready(function(){
    fetchAccount();
    fetchOwnAxie();

    function fetchAccount(){
        $.ajax({
            type: 'get',
            url: '/fetchAccountName',
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.accounts);
                $.each(response.accounts, function(key, account){
                    $('#form_add').find('#account_name').append('\
                        <option value="'+ account.id +'">'+ account.name +'</option>\
                    ');
                    $('#form_edit').find('#edit_account_name').append('\
                        <option value="'+ account.id +'">'+ account.name +'</option>\
                    ');
                });
            }
        })
    }

    function fetchOwnAxie(){
        $.ajax({
            type: 'get',
            url: '/fetchOwnAxie',
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
                                        <a href="/view/account/'+ item.account_id +'" class="view-account-link">\
                                        '+ item.axie_name +'<br>\
                                        '+ item.axie_type +'<br>\
                                        Account: '+ item.account_name +'\
                                        </a>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                })
            }
        })
    }

    //add
    $(form_add).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_add).attr('method'),
            url: $(form_add).attr('action'),
            data: new FormData(form_add),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response){
                //console.log(response.message);
                if(response.status == 404){
                    $.each(response.error, function(name, err){
                        $('#form_add').find('label.'+ name +'_error').text(err);
                        $('#form_add').find('label.'+ name +'_error').show();
                    })
                }else{
                    $('#form_add').find('label.message-error').text('');
                    $('#form_add').find('label.message-error').hide();
                    $('#form_add').find('#img_add_preview').hide();
                    $('#form_add').find('input').val('');
                    $('#toast').show().delay(3000).fadeOut();
                    $('#toast').find('div.toast-body').text(response.message);
                    fetchOwnAxie();
                }
            }
        })
    })
    //update
    $('#form_edit').on('submit', function(e){
        e.preventDefault();

        var id = $('#form_edit').find('#edit_axie_id').val();
        var formData ={
            'axie_name': $('#form_edit').find('#edit_name').val(),
            'axie_type': $('#form_edit').find('#edit_type').val(),
            'account_name': $('#form_edit').find('#edit_account_name').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'put',
            url: '/updateAxie/' + id,
            data: formData,
            dataType: 'json',
            success: function(response){
                if(response.status == 404){
                    $.each(response.error, function(name, err){
                        $('#form_edit').find('label.'+ name +'_error').text(err);
                        $('#form_edit').find('label.'+ name +'_error').show();
                    })
                }else{
                    $('#editModal').modal('hide');
                    $('#form_edit').find('label.message-error').text('');
                    $('#form_edit').find('label.message-error').hide();
                    $('#form_edit').find('input').val('');
                    $('#toast').show().delay(3000).fadeOut();
                    $('#toast').find('div.toast-body').text(response.message);
                    fetchOwnAxie();
                }
            }
        })
    })

    $(document).on('click', '#btn_delete', function(e){
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
                $('#deleteModal').find('#delete_img').attr('src', '');
                $('#deleteModal').find('p').text('');
                $('#deleteModal').find('#btn_delete').val('');

                $('#deleteModal').modal('hide');
                $('#toast').show().delay(3000).fadeOut();
                $('#toast').find('div.toast-body').text(response.message);
                fetchOwnAxie();
            }
        })
    })

    //image preview
    axie_picture.onchange = evt => {
        const [file] = axie_picture.files
        if (file) {
            img_add_preview.src = URL.createObjectURL(file)
            $('#img_add_preview').show();
        }
    }
    //responsive screen
    $(window).on('resize', function(){
        var win = $(this); //this = window
        if (win.width() <= 600) {
            $('.body-container').toggleClass('px-5')
        }
    });
    if ($(window).width() <= 600) {
        $('.body-container').toggleClass('px-5')
    }
})

var id;

function editAxie(id){
    $('#editModal').modal('show');

    $.ajax({
        type: 'get',
        url: '/editAxie/'+ id,
        success: function(response){
            $.each(response.axie, function(key, item){
                $('#form_edit').find('#edit_axie_id').val(item.axie_id);
                $('#form_edit').find('#edit_name').val(item.axie_name);
                $('#form_edit').find('#edit_type').val(item.axie_type).change();
                $('#form_edit').find('#edit_account_name').val(item.account_id).change();
            });            
        }
    })
}

function deleteAxie(id){
    $('#deleteModal').modal('show');

    $.ajax({
        type: 'get',
        url: '/editAxie/'+ id,
        success: function(response){
            $.each(response.axie, function(key, item){
                $('#deleteModal').find('#delete_img').attr('src', '/images/axies/'+ item.axie_picture);
                $('#deleteModal').find('p').text('Do you want to delete '+ item.axie_name +'?');
                $('#deleteModal').find('#btn_delete').val(item.axie_id);
            });            
        }
    })
}