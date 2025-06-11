<?php
session_start();
include '../config/db.php'; // koneksi ke database

$user_id = $_SESSION['user_id']; // ambil ID user dari session

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // ambil input username baru
    $photo = $_FILES['photo']['name']; // ambil nama file foto yang diupload

    
    // Jika ada file foto yang diupload
    if ($photo) {
        $tmp = $_FILES['photo']['tmp_name']; // ambil lokasi temporary file
        move_uploaded_file($tmp, "../uploads/$photo"); // pindahkan file ke folder uploads
        // Update username dan nama file foto di database
        mysqli_query($conn, "UPDATE users SET username='$username', photo='$photo' WHERE id='$user_id'");
    } else {
        // Kalau tidak upload foto, update hanya username
        mysqli_query($conn, "UPDATE users SET username='$username' WHERE id='$user_id'");
    }

    // Setelah update, redirect ke halaman profil
    header("Location: profile.php");
    exit();
} else {
    // Kalau halaman baru dibuka (bukan dari form submit)
    // Ambil data user dari database
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'"));

    // Tampilkan form edit profil
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Edit Profil</title>
        <link rel="stylesheet" href="../assets/css/edit_profile.css?v=<?= time() ?>"> <!-- Link ke file CSS -->
    </head>
    <body>
        <div class="edit-profile-container">
            <h2>Edit Profil</h2>
            <form method="POST" enctype="multipart/form-data"> <!-- Form untuk edit username dan upload foto -->
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="{$user['username']}" required>
    
                <label for="photo" class="custom-file-label">Upload Foto Baru:</label>
                <input type="file" name="photo" id="photo" class="custom-file-input">
    
                <button type="submit">💾 Simpan Perubahan</button>
            </form>
            <a href="profile.php" class="back-link">← Kembali ke Profil</a>
        </div>
    </body>
    </html>
    HTML;
}
?>
