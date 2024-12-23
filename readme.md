# Sistem Pendataan Mahasiswa MBKM/MSIB ITERA

Sistem informasi berbasis web untuk mengelola data mahasiswa yang mengikuti program MBKM (Merdeka Belajar Kampus Merdeka) dan MSIB (Magang dan Studi Independen Bersertifikat) di Institut Teknologi Sumatera.

## Daftar Isi
- [Kriteria Penilaian](#kriteria-penilaian)
  - [1. Client-side Programming (30%)](#1-client-side-programming-30)
  - [2. Server-side Programming (30%)](#2-server-side-programming-30)
  - [3. Database Management (20%)](#3-database-management-20)
  - [4. State Management (20%)](#4-state-management-20)
- [Fitur](#fitur)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Struktur Project](#struktur-project)
- [Instalasi](#instalasi)

## Kriteria Penilaian

### 1. Client-side Programming (30%)

#### 1.1 Manipulasi DOM (15%)
- ✅ Implementasi form input dengan lebih dari 4 elemen:
  - Input text untuk NIM
  - Input text untuk Nama
  - Radio button untuk Gender
  - Select untuk Program Studi
  - Input text untuk Instansi
  - Input email untuk Email

- ✅ Menampilkan data dalam bentuk tabel dengan kolom:
  - NIM
  - Nama
  - Jenis Kelamin
  - Program Studi
  - Instansi
  - Email
  - Aksi (Edit/Delete)

#### 1.2 Event Handling (15%)
- ✅ Implementasi validasi form menggunakan JavaScript:
  - Validasi NIM (harus 9 digit)
  - Validasi nama (minimal 3 karakter)
  - Validasi email (format email valid)
  - Validasi instansi (minimal 3 karakter)
  - Konfirmasi sebelum menghapus data

### 2. Server-side Programming (30%)

#### 2.1 Form Processing (20%)
- ✅ Implementasi metode POST untuk pengiriman data
- ✅ Validasi server-side untuk semua input
- ✅ Penyimpanan informasi browser dan IP address pengguna
- ✅ Penggunaan prepared statements untuk query database

#### 2.2 OOP Implementation (10%)
- ✅ Class `Koneksi` untuk manajemen database:
  - Method constructor untuk inisialisasi koneksi
  - Method getConnection untuk mengakses koneksi

### 3. Database Management (20%)

#### 3.1 Database Creation (5%)
- ✅ Pembuatan database `student_db`
- ✅ Tabel `mahasiswa` dengan struktur:
  - nim (PRIMARY KEY)
  - nama
  - gender
  - prodi
  - instansi
  - email
  - browser_info
  - ip_address

#### 3.2 Database Connection (5%)
- ✅ Implementasi file konfigurasi database (config.php)
- ✅ Penggunaan konstanta untuk kredensial database
- ✅ Error handling untuk koneksi database

#### 3.3 Data Manipulation (10%)
- ✅ Implementasi operasi CRUD:
  - Create: Menambah data mahasiswa baru
  - Read: Menampilkan data mahasiswa
  - Update: Mengubah data mahasiswa
  - Delete: Menghapus data mahasiswa

### 4. State Management (20%)

#### 4.1 Session Management (10%)
- ✅ Implementasi sistem login
- ✅ Proteksi halaman dengan pengecekan session
- ✅ Penyimpanan data user dalam session
- ✅ Pengelolaan logout dan destroy session

#### 4.2 Cookie & Storage (10%)
- ✅ Implementasi cookie untuk last submission time
- ✅ Validasi form menggunakan browser storage
- ✅ Pengelolaan state pada client-side

## Fitur
- Login dan Register User
- CRUD Data Mahasiswa
- Validasi Form (Client & Server side)
- Session Management
- Responsive Design

## Teknologi yang Digunakan
- PHP 7.4
- MySQL/MariaDB
- HTML5
- CSS3
- JavaScript
- Font Awesome Icons
- Modern UI Design dengan CSS Custom Properties

## Struktur Project
```
├── config.php          # Konfigurasi database
├── index.php          # Halaman utama & form input
├── login.php          # Halaman login
├── register.php       # Halaman register
├── process.php        # Pemrosesan form
├── edit.php           # Edit data mahasiswa
├── delete.php         # Hapus data mahasiswa
└── logout.php         # Proses logout
```

## Instalasi
1. Clone repository ini
2. Import database dari file `database.sql`
3. Konfigurasi database di `config.php`
4. Jalankan di web server (Apache/Nginx)
5. Akses melalui browser