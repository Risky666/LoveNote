<?php

// Mulai sesi untuk akses session
session_start();

// Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // Jika tidak, arahkan ke halaman login
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Link ke file CSS khusus halaman admin -->
    <link rel="stylesheet" href="../assets/css/admin/index.css">
</head>
<body>
    <!-- Sidebar menu admin -->
    <div class="sidebar">
        <h3>Menu Admin</h3>
        <a href="manage_user.php">Manage User</a> <!-- Link ke halaman manage user -->
        <a href="entri_semua_tamu.php">Entri Semua Tamu</a> <!-- Link ke data semua tamu -->
        <a href="laporan.php">Laporan</a> <!-- Link ke halaman laporan -->
        <a href="logout.php">Logout</a> <!-- Logout -->
    </div>

    <!-- Konten utama halaman admin -->
    <div class="content">
        <h1>Admin Dashboard</h1>
        <p>Selamat datang di halaman admin.</p>
    </div>
</body>
</html>
