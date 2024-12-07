<?php
$mysqli = new mysqli('localhost', 'root', '', 'mejatim');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
