<?php 
session_start();
include '../config/db.php'; // koneksi ke database

$user_id = $_SESSION['user_id']; // ambil ID user dari session

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password']; // ambil input password baru

    // Update password user di database
    mysqli_query($conn, "UPDATE users SET password='$password' WHERE id='$user_id'");

    // Tampilkan halaman sukses setelah password berhasil diubah
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Password Berhasil</title>
        <style>
            /* CSS */
            body {
                background-color: #f9f8f4; 
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .success-message {
                background-color: #e0e5da; 
                padding: 30px;
                border-radius: 16px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                text-align: center;
                color: #2f3e34;
                border: 1px solid #c2ccb9;
            }
            .success-message p {
                font-size: 1.2em;
                margin-bottom: 20px;
            }
            .success-message a {
                display: inline-block;
                background-color: #bfa046; 
                color: white;
                text-decoration: none;
                padding: 10px 20px;
                border-radius: 30px;
                font-weight: bold;
                transition: background-color 0.3s, transform 0.3s;
            }
            .success-message a:hover {
                background-color: #9d8437; 
                transform: scale(1.05);
            }
        </style>
    </head>
    <body>
        <div class="success-message">
            <p>Password berhasil diubah!</p>
            <a href="index.php">Kembali ke Beranda</a>
        </div>
    </body>
    </html>
    HTML;
} else {
    
    // Tampilkan form untuk ganti password
    echo <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="../assets/css/ganti_password.css"> <!-- link ke file CSS eksternal -->
</head>
<body>
    <div class="change-password-container">
        <h2>Ganti Password</h2>
        <form method="POST">
            <label for="password">Password Baru:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Ganti Password</button>
        </form>
    </div>
</body>
</html>
HTML;
}
?>
