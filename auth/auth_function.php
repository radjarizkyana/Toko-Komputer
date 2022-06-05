<?php

$conn = mysqli_connect("localhost", "root", "", "db_ecommerrce");

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            window.location.href = './register?response=userfail';
			</script>";
        return false;
    }
    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        window.location.href = './register?response=passfail';
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO `tb_user` VALUES ('','$username','$password', DEFAULT)");

    return mysqli_affected_rows($conn);
}
