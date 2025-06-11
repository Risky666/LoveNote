<?php
// Mulai session untuk melacak login user
session_start();

// Cek apakah user sudah login dan role-nya 'user'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    // Jika belum login atau role bukan 'user', redirect ke halaman login
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <style>
/* Global body styling */
body {
    margin: 0;
    font-family: 'Playfair Display', 'Segoe UI', Tahoma, sans-serif;
    display: flex;
    min-height: 100vh;
    flex-direction: column;
    background-color: #fdfcf8; /* ivory */
    color: #2e2e2e;
    position: relative;
    overflow: hidden;
}

/* Background sparkle lembut */
body::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 200%;
    height: 200%;
    background-image: radial-gradient(#e6c96b 1px, transparent 1px),
                      radial-gradient(#daa520 1px, transparent 1px);
    background-size: 100px 100px;
    opacity: 0.06;
    z-index: 0;
    animation: sparkleFlow 60s linear infinite;
}

@keyframes sparkleFlow {
    0% { transform: translate(0, 0); }
    100% { transform: translate(-100px, -100px); }
}

/* Container utama */
.container {
    display: flex;
    flex: 1;
    position: relative;
    z-index: 1;
}

/* Sidebar navigasi */
.sidebar {
    width: 240px;
    background-color: #78866b; /* sage green tua */
    color: white;
    display: flex;
    flex-direction: column;
    padding: 25px 20px;
    box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
    border-right: 3px solid #daa520;
}

/* Judul sidebar */
.sidebar h2 {
    margin-top: 0;
    font-size: 22px;
    color: #fff2d3;
    text-align: center;
    margin-bottom: 30px;
}

/* Link menu sidebar */
.sidebar a {
    color: #fff8dc;
    text-decoration: none;
    padding: 12px 16px;
    margin: 5px 0;
    border-radius: 6px;
    transition: background 0.2s, color 0.2s, transform 0.2s;
    font-weight: 600;
}

.sidebar a:hover {
    background-color: #daa520;
    color: #2e2e2e;
    transform: translateX(5px);
}

/* Konten utama */
.content {
    flex: 1;
    padding: 50px;
    background-color: #ffffff;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
    border-left: 1px solid #ddd;
    position: relative;
    z-index: 1;
}

/* Judul */
.content h1 {
    margin-top: 0;
    color: #78866b;
    font-size: 2rem;
    animation: fadeInUp 1.2s ease-in;
}

/* Deskripsi */
.content p {
    font-size: 16px;
    color: #555;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        flex-direction: row;
        overflow-x: auto;
        padding: 10px;
        justify-content: center;
    }

    .sidebar h2 {
        display: none;
    }

    .sidebar a {
        margin: 0 10px;
        padding: 10px 15px;
        white-space: nowrap;
        font-size: 14px;
    }

    .content {
        padding: 24px;
    }
}

    </style>
</head>
<body>

<!-- Struktur halaman -->
<div class="container">
    <!-- Sidebar navigasi -->
    <div class="sidebar">
        <h2>👤 User Panel</h2> <!-- Icon dan nama panel -->
        <a href="profile.php">Profil</a> <!-- Link ke halaman profil user -->
        <a href="entri.php">Tulis Pesan</a> <!-- Link untuk menulis ucapan -->
        <a href="isi_buku_tamu.php">Ucapanku</a> <!-- Link melihat ucapan pribadi -->
        <a href="lihat_semua_ucapan.php">Lihat Semua Ucapan</a> <!-- Link melihat semua ucapan -->
        <a href="logout.php">Logout</a> <!-- Link untuk logout -->
    </div>

    <!-- Area konten utama -->
    <div class="content">
        <h1>Selamat datang di Dashboard User!</h1> <!-- Judul dashboard -->
        <p>Silakan gunakan menu di atas untuk mengakses fitur-fitur yang tersedia.</p>
    </div>
</div>

</body>
</html>
