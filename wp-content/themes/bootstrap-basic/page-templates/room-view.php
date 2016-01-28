<?php
/*
 * Template Name: Room View
 *
 * @Author:	Chris Schaefer
 *
*/
session_start();
$debug = false;
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
			<?php for($i = 0; $i < 5; $i++) { ?>
			<tr>
				<td>Complaint information here</td>
				<td>Notes here</td>
				<td width="1%"><input type="radio" checked="checked"/></td>
				<td width="1%"><input type="radio" /></td>
				<td width="1%"><input type="radio" /></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
<?php endwhile;
get_footer(); ?>