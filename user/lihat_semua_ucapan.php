<?php
// Menghubungkan ke database
include '../config/db.php';

// Memulai sesi untuk mengecek apakah user sudah login
session_start();

// Jika user belum login atau bukan role 'user', arahkan ke halaman login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit();
}

// Query untuk mengambil semua entri guestbook beserta username, diurutkan dari yang terbaru
$result = mysqli_query($conn, "SELECT g.*, u.username FROM guestbook_entries g JOIN users u ON g.user_id = u.id ORDER BY g.tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua Ucapan Tamu</title>
    <!-- Menghubungkan ke file CSS eksternal -->
    <link rel="stylesheet" href="../assets/css/lihat_semua_ucapan.css">
</head>
<body>

<div class="container">
    <!-- Judul halaman dengan ikon cincin -->
    <h2><span class="emoji">💍</span> Selamat Menikah ChiefRR & Nadilluv <span class="emoji">💍</span></h2>

    <!-- Mengecek apakah ada data ucapan -->
    <?php if (mysqli_num_rows($result) > 0): ?>
        <!-- Melakukan perulangan untuk setiap baris data ucapan -->
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="ucapan">
                <!-- Menampilkan username yang memberikan ucapan -->
                <strong><?= ($row['username']) ?> 🌸</strong>
                <!-- Menampilkan isi pesan ucapan, dengan newline diubah menjadi <br> -->
                <p><?= nl2br(($row['pesan'])) ?></p>
                <!-- Menampilkan tanggal pengiriman ucapan -->
                <small>🕒 <?= $row['tanggal'] ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <!-- Jika tidak ada ucapan -->
        <p class="kosong">Belum ada ucapan dari tamu.</p>
    <?php endif; ?>

    <!-- Tombol kembali ke halaman dashboard -->
    <div class="kembali">
        <a href="index.php" class="btn-kembali">Kembali ke Dashboard</a>
    </div>
</div>

</body>
</html>
