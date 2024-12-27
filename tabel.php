<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data UKT Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Tabel Data UKT Mahasiswa</h1>
    <a href="index.php">Kembali ke Form</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Alamat</th>
                <th>Prodi</th>
                <th>UKT</th>
            </tr>
        </thead>
        <tbody>
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

            // Query untuk mendapatkan data
            $sql = "SELECT * FROM ukt_mahasiswa";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['nim']}</td>
                        <td>{$row['alamat']}</td>
                        <td>{$row['prodi']}</td>
                        <td>Rp " . number_format($row['ukt'], 2) . "</td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
