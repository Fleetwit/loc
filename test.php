<?php
	require_once("loc.php");
	
	if (isset($_GET["loc"])) {
		$location = getLocationData($_GET["loc"]);
		debug("location",$location);
	}
?>