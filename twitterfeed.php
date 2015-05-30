<?
$search_query = $_POST['ticker'];


//set gauges to zero
 $g1=0; // gauge 1
 $g2=0; // gauge 2

//Search Query
//$search_query = "CMCSA";

$outputString;

require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "51234764-J2nNPym0Dspt0esm6xDuVt722MPAn2sHCW6wsX0LW",
    'oauth_access_token_secret' => "J6RCz78Jj8v2b59XN7ViUyU5amtbftrRVzKcHjK6t51RI",
    'consumer_key' => "byhraYuq3s1ZDravJVyO18YRx",
    'consumer_secret' => "0Ulbk6sE2Jbh3FYhAycmLbOKjed37t8Pz5yrAJ0sKdj3l1tIjH"
);

//Number of Requests to make
$numberRequests = 5;

//Number of Results per requests
$numberResults = 100;

/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$extra_parameters = '&lang=en&include_entities=1&count='. $numberRequests;
$getfield = "&q=".$search_query.$extra_parameters;
$requestMethod = 'GET';


$debugCt = 1;

//implements twitter API
$twitter = new TwitterAPIExchange($settings);

//pull number of requests
for($i=0; $i<=$numberRequests; $i++){

	if($i>0){
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$getfield = $next_results."&q=".$search_query.$extra_parameters;
	}

	$json_string = $twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
	             ->performRequest();

	//convert json string to array
	$json_output = json_decode($json_string, true);


	
	$next_results = $json_output[search_metadata][next_results];
	//iterate through each tweet
	// print "<pre>";
	// print_r ($json_output);
	// print "</pre>";
	foreach($json_output[statuses] as $tweets){
		
		//Text Values
		$text = $tweets[text];

		//add text to return string

		$holdingString = str_replace(',', ' ', $text).",";
		$holdingString = preg_replace('/[^\x20-\x7E]/', '', $holdingString);
		$outputString .= str_replace("\n", ' ', $holdingString);
		$outputString .= $tweets[user][followers_count]."\n";
			
	}

	}
	//$outputString = preg_replace('/[^\x20-\x7E]/', '', $outputString);
	
	//print_r($outputString);
	$result = exec('python example.py ' . escapeshellarg($outputString)); //. escapeshellarg(json_encode($data))
	$resultData = json_decode($result, true);
	//print_r ($result);
	// print 'Average: ' . $resultData[0] . '<br>';
	// print 'Weighted Average: ' . $resultData[1] . '<br>';
	// print 'Number of Tweets analyzed: ' . $resultData[2] . '<br>';
	//print $result;
	echo "<script>updateGuage(".$resultData[0]."); updateGuage(".$resultData[0].");</script>"
 
//<script type = 'text/javascript' > updateGuage(<? print $resultData[0] ?>); updateGuage(<? print $resultData[0] ?>); </script>
?>