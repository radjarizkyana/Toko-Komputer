<?php

session_start();
require './produk_function.php';
if (!isset($_SESSION['login'])) {
    header('Location; ../');
    exit;
}

$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$produk = query("SELECT *
FROM tb_product
INNER JOIN tb_category ON tb_product.category=tb_category.category_id");

if ($id != null) {
    $productId = query("SELECT * FROM tb_product WHERE product_id = '$id'")[0];
}
$kategori = query("SELECT * FROM tb_category ORDER BY category_id DESC");

// EDIT PRODUCT LOGIC
if (isset($_POST['edit-product'])) {
    if (update($_POST) > 0) {
        echo "
			<script>
				document.location.href = './?response=updatesuccess';
			</script>
		";
    } else {
        echo "
			<script>
				document.location.href = './?response=updatefalse';
			</script>
		";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Toko Komputer | Admin Dashboard</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-logo">
                <span class="site-title">Komputer</span>
            </div>
            <div class="header-search">
                <button class="button-menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="main">
            <div class="sidebar">
                <ul>
                    <li><a href="./update-produk" class="active"><span>Tambah Produk</span></a></li>
                    <li><a href="./"><span>Kembali</span></a></li>
                    <li><a href="../../auth/logout"><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="page-content">
                <div class="form-grup" style="margin-top: 1rem;">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <a style="float: right;" href="./"><i class="fas fa-times"></i></a>
                        <input type="hidden" name="id" id="id" value="<?= $id ?>">

                        <input type="hidden" name="gambar_lama" value="<?= $productId["thumb_product"]; ?>">

                        <input type="text" id="nama_produk" name="nama_produk" value="<?= $productId['name_product'] ?>" class="input">

                        <select name="category_id" id="category_id" required>
                            <?php foreach ($kategori as $kategori) : ?>
                                <option value="<?= $kategori['category_id'] ?>"><?= $kategori['category_name'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <input type="text" id="harga_produk" name="harga_produk" value="<?= $productId['price_product'] ?>" class="input">

                        <input type="text" id="desc_produk" name="desc_produk" value="<?= $productId['desc_product'] ?>" class="input">

                        <input type="number" id="stok_produk" name="stok_produk" value="<?= $productId['stock_product'] ?>" class="input">

                        <img src="../../img/<?= $productId['thumb_product'] ?>" style="width: 100px;">

                        <label class="custom-file-upload">
                            <input type="file" name="gambar" id="gambar" />
                            <span style="float: right;">Gambar Product</span>
                        </label>

                        <input type="submit" name="edit-product" value="Update" class="submit-input">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script src="../main.js"></script>
</body>

</html>