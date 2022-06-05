<?php
session_start();
require './main_function.php';

$product = query("SELECT *
FROM tb_product
INNER JOIN tb_category
ON tb_product.category = tb_category.category_id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Komputer Indonesia</title>
</head>

<body>

    <!-- navbar -->
    <nav>
        <div class="logo">
            <h2>Toko Komputer</h2>
        </div>

        <ul class="list-menu">
            <li><a href="./" class="active">Home</a></li>
            <?php if (isset($_SESSION['login']) === true) { ?>
                <li><a href="auth/logout">Logout</a></li>
            <?php }else{ ?>
                <li><a href="auth/login">Login</a></li>
            <?php } ?>
        </ul>
        <div class="menu-bars" id="toggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- product -->
    <div class="data_product">
        <?php foreach ($product as $product) : ?>
            <div class="product-card">
                <div class="product-tumb">
                    <img src="img/<?= $product['thumb_product'] ?>" alt="">
                </div>
                <div class="product-details">
                    <span class="product-catagory"><?= $product['category_name'] ?></span>
                    <h4><a href=""><?= $product['name_product'] ?></a></h4>
                    <p><?= $product['desc_product'] ?></p>
                    <p>Stok : <?= $product['stock_product'] ?></p>
                    <div class="product-bottom-details">
                        <div class="product-price">Rp.<?= $product['price_product'] ?></div>
                        <div class="product-links">
                            <a href="./order-form/?product=<?= $product['product_id'] ?>"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- product end -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script src="js/main.js"></script>
</body>

</html>