<?php
session_start();
require './order_function.php';

if (isset($_GET['product'])) {
    $id = $_GET['product'];
} else {
    header('Location: ../');
    exit;
}

$response = (isset($_GET['response'])) ? $_GET['response'] : null;

if ($response === "payfail") {
    $response = "Uang anda tidak cukup!";
} elseif ($response === "stokfail") {
    $response = "Stok produk kurang, silahkan kurangi orderan anda!";
}

$product = query("SELECT *
FROM tb_product
INNER JOIN tb_category
ON tb_product.category = tb_category.category_id WHERE product_id = '$id'");

if ($product != []) {
    $product = $product[0];
}
$price_product = $product['price_product'];
$price_product = explode('.', $price_product);

$new_price = implode('', $price_product);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Komputer Indonesia</title>
</head>

<body>

    <!-- navbar -->
    <nav>
        <div class="logo">
            <h2>Toko Komputer</h2>
        </div>

        <ul class="list-menu">
            <li><a href="./" class="active">Order form</a></li>
            <li><a href="../">Back</a></li>
        </ul>
        <div class="menu-bars" id="toggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- form order -->
    <?php if ($response) : ?>
        <div class="badge" style="margin-top: 3rem;">
            <strong><?= $response ?></strong>
        </div>
    <?php endif; ?>
    <?php if ($id != null) { ?>
        <form action="./order.php" method="POST">
            <p>Nama barang : <b><?= $product['name_product'] ?></b></p><br>
            <p class="price">Harga yang harus dibayar : <b><?= $new_price ?></b></p>
            <input type="hidden" name="id_product" id="id_product" value="<?= $id ?>">
            <input type="hidden" name="price" id="price" value="<?= $new_price ?>">
            <div class="group">
                <input type="text" name="nama_pemesan" id="nama_pemesan" required><span class="highlight"></span><span class="bar"></span>
                <label>Nama Lengkap</label>
            </div>
            <div class="group">
                <input type="text" name="alamat_pemesan" id="alamat_pemesan" required><span class="highlight"></span><span class="bar"></span>
                <label>Alamat Anda</label>
            </div>
            <div class="group">
                <input type="number" name="jumlah_beli" id="jumlah_beli" value="1" required><span class="highlight"></span><span class="bar"></span>
                <label>Jumlah Barang</label>
            </div>
            <div class="group">
                <input type="number" name="uang" id="uang" required><span class="highlight"></span><span class="bar"></span>
                <label>Uang Anda</label>
            </div>
            <div class="group">
                <input type="pesan" name="pesan" id="pesan"><span class="highlight"></span><span class="bar"></span>
                <label>Pesan / Keterangan</label>
            </div>
            <?php if (isset($_SESSION['login']) === true) { ?>
                <input type="submit" name="order" id="order" class="button buttonBlue" value="Order">
            <?php } else { ?>
                <a href="../auth/login" class="button buttonBlue" style="width: 90%; text-decoration: none;">Anda harus login untuk lanjut</a>
            <?php } ?>
        </form>
    <?php } ?>
    <!-- form order end -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>