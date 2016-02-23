<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2/23/16
 * Time: 12:40 PM
 */
define ('APP_PATH', dirname(dirname(__FILE__)) . '/');
include_once dirname(APP_PATH) . '/wp-config.php';
include_once APP_PATH . 'includes/initialize.php';

function getCampuss() {
	$campuss = new campusArray();
	$campuss->load();
	return json_encode($campuss->toOptionList());
}

function getBuildings($campus = null) {
	if($campus == null) echo json_encode(array());
	$buildings = new buildingArray();
	return json_encode($buildings->toOptionList($campus));
}

function getRooms($building = null) {
	if($building == null) echo json_encode(array());
	$rooms = new roomArray();
	return json_encode($rooms->toOptionList($building));
}

if(isset($_REQUEST["func"]) && !empty($_REQUEST["func"])) {
	$function = $_REQUEST["func"];
} else {
	die(json_encode(array()));
}
if(isset($_REQUEST["parm"]) && !empty($_REQUEST["parm"])) {
	$parameter = $_REQUEST["parm"];
} else {
	$parameter = null;
}
echo $function($parameter);