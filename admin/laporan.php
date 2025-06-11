<?php

// Mulai sesi untuk pengecekan role login
session_start();

// Cek apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php"); // redirect jika bukan admin
    exit();
}

// Include koneksi database
include '../config/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku Tamu</title>
    <style>
    /* Variabel warna dan gaya umum */
    :root {
        --primary-color: #16a085;
        --primary-hover: #1abc9c;
        --background-color: #2c3e50;
        --card-color: #34495e;
        --text-color: #ecf0f1;
        --border-radius: 0px;
        --transition-speed: 0.3s;
    }

    /* Reset dan box sizing */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /*  body */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        padding: 30px;
        min-height: 100vh;
    }

    /* Judul halaman */
    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        color: var(--primary-color);
        font-weight: 700;
    }

    /* Gaya tiap entri buku tamu */
    .entry {
        background: var(--card-color);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.5);
        transition: transform var(--transition-speed);
    }

    /* Efek hover */
    .entry:hover {
        transform: translateY(-3px);
    }

    .entry strong {
        font-size: 20px;
        color: var(--primary-hover);
    }

    .entry small {
        display: block;
        color: #bdc3c7;
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .entry p {
        font-size: 16px;
        line-height: 1.6;
        color: var(--text-color);
    }

    /* Total entri di bagian akhir */
    .total {
        margin-top: 30px;
        background: var(--primary-hover);
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        border-radius: var(--border-radius);
        color: white;
    }

    /* Tombol kembali */
    a.back {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 20px;
        background-color: var(--primary-color);
        color: white;
        text-decoration: none;
        border-radius: var(--border-radius);
        font-size: 16px;
        font-weight: 700;
        text-align: center;
        transition: background-color var(--transition-speed);
        width: 100%;
        max-width: 300px;
    }

    a.back:hover {
        background-color: var(--primary-hover);
    }

    .center {
        text-align: center;
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 600px) {
        body {
            padding: 20px;
        }
        h2 {
            font-size: 24px;
        }
        .entry p {
            font-size: 15px;
        }
        .total {
            font-size: 16px;
        }
        a.back {
            font-size: 14px;
            padding: 10px 16px;
        }
    }
    </style>
</head>
<body>

<h2>Laporan Buku Tamu</h2>

<?php
// Ambil seluruh data entri dari tabel guestbook_entries, urutkan dari yang terbaru
$query = "SELECT * FROM guestbook_entries ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$total = 0; // Variabel untuk menghitung total entri

// Loop setiap entri dan tampilkan
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='entry'>";
    
    // Tampilkan nama (gunakan fallback jika nama tidak ada)
    echo "<strong>" . htmlspecialchars($row['nama'] ?? $row['name'] ?? 'Anonim') . "</strong>";

    // Tampilkan waktu entri jika ada
    if (!empty($row['created_at']) && $row['created_at'] != '0000-00-00 00:00:00') {
        echo "<small>Dikirim pada " . date("d-m-Y H:i", strtotime($row['created_at'])) . "</small>";
    }

    // Tampilkan isi pesan (dengan nl2br agar baris baru terlihat)
    echo "<p>" . nl2br(htmlspecialchars($row['pesan'] ?? $row['message'] ?? '')) . "</p>";
    echo "</div>";

    $total++; // Tambahkan total entri
}

// Tampilkan total jumlah entri
echo "<div class='total'>Total Entri Buku Tamu: $total</div>";
?>

<!-- Tombol kembali ke dashboard -->
<div class="center">
    <a href="index.php" class="back">Kembali ke Dashboard</a>
</div>

</body>
</html>
