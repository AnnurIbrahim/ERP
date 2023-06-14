<?php
require_once "database.php";
global $title;
$title="Acceptatietesten";
include_once "top.inc.php";

connect();
$result=laadAcceptatietesten();
toonAcceptatietesten($result);
disconnect();

include_once "bottom.inc.php";