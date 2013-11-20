$(document).ready(function(){
  
    hideAll();
    stopAllLiveUpdates();
  
    $(".popout-box").mousedown(function(){
       	$(this).css("background", "#f16529");
    });
    $(".popout-box").mouseup(function(){
       	$(this).css("background", "#ff5335");
    });
    
    $(".homepage-button").click(function(){
      hideAll();
    	$(".back-button").fadeIn(1000);
    	$(".slider").css("height", (window.innerHeight - 378) + "px");
    });

	$(".lab").click(function(){
	  hideAll();
	  stopAllLiveUpdates();
        if($("#stats-screen").is(":visible")){
            $("#stats-sidebar").slideUp();
            $("#stats-screen").slideUp('medium', function(){
                $("#lab-screen").slideDown();
                $("#lab-sidebar").slideDown();
                $("#lab-zone-overlay").fadeIn(1000);
            });
        } else if ($("#overview-screen").is(":visible")){
            $("#overview-screen").slideUp('medium', function(){
                $("#lab-screen").slideDown();
                $("#lab-sidebar").slideDown();
                $("#lab-zone-overlay").fadeIn(1000);
            });
        } else {
            $("#lab-screen").slideDown();
            $("#lab-sidebar").slideDown();
            $("#lab-zone-overlay").fadeIn(1000);
        }
        loadLabMovementScreen();
    });

    $(".stats").click(function(){
      hideAll();
      stopAllLiveUpdates();
      drawDailyLightChart();
        if($("#lab-screen").is(":visible")){
            $("#lab-sidebar").slideUp();
            $("#lab-zone-overlay").fadeOut(200);
            $("#lab-screen").slideUp('medium', function(){
                $("#stats-screen").slideDown();
                $("#stats-sidebar").slideDown();
            });
        } else if ($("#overview-screen").is(":visible")){
            $("#overview-screen").slideUp('medium', function(){
                $("#stats-screen").slideDown();
                $("#stats-sidebar").slideDown();
            });
        } else {
            $("#stats-screen").slideDown();
            $("#stats-sidebar").slideDown();
        }
        loadStatsLightScreen();
    });
    
	$(".overview").click(function(){
	  hideAll();
    stopAllLiveUpdates();
        if($("#lab-screen").is(":visible")){
            $("#lab-sidebar").slideUp();
            $("#lab-zone-overlay").fadeOut(200);
            $("#lab-screen").slideUp('medium', function(){
                $("#overview-screen").slideDown();
                $("#overview-sidebar").slideDown();
            });
        } else if ($("#stats-screen").is(":visible")){
            $("#stats-sidebar").slideUp();
            $("#stats-screen").slideUp('medium', function(){
                $("#overview-screen").slideDown();
                $("#overview-sidebar").slideDown();
            });
        } else {
            $("#overview-screen").slideDown();
            $("#overview-sidebar").slideDown();
        }
    });
    
    $(".back-button").click(function(){
      hideAll();
      stopAllLiveUpdates();
    	$(".back-button").fadeOut(200);
        $("#lab-zone-overlay").fadeOut(200);
    	$(".slider").slideUp();
    	$(".slider-sidebar").slideUp();
        $("#graph-label").fadeOut(300);
        $("#switch-colour-box").hide();
    });


    $("#lab-dropdown").change(function(){
        hideAll();
        stopAllLiveUpdates();
        var selectedOpt = $("#lab-dropdown option:selected").text();
        if(selectedOpt == "Movement"){
          loadLabMovementScreen();
        } else if (selectedOpt == "Light"){
          loadLabLightScreen();
        } else if(selectedOpt == "Temp"){
          loadLabTempScreen();
        } else if (selectedOpt == "Switches"){
          loadLabSwitchData();
        }
    });

    $("#stats-dropdown").change(function(){
        hideAll();
        stopAllLiveUpdates();
        var selectedOpt = $("#stats-dropdown option:selected").text();
        if (selectedOpt == "Light"){
            $(".day-left-button").bind("click", function() {drawHourlyLightChart(2)});
            $(".day-right-button").bind("click", function() {drawHourlyLightChart(1)});
            loadStatsLightScreen();
        } else if (selectedOpt == "Temperature"){
            $(".day-left-button").bind("click", function() {drawHourlyTempChart(2)});
            $(".day-right-button").bind("click", function() {drawHourlyTempChart(1)});
            loadStatsTempScreen();
        }
    });
    
});  


function loadLabMovementScreen(){
        getLiveMovement();
        window.updateMovement = window.setInterval(getLiveMovement, 1000);
		window.updateSwitch = window.setInterval(getLiveSwitchPress, 500);
        $("#movement").show();
    }
    
    function loadLabLightScreen(){
      drawLiveLightChart();
      window.updateLight = window.setInterval(drawLiveLightChart, 10000);
      $("#live-light-chart").show();
    }
    
    function loadLabTempScreen(){
      drawLiveTempChart();
      window.updateTemp = window.setInterval(drawLiveTempChart, 10000);
      $("#live-temp-chart").show();
    }

    function loadLabWidgets(){
        getLiveLight();
        window.updateLightWidget = window.setInterval(getLiveLight, 500);
        getLiveTemp();
        window.updateTempWidget = window.setInterval(getLiveTemp, 500);
        $("#lab-widgets").show();
    }
    
    function loadLabSwitchData(){
        window.updateSwitch = window.setInterval(getLiveSwitchPress, 500);
        $("#switch-colour-box").show();
    }
    
    function hideAll(){
        $("#hourly-chart-div").hide();
        $("#movement").hide();
        $("#chart-nav-buttons").hide();
        $("#charts-dropdown").hide();
        $("#charts-temp-dropdown").hide();
        $("#charts-light-dropdown").hide();
        $("#lab-widgets").hide();
        $("#switch-colour-box").hide();
        $(".live-chart").hide();
        $(".static-chart").hide();
    }

    

    function loadStatsLightScreen(){
        drawDailyLightChart();
        $("#hourly-chart-div").show();
        $("#chart-nav-buttons").show();
        $("#charts-dropdown").show();
        $("#charts-light-dropdown").show();
    }

    function loadStatsTempScreen(){
        drawDailyTempChart();
        $("#static-temp-chart").show();
        $("#chart-nav-buttons").show();
        $("#charts-dropdown").show();
        $("#charts-temp-dropdown").show();
    }