<?php
require_once "database.php";
global $title;
$title="Opdrachten";
include_once "top.inc.php";

connect();
$result=zoekOpdrachten();
toonOpdrachten($result);
disconnect();

include_once "bottom.inc.php";
?>