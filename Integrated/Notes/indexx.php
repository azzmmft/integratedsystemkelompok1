<?php
$mysqli = new mysqli('localhost', 'root', '', 'mejatim');

// Ambil semua data event
$result = $mysqli->query("SELECT * FROM events");

if ($result->num_rows > 0) {
    while ($event = $result->fetch_assoc()) {
        echo "<div class='event'>";
        echo "<h3>" . $event['event_title'] . "</h3>";
        echo "<p><strong>Tanggal:</strong> " . $event['event_date'] . "</p>";
        echo "<p><strong>Pelukis:</strong> " . implode(", ", json_decode($event['pelukis'], true)) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>Belum ada event tersedia.</p>";
}
?>
