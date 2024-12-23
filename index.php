<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Koneksi();
$conn = $db->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan MBKM/MSIB ITERA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --background-color: #f0f9ff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: var(--background-color);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo img {
            width: 80px;
            height: auto;
        }

        .title h1 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .title p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info span {
            color: #64748b;
        }

        .logout-btn {
            padding: 0.5rem 1rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .form-card {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .radio-group {
            display: flex;
            gap: 2rem;
            margin-top: 0.5rem;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: var(--secondary-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        tr:hover {
            background: #f8fafc;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .edit-btn {
            background: #0ea5e9;
        }

        .delete-btn {
            background: #ef4444;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <div class="logo">
                    <img src="bg.jpeg" alt="MBKM Logo">
                </div>
                <div class="title">
                    <h1>Pendataan MBKM/MSIB ITERA</h1>
                    <p>Sistem Informasi Mahasiswa Program MBKM dan MSIB</p>
                </div>
            </div>
            <div class="user-info">
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="success-message">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <div class="form-card">
            <form id="studentForm" action="process.php" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="nim">NIM:</label>
                    <input type="text" id="nim" name="nim" required>
                    <span id="nimError" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Lengkap:</label>
                    <input type="text" id="nama" name="nama" required>
                    <span id="namaError" class="error"></span>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin:</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="laki" name="gender" value="Laki-laki" required>
                            <label for="laki">Laki-laki</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="perempuan" name="gender" value="Perempuan">
                            <label for="perempuan">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prodi">Program Studi:</label>
                    <select id="prodi" name="prodi" required>
                        <option value="">Pilih Program Studi</option>
                        <option value="Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Komputer">Teknik Komputer</option>
                    </select>
                    <span id="prodiError" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="instansi">Instansi Magang/Studi:</label>
                    <input type="text" id="instansi" name="instansi" required>
                    <span id="instansiError" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <span id="emailError" class="error"></span>
                </div>

                <button type="submit" class="btn">Submit Data</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Program Studi</th>
                    <th>Instansi</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM mahasiswa ORDER BY nim DESC");
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($row['nim'])."</td>";
                    echo "<td>".htmlspecialchars($row['nama'])."</td>";
                    echo "<td>".htmlspecialchars($row['gender'])."</td>";
                    echo "<td>".htmlspecialchars($row['prodi'])."</td>";
                    echo "<td>".htmlspecialchars($row['instansi'])."</td>";
                    echo "<td>".htmlspecialchars($row['email'])."</td>";
                    echo "<td class='action-buttons'>
                            <a href='edit.php?nim=".htmlspecialchars($row['nim'])."' class='btn edit-btn'><i class='fas fa-edit'></i></a>
                            <a href='delete.php?nim=".htmlspecialchars($row['nim'])."' class='btn delete-btn' onclick='return confirm(\"Yakin ingin menghapus?\")'><i class='fas fa-trash'></i></a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function validateForm() {
            let isValid = true;
            const nim = document.getElementById('nim').value;
            const nama = document.getElementById('nama').value;
            const prodi = document.getElementById('prodi').value;
            const email = document.getElementById('email').value;
            const instansi = document.getElementById('instansi').value;

            // Reset error messages
            document.getElementById('nimError').textContent = '';
            document.getElementById('namaError').textContent = '';
            document.getElementById('prodiError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('instansiError').textContent = '';

            // NIM validation
            if(!/^\d{9}$/.test(nim)) {
                document.getElementById('nimError').textContent = 'NIM harus 9 digit angka';
                isValid = false;
            }

            // Nama validation
            if(nama.length < 3) {
                document.getElementById('namaError').textContent = 'Nama minimal 3 karakter';
                isValid = false;
            }

            // Prodi validation
            if(!prodi) {
                document.getElementById('prodiError').textContent = 'Pilih program studi';
                isValid = false;
            }

            // Instansi validation
            if(instansi.length < 3) {
                document.getElementById('instansiError').textContent = 'Nama instansi minimal 3 karakter';
                isValid = false;
            }

            // Email validation
            if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById('emailError').textContent = 'Format email tidak valid';
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>