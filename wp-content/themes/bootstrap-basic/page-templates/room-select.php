<?php
/*
 * Template Name: Room Select
 *
 * @Author:	Chris Schaefer
 *
*/

session_start();

/**
 * Outputs markup for a select drop down list
 * If $selected is set then it will mark any matches
 * in the list as the selected
 * @param $options
 * @param $selected
 */
function output_select($options, $selected) {
	if(isset($options) && is_array($options)) {
		echo "<option>Select</option>";
		foreach($options as $value => $label) {
			echo "<option value=\"$value\"";
			if(isset($selected) && !empty($selected)) {
				if($value == $selected) {
					echo " selected";
				}
			}
			echo ">$label</option>";
		}
	}
}

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
				<div class="col-xs-12 col-sm-8 col-sm-offset-2">
					<div class="form-group">
						<label for="campus">Campus</label>
						<select name="campus" class="form-control">
							<?php output_select($data["campus"],(isset($_SESSION) ? $_SESSION["APP"]["campus"] : null)); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="building">Building</label>
						<select name="building" class="form-control"<?php (isset($_SESSION["APP"]["building"]) ? "" : " disabled"); ?>>
							<?php output_select($data["building"],(isset($_SESSION) ? $_SESSION["APP"]["building"] : null)); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="room">Room</label>
						<select name="room" class="form-control"<?php (isset($_SESSION["APP"]["room"]) ? "" : " disabled"); ?>>
							<?php output_select($data["room"],(isset($_SESSION) ? $_SESSION["APP"]["room"] : null)); ?>
						</select>
					</div>
					<input type="submit" name="submit" class="btn btn-block btn-primary" value="Select"<?php (isset($_SESSION["APP"]["room"]) ? "" : " disabled"); ?> />
				</div>
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function() {
			$('form[name="room-select"] select[name="campus"]').on('change', function() {
				if(this.value == "") {
					$('form[name="room-select"] select[name="building"]').val('').attr('disabled','');
					$('form[name="room-select"] select[name="room"]').val('').attr('disabled','');
					$('form[name="room-select"] input[name="submit"]').attr('disabled','');
				} else {
					$('form[name="room-select"] select[name="building"]').removeAttr('disabled');
				}
			});
			$('form[name="room-select"] select[name="building"]').on('change', function() {
				if(this.value == "") {
					$('form[name="room-select"] select[name="room"]').val('').attr('disabled','');
				} else {
					$('form[name="room-select"] select[name="room"]').removeAttr('disabled');
				}
			});
			$('form[name="room-select"] select[name="room"]').on('change', function() {
				if(this.value == "") {
					$('form[name="room-select"] input[name="submit"]').attr('disabled','');
				} else {
					$('form[name="room-select"] input[name="submit"]').removeAttr('disabled','');
				}
			});
		});
		var validateselection = function(form) {
			if(form.campus.value == "") { alert("Please select a campus"); return false; }
			if(form.building.value == "") { alert("Please select a building"); return false; }
			if(form.room.value == "") { alert("Please select a room"); return false; }
			return true;
		};
	</script>
<?php endwhile;
get_footer(); ?>