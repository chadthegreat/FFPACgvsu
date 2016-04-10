<?php
$complaint_status = array("Fixed", "In Progress", "Not Fixed");
?>
<table class="table table-condensed table-striped">
	<thead>
	<tr>
		<th>Complaint</th>
		<th>Notes</th>
		<th>Status</th>
		<th>Long Term</th>
		<th>Date</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row) { ?>
		<tr data-id="<?php echo $row["ID"]; ?>">
			<td><?php echo $row["Complaint"]; ?></td>
			<td data-task="note-edit" class="note-edit"><?php
				if($row["note_count"] > 0) {
					echo '<span class="glyphicon glyphicon-pencil">&nbsp;</span>Click to edit notes';
				} else {
					echo '<span class="glyphicon glyphicon-plus">&nbsp;</span>Click to add notes';
				}
				echo ($row["note_count"] > 0) ? " ({$row["note_count"]})" : ""; ?></td>
			<td>
				<select name="status" class="form-control">
					<?php
					foreach($complaint_status as $value) {
						echo "<option value=\"$value\"";
						echo ($row["Status"] == $value) ? " selected" : "";
						echo ">$value</option>";
					}
					?>
				</select>
			</td>
			<td>
				<input type="checkbox" name="LongTermRenovation" class="form-control" <?php echo ($row["LongTermRenovation"]) ? "checked" : ""; ?> />
			</td>
			<td><?php echo substr($row["InsertedOn"],0,10); ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<script class="remOnLoad">
	$('[data-task="note-edit"]').on('click',
		function(event) {
			var complaintID = $(this).parent('[data-id]').data('id');
			loadnote(complaintID);
		});
	$('select[name="status"]').on('change',
		function(event) {
			var complaintID = $(this).parents('[data-id]').data('id');
			var status = $(this).val();
			poststatus(complaintID, status, this);
		});
	$('input[name="LongTermRenovation"]').on('change',
		function(event) {
			var complaintID = $(this).parents('[data-id]').data('id');
			var value = $(this).is(':checked');
			postlongterm(complaintID, value, this);
		});
	$('.remOnLoad').remove();
</script>