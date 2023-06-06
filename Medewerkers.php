<?php
require_once "database.php";
global $title;
$title="Medewerkers";
include_once "top.inc.php";

connect();
$result=zoekMedewerkers();
toonMedewerkers($result);
disconnect();

include_once "bottom.inc.php";
