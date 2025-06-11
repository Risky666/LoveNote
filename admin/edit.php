<?php
// Menghubungkan ke database
include '../config/db.php';

// Validasi apakah parameter ID tersedia di URL
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Mengambil data tamu berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM guestbook_entries WHERE id=$id");
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan di database
if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Proses update data setelah form disubmit
if (isset($_POST['update'])) {
    $nama = $_POST['name'];
    $pesan = $_POST['message'];

    // Melakukan update ke database
    mysqli_query($conn, "UPDATE guestbook_entries SET nama='$nama', pesan='$pesan' WHERE id=$id");

    // Redirect ke halaman entri semua tamu setelah update
    header("Location: entri_semua_tamu.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Tamu</title>
    <style>
    /* Tema warna dan variabel CSS  */
    :root {
        --primary-color: #16a085;
        --primary-hover: #1abc9c;
        --danger-color: #e74c3c;
        --danger-hover: #c0392b;
        --background-color: #2c3e50;
        --card-color: #34495e;
        --text-color: #ecf0f1;
        --border-radius: 0px;
        --transition-speed: 0.3s;
    }

    /* Reset CSS dasar */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Gaya umum untuk body */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        padding: 30px;
        font-size: 16px;
        line-height: 1.5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* Gaya untuk form */
    form {
        background-color: var(--card-color);
        padding: 30px;
        border-radius: var(--border-radius);
        box-shadow: 0 2px 10px rgba(0,0,0,0.5);
        width: 100%;
        max-width: 500px;
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: var(--primary-color);
        font-weight: 700;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    /* Input dan textarea */
    input[type="text"],
    textarea {
        width: 100%;
        padding: 12px 14px;
        margin-bottom: 20px;
        border: 1px solid #5a6b7c;
        border-radius: var(--border-radius);
        background-color: #3b556e;
        color: var(--text-color);
        font-size: 15px;
        transition: border-color var(--transition-speed), background-color var(--transition-speed);
    }

    /* Fokus pada input/textarea */
    input[type="text"]:focus,
    textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        background-color: #2f455a;
    }

    /* Tombol submit */
    button[type="submit"] {
        background-color: var(--primary-color);
        color: white;
        font-weight: 700;
        font-size: 16px;
        padding: 12px 20px;
        border: none;
        cursor: pointer;
        transition: background-color var(--transition-speed);
        width: 100%;
        border-radius: var(--border-radius);
        margin-bottom: 15px;
    }

    button[type="submit"]:hover {
        background-color: var(--primary-hover);
    }

    /* Tombol kembali */
    a {
        display: inline-block;
        text-align: center;
        background-color: var(--primary-color);
        color: white;
        font-weight: 700;
        font-size: 16px;
        padding: 12px 20px;
        text-decoration: none;
        width: 100%;
        transition: background-color var(--transition-speed);
        border-radius: var(--border-radius);
    }

    a:hover {
        background-color: var(--primary-hover);
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 600px) {
        form {
            padding: 20px;
        }
        input[type="text"],
        textarea {
            font-size: 14px;
        }
        button[type="submit"],
        a {
            font-size: 14px;
            padding: 10px 16px;
        }
    }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Edit Data Tamu</h2>

        <!-- Input nama -->
        <label>Nama:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($data['nama']) ?>" required>

        <!-- Input pesan -->
        <label>Pesan:</label>
        <textarea name="message" rows="5" required><?= htmlspecialchars($data['pesan']) ?></textarea>

        <!-- Tombol simpan -->
        <button type="submit" name="update">Simpan Perubahan</button>

        <!-- Tombol kembali -->
        <a href="entri_semua_tamu.php">Kembali</a>
    </form>
</body>
</html>

