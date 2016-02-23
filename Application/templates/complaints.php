<?php
$complaint_status = array("Fixed", "Partly Fixed", "Not Fixed");
?>
<table class="table">
	<thead>
	<tr>
		<th>Complaint</th>
		<th>Notes</th>
		<th>Status</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row) { ?>
		<tr data-id="<?php echo $row["ID"]; ?>">
			<td><?php echo $row["Complaint"]; ?></td>
			<td data-task="note-edit" class="note-edit">Click to view notes</td>
			<td width="20%">
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
		</tr>
	<?php } ?>
	</tbody>
</table>
<script class="remOnLoad">
	$('[data-task="note-edit"]').on('click',
		function() {
			var complaintID = $(this).parent('[data-id]').data('id');
			loadnote(complaintID);
		});
	$('.remOnLoad').remove();
</script>