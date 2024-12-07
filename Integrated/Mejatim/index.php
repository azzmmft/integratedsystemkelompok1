<?php //milih function di controller
include_once("c_meJatim.php");
$controller = new c_MeJatim();


if (isset($_POST['login'])) {
    $controller->login();
}