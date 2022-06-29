$(document).ready(function(){
    fetchOwnAccounts();

    function fetchOwnAccounts(){
        $.ajax({
            type: "get",
            url: "/fetchOwnAccounts",
            proccessData: false,
            contentType: false,
            success: function(response){

                $('#tbl-account-tbody').html('');
                var i=1;  
                $.each(response.accounts, function(key, item){                                      
                    $('#tbl-account-tbody').append('\
                        <tr>\
                            <td scope="row">'+ i +'</td>\
                            <td>'+ item.name +'</td>\
                            <td>'+ item.type +'</td>\
                            <td>'+ item.created_at +'</td>\
                            <td>\
                                <a href="/view/account/'+ item.id +'">View</a>\
                                <button onclick="editAccount('+ item.id +')" class="btn-edit">Edit</button>\
                                <button onclick="deleteAccount('+ item.id +');" class="btn-delete">Delete</button>\
                            </td>\
                        </tr>\
                    ');
                    i++;
                });
            }
        })
    }

    $('#form_add').on('submit', function(e){
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
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404){
                    $.each(response.errors, function(name, error){
                        $('#form_add').find('label.'+ name +'_error').text(error[0]);
                    })
                }else{
                    $('#toast').show().delay(3000).fadeOut();
                    $('#toast').find('div.toast-body').text(response.message);
                    $('#form_add').find('label.message-error').text('');
                    $('#form_add').find('input').val('');   
                    $('#form_add').find('#account_type').val('').change();

                    fetchOwnAccounts();
                }
            }
        })
    });

    //update
    $('#form_edit').on('submit', function(e){
        e.preventDefault();
        var account_id = $('#form_edit').find('#account_id').val();
        var formData ={
            'account_name': $('#form_edit').find('#account_name').val(),
            'account_type': $('#form_edit').find('#account_type').val()
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
                    $('#modal_edit').modal('hide');
                    $('#toast').show().delay(3000).fadeOut();
                    $('#toast').find('div.toast-body').text(response.message);
                    $('#form_edit').find('label.message-error').text('');
                    $('#form_edit').find('input').val('');   
                    $('#form_edit').find('#account_type').val('').change();

                    fetchOwnAccounts();
                }
            }
        })
    });

    //delete
    $(document).on('click', '#btn_delete', function(e){
        e.preventDefault()
        var id = $(this).val();     
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "delete",
            url: "/deleteAccount/" + id,
            proccessData: false,
            contentType: false,
            success: function(response){
                $('#modal_delete').modal('hide');
                $('#toast').show().delay(3000).fadeOut();
                $('#toast').find('div.toast-body').text(response.message);
                fetchOwnAccounts();
            }
        })
    })
});

var id;

function editAccount(id){
    $('#modal_edit').modal('show');
    $('#modal_edit').find('input').val('');

    $.ajax({
        type: "get",
        url: "/editAccount/" + id,
        proccessData: false,
        contentType: false,
        success: function(response){
            $.each(response.account, function(key, item){
                $('#modal_edit').find('#account_id').val(item.id);
                $('#modal_edit').find('#account_name').val(item.name);
                $('#modal_edit').find('#account_type').val(item.type).change();
            })
        }
    })
}
function deleteAccount(id){
    $('#modal_delete').find('#btn_delete').val(id);
    $('#modal_delete').modal('show');
}