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

// Statistik 5 Serangkai
$sql = "SELECT MAX(ukt) AS max_ukt, MIN(ukt) AS min_ukt, AVG(ukt) AS avg_ukt, STD(ukt) AS std_dev, 
               COUNT(*) AS total 
        FROM ukt_mahasiswa";
$row = $conn->query($sql)->fetch_assoc();

// Ambil semua data UKT untuk perhitungan manual
$sql_all = "SELECT ukt FROM ukt_mahasiswa ORDER BY ukt ASC";
$result = $conn->query($sql_all);

$ukt = [];
while ($data = $result->fetch_assoc()) {
    if (is_numeric($data['ukt'])) {
        $ukt[] = (float)$data['ukt']; // Pastikan menjadi float
    }
}

$total_data = count($ukt);
if ($total_data > 0) {
    // Hitung Median
    if ($total_data % 2 == 0) {
        $median = ($ukt[$total_data / 2 - 1] + $ukt[$total_data / 2]) / 2;
    } else {
        $median = $ukt[floor($total_data / 2)];
    }

    // Hitung Q1 dan Q3
    $q1_index = floor(($total_data - 1) * 0.25);
    $q3_index = floor(($total_data - 1) * 0.75);
    $q1 = $ukt[$q1_index];
    $q3 = $ukt[$q3_index];
    $iqr = $q3 - $q1;

    // Hitung batas bawah dan atas
    $lower_limit = $q1 - 1.5 * $iqr; // Batas bawah berdasarkan IQR
    $upper_limit = $q3 + 1.5 * $iqr; // Batas atas berdasarkan IQR

    // Cari pencilan
    $pencilan_atas = array_filter($ukt, fn($value) => $value > $upper_limit);
    $pencilan_bawah = array_filter($ukt, fn($value) => $value < $lower_limit);
} else {
    // Jika tidak ada data
    $median = $q1 = $q3 = $iqr = $lower_limit = $upper_limit = 0;
    $pencilan_atas = [];
    $pencilan_bawah = [];
}

// Output Statistik
echo "<h1>Statistik UKT Mahasiswa</h1>";
echo "UKT Tertinggi: Rp " . number_format($row['max_ukt'], 2) . "<br>";
echo "UKT Terendah: Rp " . number_format($row['min_ukt'], 2) . "<br>";
echo "Rata-rata UKT: Rp " . number_format($row['avg_ukt'], 2) . "<br>";
echo "Median UKT: Rp " . number_format($median, 2) . "<br>";
echo "Standar Deviasi UKT: Rp " . number_format($row['std_dev'], 2) . "<br>";
echo "Total Mahasiswa: " . $row['total'] . "<br>";

echo "Q1 (Kuartil 1): Rp " . number_format($q1, 2) . "<br>";
echo "Q3 (Kuartil 3): Rp " . number_format($q3, 2) . "<br>";
echo "IQR (Interquartile Range): Rp " . number_format($iqr, 2) . "<br>";
echo "Batas Bawah: Rp " . number_format($lower_limit, 2) . "<br>";
echo "Batas Atas: Rp " . number_format($upper_limit, 2) . "<br>";

echo "<h2>Pencilan Atas</h2>";
if (count($pencilan_atas) > 0) {
    foreach ($pencilan_atas as $value) {
        echo "Rp " . number_format($value, 2) . "<br>";
    }
} else {
    echo "Tidak ada pencilan atas.<br>";
}

echo "<h2>Pencilan Bawah</h2>";
if (count($pencilan_bawah) > 0) {
    foreach ($pencilan_bawah as $value) {
        echo "Rp " . number_format($value, 2) . "<br>";
    }
} else {
    echo "Tidak ada pencilan bawah.<br>";
}

$conn->close();
?>
<a href="index.php">Kembali</a>
