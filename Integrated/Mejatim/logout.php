<?php
session_start();
session_unset();
session_destroy();
header("Location: v_HalamanLogin.php?logout=1");
exit();
?>
