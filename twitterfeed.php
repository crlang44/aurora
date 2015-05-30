<?
// $consumer_key = "byhraYuq3s1ZDravJVy018YRx";
// $consumer_secret = "0Ulbk6sE2Jbh3FYgAycmLbOKjed37t8Pz5yrAJ0sKdj3l1tljH";
// require "vendor/autoload.php";

// use Abraham\TwitterOAuth\TwitterOAuth;

// $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
// $content = $connection->get("account/verify_credentials");

// //$url = "GET https://api.twitter.com/1.1/statuses/home_timeline.json?count=25&exclude_replies=true";


// $statues = $connection->get("statuses/home_timeline", array("count" => 25, "exclude_replies" => true));
// $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => "nMznkpFRTMCuNMsmALzel9FgPlmWQDWg"));
// $url = $connection->url("oauth/authorize", array("oauth_token" => "EaQLH34YD8pgKkUiSp8RbjjOgNxIYVh7"));
// //GET https://api.twitter.com/1.1/search/tweets.json?q=twitterapi
// $gUrl = "https://api.twitter.com/1.1/search/tweets.json?q=twitterapi";
// //http_get ( string $gUrl, array("timeout"=>1), );
// $statuses = $connection->get("search/tweets", array("q" => "twitterapi"));

// print_r($statuses);

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
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

 ?>