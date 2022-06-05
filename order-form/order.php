<?php

require './order_function.php';

if (isset($_POST['order'])) {
    $id_product = $_POST['id_product'];
    $nama_pemesan = $_POST["nama_pemesan"];
    $alamat_pemesan = $_POST["alamat_pemesan"];
    $pesan = $_POST["pesan"];
    $jumlah_beli = $_POST["jumlah_beli"];
    $uang = $_POST["uang"];
    $uang = intval($uang);

    $product = query("SELECT *
            FROM tb_product
            INNER JOIN tb_category
            ON tb_product.category = tb_category.category_id WHERE product_id = '$id_product'")[0];
    $price_product = $product['price_product'];
    $price_product = explode('.', $price_product);

    $new_price = implode('', $price_product);
    $new_price = intval($new_price);

    $kembalian = $uang - $new_price;

    $stok_produk = $product['stock_product'];
    $stok_produk = intval($stok_produk);

    $sisa_stok = $stok_produk - $jumlah_beli;

    // CEK UANG KURANG / CUKUP
    if ($uang < $new_price) {
        echo "<script>
            window.location.href = './?product=$id_product&response=payfail'
        </script>";
        return false;
    } else {
        // CEK JIKA JUMLAH BELI KURANG DARI STOK PRODUK
        if ($stok_produk < $jumlah_beli) {
            echo "<script>
            window.location.href = './?product=$id_product&response=stokfail'
            </script>";
            return false;
        } else {
            // TAMBAH DATA KE TB_ORDER
            mysqli_query($conn, "INSERT INTO `tb_order` VALUES ('','$id_product','$nama_pemesan','$alamat_pemesan','$pesan')");

            // UPDATE STOK JIKA BERHASIL DIBELI
            if (mysqli_affected_rows($conn) > 0) {
                mysqli_query($conn, "UPDATE `tb_product` SET `stock_product`='$sisa_stok' WHERE product_id = '$id_product'");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style1.css">
    <title>Komputer Indonesia</title>
</head>

<body>

    <!-- navbar -->
    <nav>
        <div class="logo">
            <h2>Toko Komputer</h2>
        </div>

        <ul class="list-menu">
            <li><a href="./order" class="active">Struk</a></li>
            <li><a href="./">Back</a></li>
        </ul>
        <div class="menu-bars" id="toggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- struk -->
    <div class="invoice-card">
        <div class="invoice-details">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <td>PRODUCT ||</td>
                        <td>Unit ||</td>
                        <td>Harga ||</td>
                        <td> Bayar ||</td>
                        <td>Kembalian</td>
                    </tr>
                </thead>

                <tbody>
                    <tr class="row-data">
                        <td><?= $product['name_product'] ?></td>
                        <td id="unit"><?= $jumlah_beli ?></td>
                        <td><?= $product['price_product'] ?></td>
                        <td><?= $uang ?></td>
                        <td><?= $kembalian ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice-footer">
            <a href="./" class="btn btn-secondary" id="later">Kembali</a>
        </div>
    </div>
    <!-- struk end -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>