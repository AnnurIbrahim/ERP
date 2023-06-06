<?php
session_start();
session_destroy();

// Cache headers instellen om de pagina niet te cachen
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Doorverwijzen naar het inlogscherm
header("Location: Login.php");
exit();
?>