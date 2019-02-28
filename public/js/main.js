$(function() {
    function sendRequestServer(url, data, callback) {
         $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            error: function() {
                alert('Ошибка обработки запроса!');
            },
            success: function(response) {
                callback(response);
            }
        });
    }
    
    function showAlert(result,mess) {
        if(result) {
            $('#toast .toast-body').html(mess);
            $('#toast').addClass('alert-success').toast('show');
        } else {
            $('#toast .toast-body').html('Произошла ошибка!');
            $('#toast').addClass('alert-danger').toast('show');
        }
    }
    
    function handleAddingGood(response) {
        var mess = 'Товар добавлен! Перейти в <a href="/basket/" class="alert-link">корзину</a>';
        showAlert(response, mess);
        changeCountCart();
    }
    
    function handleFillCart(response) {
        $('#cart').text(response.cart.count);
    }
    
    function handleRecountBasket(response) {
        $('#total').text(Math.round(response.total.summ));
        handleFillCart(response);
    }
    
    function changeCountCart() {
        var url = '/basket/count/';
        sendRequestServer(url, {}, handleFillCart);
    }
    
    function handleAddingComment(response) {
        var mess = 'Спасибо за отзыв! Он будет опубликован после одобрения модератором';
        showAlert(response.adding, mess);
        $('#comment')[0].reset();
    }
    
    function handleChangeStatus(response) {
        var mess = 'Статус заказа изменен';
        showAlert(response, mess);
    }
    
    function handleDeletionComment(response) {
        var mess = 'Отзыв удален';
        showAlert(response.remote, mess);
        $('#comment_' + response.remote).remove();
    }
    
    function handlePublicationComment(response) {
        var mess = 'Публикация отзыва изменена';
        showAlert(response.publish, mess);
        var button = $('#comment_' + response.publish).find('[data-action=public]');
        var text = $(button).text() == 'Опубликовать' ? 'Отменить публикацию' : 'Опубликовать';
        $(button).text(text);
    }
    
    function handleForSaleProduct(response) {
        var mess = 'Участие в акции изменено';
        showAlert(response, mess);
    }
    
    function getCountGood(field) {
        return field.val() > 1 ? field.val() : 1;
    }
        
    $('[data-action=buy]').on('click', function() {
        var field = $('[name=quantity]');
        field.val(getCountGood(field));
        var url = '/basket/buy/' + $(this).data('id');
        var data = {
            'quantity': getCountGood(field),
        };
        sendRequestServer(url, data, handleAddingGood);    
    });
    
    $('#recount').on('click', function() {
        $('[name=quantity]').each(function() {
            $(this).val(getCountGood($(this)));
            var url = '/basket/recount/';
            var data = {
                'id': $(this).data('id'),
                'quantity': $(this).val(),
            };
            sendRequestServer(url, data, handleRecountBasket);
        });
    });
    
    $('[data-action=delete]').on('click', function() {
        var url = '/comments/delete/' + $(this).data('id');
        sendRequestServer(url, {}, handleDeletionComment);
    });
    
    $('[data-action=public]').on('click', function() {
        var url = '/comments/public/' + $(this).data('id');
        sendRequestServer(url, {}, handlePublicationComment);
    });
    
    $('#comment').on('submit', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize() + '&send=send';
        sendRequestServer(url, data, handleAddingComment);
    });
    
    $('#status').on('change', function() {
        var url = '/order/status/' + $(this).data('id');
        var data = {
            'value': $(this).val(),
        };
        sendRequestServer(url, data, handleChangeStatus);
    });
    
    $('[data-action=sale]').on('change', function() {
        var url = '/goods/sale/' + $(this).data('id');
        sendRequestServer(url, {}, handleForSaleProduct);
    });
    
    $('#product-img button').on('click', function() {
        $(this).remove();
        $('#product-img').find('img').remove();
        $('#product-img').find('[type=checkbox]').prop('checked', true);
    });
    
    $('.toast').toast({
        'delay': 3000,
    });
});
