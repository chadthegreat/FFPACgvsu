<?php
/*
 * Template Name: Room Select
 *
 * @Author:	Chris Schaefer
 *
*/
include_once ABSPATH . "Application/includes/initialize.php";

// ToDo: After we have the data we will need to load campus and then update the onchange to call an ajax script to load building and same for building -> room.

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
		<form id="form-room-select" name="room-select" action="/room-view" method="post" onsubmit="return validateselection(this)">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<div class="form-group">
						<label for="campus">Campus</label>
						<select name="campus" class="form-control">
							<?php output_select($data["campus"]); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="building">Building</label>
						<select name="building" class="form-control"<?php echo (isset($_SESSION["APP"]["building"]) ? "" : " disabled"); ?>>
							<?php output_select($data["building"]); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="room">Room</label>
						<select name="room" class="form-control"<?php echo (isset($_SESSION["APP"]["room"]) ? "" : " disabled"); ?>>
							<?php output_select($data["room"]); ?>
						</select>
					</div>
					<input type="submit" name="submit" class="btn btn-block btn-primary" value="Select"<?php echo (isset($_SESSION["APP"]["room"]) ? "" : " disabled"); ?> />
				</div>
			</div>
		</form>
	</div>
	<script class="remOnLoad">
		$('form[name="room-select"] select[name="campus"]').val('<?php echo isset($_SESSION["APP"]["campus"]) ? $_SESSION["APP"]["campus"] : ""; ?>');
		$('form[name="room-select"] select[name="building"]').val('<?php echo isset($_SESSION["APP"]["building"]) ? $_SESSION["APP"]["building"] : ""; ?>');
		$('form[name="room-select"] select[name="room"]').val('<?php echo isset($_SESSION["APP"]["room"]) ? $_SESSION["APP"]["room"] : ""; ?>');
	</script>
<?php endwhile;
get_footer(); ?>