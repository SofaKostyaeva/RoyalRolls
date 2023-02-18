$(document).ready(function () {
    $('.delete_item').click(function () {
        let id = $(this).attr("id");
        let idBasket = $(`#${id} + .name-hid`).text();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/php/delete_basket-item.php',
            data: { sourceData: idBasket },
            success: function (data) {
                if (data['success']) {
                    location.reload();
                }
                else {
                    alert("Ошибка!");
                }
            }
        });
    });

    $('.btn_access').click(function () {
        let promocode = $('.promocode_tbox').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/php/show_discount.php',
            data: { sourceData: promocode },
            success: function (data) {
                if (data['success'] == '1') {
                    alert("Данный промокод не найден");
                }
                if (data['success'] == '2') {
                    alert("Вы уже использовали данный промокод ранее");
                }
                else{
                    let total_price = data['success'];
                    $('.total_price').text("Итого: " + total_price.toFixed() + " Р");
                }
            }
        });
    });
});