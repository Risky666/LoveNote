<?php
session_start();
include '../config/db.php';

$id = $_GET['id']; // Ambil id pesan dari query parameter

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pesan = $_POST['pesan'];

    // Update pesan di database berdasarkan id pesan
    mysqli_query($conn, "UPDATE guestbook_entries SET pesan='$pesan' WHERE id='$id'");
    
    // Setelah update, redirect kembali ke halaman daftar pesan user
    header("Location: isi_buku_tamu.php");
    exit();
} else {
    // tampilkan form edit dengan data pesan yang sudah ada
    $result = mysqli_query($conn, "SELECT * FROM guestbook_entries WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);

    // Jika pesan tidak ditemukan, tampilkan pesan error dan keluar
    if (!$row) {
        echo "Pesan tidak ditemukan.";
        exit();
    }

    // Tampilkan form edit pesan dengan isi textarea yang diisi pesan lama
    echo <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesan</title>
    <link rel="stylesheet" href="../assets/css/edit_pesan.css">
</head>
<body>
    <h2>Edit Pesan</h2>
    <form method="POST">
        <textarea name="pesan" rows="5" cols="40" required>{$row['pesan']}</textarea><br>
        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="isi_buku_tamu.php">Kembali</a>
</body>
</html>
HTML;
}
?>
