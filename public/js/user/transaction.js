$(document).ready(function(){
    fetchAccount();
    fetchTransaction();

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

    function fetchTransaction(){
        $.ajax({
            type: 'get',
            url: '/fetchTransaction',
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.slp);
                $('#tbl-transaction-tbody').html('');
                var i = 1;
                $.each(response.transaction, function(key, item){
                    $('#tbl-transaction-tbody').append('\
                        <tr>\
                            <td scope="row">'+ i +'</td>\
                            <td>'+ item.account_name +'</td>\
                            <td>'+ item.account_type +'</td>\
                            <td>'+ item.totalPrice +'</td>\
                            <td>'+ item.last_added +'</td>\
                            <td>\
                                <a href="/view/account/'+ item.acc_id +'" class="view">View</a>\
                                <button onclick="deleteTransaction('+ item.acc_id +')" class="btn-delete">Delete</button>\
                            </td>\
                        </tr>\
                    ');
                    i++;
                });
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
                    });
                    console.log(response.error);
                }else{
                    $('#form_add').find('label.message-error').text('');
                    $('#form_add').find('label.message-error').hide();
                    $('#form_add').find('input').val('');
                    $('#toast').show().delay(3000).fadeOut();
                    $('#toast').find('div.toast-body').text(response.message);
                    fetchTransaction();
                }
            }
        })
    });

    //delete
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
            url: '/deleteTransaction/' + id,
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.message);
                $('#deleteModal').find('p').text('');
                $('#deleteModal').find('#btn_delete').val('');

                $('#deleteModal').modal('hide');
                $('#toast').show().delay(3000).fadeOut();
                $('#toast').find('div.toast-body').text(response.message);
                fetchTransaction();
            }
        })
    });

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
});

var id;

function deleteTransaction(id){
    $('#deleteModal').modal('show');
    $('#deleteModal').find('#btn_delete').val(id);

    $.ajax({
        type: 'get',
            url: '/fetchName/'+ id,
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.accounts);
                $('#deleteModal').find('p').text('Do you want to delete all transactions of '+ response.name +'?');
            }
    })
}