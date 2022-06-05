<?php
session_start();
require './auth_function.php';



// cek apakah tombol submit suda ditekan atau belum
if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];


    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' ");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION['dataUser'] = $row;

            if($row['user_level'] === "2"){
                header('Location: ../');
                exit;
            }else{
                header('Location: ../admin');
                exit;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Toko Komputer</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body style="background-color: blue;">

    <!-- login form -->
    <form action="" method="POST">
        <div class="group">
            <input type="text" name="username" id="username" required><span class="highlight"></span><span class="bar"></span>
            <label>Username</label>
        </div>
        <div class="group">
            <input type="password" name="password" id="password" required><span class="highlight"></span><span class="bar"></span>
            <label>Password</label>
        </div>
        <a href="../order-form" class="button buttonBlue" style="width: 25%; text-decoration: none;">Back to main menu</a>
        <a href="./register" class="button buttonBlue" style="width: 15%; text-decoration: none;">Register</a>
        <input type="submit" name="login" id="login" value="Login" class="button buttonBlue">
    </form>
    <!-- login form end -->

</body>

</html>