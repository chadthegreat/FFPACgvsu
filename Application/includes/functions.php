<?php
/**
 * Outputs markup for a select drop down list
 * If $selected is set then it will mark any matches
 * in the list as the selected
 * @param $options
 * @param $selected
 */
function output_select($options, $selected) {
	if(isset($options) && is_array($options)) {
		echo "<option>Select</option>";
		foreach($options as $value => $label) {
			echo "<option value=\"$value\"";
			if(isset($selected) && !empty($selected)) {
				if($value == $selected) {
					echo " selected";
				}
			}
			echo ">$label</option>";
		}
	}
}