<?php
// Mulai session agar bisa akses data user yang login
session_start();

// Include file koneksi database
include '../config/db.php';

// Ambil parameter 'id' dari URL (GET request)
$id = $_GET['id'];

// Hapus data dari tabel guestbook_entries berdasarkan id
mysqli_query($conn, "DELETE FROM guestbook_entries WHERE id='$id'");

// Setelah penghapusan, redirect kembali ke halaman isi_buku_tamu.php
header("Location: isi_buku_tamu.php");
exit;
?>
