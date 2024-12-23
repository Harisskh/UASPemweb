<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Koneksi();
$conn = $db->getConnection();

if(isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $result = $conn->query("SELECT * FROM mahasiswa WHERE nim = '$nim'");
    $data = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $prodi = $_POST['prodi'];
    $instansi = $_POST['instansi'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, gender=?, prodi=?, instansi=?, email=? WHERE nim=?");
    $stmt->bind_param("ssssss", $nama, $gender, $prodi, $instansi, $email, $nim);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Data berhasil diupdate";
        header("Location: index.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa - MBKM/MSIB ITERA</title>
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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .header img {
            width: 80px;
            height: auto;
            margin-right: 1rem;
        }

        h2 {
            color: var(--primary-color);
            font-size: 1.5rem;
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

        input[type="text"]:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
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
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: var(--secondary-color);
        }

        .btn-secondary {
            background: #64748b;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 1.5rem;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Mahasiswa
        </a>

        <div class="header">
            <img src="https://theme.zdassets.com/theme_assets/11435355/bceff9063d378e3cb6db2a82dec7685679d18255.png" alt="MBKM Logo">
            <h2>Edit Data Mahasiswa MBKM/MSIB</h2>
        </div>

        <?php if(isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="edit.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="nim" value="<?php echo htmlspecialchars($data['nim']); ?>">
            
            <div class="form-group">
                <label>NIM:</label>
                <input type="text" value="<?php echo htmlspecialchars($data['nim']); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                <span id="namaError" class="error"></span>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="laki" name="gender" value="Laki-laki" <?php if($data['gender'] == 'Laki-laki') echo 'checked'; ?> required>
                        <label for="laki">Laki-laki</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="perempuan" name="gender" value="Perempuan" <?php if($data['gender'] == 'Perempuan') echo 'checked'; ?>>
                        <label for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="prodi">Program Studi:</label>
                <select id="prodi" name="prodi" required>
                    <option value="">Pilih Program Studi</option>
                    <option value="Informatika" <?php if($data['prodi']=='Informatika') echo 'selected'; ?>>Teknik Informatika</option>
                    <option value="Sistem Informasi" <?php if($data['prodi']=='Sistem Informasi') echo 'selected'; ?>>Sistem Informasi</option>
                    <option value="Teknik Komputer" <?php if($data['prodi']=='Teknik Komputer') echo 'selected'; ?>>Teknik Komputer</option>
                </select>
                <span id="prodiError" class="error"></span>
            </div>

            <div class="form-group">
                <label for="instansi">Instansi Magang/Studi:</label>
                <input type="text" id="instansi" name="instansi" value="<?php echo htmlspecialchars($data['instansi']); ?>" required>
                <span id="instansiError" class="error"></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                <span id="emailError" class="error"></span>
            </div>

            <div class="button-group">
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            let isValid = true;
            const nama = document.getElementById('nama').value;
            const prodi = document.getElementById('prodi').value;
            const email = document.getElementById('email').value;
            const instansi = document.getElementById('instansi').value;

            // Reset error messages
            document.getElementById('namaError').textContent = '';
            document.getElementById('prodiError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('instansiError').textContent = '';

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