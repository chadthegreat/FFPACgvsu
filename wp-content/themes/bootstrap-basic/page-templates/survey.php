<?php
/*
 * Template Name: Survey
 *
 * @author: Chris Schaefer
 */
get_header();
?>
<?php while(have_posts()) : the_post(); ?>
	<div class="container" id="home-content">
	<h1 class="page-title"><?php the_title(); ?></h1>
	<?php the_content(); ?>
	Pending survey link to get proper questions / inputs
	</div>
<?php
endwhile;
get_footer();
?>