<?php
/*
 * Template Name: Walkthrough
 *
 * @Author:	Chris Schaefer
 *
*/
include_once ABSPATH . "Application/includes/initialize.php";
$data["campus"] = array("ALL"=>"Allendale","PEW"=>"Pew");
$data["building"] = array("CHS"=>"Cook-DeVos Center for Health Sciences",
	"DEV"=>"DeVos Hall",
	"EHC"=>"Eberhard Center",
	"KEL"=>"KEL?",
	"KEN"=>"Kennedy Hall",
	"SCB"=>"L. William Seidman Center");
$data["room"] = array("2315"=>"2315");
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
						<select name="building" class="form-control"<?php (isset($_SESSION["APP"]["building"]) ? "" : " disabled"); ?>>
							<?php output_select($data["building"]); ?>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label for="room">Room</label>
						<select name="room" class="form-control"<?php (isset($_SESSION["APP"]["room"]) ? "" : " disabled"); ?>>
							<?php output_select($data["room"]); ?>
						</select>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-xs-12">
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
			</div>
		</div>
	</div>
	<script class="remOnLoad">
		$('form[name="room-select"] select[name="campus"]').val('<?php echo isset($_SESSION) ? $_SESSION["APP"]["campus"] : ""; ?>');
		$('form[name="room-select"] select[name="building"]').val('<?php echo isset($_SESSION) ? $_SESSION["APP"]["building"] : ""; ?>');
		$('form[name="room-select"] select[name="room"]').val('<?php echo isset($_SESSION) ? $_SESSION["APP"]["room"] : ""; ?>');
	</script>
<?php endwhile;
get_footer();
?>