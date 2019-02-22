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
            $('#message').html(mess);
            $('#message').addClass('alert-success').show();
        } else {
            $('#message').html('Произошла ошибка!');
            $('#message').addClass('alert-danger').show();
        }
    }
    
    function handleAddingGood(response) {
        var mess = 'Товар добавлен! Перейти в <a href="/basket/" class="alert-link">корзину</a>';
        showAlert(response.adding, mess);
        changeCountCart();
    }
    
    function handleFillCart(response) {
        $('#cart').text(response.cart.count);
    }
    
    function handleRecountBasket(response) {
        $('#total').text(response.total.summ);
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
    
    function getCountGood(field) {
        return field.val() > 1 ? field.val() : 1;
    }
        
    $('[data-action=buy]').on('click', function() {
        var field = $('[name=quantity]');
        field.val(getCountGood(field));
        var url = '/basket/buy/';
        var data = {
            'good': $(this).data('id'),
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
    
    $('#comment').on('submit', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize() + '&send=send';
        sendRequestServer(url, data, handleAddingComment);
    });
});
