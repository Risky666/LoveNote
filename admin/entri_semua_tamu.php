<?php
// Menghubungkan ke database
include '../config/db.php';

// Jika parameter GET 'hapus' ada, maka hapus data berdasarkan ID
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM guestbook_entries WHERE id=$id");
}

// Jika tombol edit ditekan, lakukan update data berdasarkan ID
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['name'];
    $pesan = $_POST['message'];
    mysqli_query($conn, "UPDATE guestbook_entries SET nama='$nama', pesan='$pesan' WHERE id=$id");
}

// Ambil semua data dari tabel guestbook_entries
$result = mysqli_query($conn, "SELECT * FROM guestbook_entries");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku Tamu</title>
    <style>
    /* CSS*/
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

    /* Reset dan styling dasar */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        padding: 30px;
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: var(--primary-color);
        font-weight: 700;
    }

    /* Tabel dan tampilan responsif */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    th, td {
        padding: 14px 18px;
        text-align: left;
    }

    th {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        font-size: 16px;
    }

    tr {
        background-color: var(--card-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    tr:hover {
        background-color: var(--primary-hover);
    }

    input[type="text"] {
        width: 100%;
        padding: 10px 12px;
        background-color: #3b556e;
        color: var(--text-color);
        border: 1px solid #5a6b7c;
    }

    input[type="text"]:focus {
        border-color: var(--primary-color);
        background-color: #2f455a;
    }

    .action-cell {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    /* Link tombol */
    a {
        padding: 8px 15px;
        text-decoration: none;
        border-radius: var(--border-radius);
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        transition: background-color var(--transition-speed);
    }

    a:hover {
        background-color: var(--primary-hover);
    }

    a[href*="hapus"] {
        background-color: var(--danger-color);
    }

    a[href*="hapus"]:hover {
        background-color: var(--danger-hover);
    }

    /* Tombol kembali */
    a.kembali {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 30px;
        background-color: var(--primary-color);
        font-size: 16px;
        font-weight: 700;
    }

    a.kembali:hover {
        background-color: var(--primary-hover);
    }

    /* Responsif untuk mobile */
    @media (max-width: 600px) {
        table, th, td {
            font-size: 14px;
        }

        .action-cell {
            flex-direction: column;
            gap: 6px;
        }
    }
    </style>
</head>
<body>
    <h2>Data Buku Tamu</h2>

    <!-- Tabel data buku tamu -->
    <table>
        <tr>
            <th>Nama</th>
            <th>Pesan</th>
            <th>Aksi</th>
        </tr>

        <!-- Loop setiap entri dan tampilkan dalam form -->
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <form method="POST">
                    <td>
                        <!-- Edit nama -->
                        <input type="text" name="name" value="<?= htmlspecialchars($row['nama']) ?>">
                    </td>
                    <td>
                        <!-- Edit pesan -->
                        <input type="text" name="message" value="<?= htmlspecialchars($row['pesan']) ?>">
                    </td>
                    <td class="action-cell">
                        <!-- Simpan ID tersembunyi -->
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                        <!-- Tombol edit: sebaiknya ini diganti jadi tombol submit -->
                        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>

                        <!-- Tombol hapus -->
                        <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                    </td>
                </form>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Tombol kembali ke halaman dashboard -->
    <a href="index.php" class="kembali">Kembali</a>
</body>
</html>
