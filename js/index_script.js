$('.btn_buy').click(function(){
    let id = $(this).attr("id");
    let name = $(`#${id} + .none`).text();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/php/add_to_basket.php',
        data: {sourceData: name },
        success: function(data){
            if(data['success'])
            {
                location.reload();
            }
            else
            {
                alert("Ошибка!");
            }
        }
    });
});

$('.btn_error').click(function(){
    alert("Сперва вам нужно войти в свой аккаунт");
});