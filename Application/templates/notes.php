<div id="notes">
	<?php if(count($data) > 0) { ?>
	<table class="table table-condensed table-responsive">
		<thead>
		<tr>
			<th>Notes</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($data as $row) { ?>
			<tr data-note-id="<?php echo $row["ID"]; ?>">
				<td>
					<button type="button" class="close alert-danger" aria-label="Delete">
						<span aria-hidden="true">×</span>
					</button>
					<?php echo $row["Note"]; ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<?php } else { ?>
	<label>No notes exist for the selected complaint.</label>
	<?php } ?>
	<form onsubmit="return postnote(this);">
		<input type="hidden" name="ComplaintID" value="<?php echo $complaint; ?>" />
		<div class="form-group">
			<label for="note">Add a note:</label>
			<input type="text" class="form-control" name="Note" placeholder="Note">
		</div>
		<button type="submit" class="btn btn-primary btn-block">Submit</button>
	</form>
</div>
<script class="remOnLoad">
	$('#notes tr[data-note-id] button.close').on('click',
		function(event) {
			var noteid = $(this).parents('[data-note-id]').data('note-id');
			deletenote(noteid, this);
		}
	);
	$('.remOnLoad').remove();
</script>