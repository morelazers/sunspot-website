

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
            </div>

        </div>

        <!-- <div id="heatmap-area"  style="width:868px;padding:0;height:252px;cursor:pointer;position:relative;margin-top:-290px;margin-left:375px"> -->
                
    </div>

    <!-- <div id="lab-widgets">
        <div id="nodeOne">
            <div id="T1" class="live-widget-value">45</div>
            <div id="L1" class="live-widget-value">78</div>
        </div>
        <div id="nodeTwo">
            <div id="T2" class="live-widget-value">19</div>
            <div id="L2" class="live-widget-value">23</div>
        </div>
        <div id="nodeThree">
            <div id="T3" class="live-widget-value">39</div>
            <div id="L3" class="live-widget-value">10</div>
        </div>
    </div> -->

    <div id="switch-colour-box">

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
    <div id="lab-dropdown" class="dropdown">
        <select class="sidebar-select">
            <ul class="transparent">
                <option value="movement">Movement</option>
                <option value="light">Light</option>
                <option value="temp">Temp</option></option>
                <option value="swithces">Switches</option>
            </ul>
        </select>
    </div>
</div>

<div id="stats-screen" class="slider">

    <!--<div id="hourly-chart-div">
    </div>

    <div id="daily-chart-div">
   </div>-->
    <div id="static-light-chart" class="static-chart"></div>
    <div id="static-temp-chart" class="static-chart"></div>
    

    <div id="stats-sidebar" class="slider-sidebar">
        <div id="stats-dropdown" class="dropdown">
            <select class="sidebar-select">
                <ul class="transparent">
                    <option value="light">Light</option>
                    <option value="temperature">Temperature</option>
                </ul>
            </select>
        </div>
    </div>
</div>

<div id="overview-screen" class="slider">
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



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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
<script src="js/getPastMovementData.js"></script>
<script src="js/getLiveSwitchPress.js"></script>
<script src="js/TempLightWid.js"></script> 
<script src="js/liveCharts.js"></script>
<script src="js/stopAllLiveUpdates.js"></script>
<script src="js/script.js"></script>

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


