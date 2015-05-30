<?

require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "51234764-J2nNPym0Dspt0esm6xDuVt722MPAn2sHCW6wsX0LW",
    'oauth_access_token_secret' => "J6RCz78Jj8v2b59XN7ViUyU5amtbftrRVzKcHjK6t51RI",
    'consumer_key' => "byhraYuq3s1ZDravJVyO18YRx",
    'consumer_secret' => "0Ulbk6sE2Jbh3FYhAycmLbOKjed37t8Pz5yrAJ0sKdj3l1tIjH"
);

/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?max_id=604354574137184256&q=goog&include_entities=1';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);


//save twitter output as string
$json_string = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

//convert json string to array
$json_output = json_decode($json_string, true);




foreach($json_output[statuses] as $tweets){
	
	$text = $tweets[text];
	if(!preg_match('/[^\x20-\x7F]/', text))
	print $text;
		//print $tweets[text]."\n";
}

// print $json_output[statuses][0][id];
// print"<pre>";
// print_r($json_output);
// print "</pre>";

 ?>