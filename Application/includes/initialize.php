<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

/** MySQL database password */
define('DB_PASS', '2sJrDmQnhahzSCjM');

include_once 'functions.php';

if(isset($_SESSION["APP"]["room"])) {
	$room = new room($_SESSION["APP"]["room"]);
	$building = new building($room->getBuildingID());
	$_SESSION["APP"]["building"] = $building->getID();
	$_SESSION["APP"]["campus"] = $building->getCampusID();
}