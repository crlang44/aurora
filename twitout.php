<?php
$search_query = $_POST['Input'];


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
$numberRequests = 1;

//Number of Results per requests
$numberResults = 10;

/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$extra_parameters = '&lang=en&include_entities=1&count='. $numberRequests;
$getfield = "?q=".$search_query.$extra_parameters;
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
 ?>
 <html>
	<head>
		<title>Aurora Metrics</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

	</head>
	<body class="homepage" onload="initialize(.3)">

		
				<section id ="banner">


<!-- ******************This is where the guages are ********************-->



		<script type = 'text/javascript' > updateGauges(0.5);</script>
		
		<script>
		<!-- Create Gauge Script -->					
				
			var gauges = [];
			var opins = [];
			
			function createGauge(name, label, min, max)
			{
				var config = 
				{
					size: 200,
					label: label,
					min: undefined != min ? min : 0,
					max: undefined != max ? max : 100,
					minorTicks: 10
				}
				
				var range = config.max - config.min;
				config.yellowZones = [{ from: config.min + range*0.25, to: config.min + range*0.75 }];
				config.redZones = [{ from: config.min , to: config.min + range*0.25 }];
				config.greenZones = [{ from: config.min + range*0.75, to: config.max }];
				
				gauges[name] = new Gauge(name + "GaugeContainer", config);
				gauges[name].render();
			}
			
			function createGauges()
			{
				createGauge("avg", "Average");
				

			}
			
			function updateGauges(opi,opin)
			{
				for (var key in gauges)
				{
					var value = getValue(gauges[key],opi)
					gauges[key].redraw(value);
				}
			}
			
			function getValue(gauge,opinion)
			{
				opinion =<? print $resultData[0]?>;
				var overflow = 0; //10;
				return gauge.config.min - overflow + (gauge.config.max - gauge.config.min + overflow*2) *  opinion;
			}
			
			function initialize()
			{
				createGauges();
				setInterval(updateGauges, 2000);
			}
		</script>

		<span id="avgGaugeContainer"></span>

		<span id="wavgGaugeContainer"></span>
	</br>
		<img  src=<?php print "'http://chart.finance.yahoo.com/z?s=".$_POST['Input'] . "'"?> alt="" />
		<span id="updatedgauge"></span>


				</section>	

			<!-- Carousel -->
				<section id="Toptrends" class="carousel">
					<h2> &nbsp; &nbsp; Social Media's Reactions to Latest <strong>Trends</strong>.</h2>
					<div class="reel">

						<article>
							<a href="http://finance.yahoo.com/z?s=appl" class="image featured"><img src="http://chart.finance.yahoo.com/z?s=AAPL" alt="" /></a>
							<header>
								<h3><a href="http://finance.yahoo.com/q?s=aapl">Apple Seeing Competition after I/O</a></h3>
							</header>
							<p>The Google I/O has shed light on many new features that may prove to worry Apple...</p>
						</article>

						<article>
							<a href="http://finance.yahoo.com/z?s=tsla" class="image featured"><img src="http://chart.finance.yahoo.com/z?s=TSLA" alt="" /></a>
							<header>
								<h3><a href="http://finance.yahoo.com/q?s=tsla">Tesla Powerwall</a></h3>
							</header>
							<p>Tesla trying to take over the garage, hopes consumers will buy their luxury car and park it next to their new luxury energy...</p>
						</article>

						<article>
							<a href="http://finance.yahoo.com/z?s=ctxs" class="image featured"><img src="http://chart.finance.yahoo.com/z?s=ctxs" alt="" /></a>
							<header>
								<h3><a href="http://finance.yahoo.com/q?s=ctxs">Citrix hosts most succesful...</a></h3>
							</header>
							<p>Citrix was able to find extremely talented group of programmers, gives first place prizes to everyone in competition...</p>
						</article>

						<article>
							<a href="http://finance.yahoo.com/z?s=axp" class="image featured"><img src="http://chart.finance.yahoo.com/z?s=axp" alt="" /></a>
							<header>
								<h3><a href="http://finance.yahoo.com/q?s=axp">American Express CEO dies leaving comapny...</a></h3>
							</header>
							<p>American Express CEO dies from heart attack leaving company at a tough time...</p>
						</article>

						<article>
							<a href="http://finance.yahoo.com/z?s=^dji" class="image featured"><img src="http://chart.finance.yahoo.com/z?s=^dji" alt="" /></a>
							<header>
								<h3><a href="http://finance.yahoo.com/z?s=^dji">DOW takes 115 point hit during yesterdays...</a></h3>
							</header>
							<p>DOW Jones Industrial Average takes a 115 point hit, where is the economy going...?</p>
						</article>

						<!--<article>
							<a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
							<header>
								<h3><a href="#">Pulvinar sagittis congue</a></h3>
							</header>
							<p>Commodo id natoque malesuada sollicitudin elit suscipit magna.</p>
						</article>

						<article>
							<a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>
							<header>
								<h3><a href="#">Fermentum sagittis proin</a></h3>
							</header>
							<p>Commodo id natoque malesuada sollicitudin elit suscipit magna.</p>
						</article>

						<article>
							<a href="#" class="image featured"><img src="images/pic03.jpg" alt="" /></a>
							<header>
								<h3><a href="#">Sed quis rhoncus placerat</a></h3>
							</header>
							<p>Commodo id natoque malesuada sollicitudin elit suscipit magna.</p>
						</article>

						<article>
							<a href="#" class="image featured"><img src="images/pic04.jpg" alt="" /></a>
							<header>
								<h3><a href="#">Ultrices urna sit lobortis</a></h3>
							</header>
							<p>Commodo id natoque malesuada sollicitudin elit suscipit magna.</p>
						</article>

						<article>
							<a href="#" class="image featured"><img src="images/pic05.jpg" alt="" /></a>
							<header>
								<h3><a href="#">Varius magnis sollicitudin</a></h3>
							</header>
							<p>Commodo id natoque malesuada sollicitudin elit suscipit magna.</p>
						</article>-->

					</div>
				</section>

			
			<!-- Footer -->
				<div id="footer">
					<div class="container">
						

								<!-- Contact -->
									<section class="contact">
										<header>
											<h3>Created by :</h3>
										</header>
										<p>Alex, Justin, Chris, Nidhal.</p>
										<ul class="icons">
											<li><a href="https://twitter.com/AuroraMetrics" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
											<li><a href="https://www.facebook.com/aurorametrics" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
											<li><a href="https://instagram.com/aurorametrics/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
											<!--<li><a href="#" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li> -->
										</ul>
									</section>

								<!-- Copyright -->
									<div class="copyright">
										<ul class="menu">
											<li>&copy; Aurora Metrics. All rights reserved. 2015</li>
										</ul>
									</div>

							</div>

						</div>
					</div>
				</div>

		</div>

		<!-- Scripts -->
			<script src="http://mbostock.github.com/d3/d3.js"></script>
		    <script src="assets/js/gauge.js"></script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.onvisible.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="https://cdnjs.com/libraries/chart.js"></script>
			





	</body>
</html>