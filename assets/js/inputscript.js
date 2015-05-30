<!-- Create Gauge Script -->					
				
			var gauges = [];
			
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
				createGauge("wavg", "W Average");

			}
			
			function updateGauges(rating)
			{
				for (var key in gauges)
				{
					var value = getValue(gauges[key], rating);
					gauges[key].redraw(value);
				}

			}
			
			function getValue(gauge, rating)
			{
				//opinion = 0.76;
				var overflow = 0; //10;
				return gauge.config.min - overflow + (gauge.config.max - gauge.config.min + overflow*2) *  rating;

			}
			
			function initialize()
			{
				createGauges();
				setInterval(updateGauges(rating), 1000);

			}


function ajax(window)
            {
            var ticker = page.document.getElementById("Input").value;  
            var xhr;  
             if (page.window.XMLHttpRequest) { // Mozilla, Safari, ...  
                xhr = new XMLHttpRequest();  
            } else if (page.window.ActiveXObject) { // IE 8 and older  
                xhr = new ActiveXObject("Microsoft.XMLHTTP");  
            }  
            var data = "ticker=" + ticker;
            xhr.open("POST", "twitterfeed.php", true);   
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
            xhr.send(data);  
            xhr.onreadystatechange = display_data;  
            function display_data() {  
            if (xhr.readyState == 4) {  
             if (xhr.status == 200) {  
              //alert(xhr.responseText);        
               page.document.getElementById("updatedgauge").innerHTML = xhr.responseText;  // <script type='text/javascript'> updateGauge($var1); updateGauge($var2); </script>
             } else {  
               alert('There was a problem with the request.');  
             }  
            }  
           }  
          }