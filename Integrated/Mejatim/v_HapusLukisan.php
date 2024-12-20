<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Lukisan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="hf.css">
    <link rel="stylesheet" href="v_hapus.css">
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

    <!--konten-->
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'mejatim');

        $id = $_GET['id'];
        $tampil = mysqli_query($mysqli, "SELECT * FROM lukisan where id=$id");
        $row = mysqli_fetch_assoc($tampil);

    ?>

    <div class="konten text-center">
        <h1>Cek Lukisan Anda</h1>
        <p>Lukisan yang dihapus tidak dapat dikembalikan, pastikan lukisan benar</p><br>
        <div class="infoLukisan">
        <h2><?php echo $row['judul_lukisan']; ?></h2>
        <p>Pelukis: <?php echo $row['pelukis']; ?></p>
        <form action="" method="post" name="hLukisan">
        <?php echo "<img src='" . ($row["direktori_file"]) . "' alt='" . ($row["nama_file"]) . "' width='500'>";?> <br>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"><br>
            <input class="tombol" type="submit" name="hLukisan" value="Hapus">
        </form>
        </div>
        
    </div>

    
    <?php
        include_once("c_mejatim.php");

        if(isset($_POST['hLukisan'])) {
            $main = new c_mejatim();
            $main->hapus_lukisan();
        }
    ?>

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
