<link href="./css/styles2.css" rel="stylesheet" type="text/css"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<div id="titleBar">
			Light - Live
		</div>
		<div id="content">
			<div id="main-live-light" class="main-div"></div>
			<div id="main-live-temp" class="main-div"></div>
			<div id="main-live-location" class="main-div"></div>
			<div id="main-live-interaction" class="main-div"></div>
		</div>
		<script>
		var liveTime = new Date();
		google.load('visualization', '1.0', {'packages':['corechart']});
		var cHeight = 800;
		var cWidth = 1200;
			$(document).ready(function () {
				drawLiveTempChart();
				$('#main-live-temp').hide();
				stopAllLiveUpdates();
				drawLiveLightChart();
				window.updateLight = window.setInterval(drawLiveLightChart, 5000);
				$('.main-div').hammer({prevent_default:true}).bind("dragleft",
				  	function(ev){
				  		switch(ev.target.id){
				  			case "main-live-light":
				  				stopAllLiveUpdates();
				  				$('#titleBar').text('Light - Live');
				  				$('#main-live-light').hide();
				  				$('#main-live-temp').show();
				  				window.updateTemp = window.setInterval(drawLiveTempChart, 5000);
				  				break;
				  			case "main-live-temp":
				  				stopAllLiveUpdates();
				  				$('#titleBar').text('Temp - Live');
				  				$('#main-live-temp').hide();
				  				$('#main-live-light').show();
				  				window.updateLight = window.setInterval(drawLiveLightChart, 5000);
				  				break;
				  			case "main-live-acts":
				  				break;
				  		}
				});
		    });
</script>
<script type="text/javascript" src="./js/jquery.hammer.js"></script>
<script type="text/javascript" src="./js/liveCharts2.js"></script>
<script type="text/javascript" src="./js/scripts.js"></script>