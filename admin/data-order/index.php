<?php
require './order_function.php';
session_start();

if (!isset($_SESSION['login'])) {
    header('Location; ../');
    exit;
}

$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$respon = (isset($_GET['response'])) ? $_GET['response'] : null;
$hapus = (isset($_GET['hapus'])) ? $_GET['hapus'] : null;

if ($respon === "deletesuccess") {
    $respon = "Data orderan berhasil dihapus!";
} elseif ($respon === "deletefalse") {
    $respon = "Data orderan gagal dihapus!";
}


$orderan = query("SELECT *
FROM tb_order
INNER JOIN tb_product ON tb_order.product_id=tb_product.product_id");

if ($hapus === "true") {
    if (delete($id) > 0) {
        echo "
			<script>
				document.location.href = './?response=deletesuccess';
			</script>
		";
    } else {
        echo "
			<script>
				document.location.href = './?response=deletefalse';
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
                    <li><a href="../"><span>Dashboard</span></a></li>
                    <li><a href="./" class="active"><span>Data Orderan</span></a></li>
                    <li><a href="../data-kategori"><span>Data Kategori</span></a></li>
                    <li><a href="../data-produk"><span>Data Produk</span></a></li>
                    <li><a href="../data-user"><span>Data User</span></a></li>
                    <li><a href="../../auth/logout"><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="page-content">
                <?php if ($respon) : ?>
                    <div class="badge" style="margin-bottom: 1rem;">
                        <a style="float: right;" href="./"><i class="fas fa-times"></i></a>
                        <strong><?= $respon ?></strong>
                    </div>
                <?php endif; ?>
                <table>
                    <tr>
                        <th>Nama pemesan</th>
                        <th>Alamat pemesan</th>
                        <th>Nama produk</th>
                        <th>Pesan / Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                    <?php foreach ($orderan as $orderan) : ?>
                        <tr>
                            <td><?= $orderan['nama_pemesan'] ?></td>
                            <td><?= $orderan['alamat_pemesan'] ?></td>
                            <td><?= $orderan['name_product'] ?></td>
                            <td><?= $orderan['pesan'] ?></td>
                            <td>
                                <a href="?hapus=true&id=<?= $orderan['order_id'] ?>" class="fas fa-trash" onclick="return confirm('Yakin ?')"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php if ($orderan === []) : ?>
                    <h3>Data Kosong</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script src="../main.js"></script>
</body>

</html>