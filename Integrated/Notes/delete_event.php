<?php
include('config.php');
$id = intval($_GET['id']);

if ($mysqli->query("DELETE FROM events WHERE id = $id")) {
    header("Location: index.php");
} else {
    echo "Gagal menghapus event.";
}
?>
