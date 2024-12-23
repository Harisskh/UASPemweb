# Sistem Pendataan Mahasiswa MBKM/MSIB ITERA
Link Website : https://naufal122140040-intern.great-site.net

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

#### Bonus Hosting (20%)
1. Langkah-langkah Hosting Aplikasi Web di InfinityFree ✅
Berikut adalah langkah-langkah yang saya lakukan untuk meng-host aplikasi web saya menggunakan layanan InfinityFree:
- Mendaftar Akun: Saya membuat akun di InfinityFree.net menggunakan email pribadi.
- Membuat Domain/Subdomain: Saya memilih untuk menggunakan subdomain gratis yang disediakan oleh InfinityFree. Jika memiliki domain sendiri, bisa juga menghubungkannya melalui Nameserver.
Mengunggah File:
- Masuk ke File Manager atau menggunakan FTP Client seperti FileZilla.
- Mengunggah semua file aplikasi web (HTML, CSS, JavaScript, PHP) ke folder htdocs pada root direktori domain/subdomain.
Membuat Database:
- Mengakses panel hosting InfinityFree.
- Membuat database MySQL melalui menu “MySQL Databases”.
- Memperbarui file konfigurasi aplikasi web (misalnya, config.php) untuk menyambungkan aplikasi ke database tersebut.
- Pengujian: Saya memverifikasi apakah aplikasi web berjalan dengan benar melalui subdomain atau domain yang telah disiapkan.

2. Penyedia Hosting Web yang Dipilih ✅
- Saya memilih InfinityFree sebagai penyedia hosting web untuk aplikasi saya dengan alasan berikut: 
- Gratis: Tidak memerlukan biaya hosting. 
- Fitur Lengkap: Mendukung PHP, MySQL, dan penyimpanan hingga 5 GB. 
- Subdomain Gratis: Memudahkan pengguna tanpa domain sendiri. 
- No Ads: Layanan ini bebas iklan sehingga lebih profesional. 
Meskipun gratis, InfinityFree memiliki batasan seperti kecepatan akses dan tidak mendukung fitur email hosting, namun fitur dasarnya cukup untuk aplikasi web saya.

3. Keamanan Aplikasi Web ✅
Untuk memastikan keamanan aplikasi web yang saya host, langkah-langkah berikut diterapkan:
- Validasi Input: Semua input dari pengguna divalidasi dan disanitasi untuk mencegah serangan seperti SQL Injection dan XSS.
- HTTPS: Menggunakan sertifikat SSL gratis dari Let’s Encrypt yang disediakan oleh InfinityFree untuk mengamankan data saat transmisi.
- Proteksi Direktori: Menambahkan file .htaccess untuk melindungi direktori sensitif dan membatasi akses file tertentu.
- Backup Rutin: Melakukan backup data secara manual dari File Manager dan database MySQL untuk mengantisipasi kehilangan data.

4. Konfigurasi Server ✅
Saya menerapkan konfigurasi server berikut untuk mendukung aplikasi web:
- Versi PHP: Mengatur versi PHP ke yang kompatibel dengan aplikasi saya (InfinityFree menyediakan opsi pengaturan versi PHP). 
- Pengaturan Error: Mengaktifkan tampilan error selama pengembangan dan menonaktifkannya saat aplikasi live untuk alasan keamanan. 
- Rewrite Rules: Menggunakan file .htaccess untuk pengaturan URL rewriting agar URL lebih SEO-friendly dan mudah dibaca. 
- Database: Mengoptimalkan struktur tabel di MySQL agar query berjalan lebih cepat.

Dengan konfigurasi ini, aplikasi web saya dapat berjalan dengan lancar pada hosting gratis yang disediakan InfinityFree.



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
5. Akses melalui browser https://naufal122140040-intern.great-site.net
