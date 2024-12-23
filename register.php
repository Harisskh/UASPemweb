<?php
session_start();
require_once 'config.php';

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Koneksi();
    $conn = $db->getConnection();
    
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = 'user'; // Default role
    
    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM tbl_akun WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $stmt = $conn->prepare("INSERT INTO tbl_akun (email, username, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $username, $password, $role);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Registrasi berhasil! Silakan login.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Terjadi kesalahan! Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - MBKM/MSIB ITERA</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            position: relative;
            overflow: hidden;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo img {
            width: 120px;
            height: auto;
        }

        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }
        input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: var(--secondary-color);
        }

        .links {
            text-align: center;
            margin-top: 1.5rem;
        }

        .links a {
            color: var(--accent-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .error {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .password-requirements {
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 0.5rem;
            padding-left: 0.5rem;
        }

        .requirement {
            margin: 0.25rem 0;
        }

        .requirement i {
            margin-right: 0.5rem;
            marggin-bottom: 5px;
            font-size: 0.7rem;
        }

        .valid {
            color: #22c55e;
        }

        .invalid {
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://theme.zdassets.com/theme_assets/11435355/bceff9063d378e3cb6db2a82dec7685679d18255.png" alt="MBKM Logo">
        </div>
        <h2>Daftar MBKM/MSIB ITERA</h2>
        
        <?php if(isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="" id="registerForm">
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <i id="lock" class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <div class="password-requirements">
                    <div class="requirement" id="length"></i>Minimal 8 karakter, 1 angka, dan 1 huruf Kapital</div>
                </div>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>
        
        <div class="links">
            <a href="login.php">Sudah punya akun? Login disini</a>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const requirements = {
            length: document.getElementById('length'),
            number: document.getElementById('number'),
            uppercase: document.getElementById('uppercase')
        };

        password.addEventListener('input', () => {
            const value = password.value;
            
            // Check length
            if (value.length >= 8) {
                requirements.length.classList.add('valid');
                requirements.length.classList.remove('invalid');
            } else {
                requirements.length.classList.remove('valid');
                requirements.length.classList.add('invalid');
            }
            
            // Check number
            if (/\d/.test(value)) {
                requirements.number.classList.add('valid');
                requirements.number.classList.remove('invalid');
            } else {
                requirements.number.classList.remove('valid');
                requirements.number.classList.add('invalid');
            }
            
            // Check uppercase
            if (/[A-Z]/.test(value)) {
                requirements.uppercase.classList.add('valid');
                requirements.uppercase.classList.remove('invalid');
            } else {
                requirements.uppercase.classList.remove('valid');
                requirements.uppercase.classList.add('invalid');
            }
        });
    </script>
</body>
</html>