<link rel="stylesheet" href="css/main.css">

<div class="back-button popout-box">
    <img src="img/backarrow.png" />
</div>


<div class="header-container">
    <header class="wrapper clearfix">
        <h1 class="title">LUIS</h1>
    </header>
</div>

<div id="lab-screen" class="slider">    
    <div id="movement">
        <div id="lab-img">
            <img src="img/lab.png" />
        </div>

        <div id="lab-zone-overlay">
            <!--<img src="img/pic.png" />-->

            <div id="live-user-location-zones">
                <div id="zone-1" class="lab-zone zone-1"></div>
                <div id="zone-2" class="lab-zone zone-2"></div>
                <div id="zone-3" class="lab-zone zone-3"></div>
                <div id="zone-4" class="lab-zone zone-4"></div>
                <div id="zone-5" class="lab-zone zone-5"></div>
                <div id="zone-6" class="lab-zone zone-6"></div>
				        <!-- <div id="user-test" class="live-user-location zone-1"></div> -->
            </div>

        </div>

        <!-- <div id="heatmap-area"  style="width:868px;padding:0;height:252px;cursor:pointer;position:relative;margin-top:-290px;margin-left:375px"> -->
                
    </div>

    <div id="switch-colour-box">

    </div>
    
    <div id="live-interactions">
    <div id="live-interaction-images">
      <div id="live-door-interactions" class="live-interaction-widget">
        
      </div>
      <div id="live-fridge-interactions" class="live-interaction-widget">
        
      </div>
      <div id="live-whiteboard-interactions" class="live-interaction-widget">
        
      </div>
    </div>
      
      
      <!-- LIVE TWITTER FEED -->
      <a class="twitter-timeline" href="https://twitter.com/LUISl_s" data-widget-id="404626926985162752">Tweets by @LUISl_s</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      <!-- END LIVE TWITTER FEED -->
    </div>

    <!-- LIVE LIGHT CHARTS -->
    <div id="live-lab-charts">
      <div id="live-light-con">
        <div id="live-light-chart" class="live-chart"></div>
      </div>
      <div id="live-temp-con">
          <div id="live-temp-chart" class="live-chart"></div>
        </div>
    </div><!-- END LIVE CHARTS -->

</div>
   

<div id="lab-sidebar" class="slider-sidebar">
    <div id="lab-dropdown" class="sidebar-dropdown">
        <select class="sidebar-select">
            <ul class="transparent">
                <option value="movement">Movement</option>
                <option value="light">Light</option>
                <option value="temp">Temp</option></option>
                <option value="swithces">Interactions</option>
                <option value="swithces">Switches</option>
            </ul>
        </select>
    </div>
</div>

<div id="stats-screen" class="slider">

    <div id="static-light-chart" class="static-chart"></div>
    <div id="static-temp-chart" class="static-chart"></div>
	<div id="stats-interaction-items">
		<div id="stats-interaction-fridge" class="interaction-item"></div>
		<div id="stats-interaction-door" class="interaction-item"></div>
		<div id="stats-interaction-whiteboard" class="interaction-item"></div>
		<div id="stats-interaction-chart" class="interaction-chart"></div>
	</div>
    

    <div id="stats-sidebar" class="slider-sidebar">
        <div id="stats-dropdown" class="sidebar-dropdown">
            <select class="sidebar-select" class="dropdown">
                <ul class="transparent">
                    <option value="light">Light</option>
                    <option value="temperature">Temperature</option>
					          <option value="interactions">Interactions</option>
                </ul>
            </select>
        </div>
        <div id="charts-dropdown" class="sidebar-dropdown">
          <div id="charts-light-dropdown">
            <select class="sidebar-select" id="light-date-sel"></select>
            <select class="sidebar-select" id="light-hour-sel"></select>
          </div>
          <div id="charts-temp-dropdown">
            <select class="sidebar-select" id="temp-date-sel"></select>
            <select class="sidebar-select" id="temp-hour-sel"></select>
          </div>
        </div>
        <div id="interaction-items-dropdown" class="sidebar-dropdown">
            <select class="sidebar-select dropdown" id="interaction-item-select">
              <option value="fridge">Fridge</option>
              <option value="door">Door</option>
              <option value="whiteboard">Whiteboard</option>
            </select>
        </div>
    </div>
</div>
<div id="overview-screen" class="slider">
<div id="cup"></div>
<!--
  <div id="live-temp-light-widget">
  		<div id="nodeOne">
			<img id="oneT_Img" src="../app/webroot/img/temp_mid.png">
  			<h1 id="T1"></h1>
			<img id="oneL_Img" src="../app/webroot/img/bulb_mid.png">
  			<h2 id="L1"></h2>
  		</div>
  		<div id="nodeTwo">
			<img id="twoT_Img" src="../app/webroot/img/temp_mid.png">
  			<h4 id="T2"></h4>
			<img id="twoL_Img" src="../app/webroot/img/bulb_mid.png">
  			<h3 id="L2"></h3>
  		</div>
  		<div id="nodeThree">
			<img id="threeT_Img" src="../app/webroot/img/temp_mid.png">
  			<h5 id="T3"></h5>
			<img id="threeL_Img" src="../app/webroot/img/bulb_mid.png">
  			<h6 id="L3"></h6>
  		</div>
  </div>
  <div id ="live-interaction-widget">
  		<div id="nodeFour">
		<img id="door_Img" src="../app/webroot/img/door_wid.png">
		<p id="door_txt"></p>
  		</div>
  		<div id="nodeFive">
		<img id="fridge_Img" src="../app/webroot/img/fridge_wid.png">
		<p id="fridge_txt"></p>
  		</div>
  		<div id="nodeSix">
		<img id="whiteboard_Img" src="../app/webroot/img/whiteboard_wid.png">
		<p id="whiteboard_txt"></p>
  		</div> 
  </div>
  <div id ="live-usb-widget">
		<div id="nodeSeven">
		<img id="glove_Img" src="../app/webroot/img/usb_gloves.png">
  		</div>
  		<div id="nodeEight">
		<img id="mini_fridge_Img" src="../app/webroot/img/usb_fridge.png">
  		</div>
  		<div id="nodeNine">
		<img id="fan_Img" src="../app/webroot/img/usb_fan.png">
  		</div> 
  </div>
  -->
  
  
  <div id ="overview-text">
  <h4>Our Aim: </h4>
           <p>To create a smart-lab interactive information system. Transform our existing
           <br/> lab into something that we can interact with,receiving live and on-demand data!
           <br/>SCC.330 Final Year Project</p>
  
           More Info:
           <a href="http://www.lusi.lancs.ac.uk/OnlineCoursesHandbook/ModuleCatalogue/Module.aspx?Course=016890&Year=000113" data-toggle="modal" target="_blank" class="btn btn-info">Module Page<i></i></a>
          <a href="http://www.scc.lancs.ac.uk" data-toggle="modal" target="_blank" 
          class="btn btn-info">SCC Page<i></i></a>
          <a href="http://www.infolab21.lancs.ac.uk" data-toggle="modal" target="_blank"
          class="btn btn-info">InfoLab24 Page<i></i></a>
          <a href="http://www.lancaster.ac.uk" data-toggle="modal" target="_blank" 
          class="btn btn-info">Lancaster University Page<i></i></a>
      <p>The aim of the Smart Lab System (SLS) is to turn the Software Design Studio into a smart interactive
       lab.
       <br>
       In summary, the SLS shall<br>
       - Comprise a number of web services providing climactic, environment, notification, location
       and activity services<br>
       - Comprise a number of consumer applications for visualizing, controlling and managing the
       lab environment<br>
       - Comprise consumer applications for interfacing with Facebook and Twitter to provide
       periodic commentary on the happenings in the lab.</p>
  
          <h4>Sun Spot and Java Programming: </h4>
           <p>The project will be built using Sun's Spot Java Sensors. Programming
           <br>of the sensor devices is done using NetBeans 7.4 and
           <br>SUN Spot Java Sensors. Java, Javascript, HTML and CSS are being
           <br>used for other parts of the project,e.g. Website, Interface etc.
           <br/>SCC.330 Final Year Project</p>
  
  
  
           <a href="https://www.facebook.com/luisls" data-toggle="modal" target="_blank" 
          class="btn btn-info">Facebook<i></i></a>
          <a href="https://twitter.com/LUISl_s" data-toggle="modal" target="_blank"
          class="btn btn-info">Twitter<i></i></a>
  </div>  
</div>


<div id="control-container">
    <div class="main-container">
        <div class="main wrapper clearfix">
            <div class="button-box clearfix">
                <div class="popout-box homepage-button lab">
                    <span class="center-popout-text">
                        Lab                        
                    </span>
                </div>
                <div class="popout-box homepage-button stats">
                    <span class="center-popout-text">
                        Stats                        
                    </span>
                </div>
                <div class="popout-box homepage-button overview">
                    <span class="center-popout-text">
                        Overview                        
                    </span>
                </div>
            </div><!--#button-box-->
        </div> <!-- #main -->
    </div> <!-- #main-container -->
</div>

<div class="footer-container">
    <footer class="wrapper">
        <h3></h3>
    </footer>
</div>

<script type="text/javascript">
window.onload = function(){
 
    // heatmap configuration
    var config = {
        element: document.getElementById("heatmap-area"),
        radius: 100,
        opacity: 50,   
    };
    
    //creates and initializes the heatmap
    window.heatmap = h337.create(config);
};
</script>



<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> -->
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
<!--<script src="js/getTimelineData.js"></script>
<script src="js/TempLightWid.js"></script>
<script src="js/getActuatorData.js"></script> -->
<script src="js/cup/cup.js"></script>
<script src="js/cup/Three.js"></script>
<script src="js/cup/Detector.js"></script>
<script src="js/cup/Stats.js"></script>
<script src="js/cup/OrbitControls.js"></script>
<script src="js/cup/THREEx.KeyboardState.js"></script>
<script src="js/cup/THREEx.FullScreen.js"></script>
<script src="js/cup/THREEx.WindowResize.js"></script>
<script src="js/liveCharts.js"></script>
<script src="js/stopAllLiveUpdates.js"></script>
<script src="js/script.js"></script>
<!-- <script src="js/test.js"></script> -->
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


