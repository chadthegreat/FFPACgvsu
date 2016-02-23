<?php if(count($data) > 0) { ?>
<table class="table">
	<thead>
	<tr>
		<th>Notes</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row) { ?>
		<tr data-note-id="<?php echo $row["ID"]; ?>">
			<td><?php echo $row["Note"]; ?></td>
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
	<button type="submit" class="btn btn-primary">Submit</button>
</form>