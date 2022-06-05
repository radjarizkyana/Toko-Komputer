<?php

$conn = mysqli_connect("localhost", "root", "", "db_ecommerrce");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function update($data)
{
    global $conn;
    $id = $data["id"];
    $username = htmlspecialchars($data["username"]);
    $user_level = htmlspecialchars($data["user_level"]);

    $angkaRole = ['1', '2'];
    if (!in_array($user_level,  $angkaRole)) {
        echo "<script>
            window.location.href = './update-user?id=$id&response=updatewarning'
			</script>";
        return false;
    }


    $query = "UPDATE `tb_user` SET `username`='$username',`user_level`='$user_level' WHERE user_id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    $role = query("SELECT * FROM tb_user WHERE user_id = '$id'");
    $role = $role[0];
    $user_level = $role['user_level'];
    $username = $role['username'];

    if ($user_level === '1' && $username === "admin") {
        echo "<script>
				window.location.href = '/?response=notaccess'
			</script>";
        return false;
    } else {
        mysqli_query($conn, "DELETE FROM `tb_user` WHERE user_id = '$id'");
        return mysqli_affected_rows($conn);
    }
}
