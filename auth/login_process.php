<?php
// Memulai sesi PHP, supaya nanti bisa menyimpan data user seperti user_id dan role.
session_start(); 

// Menghubungkan ke file koneksi database (db.php).
include '../config/db.php'; 

// Ambil data dari form login
// Mengambil input username dan password dari form POST.
$username = $_POST['username']; 
$password = $_POST['password']; 
// Mengambil input username dan password dari form POST.


// Cek user di database
// Membuat query SQL untuk mencari user yang cocok dengan username dan password.

//ini celah sql injection
$q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'"); 

// Jika ada 1 user yang cocok (login berhasil)
if (mysqli_num_rows($q) == 1) {
    
    // Mengambil data user tersebut dalam bentuk array.
    $user = mysqli_fetch_assoc($q);
    
    // Menyimpan id user dan role ke session untuk otentikasi di halaman selanjutnya.
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    

    // Redirect berdasarkan role user
    if ($user['role'] == 'admin') {
        header("Location: ../admin/index.php");// Kalau role-nya "admin", diarahkan ke dashboard admin.
        exit();
    } else {
        header("Location: ../user/index.php"); // Kalau role-nya "user", diarahkan ke dashboard user biasa.

        exit();
    }
       
} else {

    // Jika login gagal 
    
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8" />
        <title>Login Gagal</title>
        <style>
            /* CSS*/
            body {
                font-family: Arial, sans-serif;
                background-color: #fdfcf8;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                color: #2e2e2e;
                padding: 20px;
                box-sizing: border-box;
            }
            .message-box {
                background-color: #e6ebe0;
                padding: 30px 40px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(218, 165, 32, 0.25);
                max-width: 400px;
                text-align: center;
            }
            p {
                font-size: 1.1rem;
                margin-bottom: 20px;
                color: #78866b;
            }
            a {
                display: inline-block;
                padding: 10px 20px;
                background-color: #daa520;
                color: #2e2e2e;
                text-decoration: none;
                font-weight: bold;
                border-radius: 6px;
                transition: background-color 0.3s ease;
            }
            a:hover {
                background-color: #e6c96b;
            }
        </style>
    </head>
    <body>
        <div class="message-box">
            <p>Login gagal. Username atau password salah.</p>
            <a href="login.php">Coba lagi</a>
        </div>
    </body>
    </html>
    HTML;
    // Menampilkan halaman HTML sederhana yang memberi tahu user kalau login gagal.
}
?>
