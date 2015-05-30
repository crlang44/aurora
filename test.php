<?php
	$data = "hate hate hate hate hate$^\\1@$^49302%#@^*@^ hate hate, 2\n hate hate hate hate %&@%||@#%@!hate hate hate, 5\n hate hate hate hate hate hate hate, 0";
	$data = preg_replace('/[^A-Za-z0-9\-]/', '', $data);
	print $data;
	$result = exec('python example.py ' . escapeshellarg($data)); //. escapeshellarg(json_encode($data))
	$resultData = json_decode($result, true);
	print '<br>';
	print 'Average: ' . $resultData[0] . '<br>';
	print 'Weighted Average: ' . $resultData[1] . '<br>';
	print 'Number of Tweets analyzed: ' . $resultData[2] . '<br>';
?>