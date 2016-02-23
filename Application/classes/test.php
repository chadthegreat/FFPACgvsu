<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2/23/16
 * Time: 11:08 AM
 */

define('DB_NAME', 'ffpac');

/** MySQL database username */
define('DB_USER', 'ffpac');

/** MySQL database password */
define('DB_PASS', '2sJrDmQnhahzSCjM');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

include_once "DBCon.php";
include_once "BaseDB.php";
include_once "ArrayClass.php";
include_once "room.php";
//$GLOBALS["DB_ADAPTER"]["_dbAdapter"] = new DBCon();
//$room = new roomArray();
//$room->load();
//echo "<pre>";
//print_r($room->getArray());
//echo "</pre>";

function test_function() {
	echo "test_function()";
}
$var = "test_function";
$var();