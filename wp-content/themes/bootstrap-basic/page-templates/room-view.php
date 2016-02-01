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
get_header();
// Todo: query database for labels of campus/building/room for .page-title
	while (have_posts()) : the_post(); ?>
		<div class="container" id="home-content">
<?php if(isset($_SESSION["APP"]["campus"]) && isset($_SESSION["APP"]["building"]) && isset($_SESSION["APP"]["room"])) { ?>
			<h1 class="page-title">Campus > Building > Room</h1>
			<?php the_content(); ?>
			<?php
			if (isset($debug) && ($debug == true)) { ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Debug</h3>
					</div>
					<div class="panel-body">
						<label>$_REQUEST Variables</label>
						<table class="table">
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
			<table class="table">
				<thead>
				<tr>
					<th>Complaint</th>
					<th>Notes</th>
					<th>Fixed</th>
					<th>Partly Fixed</th>
					<th>Not Fixed</th>
				</tr>
				</thead>
				<tbody>
				<?php for ($i = 0; $i < 5; $i++) { ?>
					<tr data-id="">
						<td>Complaint information here</td>
						<td data-task="note-edit">Notes here</td>
						<td width="1%"><input type="radio" checked="checked"/></td>
						<td width="1%"><input type="radio"/></td>
						<td width="1%"><input type="radio"/></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
<?php } else { ?>
			<h1 class="page-title">Please select a room</h1>
			<a href="/room-select">Click here to select a room</a>
<?php } ?>
		</div>
	<?php endwhile;
get_footer(); ?>