<?php
	$data = "hate 4;: $ hate hate hate hate ~`ha!@#$%^&*(&^%$#$%^&*&^%$TFGG:\"?te hate, 2\n hate hate hate hate hate hate hate, 5\n hate hate hate hate hate hate hate, 0\n";
	$result = exec('python example.py ' . escapeshellarg($data)); //. escapeshellarg(json_encode($data))
	$resultData = json_decode($result, true);
	print 'Average: ' . $resultData[0] . '<br>';
	print 'Weighted Average: ' . $resultData[1] . '<br>';
	print 'Number of Tweets analyzed: ' . $resultData[2] . '<br>';
	//print $result;
?>