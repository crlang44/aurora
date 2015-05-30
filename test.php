<?php
	$result = shell_exec('python example.py');
	$resultData = json_decode($result, true);
	print $resultData;
?>