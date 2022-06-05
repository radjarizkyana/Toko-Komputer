<?php

session_start();
require './user_function.php';
if (!isset($_SESSION['login'])) {
    header('Location; ../');
    exit;
}

$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$respon = (isset($_GET['response'])) ? $_GET['response'] : null;
$hapus = (isset($_GET['hapus'])) ? $_GET['hapus'] : null;

if ($respon === "deletesuccess") {
    $respon = "Data user berhasil dihapus!";
} elseif ($respon === "deletefalse") {
    $respon = "Data user gagal dihapus!";
} elseif ($respon === "updatesuccess") {
    $respon = "Berhasil ubah data user!";
} elseif ($respon === "updatefalse") {
    $respon = "Gagal ubah data user!";
} elseif ($respon === "updatewarning") {
    $respon = "User level hanya bisa diisi dengan angka '1' & '2' saja!";
} elseif ($respon === "notaccess") {
    $respon = "Akun dengan username admin & level admin tidak bisa dihapus!";
}

$user = query("SELECT * FROM tb_user ORDER BY user_id DESC");

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
                    <li><a href="../data-order"><span>Data Orderan</span></a></li>
                    <li><a href="../data-kategori"><span>Data Kategori</span></a></li>
                    <li><a href="../data-produk"><span>Data Produk</span></a></li>
                    <li><a href="./" class="active"><span>Data User</span></a></li>
                    <li><a href="../../auth/logout"><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="page-content">
                <?php if ($respon) : ?>
                    <div class="badge">
                        <strong><?= $respon ?></strong>
                    </div>
                <?php endif; ?>
                <table style="margin-top: 1rem;">
                    <tr>
                        <th>Username</th>
                        <th>User Level</th>
                        <th>Aksi</th>
                    </tr>
                    <?php foreach ($user as $user) : ?>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <?php if ($user['user_level'] === "1") { ?>
                                <td>Admin</td>
                            <?php } else { ?>
                                <td>Costumer</td>
                            <?php } ?>
                            <td>
                                <a href="./update-user?id=<?= $user['user_id'] ?>"><i class="fas fa-edit"></i></a>
                                <a href="?hapus=true&id=<?= $user['user_id'] ?>" class="fas fa-trash" onclick="return confirm('Yakin ?')"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php if ($user === []) : ?>
                    <h3>Data Kosong</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script src="../main.js"></script>
</body>

</html>