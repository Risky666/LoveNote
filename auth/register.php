<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //menghubungkan kedatabase
    include '../config/db.php';

    //mengambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Upload Gambar
    $photo = $_FILES['photo']['name'];//$_FILES['photo'] digunakan untuk ambil file gambar yang diupload.
    $tmp = $_FILES['photo']['tmp_name'];//tmp_name: lokasi file sementara di server.
    $target_dir = '../uploads/' . basename($photo); //memindahkan file dari tmp ke folder ../uploads/.
    move_uploaded_file($tmp, $target_dir);

    // Default role selalu 'user' ketika registrasi
    $role = 'user';

    //Menjalankan Query INSERT untuk menyimpan data ke database
    mysqli_query($conn, "INSERT INTO users (username, password, role, photo) VALUES ('$username', '$password', '$role', '$photo')");
    
    //menampilkan pesan ketika berhasil registrasi
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Register Sukses</title>
        <style>
            body {
                font-family: Georgia, serif;
                background-color: #fdfcf8;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .message-box {
                background-color: #e6ebe0;
                padding: 40px;
                border-radius: 12px;
                text-align: center;
                box-shadow: 0 0 20px rgba(218, 165, 32, 0.2);
            }
            h2 {
                color: #78866b;
                margin-bottom: 20px;
            }
            a {
                display: inline-block;
                padding: 10px 20px;
                background-color: #daa520;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                font-weight: bold;
                transition: background-color 0.3s;
            }
            a:hover {
                background-color: #e6c96b;
                color: #2e2e2e;
            }
        </style>
    </head>
    <body>
        <div class="message-box">
            <h2>Register berhasil!</h2>
            <a href='login.php'>Login di sini</a>
        </div>
    </body>
    </html>
    HTML;
} else {

    //Kalau user belum submit form maka tampilkan halaman register
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/register.css" />
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Register</h2>
        <label>Username:</label>
        <input type="text" name="username" required />
        <label>Password:</label>
        <input type="password" name="password" required />
        <label>Foto:</label>
        <input type="file" name="photo" accept="image/*" required />
        <button type="submit">Register</button>
    </form>
</body>
</html>
HTML;
}
?>
