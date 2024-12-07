<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Headline Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Event</h1>
        <?php
        include('config.php');

        $result = $mysqli->query("SELECT * FROM events ORDER BY event_date ASC");

        if ($result->num_rows > 0) {
            while ($event = $result->fetch_assoc()) {
                echo "<div class='event'>";
                echo "<h2>" . htmlspecialchars($event['event_title']) . "</h2>";
                echo "<p><strong>Tanggal:</strong> " . htmlspecialchars($event['event_date']) . "</p>";

                $pelukis = json_decode($event['pelukis'], true);
                echo "<p><strong>Pelukis:</strong> " . implode(", ", array_map('htmlspecialchars', $pelukis)) . "</p>";

                echo "<div class='event-actions'>";
                echo "<a href='detail_event.php?id=" . htmlspecialchars($event['id']) . "' class='button'>Lihat Detail</a> ";
                echo "<a href='delete_event.php?id=" . htmlspecialchars($event['id']) . "' class='button' onclick='return confirm(\"Yakin ingin menghapus event ini?\")'>Hapus</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Tidak ada event yang tersedia.</p>";
        }
        ?>
        <a href="create_event.php" class="button">Tambah Event Baru</a>
    </div>
    <footer>
        &copy; 2024 MeJatim. All rights reserved.
    </footer>
</body>
</html>
