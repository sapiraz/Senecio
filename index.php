<?php
/* Copyright Senecio 2013 */
/* Code by Raz Sapir */

require_once("system/startup.php");
$site = new Site();

$site->action("general/home");
//$site->action("general/page");
$site->render();



?>