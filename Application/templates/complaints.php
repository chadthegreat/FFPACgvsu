<?php
$complaint_status = array("Fixed", "Partly Fixed", "Not Fixed");
?>
<table class="table table-condensed table-striped">
	<thead>
	<tr>
		<th>Complaint</th>
		<th>Notes</th>
		<th>Status</th>
		<th>Date</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row) { ?>
		<tr data-id="<?php echo $row["ID"]; ?>">
			<td><?php echo $row["Complaint"]; ?></td>
			<td data-task="note-edit" class="note-edit">Click to view notes<?php echo ($row["note_count"] > 0) ? " ({$row["note_count"]})" : ""; ?></td>
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
			<td><?php echo $row["InsertedOn"]; ?></td>
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
			$(this).addClass('alert-warning');
			var complaintID = $(this).parents('[data-id]').data('id');
			var status = $(this).val();
			poststatus(complaintID, status, this);
		});
	$('.remOnLoad').remove();
</script>