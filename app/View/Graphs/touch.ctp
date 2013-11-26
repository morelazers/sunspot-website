<link href="./css/touch/touch.css" rel="stylesheet" type="text/css"/>
<!-- <link href="./css/touch/jquery.gridster.min.css" rel="stylesheet" type="text/css"/> -->

<!-- <div id="item-list" class="side-list">
	<div>
	</div>
</div>
 -->


<div id="bin">
</div>

<div id="item-menu" class="item-list container">
	
	<!-- <div class="parent"> -->
		<div id="movement" class="in-grid" data-ss-colspan="3">
	        <!-- <div id="lab-img">
	            <img src="img/lab.png" />
	        </div> -->

	        <div id="lab-zone-overlay">
	            <!--<img src="img/pic.png" />-->

	            <div id="live-user-location-zones">
	                <div id="zone-1" class="lab-zone zone-1"></div>
	                <div id="zone-2" class="lab-zone zone-2"></div>
	                <div id="zone-3" class="lab-zone zone-3"></div>
	                <div id="zone-4" class="lab-zone zone-4"></div>
	                <div id="zone-5" class="lab-zone zone-5"></div>
	                <div id="zone-6" class="lab-zone zone-6"></div>
					        <div id="user-test" class="live-user-location zone-1"></div>
	            </div>

	        </div>
        </div>
	<!-- </div> -->
	<div id="switch-colour-box" class="in-grid">

    </div>
	<div id="live-interactions" class="in-grid">
		<div id="live-interaction-images">
			<div id="live-door-interactions" class="live-interaction-widget">

			</div>
			<div id="live-fridge-interactions" class="live-interaction-widget">

			</div>
			<div id="live-whiteboard-interactions" class="live-interaction-widget">

			</div>
		</div>
    </div>

</div>

<div class="main container">
	<div class="parent"></div>
</div>



<script src="js/vendor/jquery-1.10.2.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>



<script src="js/vendor/jquery-1.10.2.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="js/drawDailyLightChart.js"></script>
<script src="js/drawDailyTempChart.js"></script>
<script src="js/drawHourlyLightChart.js"></script>
<script src="js/drawHourlyTempChart.js"></script>
<script src="js/heatmapsrc/heatmap.js"></script>
<script src="js/overviewStats.js"></script> 

<!-- LIVE UPDATE SCRIPTS GO BEFORE SCRIPT.JS -->
<script src="js/getLiveMovementData.js"></script>
<!--<script src="js/getLiveInteractionData.js"></script>-->
<!-- <script src="js/getPastMovementData.js"></script> -->
<script src="js/getLiveSwitchPress.js"></script>
<script src="js/getTimelineData.js"></script>
<script src="js/TempLightWid.js"></script> 
<script src="js/liveCharts.js"></script>
<script src="js/stopAllLiveUpdates.js"></script>
<!-- <script src="js/script.js"></script> -->
<script src="js/test.js"></script>

<script src="js/touch/hammer.js"></script>
<script src="js/touch/touchpunch.js"></script>
<script src="js/touch/jquery.shapeshift.js"></script>
<script src="js/touch/jquery.gridster.min.js"></script>
<script src="js/touch/touch.js"></script>

<script>
    google.load('visualization', '1.0', {'packages':['corechart']});
    var curDate = "";
    var curTime = "";
    var curDateTime = "";
    var liveTime = new Date();
    $(document).ready(function(){
        populateDayList();
        $("body").on('change', '#temp-hour-sel', hourChangeTemp);
        $("body").on('change', '#light-hour-sel', hourChangeLight);
        //drawLiveLightChart();
        //populateHourList();
        $("body").on('change', '#temp-date-sel', dateChangeTemp);
        $("body").on('change', '#light-date-sel', dateChangeLight);
        //drawLiveTempChart();
    });
</script>