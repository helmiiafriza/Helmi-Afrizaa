<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "wad_helmi";
$port = 4308; 

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
