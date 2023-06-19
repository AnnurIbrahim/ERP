<?php
require_once "database.php";
global $title;
$title="Rooster";
include_once "top.inc.php";

connect();
$result=zoekRooster();
toonRooster($result);
disconnect();

include_once "bottom.inc.php";