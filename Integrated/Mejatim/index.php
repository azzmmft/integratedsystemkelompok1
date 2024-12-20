<?php //milih function di controller
include_once("c_meJatim.php");
$controller = new c_MeJatim();


if (isset($_POST['login'])) {
    $controller->login();
}

session_start();
$username = $_POST['admin'];
$password = $_POST['rahasia'];

// Contoh autentikasi sederhana
if ($username === 'admin' && $password === 'rahasia') {
    $_SESSION['logged_in'] = true;
    $_SESSION['last_activity'] = time(); // Set waktu login
    header("Location: v_HalamanAdmin.php");
    exit();
} else {
    // Kirim pesan error jika login gagal
    $_SESSION['error_message'] = "Username atau Password salah.";
    header("Location: v_HalamanLogin.php");
    exit();
}
?>
