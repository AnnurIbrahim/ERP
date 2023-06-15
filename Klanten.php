<?php
require_once "database.php";
global $title;
$title="Klanten";
include_once "top.inc.php";

connect();
$result=zoekKlanten();
toonKlanten($result);
disconnect();

include_once "bottom.inc.php";
