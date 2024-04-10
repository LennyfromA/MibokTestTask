<?php

    require_once "database.php";

    $sql = "SELECT p.name AS product_name, p.price AS product_price, c.name AS category_name, p.id AS product_id
            FROM products p
            JOIN categories c ON p.category_id = c.id";

    $result = mysqli_query($conn, $sql);

    $categoriesArray = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);

    if (!isset($_COOKIE['donut'])) {
        setcookie('donut', time(), time() + 60*60*24*11, '/', 'localhost');
    }

    $donut = $_COOKIE['donut'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<header>
    <a href="cart.php">
        <div id="cart">Корзина: <span id="cart-sum">0</span> рублей</div>
    </a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                let count = $('#cart-sum').text();
                let user_id = <?= $donut ?>;
                let totalSum = parseFloat($('#cart-sum').text());
                let price = parseFloat($(this).data('price'));
                let id = parseInt($(this).data('id'));
                count = parseFloat(count) + 1;
                totalSum += price;
                $('#cart-sum').text(totalSum.toFixed(2)).data('total-sum', totalSum.toFixed(2));
                $.post('http://localhost/Mibok/www/add_to_cart.php', { price: price, id: id, user_id: user_id }, function(data) {
                });

            });

        });

        $.get('http://localhost/Mibok/www/test.php', function(data) {
            console.log(data);
        });
    </script>
</header>

<body>
    <div class="wrapper">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <?php echo $categoriesArray[0]['category_name']; ?>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="items-row">

                            <div class="items__card">
                                <img src="img/echips_travel.jpg" alt="echips_travel" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[0]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[0]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart" data-id="<?= $categoriesArray[0]['product_id'] ?>" data-price="<?=  $categoriesArray[0]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="items__card">
                                <img src="img/msi_17.webp" alt="msi_katana_17" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[1]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[1]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart" data-id="<?= $categoriesArray[1]['product_id'] ?>" data-price="<?=  $categoriesArray[1]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="items__card">
                                <img src="img/msi_katana.webp" alt="tovar3" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[2]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[2]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart"  data-id="<?= $categoriesArray[2]['product_id'] ?>" data-price="<?=  $categoriesArray[2]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <?php echo $categoriesArray[3]['category_name']; ?>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="items-row">
                            <div class="items__card">
                                <img src="img/acer.jpg" alt="tovar1" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[3]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[3]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart"  data-id="<?= $categoriesArray[3]['product_id'] ?>" data-price="<?=  $categoriesArray[3]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="items__card">
                                <img src="img/dexp.jpg" alt="tovar2" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[4]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[4]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart" data-id="<?= $categoriesArray[4]['product_id'] ?>" data-price="<?=  $categoriesArray[4]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="items__card">
                                <img src="img/xiaomi.jpg" alt="tovar3" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[5]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[5]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart" data-id="<?= $categoriesArray[5]['product_id'] ?>" data-price="<?=  $categoriesArray[5]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <?php echo $categoriesArray[6]['category_name']; ?>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="items-row">
                            <div class="items__card">
                                <img src="img/ExeGate.jpg" alt="tovar1" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[6]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[6]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart" data-id="<?= $categoriesArray[6]['product_id'] ?>" data-price="<?=  $categoriesArray[6]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="items__card">
                                <img src="img/Defender.jpg" alt="tovar2" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[7]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[7]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart" data-id="<?= $categoriesArray[7]['product_id'] ?>" data-price="<?=  $categoriesArray[7]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="items__card">
                                <img src="img/Aceline.jpg" alt="tovar3" class="items-img" width="250px">
                                <div class="seansbody">
                                    <h3 class="card-title"><?php echo $categoriesArray[8]['product_name']; ?></h3>
                                    <div class="card_price"><?php echo $categoriesArray[8]['product_price']; ?> руб</div>
                                    <div class="card-button">
                                        <button class="add-to-cart"  data-id="<?= $categoriesArray[8]['product_id'] ?>" data-price="<?=  $categoriesArray[8]['product_price'] ?>">Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


