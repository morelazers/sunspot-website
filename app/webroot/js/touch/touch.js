var gridster

$(document).ready(function(){ //DOM Ready

	gridster = $(".gridster > ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [300, 300],
        min_cols: 6
    }).data('gridster');

	addMovementWidget();
	addSwitchWidget();
	/*addInteractionWidget();*/
	addLiveLightWidget();
	addLiveTempWidget();
	addTwitterWidget();
	addOverviewWidget();

	/*$("twitter-widget").draggable();*/

	$("#item-menu").hide();

	$(".sidebar-button").click(function(event){
		if($("#item-menu").is(":visible")){
			$("#item-menu").slideUp();
		} else {
			$("#item-menu").slideDown();
		}
	});

	$(".add-widget-button").click(function(){
		$(this).toggleClass("on-display");
	});

	$("#add-movement").click(function(event){
		if($("#movement").parent().is(":visible")){
			removeMovementWidget();
			$('#add-movement').css({'background-image':'url(../../img/touch/movement_icon_on.png)'});
		} else {
			addMovementWidget();
			$('#add-movement').css({'background-image':'url(../../img/touch/movement_icon.png)'});
		}
	});

	$("#add-switch").click(function(event){
		if($("#switch-colour-box").parent().is(":visible")){
			removeSwitchWidget();
			$('#add-switch').css({'background-image':'url(../../img/touch/switch_icon_on.png)'});
		} else {
			addSwitchWidget();
			$('#add-switch').css({'background-image':'url(../../img/touch/switch_icon.png)'});
		}
	});

	/*$("#add-interaction").click(function(event){
		if($("#live-interactions").parent().is(":visible")){
			removeInteractionWidget();
			$('#add-interaction').css({'background-image':'url(../../img/touch/interaction_icon_on.png)'});
		} else {
			addInteractionWidget();
			$('#add-interaction').css({'background-image':'url(../../img/touch/interaction_icon.png)'});
		}
	});*/

	$("#add-live-temp").click(function(event){
		if($("#live-temp-con").parent().is(":visible")){
			removeLiveTempWidget();
			$('#add-live-temp').css({'background-image':'url(../../img/touch/temp_icon_on.png)'});
		} else {
			addLiveTempWidget();
			$('#add-live-temp').css({'background-image':'url(../../img/touch/temp_icon.png)'});
		}
	});

	$("#add-live-light").click(function(event){
		if($("#live-light-con").parent().is(":visible")){
			removeLiveLightWidget();
			$('#add-live-light').css({'background-image':'url(../../img/touch/light_icon_on.png)'});
		} else {
			addLiveLightWidget();
			$('#add-live-light').css({'background-image':'url(../../img/touch/light_icon.png)'});
		}
	});

	$("#add-twitter").click(function(event){
		if($("#twitter-widget").parent().is(":visible")){
			removeTwitterWidget();
			$('#add-twitter').css({'background-image':'url(../../img/touch/twitter_icon_on.png)'});
		} else {
			addTwitterWidget();
			$('#add-twitter').css({'background-image':'url(../../img/touch/twitter_icon.png)'});
		}
	});

	$("#add-overview").click(function(event){
		if($("#overview-widget").parent().is(":visible")){
			removeOverviewWidget();
			$('#add-overview').css({'background-image':'url(../../img/touch/magnglass.png)'});
		} else {
			addOverviewWidget();
			$('#add-overview').css({'background-image':'url(../../img/touch/magnglassreverse.png)'});
		}
	});
	
});

function addMovementWidget(){
	//<div id="user-test" class="live-user-location zone-1"></div>
	gridster.add_widget('<li><div id="movement" class="grid-item"><div id="lab-zone-overlay"><div id="live-user-location-zones"><div id="zone-1" class="lab-zone zone-1"></div><div id="zone-2" class="lab-zone zone-2"></div><div id="zone-3" class="lab-zone zone-3"></div><div id="zone-4" class="lab-zone zone-4"></div><div id="zone-5" class="lab-zone zone-5"></div><div id="zone-6" class="lab-zone zone-6"></div></div></div></div></li>', 3, 1)
	.resizable();
	window.updateMovement = window.setInterval(getLiveMovement, 1000);
}

function removeMovementWidget(){
	gridster.remove_widget($("#movement").parent());
	window.clearInterval(window.updateMovement);
}

function addSwitchWidget(){
	gridster.add_widget('<li><div id="switch-colour-box" class="grid-item"></div></li>')
	.resizable();
	window.updateSwitch = window.setInterval(getLiveSwitchPress, 1000);
}

function removeSwitchWidget(){
	gridster.remove_widget($("#switch-colour-box").parent());
	window.clearInterval(window.updateSwitch);
}

function addInteractionWidget(){
	gridster.add_widget('<li><div id="live-interactions" class="grid-item"><div id="live-interaction-images"><div id="live-door-interactions" class="live-interaction-widget"></div><div id="live-fridge-interactions" class="live-interaction-widget"></div><div id="live-whiteboard-interactions" class="live-interaction-widget"></div></div></li>', 1, 1)
	.resizable();
}

function removeInteractionWidget(){
	gridster.remove_widget($("#live-interactions").parent());
}

function addLiveLightWidget(){
	gridster.add_widget('<li><div id="live-light-con" class="grid-item live-chart"><div id="live-light-chart" class="live-chart"></div></div></li>', 2, 1)
	.resizable();
	window.updateLight = window.setInterval(drawLiveLightChart, 1000);
}

function removeLiveLightWidget(){
	gridster.remove_widget($("#live-light-con").parent());
	window.clearInterval(window.updateLight);
}

function addLiveTempWidget(){
	gridster.add_widget('<li><div id="live-temp-con" class="grid-item live-chart"><div id="live-temp-chart" class="live-chart"></div></div></li>', 2, 1)
	.resizable();
	window.updateTemp = window.setInterval(drawLiveTempChart, 1000);
}

function removeLiveTempWidget(){
	gridster.remove_widget($("#live-temp-con").parent());
	window.clearInterval(window.updateTemp);
}

function addTwitterWidget(){
	//<div id="twitter-widget" class="in-grid"><a class="twitter-timeline" href="https://twitter.com/LUISl_s" data-widget-id="404626926985162752">Tweets by @LUISl_s</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
	//window.updateTweets = window.setInterval(getLiveTweets, 5000);
	gridster.add_widget('<li><div id="twitter-widget" class="in-grid"><div id="twitter-feed"></div></div></li>', 1, 1)
	.resizable();
	displayTweets();
}

function removeTwitterWidget(){
	gridster.remove_widget($("#twitter-widget").parent());
	//window.clearInterval(window.updateTweets);
}

function addOverviewWidget(){
	gridster.add_widget('<li><div id="overview-widget" class="in-grid"><div id="live-temp-light-widget"><div id="nodeOne"><img id="oneT_Img" src="../app/webroot/img/temp_mid.png"><h1 id="T1"></h1><img id="oneL_Img" src="../app/webroot/img/bulb_mid.png"><h2 id="L1"></h2></div><div id="nodeTwo"><img id="twoT_Img" src="../app/webroot/img/temp_mid.png"><h4 id="T2"></h4><img id="twoL_Img" src="../app/webroot/img/bulb_mid.png"><h3 id="L2"></h3></div><div id="nodeThree"><img id="threeT_Img" src="../app/webroot/img/temp_mid.png"><h5 id="T3"></h5><img id="threeL_Img" src="../app/webroot/img/bulb_mid.png"><h6 id="L3"></h6></div></div><div id ="live-usb-widget"><div id="nodeSeven"><img id="glove_Img" src="../app/webroot/img/usb_gloves.png"></div><div id="nodeEight"><img id="mini_fridge_Img" src="../app/webroot/img/usb_fridge.png"></div><div id="nodeNine"><img id="fan_Img" src="../app/webroot/img/usb_fan.png"></div> </div></div></li>', 2, 1);
	window.updateLightWidget = window.setInterval(getLiveLight, 500);
	window.updateTempWidget = window.setInterval(getLiveTemp, 500);
	window.updateActuator = window.setInterval(getActuatorData, 500);
}

function removeOverviewWidget(){
	gridster.remove_widget($("#overview-widget").parent());
	clearInterval(window.updateLightWidget);
    clearInterval(window.updateTempWidget);
    clearInterval(window.updateActuator);
}