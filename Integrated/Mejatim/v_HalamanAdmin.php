<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin MeJatim</title>
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
                <div class="col-md-6 text-right mt-3">
                    <span class="MeJatim_header"><b>Halo, Admin!</b></span>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!--Konten -->
    <div class="konten">
        <div class="begin">
            <div class="judul">
                <h3><b>Selamat Datang di Mejatim!</b></h3>
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
                    echo "<a href='v_EditLukisan.php?id=" . $result['id'] . "' class='text-right'>Edit</a>";
                    echo "<a href='v_HapusLukisan.php?id=" . $result['id'] . "' class='text-right'>Hapus</a>";
                    echo "</button>";
                    echo '</div>';
                }
            } else {
                echo "Belum ada lukisan tersedia";
            }
            ?>
        </div>

        <!-- Daftar Events -->
        <div class="container">
            <h4>Daftar Events</h4>
            <?php
            // Ambil data dari tabel events di Notes
            $events_result = $mysqli->query("SELECT event_title, event_date, pelukis FROM events ORDER BY event_date ASC");

            if ($events_result->num_rows > 0) {
                echo "<div class='events-container'>";
                while ($event = $events_result->fetch_assoc()) {
                    echo "<div class='event'>";
                    echo "<h3>" . htmlspecialchars($event['event_title']) . "</h3>";
                    echo "<p><strong>Tanggal:</strong> " . htmlspecialchars($event['event_date']) . "</p>";

                    $pelukis = json_decode($event['pelukis'], true);
                    echo "<p><strong>Pelukis:</strong> " . implode(", ", array_map('htmlspecialchars', $pelukis)) . "</p>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>Tidak ada events yang tersedia.</p>";
            }
            ?>
        </div>

        <!--Ini tambah-->
        <div class="add-button text-right">
            <button class="btn add-button" onclick="redirectToTambah()">
                <i class="bi-plus-circle-fill" style="font-size: 5rem; color:#052B4F;"></i>
            </button>
        </div>
        <script>
            function redirectToTambah() {
                window.location.href = 'v_TambahLukisan.php';
            }
        </script>
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