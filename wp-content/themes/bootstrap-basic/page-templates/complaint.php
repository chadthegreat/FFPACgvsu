<?php
/*
 * Template Name: New Complaint
 *
 * @author: Chris Schaefer
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
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Enter Complaint</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<textarea class="form-control"></textarea>
					</div>
					<button class="btn btn-block btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endwhile;
get_footer();