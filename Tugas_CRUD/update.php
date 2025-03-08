<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

// Ambil data produk yang akan diedit
$result = $conn->prepare("SELECT * FROM Product WHERE id_product = ?");
$result->bind_param("i", $id);
$result->execute();
$product = $result->get_result()->fetch_assoc();

if (!$product) {
    die("Produk tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_product'];
    $jenis = $_POST['jenis_product'];
    $harga = $_POST['harga'];

    $sql = "UPDATE Product SET nama_product=?, jenis_product=?, harga=? WHERE id_product=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $nama, $jenis, $harga, $id);

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
    <title>Edit Produk</title>
</head>
<body>
    <h2>Edit Data Produk</h2>
    <form method="POST">
        Nama Produk: <input type="text" name="nama_product" value="<?= htmlspecialchars($product['nama_product']); ?>" required><br>
        Jenis Produk: <input type="text" name="jenis_product" value="<?= htmlspecialchars($product['jenis_product']); ?>" required><br>
        Harga: <input type="number" name="harga" value="<?= htmlspecialchars($product['harga']); ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
