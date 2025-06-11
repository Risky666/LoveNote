<?php
session_start(); // Memulai session untuk mengakses data login

include '../config/db.php'; // Koneksi ke database

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Kalau belum, redirect ke halaman login
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil ID user dari session
$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'"); // Query data user berdasarkan ID
$user = mysqli_fetch_assoc($result); // Ambil hasil query sebagai array

if (!$user) {
    // Jika user tidak ditemukan di database
    echo "User tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"> 
    <title>Profil Saya</title> <!-- Judul halaman -->
    <link rel="stylesheet" href="../assets/css/profile.css?v=<?= time() ?>"> <!-- Import file CSS eksternal -->
</head>
<body>

<!-- Kontainer utama profil -->
<div class="profile-container">
    <h2>Profil Anda</h2>

    <!-- Menampilkan username user -->
    <div class="profile-info">
        <strong>Username:</strong> <?= htmlspecialchars($user['username']) ?>
    </div>

    <!-- Menampilkan role user -->
    <div class="profile-info">
        <strong>Role:</strong> <?= htmlspecialchars($user['role']) ?>
    </div>

    <!-- Jika user memiliki foto profil -->
    <?php if (!empty($user['photo'])): ?>
        <div class="profile-photo">
            <img src="../uploads/<?= htmlspecialchars($user['photo']) ?>" alt="Foto Profil">
        </div>
    <?php else: ?>
        <!-- Jika tidak ada foto profil -->
        <p>Tidak ada foto profil.</p>
    <?php endif; ?>

    <!-- Link navigasi -->
    <div class="profile-links">
        <a href="edit_profil.php">Edit Profil</a> <!-- Link ke edit profil -->
        <a href="ganti_password.php">Ganti Password</a> <!-- Link ke ganti password -->
        <a href="index.php">Kembali</a> <!-- Link kembali ke dashboard -->
    </div>
</div>

</body>
</html>
