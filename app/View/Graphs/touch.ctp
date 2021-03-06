<link href="./css/touch/touch.css" rel="stylesheet" type="text/css"/>
<link href="./css/touch/jquery.gridster.min.css" rel="stylesheet" type="text/css"/>



<div id="item-menu" class="item-list sidebar">
	<div class="button-container">
		<div id="add-movement" class="add-widget-button on-display"></div>
		<div id="add-switch" class="add-widget-button on-display"></div>
		<!-- <div id="add-interaction" class="add-widget-button on-display"></div> -->
		<div id="add-live-temp" class="add-widget-button on-display"></div>
		<div id="add-live-light" class="add-widget-button on-display"></div>
		<div id="add-twitter" class="add-widget-button on-display"></div>
		<div id="add-overview" class="add-widget-button on-display"></div>
	</div>
</div>

<div class="expand-sidebar">
	<img id="sidebar-button" src="../../img/touch/sidebar.png" class="sidebar-button">
</div>

<div class="gridster">
	<ul type="none">
		
	</ul>
</div>





<script src="js/vendor/jquery-1.10.2.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>



<script src="js/vendor/jquery-1.10.2.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!-- <script src="js/drawDailyLightChart.js"></script>
<script src="js/drawDailyTempChart.js"></script>
<script src="js/drawHourlyLightChart.js"></script>
<script src="js/drawHourlyTempChart.js"></script>
<script src="js/heatmapsrc/heatmap.js"></script>
<script src="js/overviewStats.js"></script>  -->

<!-- LIVE UPDATE SCRIPTS GO BEFORE SCRIPT.JS -->
<script src="js/getLiveMovementData.js"></script>
<!--<script src="js/getLiveInteractionData.js"></script>-->
<!-- <script src="js/getPastMovementData.js"></script> -->
<script src="js/getLiveSwitchPress.js"></script>
<script src="js/getTimelineData.js"></script>
<script src="js/TempLightWid.js"></script> 
<script src="js/liveCharts2.js"></script>
<script src="js/getActuatorData.js"></script>
<!-- <script src="js/touch/twittertouch.js"></script> -->
<!-- <script src="js/stopAllLiveUpdates.js"></script> -->
<!-- <script src="js/script.js"></script> -->
<!-- <script src="js/test.js"></script> -->

<script src="js/touch/touchpunch.js"></script>
<script src="js/touch/hammer.js"></script>
<script src="js/touch/jquery.gridster.min.js"></script>
<script src="js/touch/twitter.js"></script>
<script src="js/touch/touch.js"></script>


<script>
    google.load('visualization', '1.0', {'packages':['corechart']});
    var curDate = "";
    var curTime = "";
    var curDateTime = "";
    var liveTime = new Date();
    $(document).ready(function(){
        populateDayList();
        /*$("body").on('change', '#temp-hour-sel', hourChangeTemp);
        $("body").on('change', '#light-hour-sel', hourChangeLight);*/
        //drawLiveLightChart();
        //populateHourList();
        /*$("body").on('change', '#temp-date-sel', dateChangeTemp);
        $("body").on('change', '#light-date-sel', dateChangeLight);*/
        drawLiveTempChart();
    });
</script>