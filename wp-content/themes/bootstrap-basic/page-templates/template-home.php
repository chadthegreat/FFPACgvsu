<?php
/*
 * Template Name: Homepage
 *
 * @Author:	Arbor Solutions
 *
*/
get_header();
?>
<?php while(have_posts()) : the_post(); ?>
	<div class="container" id="home-content">
	<?php the_content(); ?>
	</div>
<?php endwhile;
get_footer(); ?>