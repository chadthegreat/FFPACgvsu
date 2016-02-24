<?php
/*
 * Template Name: Room View
 *
 * @Author:	Chris Schaefer
 *
*/
include_once ABSPATH . "Application/includes/initialize.php";

$debug = false;

// Set any selected room variables
if(isset($_REQUEST["campus"])) {
	$_SESSION["APP"]["campus"] = $_REQUEST["campus"];
	if(isset($_REQUEST["building"])) {
		$_SESSION["APP"]["building"] = $_REQUEST["building"];
		if(isset($_REQUEST["room"])) {
			$_SESSION["APP"]["room"] = $_REQUEST["room"];
		}
	}
}
$campus = new campusArray();
$campus->load();
$data["campus"] = $campus->getArrayKeyValue();
$data["building"] = array();
$data["room"] = array();
if(isset($_SESSION["APP"]["campus"])) {
	$building = new buildingArray();
	$building->load();
	$data["building"] = $building->loadByCampus($_SESSION["APP"]["campus"]);
	if(isset($_SESSION["APP"]["building"])) {
		$room = new roomArray();
		$room->load();
		$data["room"] = $room->loadByBuilding($_SESSION["APP"]["building"]);
	}
}
get_header();
// Todo: query database for labels of campus/building/room for .page-title
	while (have_posts()) : the_post(); ?>
		<div class="container" id="home-content">
<?php if(isset($_SESSION["APP"]["campus"]) && isset($_SESSION["APP"]["building"]) && isset($_SESSION["APP"]["room"])) { ?>
			<h1 class="page-title"><?php echo $campus->getArrayKeyValue()[$_SESSION["APP"]["campus"]]; ?> > <?php echo $building->getArrayKeyValue()[$_SESSION["APP"]["building"]]; ?> > <?php echo $room->getArrayKeyValue()[$_SESSION["APP"]["room"]]; ?></h1>
			<?php the_content(); ?>
			<?php
			if (isset($debug) && ($debug == true)) { ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Debug</h3>
					</div>
					<div class="panel-body">
						<label>$_REQUEST Variables</label>
						<table class="table table-condensed table-responsive">
							<thead>
							<tr>
								<th>Key</th>
								<th>Value</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($_REQUEST as $key => $value) {
								echo "<tr><td>$key</td><td>$value</td>";
							} ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }
			?>
			<div id="complaints">
				<?php
				if(isset($_SESSION["APP"]["room"]) && !empty($_SESSION["APP"]["room"])) {
					$complaints = new complaintArray();
					$data = $complaints->loadByRoom($_SESSION["APP"]["room"]);
					include_once ABSPATH . '/Application/templates/complaints.php';
				}
				?>
			</div>
<?php } else { ?>
			<h1 class="page-title">Please select a room</h1>
			<a href="/room-select">Click here to select a room</a>
<?php } ?>
		</div>
	<?php endwhile;
get_footer(); ?>