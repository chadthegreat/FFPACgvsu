<?php
/*
 * Template Name: Room View
 *
 * @Author:	Chris Schaefer
 *
*/
$debug = true;
get_header();
// Todo: query database for labels of campus/building/room for .page-title
?>
<?php while(have_posts()) : the_post(); ?>
	<div class="container" id="home-content">
		<h1 class="page-title">Campus > Building > Room</h1>
		<?php the_content(); ?>
		<?php
			if( isset( $debug ) && ( $debug == true ) ) { ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Debug</h3>
					</div>
					<div class="panel-body">
						<label>$_REQUEST Variables</label>
						<table class="table">
							<thead>
							<tr><th>Key</th><th>Value</th></tr>
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
	</div>
<?php endwhile;
get_footer(); ?>