$(document).ready(function(){
    $('.delete').click(function(){
        var thisId = $(this).attr('id');
        var ident = $(`#${thisId} + .ident_hid`).text();
        $.ajax({
            type: 'POST',
            url: '/php/delete_order.php',
            dataType: 'json',
            data: {postData: ident},
            success: function(data){
                if(data['success'])
                {
                    location.reload();
                }
            }
        });
    });
});