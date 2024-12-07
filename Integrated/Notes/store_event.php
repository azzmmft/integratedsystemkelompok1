<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $mysqli->real_escape_string($_POST['title']);
    $date = $mysqli->real_escape_string($_POST['date']);
    $pelukis = json_encode($_POST['pelukis']); // Simpan dalam format JSON

    $stmt = $mysqli->prepare("INSERT INTO events (event_title, event_date, pelukis) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $date, $pelukis);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
