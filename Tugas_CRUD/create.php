<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_product'];
    $jenis = $_POST['jenis_product'];
    $harga = $_POST['harga'];

    $sql = "INSERT INTO Product (nama_product, jenis_product, harga) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama, $jenis, $harga);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
    <h2>Tambah Data Produk</h2>
    <form method="POST">
        Nama Produk: <input type="text" name="nama_product" required><br>
        Jenis Produk: <input type="text" name="jenis_product" required><br>
        Harga: <input type="number" name="harga" required><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
