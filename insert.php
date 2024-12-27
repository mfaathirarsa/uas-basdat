<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_ukt";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$alamat = $_POST['alamat'];
$prodi = $_POST['prodi'];
$ukt = $_POST['ukt'];

// Insert data
$sql = "INSERT INTO ukt_mahasiswa (nama, nim, alamat, prodi, ukt) VALUES ('$nama', '$nim', '$alamat', '$prodi', '$ukt')";
if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<a href="index.php">Kembali</a>
