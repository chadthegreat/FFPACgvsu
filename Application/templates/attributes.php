<?php
$attributes = new attributeArray();
$attributes->load();
/* figure out a cleaner way to do this */
if(isset($_SESSION["APP"]["room"])) {
	$db = new DBCon();
	$db->Link();
	$strSQL = "SELECT * FROM ffpac.roomattribute WHERE RoomID = {$_SESSION["APP"]["room"]}";
	$db->SetQueryStmt($strSQL);
	if ($db->Query()) {
		foreach ($db->GetAll() as $row) {
			$selectedAttributes[] = $row["AttributeID"];
		}
	}
}
?>
<form method="post" name="attributes">
	<input type="hidden" name="RoomID" value="<?php echo $_SESSION["APP"]["room"]; ?>" />
	<?php foreach($attributes->getArray() as $attribute) { ?>
		<div class="checkbox"><label for="att_<?php echo $attribute->getID(); ?>">
				<input <?php
							 if(isset($selectedAttributes)) {
								 if(in_array($attribute->getID(),$selectedAttributes)) {
									 echo "checked ";
								 }
							 }
							 ?>name="att_<?php echo $attribute->getID(); ?>" type="checkbox"><?php echo $attribute->getDescription(); ?>
			</label></div>
	<?php } ?>
	<input class="btn btn-primary btn-block" type="submit" name="submit" value="Save Attributes" />
</form>