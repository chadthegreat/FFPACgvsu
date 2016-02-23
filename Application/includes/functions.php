<?php
/**
 * Outputs markup for a select drop down list
 * If $selected is set then it will mark any matches
 * in the list as the selected
 * @param $options
 * @param $selected
 */
function output_select($options, $selected = null) {
	if(isset($options) && is_array($options)) {
		echo "<option value=\"\">Select</option>";
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

function loadClass($class) {
	if (file_exists(ABSPATH . 'classes/'.$class.'.php')) { // Load class
		include ABSPATH . "classes/$class.php";
	} else if(strpos($class,"Array")) {
		$class = substr($class,0,strpos($class, "Array"));
		if(file_exists(ABSPATH . "classes/$class.php"))
			include ABSPATH . "classes/$class.php";
	} else if(strpos($class,"TS") === 0) { // Load core
		if(file_exists(ABSPATH . "include/core/$class.php")) {
			include ABSPATH . "include/core/$class.php";
		}
	} else {
		echo "<pre>";
		throw new Exception("Unable to load class: $class");
		echo "</pre>";
	}
}
spl_autoload_register('loadClass');