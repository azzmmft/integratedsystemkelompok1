<?php //ini isinya function
include_once("m_admin.php");
session_start();

class c_MeJatim {
    public $model;

    public function __construct(){
        $this->model = new m_admin();
    }

    function login() {
        if ($_POST['username'] == 'admin' && $_POST['password'] == 'rahasia') {
            $_SESSION['username'] = 'admin';
            $_SESSION['role'] = 'admin';     
            $data = $this->model->selectAll();
            include "v_HalamanAdmin.php";
        } else {
            $_SESSION['error_message'] = "Username atau password salah! Coba isikan kembali dengan benar.";
            header('Location:v_HalamanLogin.php');
            exit();
        }
    }

    function add_lukisan() {
        $judul = $_POST ['judulLukisan'];
        $pelukis = $_POST['namaPelukis'];
        $deskripsi = $_POST['deskripsiKarya'];
        $foto = $_POST['addGambar'];

        if(isset($_FILES['addGambar'])) {
            $fileName = $_FILES['addGambar'] ['name'];
            $fileTmpName = $_FILES['addGambar']['tmp_name'];

            $fileDestination = 'uploads/' . uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            move_uploaded_file($fileTmpName, $fileDestination);
        }

        $insert = $this->model->tambahLukisan($judul, $pelukis, $deskripsi, $fileName, $fileDestination);
        header("location:v_HalamanAdmin.php"); 
    }
    function edit_lukisan() {
        // Ambil data dari form
        $id = $_POST['id'];
        $judul = $_POST['judulLukisan'];
        $pelukis = $_POST['namaPelukis'];
        $deskripsi = $_POST['deskripsiKarya'];
    
        // Cek apakah file gambar baru diunggah
        $fileName = null; // Inisialisasi variabel untuk mencegah undefined
        $fileDestination = null;
    
        if (isset($_FILES['addGambar']) && $_FILES['addGambar']['error'] === UPLOAD_ERR_OK) {
            // Ambil informasi file
            $fileName = $_FILES['addGambar']['name'];
            $fileTmpName = $_FILES['addGambar']['tmp_name'];
            $fileSize = $_FILES['addGambar']['size'];
            $fileError = $_FILES['addGambar']['error'];
            $fileType = $_FILES['addGambar']['type'];
    
            // Validasi ekstensi file
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
            if (in_array($fileExt, $allowed)) {
                // Generate nama file unik
                $uniqueFileName = uniqid('', true) . '.' . $fileExt;
                $fileDestination = 'uploads/' . $uniqueFileName;
    
                // Pindahkan file ke folder tujuan
                if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                    die("Error: Gagal mengunggah file.");
                }
            } else {
                die("Error: Format file tidak diizinkan. Hanya jpg, jpeg, png, atau gif.");
            }
        }
    
        // Update data menggunakan model
        $update = $this->model->editLukisan($id, $judul, $pelukis, $deskripsi, $fileName, $fileDestination);
    
        // Redirect ke halaman admin
        if ($update) {
            header("Location: v_HalamanAdmin.php?status=success");
            exit();
        } else {
            header("Location: v_HalamanAdmin.php?status=failed");
            exit();
        }
    }
    // function edit_lukisan() {
    //     $id = $_POST ['id'];
    //     $judul = $_POST ['judulLukisan'];
    //     $pelukis = $_POST['namaPelukis'];
    //     $deskripsi = $_POST['deskripsiKarya'];
    //     $foto = $_POST['addGambar'];

    //     if(isset($_FILES['addGambar'])) {
    //         $fileName = $_FILES['addGambar'] ['name'];
    //         $fileTmpName = $_FILES['addGambar']['tmp_name'];

    //         $fileDestination = 'uploads/' . uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
    //         move_uploaded_file($fileTmpName, $fileDestination);
    //     }

    //     $update = $this->model->editLukisan($id, $judul, $pelukis, $deskripsi, $fileName, $fileDestination);
    //     header("location:v_HalamanAdmin.php"); 
    // }

    function tampilkan_lukisan() {
        $result = $this->model->selectAll();
        header("location:v_HalamanPublik.php"); 
    }

    function hapus_lukisan() {
        $id = $_POST ['id'];
        $result = $this->model->deleteProgram($id);
        header("location:v_HalamanAdmin.php"); 
    }
}
?>

