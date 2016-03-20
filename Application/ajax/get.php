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

function getComplaints($room = null) {
	if($room == null) die();
	$_SESSION["APP"]["room"] = $room;
	$complaint = new complaintArray();
	$data = $complaint->loadByRoom($room);
	include_once APP_PATH . 'templates/complaints.php';
}

function getNotes($complaint = null) {
	if($complaint == null) die();
	$notes = new noteArray();
	$data = $notes->loadByComplaint($complaint);
	include_once APP_PATH . 'templates/notes.php';
}

function getAttributes($room = null) {
	if($room == null) die();
	$_SESSION["APP"]["room"] = $room;
	$complaint = new complaintArray();
	$data = $complaint->loadByRoom($room);
	include_once APP_PATH . 'templates/attributes.php';
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