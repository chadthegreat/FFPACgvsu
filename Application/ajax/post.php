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
	$pRoom = $parm["room"];
	$pComplaint = $parm["complaint"];
	$complaint = new complaint();
	$complaint->setRoomID($pRoom);
	$complaint->setComplaint($pComplaint);
	$complaint->setStatus("Not Fixed");
	$complaint->save();
}

function insertNote($parm) {
	$pComplaintID = $parm["ComplaintID"];
	$pNote = $parm["Note"];
	$note = new note();
	$note->setComplaintID($pComplaintID);
	$note->setNote($pNote);
	$note->save();
}

function deleteNote($parm) {
	$pNoteID = $parm["NoteID"];
	$note = new note($pNoteID);
	$note->delete();
}

function updateStatus($parm) {
	$pComplaintID = $parm["ComplaintID"];
	$pStatus = $parm["status"];
	$complaint = new complaint($pComplaintID);
	$complaint->setStatus($pStatus);
	$complaint->save();
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

if(!is_array($parameter)) die("Something went wrong, please try again!");

echo $function($parameter);
