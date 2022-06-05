<?php


require './auth_function.php';
$response = (isset($_GET['response'])) ? $_GET['response'] : null;

if ($response === "userfail") {
    $response = "Username sudah tersedia!";
} elseif ($response === "passfail") {
    $response = "Password tidak sesuai!";
} elseif ($response === "success") {
    $response = "Registrasi berhasil!";
} elseif ($response === "fail") {
    $response = "Registrasi gagal!";
}


if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        window.location.href = './register?response=success';
        </script>";
    } else {
        echo "<script>
        window.location.href = './register?response=fail';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | Toko Komputer</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body style="background-color: blue;">

    <!-- login form -->
    <form action="" method="POST">
        <?php if ($response) : ?>
            <div class="badge" style="width: 90%; margin-bottom: 1rem;">
                <strong><?= $response ?></strong>
            </div>
        <?php endif; ?>
        <div class="group">
            <input type="text" name="username" id="username" required><span class="highlight"></span><span class="bar"></span>
            <label>Username</label>
        </div>
        <div class="group">
            <input type="password" name="password" id="password" required><span class="highlight"></span><span class="bar"></span>
            <label>Password</label>
        </div>
        <div class="group">
            <input type="password" name="password2" id="password2" required><span class="highlight"></span><span class="bar"></span>
            <label>Confirm Password</label>
        </div>
        <a href="./login" class="button buttonBlue" style="width: 10%; text-decoration: none;">Back</a>
        <input type="submit" name="register" id="register" value="Register" class="button buttonBlue">
    </form>
    <!-- login form end -->

</body>

</html>