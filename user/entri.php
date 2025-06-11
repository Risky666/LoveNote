<?php
session_start(); // Mulai sesi, untuk mengambil data user yang login

include '../config/db.php'; // Include koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Jika form dikirim menggunakan post
    $user_id = $_SESSION['user_id']; // Ambil ID user dari session
    $pesan = $_POST['pesan']; // Ambil isi pesan dari form

    // Ambil username user dari database berdasarkan ID user
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = '$user_id'");
    $user = mysqli_fetch_assoc($result);
    $nama = $user['username']; // Simpan username untuk dimasukkan ke tabel buku tamu

    // Masukkan data pesan ke tabel guestbook_entries
    mysqli_query($conn, "INSERT INTO guestbook_entries (user_id, nama, pesan) VALUES ('$user_id', '$nama', '$pesan')");

    // Tampilkan halaman sukses setelah pesan berhasil disimpan
    echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Pesan Terkirim</title>
    <link rel="stylesheet" href="../assets/css/entri_user.css"> <!-- css external -->
</head>
<body>
<div class="success-alert">
    <p>✅ Pesan berhasil dikirim!</p>
    <a href="isi_buku_tamu.php">📄 Lihat Pesan</a> <!-- Link ke halaman lihat entri diri sendiri-->
</div>
</body>
</html>
HTML;

} else {
    //  form isi buku tamu
    echo <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <title>Isi Buku Tamu</title>
        <link rel="stylesheet" href="../assets/css/entri_user.css"> <!-- Css external -->
    </head>
    <body>
    <div class="container">
        <h2>Isi Buku Tamu</h2>
        <form method="POST">
            <label for="pesan">Pesan Anda:</label><br>
            <textarea name="pesan" id="pesan" rows="5" cols="50" required></textarea><br><br>
            <button type="submit">Kirim</button>
        </form>
    </div>
    </body>
    </html>
    HTML;
    
}
?>
