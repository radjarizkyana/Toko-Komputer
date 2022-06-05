<?php

session_start();

require './user_function.php';
if (!isset($_SESSION['login'])) {
    header('Location; ../');
    exit;
}

$id = (isset($_GET['id'])) ? $_GET['id'] : null;
if ($id != null) {
    $userbyId = query("SELECT * FROM tb_user WHERE user_id = '$id'")[0];
}

// EDIT LOGIC
if (isset($_POST['edit-user'])) {
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
                    <li><a href="./update-user?id=<?= $id ?>" class="active"><span>Edit data user</span></a></li>
                    <li><a href="./"><span>Kembali</span></a></li>
                </ul>
            </div>
            <div class="page-content">
                <div class="form-grup" style="margin-top: 1rem;">
                    <form action="" method="POST">
                        <a style="float: right;" href="./"><i class="fas fa-times"></i></a>
                        <input type="hidden" name="id" id="id" value="<?= $id ?>">
                        <p>Username</p>
                        <input type="text" id="username" name="username" value="<?= $userbyId['username'] ?>" class="input">

                        <p>User Level</p>
                        <input type="text" id="user_level" name="user_level" value="<?= $userbyId['user_level'] ?>" class="input">
                        <small>Ket * lv 1 = admin, 2 = costumer</small>


                        <input type="submit" name="edit-user" value="Submit" class="submit-input">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script src="../main.js"></script>
</body>

</html>