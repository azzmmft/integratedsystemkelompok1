<?php
session_start();

// Inisialisasi sesi jika belum ada
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = 0;
}

$lockout_duration = 60; // Lockout 1 menit dalam detik
$max_attempts = 3; // Maksimal percobaan gagal
$current_time = time(); // Waktu sekarang

$locked = false; // Status akun terkunci

// Reset percobaan jika masa kunci telah habis
if ($_SESSION['lockout_time'] > 0 && $_SESSION['lockout_time'] <= $current_time) {
    $_SESSION['login_attempts'] = 0; // Reset percobaan
    $_SESSION['lockout_time'] = 0;   // Reset waktu kunci
    $locked = false;
}

// Cek apakah dalam masa lockout
if ($_SESSION['lockout_time'] > $current_time) {
    $remaining_time = $_SESSION['lockout_time'] - $current_time;
    $locked = true; // Status terkunci
    $_SESSION['error_message'] = "Akun terkunci. Coba lagi dalam $remaining_time detik.";
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simulasi validasi 
    $valid_username = "admin";
    $valid_password = "rahasia";

    if ($username === $valid_username && $password === $valid_password) {
        // Reset jika berhasil login
        $_SESSION['login_attempts'] = 0;
        $_SESSION['lockout_time'] = 0;
        header("Location: v_HalamanAdmin.php"); // Redirect ke admin
        exit;
    } else {
        $_SESSION['login_attempts']++;

        if ($_SESSION['login_attempts'] >= $max_attempts) {
            $_SESSION['lockout_time'] = $current_time + $lockout_duration; // Set waktu kunci
            $_SESSION['error_message'] = "Terlalu banyak percobaan gagal. Akun terkunci selama $lockout_duration detik.";
            $locked = true;
        } else {
            $remaining_attempts = $max_attempts - $_SESSION['login_attempts'];
            $_SESSION['error_message'] = "Username atau password salah. $remaining_attempts sisa percobaan lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin MeJatim</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const remainingTime = <?= isset($remaining_time) ? $remaining_time : 0 ?>;
            const loginButton = document.getElementById('loginButton');

            if (remainingTime > 0) {
                loginButton.disabled = true; // Nonaktifkan tombol login
                let countdown = remainingTime;

                const interval = setInterval(() => {
                    loginButton.textContent = `Login (${countdown}s)`;
                    countdown--;

                    if (countdown <= 0) {
                        clearInterval(interval);
                        loginButton.disabled = false; // Aktifkan tombol login
                        loginButton.textContent = "Login";
                    }
                }, 1000);
            }
        });
    </script>
</head>

<body class="bg-gray-200">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md bg-white p-8 shadow-lg rounded-lg w-full">
            <div class="font-bold mb-2 text-center text-lg" style="font-family: Poppins, sans-serif;">Login Admin MeJatim</div>
            
            <!-- Menampilkan pesan error -->
            <?php
                if (isset($_SESSION['error_message'])) {
                    echo "<div class='mb-4 p-3 bg-red-100 text-red-700 rounded' style='font-family: Poppins, sans-serif;'>".$_SESSION['error_message']."</div>";
                    unset($_SESSION['error_message']); // Hapus pesan error setelah ditampilkan
                }
            ?>

            <!-- Form Login -->
            <form id="loginForm" class="space-y-4" method="post" enctype="multipart/form-data" action="">
                <div>
                    <label for="username" class="block mb-1" style="font-family: Poppins, sans-serif;">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" style="font-family: Poppins, sans-serif;" required <?php if ($locked) echo 'disabled'; ?> />
                </div>
                <div>
                    <label for="password" class="block mb-1" style="font-family: Poppins, sans-serif;">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" style="font-family: Poppins, sans-serif;" required <?php if ($locked) echo 'disabled'; ?> />
                </div>

                <div class="g-recaptcha" data-sitekey="6Lfm7JAqAAAAAOLFMM8L9aQrGPJSBQm2bR8N2stV"></div>
                <button type="submit" id="loginButton" class="bg-blue-900 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600" style="font-family: Poppins, sans-serif;" <?php if ($locked) echo 'disabled'; ?>>
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
