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

function insertComplaint($parm) {
	if(!is_array($parm)) die("Something went wrong, please try again!");
	$pRoom = $parm["room"];
	$pComplaint = $parm["complaint"];
	$complaint = new complaint();
	$complaint->setRoomID($pRoom);
	$complaint->setComplaint($pComplaint);
	$complaint->setStatus("Not Fixed");
	$complaint->save();
}

function insertNote($parm) {
	if(!is_array($parm)) die("Something went wrong, please try again!");
	$pComplaintID = $parm["ComplaintID"];
	$pNote = $parm["Note"];
	$note = new note();
	$note->setComplaintID($pComplaintID);
	$note->setNote($pNote);
	$note->save();
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
