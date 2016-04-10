<?php
/*
 * Template Name: Leaderboard
 *
 * @Author:	Chris Schaefer
 *
*/
include_once ABSPATH . "Application/includes/initialize.php";
$complaint = new complaintArray();
get_header();
?>
<?php while(have_posts()) : the_post(); ?>
	<div class="container" id="home-content">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<form id="form-room-select" name="room-select" action="/room-view" method="post" onsubmit="return validateselection(this)">
			<div class="row">
				<div class="col-xs-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Rooms with Most Complaints</h3>
						</div>
						<div class="panel-body">
							<table class="table" id="room-leaders">
								<thead><tr><th>Campus</th><th>Building</th><th>Room</th><th>Complaints</th></tr></thead>
								<tbody>
								<?php
								$rooms = $complaint->loadRoomLeaderboard();
								if($rooms !== false) {
									foreach ($rooms as $room) { ?>
										<tr>
											<td><?php echo $room["Campus"]; ?></td>
											<td><?php echo $room["Building"]; ?></td>
											<td><?php echo $room["Room"]; ?></td>
											<td><?php echo $room["Count"]; ?></td>
										</tr>
									<?php }
								}?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Buildings with Most Complaints</h3>
						</div>
						<div class="panel-body">
							<table class="table" id="building-leaders">
								<thead><tr><th>Building</th><th>Complaints</th></tr></thead>
								<tbody>
								<?php
								$rooms = $complaint->loadBuildingLeaderboard();
								if($rooms !== false) {
									foreach ($rooms as $room) { ?>
										<tr>
											<td><?php echo $room["Building"]; ?></td>
											<td><?php echo $room["Count"]; ?></td>
										</tr>
									<?php }
								}?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Campuses with Most Complaints</h3>
						</div>
						<div class="panel-body">
							<table class="table" id="campus-leaders">
								<thead><tr><th>Campus</th><th>Complaints</th></tr></thead>
								<tbody>
								<?php
								$rooms = $complaint->loadCampusLeaderboard();
								if($rooms !== false) {
									foreach ($rooms as $room) { ?>
										<tr>
											<td><?php echo $room["Campus"]; ?></td>
											<td><?php echo $room["Count"]; ?></td>
										</tr>
									<?php }
								}?>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function() {
			$('#room-leaders,#building-leaders,#campus-leaders').dataTable();
		})
	</script>
<?php endwhile;
get_footer(); ?>