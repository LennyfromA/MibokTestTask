<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/stylecart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

<header>
    <div id="cart">
        Корзина: <span id="cart-count">0</span> товаров на сумму <span id="cart-total">0</span> руб.
        <button type="button" class="btn btn-outline-light" id="out">Оформить заказ</button>
    </div>
</header>
<ul id="myList"></ul>

<script>
    $(document).ready(function() {
        let cartItems = [];
        let totalPrice = 0;
        let totalQuantity = 0;
        let session_id = "<?php echo $_COOKIE['donut']; ?>";


        $.get('http://localhost/Mibok/www/distributor.php', function(data) {
            console.log(data);
            $.each(data, function(index, item) {
                let li = $('<li>').attr('id', index).data('itemIndex', index).text(item.product_name + ': ' + item.product_price + ' руб. * ' + item.quantity);
                let removeButton =  $('<button  id="del_button">').text('Удалить').data('itemIndex', index).click(function() {
                    removeItem($(this).data('itemIndex'));
                });
                li.append(removeButton);
                $('#myList').append(li);
                cartItems[index] = item;
                totalPrice += parseFloat(item.product_price) * parseInt(item.quantity);
                totalQuantity += parseInt(item.quantity);
                updateCart();
            });
        });

        function removeItem(index) {
            let item = cartItems[index];
            console.log(cartItems);
            console.log(item);
            if (item.quantity > 1) {
                item.quantity -= 1;
                totalQuantity -= 1;
                totalPrice -= parseFloat(item.product_price);
                let lit = $('#' + index).text(item.product_name + ': ' + item.product_price + ' руб. * ' + item.quantity);
                let removeButton =  $('<button  id="del_button">').text('Удалить').data('itemIndex', index).click(function() {
                    removeItem($(this).data('itemIndex'));
                });
                lit.append(removeButton);
                console.log('in if', lit);
                $.post('http://localhost/Mibok/www/update_cart_quantity.php', { session_id: session_id, product_id: index, quantity: item.quantity, action: 'update' }, function(data) {
                });
            } else {
                totalPrice -= parseFloat(item.product_price) * item.quantity;
                totalQuantity -= item.quantity;
                cartItems.splice(index, 0);
                $('#' + index).remove();
                console.log('in else', cartItems);
                $.post('http://localhost/Mibok/www/update_cart_quantity.php', { session_id: session_id, product_id: index, action: 'delete' }, function(data) {
                });
            }
            updateCart();
        }

        function updateCart() {
            $('#cart-count').text(totalQuantity);
            $('#cart-total').text(totalPrice.toFixed(2));
        }

        $('#out').click(function() {

            alert('Ваш заказ оформлен');
            cartItems = [];
            totalPrice = 0;
            totalQuantity = 0;
            updateCart();
            $('#myList').empty();
            $.post('http://localhost/Mibok/www/update_cart_quantity.php', { session_id: session_id, action: 'buy' }, function(data) {
            });
        });
    });
</script>
</body>
</html>