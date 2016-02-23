<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

/** MySQL database password */
define('DB_PASS', '2sJrDmQnhahzSCjM');

include_once 'functions.php';