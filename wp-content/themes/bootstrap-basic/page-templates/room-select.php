<?php
/*
 * Template Name: Room Select
 *
 * @Author:	Chris Schaefer
 *
*/
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
							<option value="">Select</option>
							<option value="ALL">Allendale</option>
							<option value="PEW">Pew</option>
						</select>
					</div>
					<div class="form-group">
						<label for="building">Building</label>
						<select name="building" class="form-control" disabled>
							<option value="">Select</option>
							<option value="CHS">Cook-DeVos Center for Health Sciences</option>
							<option value="DEV">DeVos Hall</option>
							<option value="EHC">Eberhard Center</option>
							<option value="KEL">KEL?</option>
							<option value="KEN">Kennedy Hall</option>
							<option value="SCB">L. William Seidman Center</option>
						</select>
					</div>
					<div class="form-group">
						<label for="room">Room</label>
						<select name="room" class="form-control" disabled>
							<option value="">Select</option>
							<option value="2351">2351</option>
						</select>
					</div>
					<input type="submit" name="submit" class="btn btn-block btn-primary" value="Select" disabled />
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
		}
	</script>
<?php endwhile;
get_footer(); ?>