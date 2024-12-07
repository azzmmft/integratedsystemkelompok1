<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Lukisan</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="hf.css">
        <link rel="stylesheet" href="v_edit.css">
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
                    <button class="btn btn-outline-light profile-button">
                        <i class="bi-person-circle"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="konten text-center">

        <div class="judul">
            <h5><b>Yuk, Tambah Lukisan!</b></h5> 
        </div>

        <div class="formulir">
            <form action="" method="post" name="tLukisan" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="judulLukisan">Judul Lukisan</label>
                    <input type="text" name="judulLukisan" id="judulLukisan" required>
                </div>

                <div class="form-group">
                    <label for="pelukis">Nama Pelukis</label>
                    <input type="text" name="namaPelukis"  id="pelukis" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Karya</label>
                    <input type="text" name="deskripsiKarya" id="deskripsi" required>
                </div>

                <div class="form-file text-center">
                    <label for="addGambar" class="addGambar">Tambah Foto</label><br>
                    <input type="file" name="addGambar" id="addGambar" required>
                </div>

                <input class="tombol" type="submit" name="tLukisan" value="Tambah">

            </form>
        </div>

    </div>   

        <?php
            include_once("c_Mejatim.php");

            if(isset($_POST['tLukisan'])) {
                $main = new c_Mejatim();
                $main->add_lukisan();
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
