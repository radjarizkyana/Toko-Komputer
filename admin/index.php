<?php 

session_start();

if(!isset($_SESSION['login'])){
    header('Location; ../');
    exit;
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
    <link rel="stylesheet" href="style.css">
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
                    <li><a href="./" class="active"><span>Dashboard</span></a></li>
                    <li><a href="./data-order"><span>Data Orderan</span></a></li>
                    <li><a href="./data-kategori"><span>Data Kategori</span></a></li>
                    <li><a href="./data-produk"><span>Data Produk</span></a></li>
                    <li><a href="./data-user"><span>Data User</span></a></li>
                    <li><a href="../auth/logout"><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="page-content">
                <h1>hi Admin</h1>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script src="main.js"></script>
</body>

</html>