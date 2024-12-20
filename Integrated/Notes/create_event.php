<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Event Baru</h1>
        <form action="store_event.php" method="POST">
            <label for="title">Judul Event:</label>
            <input type="text" name="title" id="title" required><br><br>

            <label for="date">Tanggal Event:</label>
            <input type="date" name="date" id="date" required><br><br>

            <label for="pelukis">Pilih Pelukis:</label>
            <select name="pelukis[]" id="pelukis" multiple required>
                <?php
                include('config.php');
                $result = $mysqli->query("SELECT DISTINCT pelukis FROM lukisan");

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['pelukis']) . "'>" . htmlspecialchars($row['pelukis']) . "</option>";
                }
                ?>
            </select><br><br>

            <button type="submit">Simpan Event</button>
        </form>
    </div>
</body>
</html>
