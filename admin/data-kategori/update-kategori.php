<?php

session_start();
require './kategori_function.php';
if (!isset($_SESSION['login'])) {
    header('Location; ../');
    exit;
}

$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$kategori = query("SELECT * FROM tb_category ORDER BY category_id DESC");
if ($id != null) {
    $kategoribyId = query("SELECT * FROM tb_category WHERE category_id = '$id'")[0];
}

// EDIT LOGIC
if (isset($_POST['edit-category'])) {
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
                    <li><a href="./update-kategori" class="active"><span>Edit Kategori</span></a></li>
                    <li><a href="./"><span>Kembali</span></a></li>
                    <li><a href="../../auth/logout"><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="page-content">
                <div class="form-grup" style="margin-top: 1rem;">
                    <form action="" method="POST">
                        <a style="float: right;" href="./"><i class="fas fa-times"></i></a>
                        <input type="hidden" name="id" id="id" value="<?= $id ?>">
                        <p>Nama Kategori Baru</p>
                        <input type="text" id="category_name" name="category_name" value="<?= $kategoribyId['category_name'] ?>" class="input">

                        <input type="submit" name="edit-category" value="Submit" class="submit-input">
                    </form>
                </div>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
        <script src="../main.js"></script>
</body>

</html>