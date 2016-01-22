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
		<form id="form-room-select" name="room-select">
			<p>
				<label for="campus">Campus</label>
				<select name="campus" class="form-control">
					<option value="">Select</option>
					<option value="ALL">Allendale</option>
					<option value="PEW">Pew</option>
				</select>
			</p>
			<p>
				<label for="building">Building</label>
				<select name="building" class="form-control">
					<!-- (CHS, DEV, EHC, KEL, KEN, SCB) -->
					<option value="">Select</option>
					<option value="CHS">Cook-DeVos Center for Health Sciences</option>
					<option value="DEV">DeVos Hall</option>
					<option value="EHC">Eberhard Center</option>
					<option value="KEL"></option>
					<option value="KEN">Kennedy Hall</option>
					<option value="SCB">L. William Seidman Center</option>
				</select>
			</p>
			<p>
				<label for="room">Room</label>
				<select name="room" class="form-control">
					<option value="">Select</option>
					<option value="">2351</option>
				</select>
			</p>
		</form>
	</div>
<?php endwhile;
get_footer(); ?>