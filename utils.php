<?php
	function json_read($url) {
		return json_decode(file_get($url),true);
	}
	
	function file_get($url,$data=array()) {
		if (strpos($url,"://")===false) {
			return file_get_contents($url);
		} else {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			if (count($data) > 0) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			}
			$output = curl_exec($ch);
			curl_close($ch);
			return $output;
		}
	}
	function debug($label, $data) {
		echo "<div style=\"margin-left: 40px;background-color:#eeeeee;\"><u><h3>".$label."</h3></u><pre style=\"border-left:2px solid #000000;margin:10px;padding:4px;\">".print_r($data, true)."</pre></div>";
	}
?>