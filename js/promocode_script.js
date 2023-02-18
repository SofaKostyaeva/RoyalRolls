$(document).ready(function () {
    $('.delete_promocode').click(function () {
        let id = $(this).attr("id");
        let id_promocode = $(`#${id} + #id_promocode`).text();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/php/delete_promocode.php',
            data: { post_data: id_promocode },
            success: function (data) {
                if (data['success']) {
                    location.reload();
                }
            }
        });
    });
});