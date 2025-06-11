<?php
// Hubungkan ke database
include '../config/db.php';

// Tambah user baru
if (isset($_POST['add'])) {
    $username = $_POST['username']; // Ambil username dari form
    $password = $_POST['password']; // Ambil password dari form
    $role = $_POST['role'];         // Ambil role dari form
    // Query insert ke tabel users
    mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')") or die('Gagal menambah user: ' . mysqli_error($conn));
}

// Hapus user berdasarkan ID
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // Ambil ID dari parameter URL
    // Query delete berdasarkan ID
    mysqli_query($conn, "DELETE FROM users WHERE id=$id") or die('Gagal menghapus user: ' . mysqli_error($conn));
}

// Update role user
if (isset($_POST['update_role'])) {
    $id = $_POST['user_id'];          // Ambil ID user dari form
    $new_role = $_POST['new_role'];  // Ambil role baru dari form
    // Query update role
    mysqli_query($conn, "UPDATE users SET role='$new_role' WHERE id=$id") or die('Gagal update role: ' . mysqli_error($conn));
}

// Update password user
if (isset($_POST['update_password'])) {
    $id = $_POST['user_id'];               // Ambil ID user dari form
    $new_password = $_POST['new_password']; // Ambil password baru dari form
    // Query update password
    mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE id=$id") or die('Gagal update password: ' . mysqli_error($conn));
}

// Ambil semua user dari database
$result = mysqli_query($conn, "SELECT * FROM users") or die('Gagal mengambil data: ' . mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manage User</title>
    <!-- Link ke file CSS eksternal -->
    <link rel="stylesheet" href="../assets/css/admin/manage_user.css">
</head>
<body>
    <h2>Manage User</h2>

    <!-- Tabel daftar user -->
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td class="aksi">
                    <!-- Tombol hapus user -->
                    <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>

                    <!-- Form untuk ubah role user -->
                    <form method="POST" class="form-inline">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <select name="new_role">
                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>user</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>admin</option>
                        </select>
                        <button type="submit" name="update_role">Ubah Role</button>
                    </form>

                    <!-- Form untuk ubah password user -->
                    <form method="POST" class="form-inline">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <input type="text" name="new_password" placeholder="New Password" required>
                        <button type="submit" name="update_password">Ganti Password</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Form tambah user baru -->
    <h3>Tambah User Baru</h3>
    <form method="POST" class="tambah-user">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role">
            <option value="user" selected>user</option>
            <option value="admin">admin</option>
        </select>
        <button type="submit" name="add">Tambah</button>
    </form>

    <br>
    <!-- Tombol kembali ke dashboard -->
    <a href="index.php" class="kembali">← Kembali</a>
</body>
</html>
