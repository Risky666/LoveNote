<?php
session_start(); // Mulai session untuk akses data user yang login
include '../config/db.php'; // Koneksi ke database

// Cek apakah user sudah login dan role-nya 'user', kalau tidak arahkan ke login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session

// Ambil semua pesan dari user tersebut di tabel guestbook_entries
$result = mysqli_query($conn, "SELECT * FROM guestbook_entries WHERE user_id = '$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Pesan Anda</title>
<link rel="stylesheet" href="../assets/css/isi_buku_tamu.css"> <!-- Css external -->
</head>
<body>

<h2>
    Pesan Anda
    <a href="index.php" class="btn-dashboard">kembali ke Dashboard</a> <!-- Link kembali -->
</h2>

<?php if(mysqli_num_rows($result) > 0): ?> 
    <!-- Kalau ada pesan dari user -->
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="pesan">
            <p><?= ($row['pesan']) ?></p>

            <div class="actions">
                <!-- Link untuk edit pesan berdasarkan id -->
                <a href="edit_pesan.php?id=<?= $row['id'] ?>">Edit</a>
                <!-- Link untuk hapus pesan, ada konfirmasi javascript -->
                <a href="hapus_pesan.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus pesan ini?')">Hapus</a>
            </div>
            
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <!-- Jika belum ada pesan, tampilkan link untuk buat pesan baru -->
    <p>Anda belum memiliki pesan. <a href="entri.php">Tulis pesan pertama Anda</a></p>
<?php endif; ?>

</body>
</html>
