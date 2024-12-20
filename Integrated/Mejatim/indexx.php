<?php
$mysqli = new mysqli('localhost', 'root', '', 'mejatim');

// Ambil semua data lukisan
$result = $mysqli->query("SELECT * FROM lukisan");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='lukisan'>";
        echo "<img src='" . $row['direktori_file'] . "' alt='" . $row['judul_lukisan'] . "'>";
        echo "<h3>" . $row['judul_lukisan'] . "</h3>";
        echo "<p>Oleh: " . $row['pelukis'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>Belum ada lukisan tersedia.</p>";
}
?>