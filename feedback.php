<p style="text-align: center">Result: <? print $resultData[0]; ?></p>
<p style="text-align: center">Weighted Average: <? print $resultData[1]; ?></p>
<p style="text-align: center">Sample size: <? print $resultData[2]; ?></p>
		<span id="avgGaugeContainer"></span>

		<span id="wavgGaugeContainer"></span>
	</br>
		<img  src=<?php print "'http://chart.finance.yahoo.com/z?s=".$_POST['Input'] . "'"?> alt="" />
		<span id="updatedgauge"></span>