<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data UKT Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 500px; margin: auto; }
        label, input, select, button { display: block; width: 100%; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Masukkan Data UKT Mahasiswa</h1>
    <form action="insert.php" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required>
        
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea>
        
        <label for="prodi">Prodi:</label>
        <input type="text" id="prodi" name="prodi" required>
        
        <label for="ukt">UKT:</label>
        <input type="number" id="ukt" name="ukt" step="0.01" required>
        
        <button type="submit">Submit</button>
    </form>
    <a href="tabel.php">Lihat Data</a>
    <a href="statistik.php">Statistik UKT</a>
</body>
</html>
