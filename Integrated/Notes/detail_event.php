<?php
include('config.php');
$id = intval($_GET['id']);
$event = $mysqli->query("SELECT * FROM events WHERE id = $id")->fetch_assoc();

if (!$event) {
    echo "Event tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($event['event_title']) ?></h1>
        <p><strong>Tanggal:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
        <p><strong>Pelukis:</strong> <?= implode(", ", array_map('htmlspecialchars', json_decode($event['pelukis'], true))) ?></p>
        <a href="index.php" class="button">Kembali ke Daftar Event</a>
    </div>
</body>
</html>
