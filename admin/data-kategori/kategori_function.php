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

function tambah($data)
{
    global $conn;
    $category_name = htmlspecialchars($data["category_name"]);

    $query = "INSERT INTO tb_category
				VALUES
				('', '$category_name')
			";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;

    $product = query("SELECT *
    FROM tb_product
    INNER JOIN tb_category
    ON tb_product.category = tb_category.category_id WHERE category_id = '$id'");

    if ($product === []) {
        mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '$id'");
        return mysqli_affected_rows($conn);
    } else {
        mysqli_query($conn, "DELETE FROM tb_product WHERE category = '$id'");
        if (mysqli_affected_rows($conn) > 0) {
            mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '$id'");
            return mysqli_affected_rows($conn);
        }
    }
}

function update($data)
{
    global $conn;
    $id = $data["id"];
    $category_name = htmlspecialchars($data["category_name"]);

    $query = "UPDATE `tb_category` SET `category_name`='$category_name' WHERE category_id = '$id'
			";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
