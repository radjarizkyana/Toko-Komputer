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
    $product_name = htmlspecialchars($data["nama_produk"]);
    $category_id = htmlspecialchars($data["category_id"]);
    $product_price = htmlspecialchars($data["harga_produk"]);
    $product_description = htmlspecialchars($data["desc_produk"]);
    $stock_product = htmlspecialchars($data["stok_produk"]);

    $product_image = upload();
    if (!$product_image) {
        return false;
    }


    $query = "INSERT INTO `tb_product` VALUES ('','$product_name','$category_id','$product_price','$product_image','$product_description','$stock_product')
			";

    if ($category_id === "null") {
        echo "
			<script>
				document.location.href = './?response=error';
			</script>
		";
        return false;
    } else {
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}


function update($data)
{
    global $conn;
    $id = $data["id"];
    $product_name = htmlspecialchars($data["nama_produk"]);
    $category_id = htmlspecialchars($data["category_id"]);
    $product_price = htmlspecialchars($data["harga_produk"]);
    $product_description = htmlspecialchars($data["desc_produk"]);
    $stock_product = htmlspecialchars($data["stok_produk"]);
    $gambar_lama = htmlspecialchars($data["gambar_lama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE `tb_product` SET `name_product`='$product_name',`category`='$category_id',`price_product`='$product_price',`thumb_product`='$gambar',`desc_product`='$product_description',`stock_product`='$stock_product' WHERE product_id = '$id'
				";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;

    $orderan = query("SELECT * FROM tb_order WHERE product_id = '$id'");

    if ($orderan === []) {
        mysqli_query($conn, "DELETE FROM `tb_product` WHERE product_id = '$id'");
        return mysqli_affected_rows($conn);
    } else {
        mysqli_query($conn, "DELETE FROM `tb_order` WHERE product_id = '$id'");
        if (mysqli_affected_rows($conn) > 0) {
            mysqli_query($conn, "DELETE FROM `tb_product` WHERE product_id = '$id'");
            return mysqli_affected_rows($conn);
        }
    }
}
// upload func
function upload()
{

    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                window.location.href = './?response=imgfail';
			</script>";
        return false;
    }

    $ekstensi_gambar_valid = ['jpg', 'jpeg', 'png', 'jfif'];
    $ekstensi_gambar = explode('.', $nama_file);
    $ekstensi_gambar = strtolower(end($ekstensi_gambar));
    if (!in_array($ekstensi_gambar, $ekstensi_gambar_valid)) {
        echo "<script>
                window.location.href = './?response=imgwarning';
			</script>";
        return false;
    }

    if ($ukuran_file > 1000000) {
        echo "<script>
            window.location.href = './?response=imgover';
		</script>";
        return false;
    }

    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_gambar;

    move_uploaded_file($tmp_name, '../../img/' . $nama_file_baru);

    return $nama_file_baru;
}
