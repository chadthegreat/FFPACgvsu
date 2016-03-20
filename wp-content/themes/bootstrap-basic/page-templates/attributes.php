<?php
/*
 * Template Name: Room Attributes
 *
 * @Author:	Chris Schaefer
 *
*/
include_once ABSPATH . "Application/includes/initialize.php";
$campus = new campusArray();
$campus->load();
$data["campus"] = $campus->getArrayKeyValue();
$data["building"] = array();
$data["room"] = array();
if(isset($_SESSION["APP"]["campus"])) {
	$building = new buildingArray();
	$data["building"] = $building->loadByCampus($_SESSION["APP"]["campus"]);
	if(isset($_SESSION["APP"]["building"])) {
		$room = new roomArray();
		$data["room"] = $room->loadByBuilding($_SESSION["APP"]["building"]);
	}
}
if(isset($_REQUEST["RoomID"])) {
	$db = new DBCon();
	$db->Link();
	$strSQL = "DELETE FROM ffpac.roomattribute WHERE RoomID = {$_REQUEST["RoomID"]}";
	$db->SetQueryStmt($strSQL);
	if ($db->Query()) {
		foreach($_REQUEST as $key => $value) {
			if(strstr($key, "att_")) {
				$key = substr($key, 4);
				$strSQL = "INSERT INTO ffpac.roomattribute (RoomID, AttributeID) VALUES ('" . $_REQUEST["RoomID"] . "', '$key')";
				$db->SetQueryStmt($strSQL);
				if(!$db->Query()) {
					echo "failed $value";
				}
			}
		}
	}
	unset($db);
}
get_header();
?>
<?php while(have_posts()) : the_post(); ?>
	<div class="container" id="home-content">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<form id="form-room-select" name="room-select" onsubmit="return validateselection(this)">
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label for="campus">Campus</label>
						<select name="campus" class="form-control">
							<?php output_select($data["campus"]); ?>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label for="building">Building</label>
						<select name="building" class="form-control"<?php echo (isset($_SESSION["APP"]["building"]) ? "" : " disabled"); ?>>
							<?php output_select($data["building"]); ?>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label for="room">Room</label>
						<select name="room" class="form-control"<?php echo (isset($_SESSION["APP"]["room"]) ? "" : " disabled"); ?>>
							<?php output_select($data["room"]); ?>
						</select>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Selected Rooms Attributes</h3>
					</div>
					<div id="attribute_list" class="panel-body">
						<?php include_once ABSPATH . "/Application/templates/attributes.php"; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script class="remOnLoad">
		$('form[name="room-select"] select[name="campus"]').val('<?php echo isset($_SESSION["APP"]["campus"]) ? $_SESSION["APP"]["campus"] : ""; ?>');
		$('form[name="room-select"] select[name="building"]').val('<?php echo isset($_SESSION["APP"]["building"]) ? $_SESSION["APP"]["building"] : ""; ?>');
		$('form[name="room-select"] select[name="room"]').val('<?php echo isset($_SESSION["APP"]["room"]) ? $_SESSION["APP"]["room"] : ""; ?>');
	</script>
<?php endwhile;
get_footer();
?>