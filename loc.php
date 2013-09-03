<?php
	
	require_once("utils.php");
	
	function getLocationData($address) {
		$rawdata = json_read("http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false");
		
		if ($rawdata["status"] != "OK") {
			return false;
		}
		$data = $rawdata["results"][0];
		$keys = array(
			"postal_code"					=> "zipcode",
			"locality"						=> "city",
			"administrative_area_level_1"	=> "state",
			"country"						=> "country"
		);
		$output = array();
		foreach ($data["address_components"] as $group) {
			foreach ($group["types"] as $type) {
				if (array_key_exists($type, $keys)) {
					$output[$keys[$type]] = $group["short_name"];
				}
			}
		}
		$output["lat"]	= $data["geometry"]["location"]["lat"];
		$output["lng"]	= $data["geometry"]["location"]["lng"];
		
		// Get the timezone
		$tzraw = json_read("https://maps.googleapis.com/maps/api/timezone/json?location=".$output["lat"].",".$output["lng"]."&timestamp=".time()."&sensor=false");
		
		$output["timezone"] = $tzraw["timeZoneId"];
		
		return $output;
	}
?>