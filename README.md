# 💍 LoveNote 💍 – Media Latihan Penetration Testing

**LoveNote** adalah aplikasi **buku tamu digital berbasis web** bertema pernikahan yang dikembangkan sebagai **media latihan penetration testing** dan **ethical hacking**. Website ini tidak hanya menampilkan fitur standar aplikasi web (login, register, form input, dan upload file), tetapi juga **secara sengaja mengandung celah keamanan umum** untuk tujuan edukasi.

> 🎓 Proyek ini dikembangkan selama masa magang di **PT. Siber Sekuriti Indonesia**, sebagai bagian dari program pembelajaran penetration testing dan keamanan aplikasi web.

---

## 🎯 Tujuan Proyek

LoveNote **bukan untuk penggunaan produksi nyata**, melainkan dirancang untuk:

- Latihan eksploitasi celah keamanan web
- Demonstrasi simulasi serangan seperti XSS, SQL Injection, dan File Upload Bypass

Aplikasi ini cocok untuk digunakan di **localhost** atau lab virtual (seperti VirtualBox + Kali Linux) sebagai **target simulasi pentest**.

---

## 🧪 Contoh Celah yang Disisipkan

| Jenis Celah           | Deskripsi Singkat |
|-----------------------|-------------------|
| 🔓 SQL Injection      | form login rentan terhadap injeksi SQL |
| 🖼️ File Upload Bypass | Tidak ada validasi MIME-type/file extension |
| 🐛 Stored XSS         | Input pesan tamu langsung ditampilkan tanpa disanitasi |


---

## 👥 Akun Login Default

### 🔐 Admin
- **Username:** `admin`
- **Password:** `admin123`

### 👤 User
- **Username:** `chiefrr` &nbsp;|&nbsp; **Password:** `chiefrr`  
- **Username:** `nadilluv` &nbsp;|&nbsp; **Password:** `nadilluv`

---

## 📝 Fitur Aplikasi

### Untuk Pengguna (User)
- ✅ Register akun beserta upload foto
- ✅ Login & Logout
- ✅ Tulis, edit, dan hapus pesan di buku tamu
- ✅ Edit profil dan ubah password
- ✅ Lihat daftar pesan dari tamu lain

### Untuk Admin
- 🔐 Login khusus admin
- 🧾 Dashboard untuk kelola data user & pesan
- ✍️ Tambah, edit, dan hapus pengguna
- 🧑‍⚖️ Ubah peran user (admin/user)
- 🧹 Moderasi atau hapus pesan tidak sesuai

---

## 🚀 Cara Instalasi & Menjalankan

### 1. Clone Repositori
```bash
git clone https://github.com/username/love-note.git
cd love-note
