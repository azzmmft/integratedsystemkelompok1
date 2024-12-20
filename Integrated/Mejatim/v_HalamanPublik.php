<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Publik</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="hf.css">
    <link rel="stylesheet" href="v_halaman.css">
</head>

<body>
    <!--Header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="MeJatim_header"><b>MeJatim</b></h5>
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn login-btn" onclick="goToLogin()">Login Admin</button>
                </div>
            </div>
        </div>
    </header>

    <script>
        function goToLogin() {
            window.location.href = "v_HalamanLogin.php";
        }
    </script>

    <!--Konten -->
    <div class="konten">

        <div class="begin">
            <div class="judul">
                <h3><b>Selamat Datang di MeJatim!</b></h3>
            </div>

            <div class="deskripsi">
                <p>Galeri digital hasil karya lukis seniman Jawa Timur</p>
            </div>
        </div>

        <div class="deskripsi">
            <p><b>Koleksi Kami</b></p>
        </div>

        <div class="gallery">
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'mejatim');
            $tampil = mysqli_query($mysqli, "SELECT * FROM lukisan");

            if ($tampil->num_rows > 0) {
                while ($result = $tampil->fetch_assoc()) {
                    echo '<div class="gallery-item">';
                    echo '<button onclick="location.href=\'v_tampil_lukisan.php?id=' . ($result["id"]) . '\'">';
                    echo "<img src='" . ($result["direktori_file"]) . "' alt='" . ($result["nama_file"]) . "' width='210'>";
                    echo "<h6>" . $result['judul_lukisan'] . "</h6>";
                    echo "<p class='text-right'>Oleh " . $result['pelukis'] . "</p>";
                    echo "</button>";
                    echo '</div>';
                }
            } else {
                echo "Belum ada lukisan tersedia";
            }
            ?>
        </div>
    </div>

    

    <!--Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-left">
                    <h5 class="Mejatim_footer"><b>MeJatim</b></h5>
                </div>
                <div class="col-md-4 text-center">
                    <p class="copyright">&copy; MeJatim 2024</p>
                </div>
                <div class="social col-md-4 text-right">
                    <p class="sosmed">Media Sosial Kami</p>
                    <ul class="social-media list-inline">
                        <li class="list-inline-item"><a href="#"><i class="bi-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="bi-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>